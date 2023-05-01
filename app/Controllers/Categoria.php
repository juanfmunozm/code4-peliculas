<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaModel();

        return view('/categoria/index',[
            'categorias' => $categoriaModel->findAll()
        ]);
    }

    public function new()
    {
        return view('/categoria/new');
    }

    public function show($id)
    {
        $categoriaModel= new CategoriaModel();

        return view('categoria/show',[
            'categoria' => $categoriaModel->find($id)
        ]);
    }

    public function create()
    {
        $categoriaModel= new CategoriaModel();
        /*$data = [
            'titulo' => $_POST['titulo'],
            'description'    => $_POST['description'],
        ];*/
        // $this->request->getPost('titulo');
        $categoriaModel->insert($_POST);
        echo "Creado!";

    }

    public function edit($id)
    {
        $categoriaModel= new CategoriaModel();

        return view('categoria/edit',[
            'categoria' => $categoriaModel->find($id)
        ]);
        
    }

    public function update($id)
    {
        $categoriaModel= new CategoriaModel();
        /*$this->request->getPost('titulo');
        $this->request->getPost('description');*/
        $categoriaModel->update($id,$_POST);
        echo "Actualizado!";
    }

    public function delete($id)
    {
        $categoriaModel= new CategoriaModel();
        $categoriaModel->delete($id);
        echo "Eliminado!";
    }

}