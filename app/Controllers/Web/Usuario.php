<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function create_user()
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->insert(
            [
                'usuario' => 'admin',
                'email' => 'admin@gmail.com',
                'contrasena' => $usuarioModel->contrasenaHash('12345')
            ]
        );
    }

    public function login()
    {
        echo view('web/usuario/login');
    }

    public function login_post()
    {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');

        $usuario = $usuarioModel->select('id,usuario,email,contrasena,tipo')
        ->orWhere('email',$email)
        ->orWhere('usuario',$email)
        ->first();

        if($usuario && $usuarioModel->contrasenaVerificar($contrasena,$usuario->contrasena))
        {            
           // $session = session();
            unset($usuario->contrasena);
           // $session->set('usuario',$usuario);

            session()->set('usuario',$usuario);

            return redirect()->to('/dashboard/categoria')->with('mensaje','Bienvenido '.$usuario->usuario);            
        }
  
        return redirect()->back()->with('mensaje','Usuario y/o contraseña invalidas');
    }

    public function register()
    {
        echo view('web/usuario/register');
    }

    public function register_post()
    {
        $usuarioModel = new UsuarioModel();

        if($this->validate('usuarios'))
        {
            $usuarioModel->insert([
                'usuario' => $this->request->getPost('usuario'),
                'email'   => $this->request->getPost('email'),  
                'contrasena' => $usuarioModel->contrasenaHash( $this->request->getPost('contrasena'))                               
            ]);

            return redirect()->to(route_to('usuario.login'))->with('mensaje','Registro Correcto');            
        }
        else{
            session()->setFlashdata('errorValidation',$this->validator->listErrors());
            return redirect()->back()->withInput();       
        } 
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('usuario.login'));
    }

}
