<?php

namespace App\Controllers\Api;

use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController
{

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function paginado()
    {
        return $this->respond($this->model->paginate(10));
    }

    public function paginado_full()
    {
        $peliculas = $this->model
        ->when($this->request->getGet('buscar'), static function($query, $buscar)
        {
            $query->groupStart()->orLike('peliculas.titulo',$buscar,'both');
            $query->orLike('peliculas.description',$buscar,'both')->groupEnd();
        })
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
        
        if($categoria_id = $this->request->getGet('categoria_id')){
            $peliculas = $peliculas->where('peliculas.categoria_id',$categoria_id);     
        }
        if($etiqueta_id = $this->request->getGet('etiqueta_id')){
            $peliculas = $peliculas->where('etiquetas.id',$etiqueta_id);
        }
        
        $peliculas = $peliculas->groupBy('peliculas.id');
        //$peliculas = $peliculas->paginate(10);

        return $this->respond($peliculas->paginate(10));
    }

    public function index_por_categoria($categoriaId)
    {
        $peliculas = $this->model
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
    
        $peliculas = $peliculas->where('peliculas.categoria_id',$categoriaId);     
        
        $peliculas = $peliculas->groupBy('peliculas.id');

        return $this->respond($peliculas->paginate(10));
    }

    public function index_por_etiqueta($etiquetaId)
    {
        $peliculas = $this->model
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(etiquetas.titulo) as etiquetas, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_id','left')
        ->join('etiquetas','etiquetas.categoria_id = categorias.id','left')
        ->join('pelicula_imagen','pelicula_imagen.pelicula_id = peliculas.id','left')
        ->join('imagenes', 'pelicula_imagen.imagen_id = imagenes.id','left');
    
        $peliculas = $peliculas->where('etiquetas.id',$etiquetaId); 
        
        $peliculas = $peliculas->groupBy('peliculas.id');

        return $this->respond($peliculas->paginate(10));
    }

    public function show($id = null)
    {
        $data = [
            'pelicula' => $this->model->select('peliculas.*, categorias.titulo as categoria')->join('categorias','categorias.id = peliculas.categoria_id')->find($id),
            'imagenes' => $this->model->getImagenById($id),
            'etiquetas' => $this->model->getEtiquetasById($id)  
        ];
        return $this->respond($data);
    }

    public function create()
    {
        if($this->validate('peliculas')) {            
           $id = $this->model->insert($_POST);
        }
        else {
            return $this->respond($this->validator->getErrors(),400);
        }

        return $this->respond($id);
    }

    public function update($id = null)
    { 
        
       if($this->validate('peliculas'))
       {
            $this->model->update($id,$this->request->getRawInput());
            return $this->respond($id);
        }
        else {
            return $this->respond($this->validator->getErrors(),400);
        }
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        return $this->respond('ok');
    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();


        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id',$etiquetaId)
                              ->where('pelicula_id',$peliculaId)->first();
        if(!$peliculaEtiqueta)
        {
           $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId                
                ]
            );
        }

        return $this->respond('ok');
    }

    public function etiqueta_delete($id,$etiquetaId)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $peliculaEtiquetaModel->where('etiqueta_id',$etiquetaId)
        ->where('pelicula_id',$id)->delete();
        return $this->respond('{"mensaje" : "Etiqueta Eliminada"}');
        //return redirect()->back()->with('mensaje','Etiqueta Eliminada');
    }

    public function upload($peliculaId)
    {
        helper('filesystem');

        if($imagefile = $this->request->getFile('imagen'))
        {
            if($imagefile->isValid())
            {
                $validated = $this->validate([
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image,image/png]',
                    'max_size[imagen,8000]'
                ]);        

                if($validated)
                {
                    $imageNombre = $imagefile->getRandomName();
                    $ext = $imagefile->getExtension();
                    //$imagefile->move(WRITEPATH . 'uploads/peliculas', $imageNombre);
                    $imagefile->move('../public/uploads/peliculas', $imageNombre);
                    $imagenModel = new ImagenModel();
                    $imagenId = $imagenModel->insert(
                        [
                            'imagen' => $imageNombre,
                            'extension' => $ext,
                            'data'  => json_encode(get_file_info('../public/uploads/peliculas'.$imageNombre))             
                        ]
                    );

                    $peliculaImagenModel = new PeliculaImagenModel();
                    $peliculaImagenModel->insert(
                        [
                            'pelicula_id' => $peliculaId,
                            'imagen_id' => $imagenId                
                        ]
                    );  
                    
                    return $this->respond('Imagen cargada correctamente');
                }
            }            
        }
        return $this->respond('Error cargando imagen');
    }

    public function borrar_imagen($imagenId)
    {
        $imageModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();

        //Borrar imagen en directorio
        $imagen = $imageModel->find($imagenId);
        if($imagen == null){
            return 'no existe imagen';
        }

        $imageRuta = 'uploads/peliculas/'.$imagen->imagen;
        unlink($imageRuta);

        $peliculaImagenModel->where('imagen_id',$imagenId)->delete();
        $imageModel->delete($imagenId);

        return $this->respond('Imagen eliminada');

    }
}

?>
