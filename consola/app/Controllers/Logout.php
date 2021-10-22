<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
class Logout extends BaseController
{
    public function index()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('login'); 
    }
}
