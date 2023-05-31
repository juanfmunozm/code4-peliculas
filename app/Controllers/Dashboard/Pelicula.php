<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')
                                        ->join('categorias','categorias.id = peliculas.categoria_id')->paginate(3),
            'pager' =>   $peliculaModel->pager                          
        ];

        return view('/dashboard/pelicula/index',$data);
    }

    public function new()
    {        
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/pelicula/new', [
            'categorias' => $categoriaModel->find(),
        ]);
    }

    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagenById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id)            
        ]);
    }

    public function create()
    {
        $peliculaModel = new PeliculaModel();
        if($this->validate('peliculas')){
            /*$data = [
                'titulo' => $_POST['titulo'],
                'description'    => $_POST['description'],
            ];*/
            // $this->request->getPost('titulo');
            $peliculaModel->insert($_POST);
            session()->setFlashdata('mensaje','Creada!');
            return redirect()->to('/dashboard/pelicula');
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/pelicula/edit',[
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find()
        ]);
        
    }

    public function update($id)
    {
        $peliculaModel = new PeliculaModel();

       if($this->validate('peliculas')){

            /*$this->request->getPost('titulo');
            $this->request->getPost('description');*/
            $peliculaModel->update($id,$_POST);

            $this->asignar_imagen($id);
            
            //return redirect()->back();
            session()->setFlashdata('mensaje','Actualizada!');
            return redirect()->to('/dashboard/pelicula');
            
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();;
        } 
        
    }

    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        session()->setFlashdata('mensaje','Eliminada!');
        return redirect()->back();
    }

    public function descargar_imagen($imagenId)
    {
        $imageModel = new ImagenModel();
        $imagen = $imageModel->find($imagenId);
        if($imagen == null){
            return 'no existe imagen';
        }
        return $this->response->download('uploads/peliculas/'.$imagen->imagen,null)->setFileName('imagen'.$imagenId.'.jpg');
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

        return redirect()->back()->with('mensaje','Imagen eliminada');

    }

    private function asignar_imagen($peliculaId)
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
                            'data'  => json_encode(get_file_info('../public/uploads/peliculas/'.$imageNombre))             
                        ]
                    );

                    $peliculaImagenModel = new PeliculaImagenModel();
                    $peliculaImagenModel->insert(
                        [
                            'pelicula_id' => $peliculaId,
                            'imagen_id' => $imagenId                
                        ]
                    );                
                }


                return $this->validator->listErrors();
            }            
        }
    }
    private function generar_imagen()
    {
        $imagenModel = new ImagenModel();
        $imagenModel->insert(
            [
                'imagen' => date('Y-m-d H:m:s'),
                'extension' => 'Pendiente',
                'data'  => 'Pendiente'                
            ]
        );
    }

    /*private function asginar_imagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert(
            [
                'pelicula_id' => 1,
                'imagen_id' => 5                
            ]
        );
    }*/

    public function etiquetas($id)
    {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if($categoriaId = $this->request->getGet('categoria_id'))
        {
            $etiquetas = $etiquetaModel->where('categoria_id',$categoriaId)->findAll();
        }

        return view('dashboard/pelicula/etiquetas',
            [
                'pelicula' => $peliculaModel->find($id),
                'categorias' => $categoriaModel->findAll(),
                'categoria_id' => $categoriaId,
                'etiquetas' => $etiquetas
            ]
        );
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

        return redirect()->back();
    }

    public function etiqueta_delete($id,$etiquetaId)
    {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();

        $peliculaEtiquetaModel->where('etiqueta_id',$etiquetaId)
        ->where('pelicula_id',$id)->delete();
        echo '{"mensaje" : "Etiqueta Eliminada"}';
        //return redirect()->back()->with('mensaje','Etiqueta Eliminada');
    }

    public function image($image)
    {
        if(!$image){
            $image = $this->request->getGet('image');
        }
        $name = WRITEPATH . 'uploads/peliculas/' . $image;
        if(!file_exists($name))
        {
            throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($name,'rb');

        header("Content-Type: image/png");
        header("Content-length: ". filesize($name));

        fpassthru($fp);
        exit;


    }

}