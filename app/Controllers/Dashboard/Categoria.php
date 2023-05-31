<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    public function textRutaNombre()
    {
        echo "ruta nombre";
    }

    public function index()
    {
        session()->set('user','usernombre');
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/categoria/index',[
            'categorias' => $categoriaModel->paginate(3), //->findAll()
            'pager' => $categoriaModel->pager
        ]);
    }

    public function show($id)
    {
        $categoriaModel= new CategoriaModel();

        return view('dashboard/categoria/show',[
            'categoria' => $categoriaModel->find($id)
        ]);
    }

    public function new()
    {
        //return redirect()->route('test');
        return view('/dashboard/categoria/new');
    }

    public function create()
    {
        $categoriaModel= new CategoriaModel();
        if($this->validate('categorias')){
            /*$data = [
                'titulo' => $_POST['titulo'],
                'description'    => $_POST['description'],
            ];*/
            // $this->request->getPost('titulo');
            $categoriaModel->insert($_POST);
            return redirect()->to('/dashboard/categoria')->with('mensaje','Creada!');
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }

    }

    public function edit($id)
    {
        $categoriaModel= new CategoriaModel();

        return view('dashboard/categoria/edit',[
            'categoria' => $categoriaModel->find($id)
        ]);
        
    }

    public function update($id)
    {
        $categoriaModel= new CategoriaModel();
        if($this->validate('categorias')){
            /*$this->request->getPost('titulo');
            $this->request->getPost('description');*/
            $categoriaModel->update($id,$_POST);
            return redirect()->to('/dashboard/categoria')->with('mensaje','Actualizada!');
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $categoriaModel= new CategoriaModel();
        $categoriaModel->delete($id);
        session()->setFlashdata('mensaje','Eliminada!');
        return redirect()->back();
        //return redirect()->back()->with('mensaje','Eliminada!');
    }

}