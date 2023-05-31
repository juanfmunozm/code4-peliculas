<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{
    public function index()
    {
        $etiquetaModel = new EtiquetaModel();

        $data = [
            'etiquetas' => $etiquetaModel->select('etiquetas.*, categorias.titulo as categoria')
                                        ->join('categorias','categorias.id = etiquetas.categoria_id')->paginate(3), //->find()
            'pager' => $etiquetaModel->pager                            
        ];

        return view('/dashboard/etiqueta/index',$data);
    }

    public function new()
    {        
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/etiqueta/new', [
            'categorias' => $categoriaModel->find(),
        ]);
    }

    public function show($id)
    {
        $EtiquetaModel = new EtiquetaModel();
        

        return view('/dashboard/etiqueta/show',[
            'etiqueta' => $EtiquetaModel->find($id)
                
        ]);
    }

    public function create()
    {
        $EtiquetaModel = new EtiquetaModel();
        if($this->validate('etiquetas')){
            $EtiquetaModel->insert($_POST);
            session()->setFlashdata('mensaje','Creada!');
            return redirect()->to('/dashboard/etiqueta');
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $EtiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();

        return view('/dashboard/etiqueta/edit',[
            'etiqueta' => $EtiquetaModel->find($id),
            'categorias' => $categoriaModel->find(),   
        ]);
        
    }

    public function update($id)
    {
        $EtiquetaModel = new EtiquetaModel();

       if($this->validate('etiquetas')){

            /*$this->request->getPost('titulo');
            $this->request->getPost('description');*/
            $EtiquetaModel->update($id,$_POST);
            
            //return redirect()->back();
            session()->setFlashdata('mensaje','Actualizada!');
            return redirect()->to('/dashboard/etiqueta');
            
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();;
        } 
        
    }

    public function delete($id)
    {
        $EtiquetaModel = new EtiquetaModel();
        $EtiquetaModel->delete($id);
        session()->setFlashdata('mensaje','Eliminada!');
        return redirect()->back();
    }


}