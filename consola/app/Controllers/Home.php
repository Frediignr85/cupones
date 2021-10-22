<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
class Home extends BaseController
{
    public function index()
    {
        $datos['hola'] = "perro";
        return view('welcome_message',$datos);
    }
}
