<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        $data = [
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')
                                        ->join('categorias','categorias.id = peliculas.categoria_id')->find()
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

    private function asginar_imagen()
    {
        $peliculaImagenModel = new PeliculaImagenModel();
        $peliculaImagenModel->insert(
            [
                'pelicula_id' => 1,
                'imagen_id' => 5                
            ]
        );
    }

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

}