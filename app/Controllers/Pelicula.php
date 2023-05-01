<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        return view('/pelicula/index',[
            'peliculas' => $peliculaModel->findAll()
        ]);
    }

    public function new()
    {
        return view('/pelicula/new');
    }

    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('pelicula/show',[
            'pelicula' => $peliculaModel->find($id)
        ]);
    }

    public function create()
    {
        $peliculaModel = new PeliculaModel();
        /*$data = [
            'titulo' => $_POST['titulo'],
            'description'    => $_POST['description'],
        ];*/
        // $this->request->getPost('titulo');
        $peliculaModel->insert($_POST);
        echo "Creado!";

    }

    public function edit($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('pelicula/edit',[
            'pelicula' => $peliculaModel->find($id)
        ]);
        
    }

    public function update($id)
    {
        $peliculaModel = new PeliculaModel();
        /*$this->request->getPost('titulo');
        $this->request->getPost('description');*/
        $peliculaModel->update($id,$_POST);
        echo "Actualizado!";
    }

    public function delete($id)
    {
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);
        echo "Eliminado!";
    }

}