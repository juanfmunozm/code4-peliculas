<?php

namespace App\Controllers\Dashboard;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function update($id)
    {

    
    }    

}
