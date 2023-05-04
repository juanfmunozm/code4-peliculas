<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    public function index()
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/pelicula/index',[
            'peliculas' => $peliculaModel->findAll()
        ]);
    }

    public function new()
    {        
        return view('/dashboard/pelicula/new');
    }

    public function show($id)
    {
        $peliculaModel = new PeliculaModel();

        return view('/dashboard/pelicula/show',[
            'pelicula' => $peliculaModel->find($id)
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

        return view('/dashboard/pelicula/edit',[
            'pelicula' => $peliculaModel->find($id)
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

}