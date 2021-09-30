<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $datos['hola'] = "perro";
        return view('welcome_message',$datos);
    }
}
