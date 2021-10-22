<?php

namespace App\Controllers;
use App\Models\ModeloRecuperar;
use App\Models\ModeloDashboard;
header('Access-Control-Allow-Origin: *');
class Recuperar extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloRecuperar();
        
    }
    public function index()
    {

        $datos1['title'] = 'RECUPERAR';
        $datos1['links'] = null;
        $datos1['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
        $datos1['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
        $datos1['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';
        $datos1['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
        $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
        $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
        $modelo = $this->ElModelo;
        $query = $modelo->datos_empresa(1);
        $datos['result'] = $query->getResultArray();
        echo view('header',$datos1);
        $a = rand(1,9999);
        $src = base_url("/assets/js/funciones/funciones_login.js?t".$a."=".$a);
        $datos3['url'] = '<script src="'.$src.'" ></script>';
        echo view('recuperar',$datos);
        echo view('footer',$datos3);
    }
    function enviar(){
        $username = $this->request->getPost('username');
        $modelo = $this->ElModelo;
        $query = $modelo->verificar_username($username);
        if(count($query->getResultArray()) > 0){
            $datos = $query->getResultArray();
            foreach ($datos as $key => $value) {
                $id_usuario = $value['id_usuario'];
                $id_tipo_usuario = $value['id_tipo_usuario'];
                $id_dependiente = $value['id_dependiente'];
                $id_admin_sucursal = $value['id_admin_sucursal'];
            }
            $query2 = $modelo->traer_correo($id_tipo_usuario, $id_dependiente, $id_admin_sucursal);
            if(count($query2->getResultArray()) > 0){
                $datos = $query2->getResultArray();
                foreach ($datos as $key => $value){
                    $correo = $value['correo'];
                }
                $destino = $correo;
                $asunto = "Recuperacion de Cuenta";
                $headers = "From: soporte@web-uis.com". "\r\n";
                $headers .= "CC:  soporte@web-uis.com";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $id = md5($id_usuario);
                $message = '<!doctype html>
                                <html>
                                    <head>
                                      <meta name="viewport" content="width=device-width" />
                                      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                      <title>Your Ideal Solution</title>
                                      <style>
                                        /* -------------------------------------
                                            GLOBAL RESETS
                                        ------------------------------------- */
                                        img {
                                          border: none;
                                          -ms-interpolation-mode: bicubic;
                                          max-width: 100%; }
          
                                        body {
                                          background-color: #f6f6f6;
                                          font-family: sans-serif;
                                          -webkit-font-smoothing: antialiased;
                                          font-size: 14px;
                                          line-height: 1.4;
                                          margin: 0;
                                          padding: 0;
                                          -ms-text-size-adjust: 100%;
                                          -webkit-text-size-adjust: 100%; }
          
                                        table {
                                          border-collapse: separate;
                                          mso-table-lspace: 0pt;
                                          mso-table-rspace: 0pt;
                                          width: 100%; }
                                          table td {
                                            font-family: sans-serif;
                                            font-size: 14px;
                                            vertical-align: top; }
          
                                        /* -------------------------------------
                                            BODY & CONTAINER
                                        ------------------------------------- */
          
                                        .body {
                                          background-color: #f6f6f6;
                                          width: 100%; }
          
                                        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                                        .container {
                                          display: block;
                                          Margin: 0 auto !important;
                                          /* makes it centered */
                                          max-width: 580px;
                                          padding: 10px;
                                          width: 580px; }
          
                                        /* This should also be a block element, so that it will fill 100% of the .container */
                                        .content {
                                          box-sizing: border-box;
                                          display: block;
                                          Margin: 0 auto;
                                          max-width: 580px;
                                          padding: 10px; }
          
                                        /* -------------------------------------
                                            HEADER, FOOTER, MAIN
                                        ------------------------------------- */
                                        .main {
                                          background: #ffffff;
                                          border-radius: 3px;
                                          width: 100%; }
          
                                        .wrapper {
                                          box-sizing: border-box;
                                          padding: 20px; }
          
                                        .content-block {
                                          padding-bottom: 10px;
                                          padding-top: 10px;
                                        }
          
                                        .footer {
                                          clear: both;
                                          Margin-top: 10px;
                                          text-align: center;
                                          width: 100%; }
                                          .footer td,
                                          .footer p,
                                          .footer span,
                                          .footer a {
                                            color: #999999;
                                            font-size: 12px;
                                            text-align: center; }
          
                                        /* -------------------------------------
                                            TYPOGRAPHY
                                        ------------------------------------- */
                                        h1,
                                        h2,
                                        h3,
                                        h4 {
                                          color: #000000;
                                          font-family: sans-serif;
                                          font-weight: 400;
                                          line-height: 1.4;
                                          margin: 0;
                                          Margin-bottom: 30px; }
          
                                        h1 {
                                          font-size: 35px;
                                          font-weight: 300;
                                          text-align: center;
                                          text-transform: capitalize; }
          
                                        p,
                                        ul,
                                        ol {
                                          font-family: sans-serif;
                                          font-size: 14px;
                                          font-weight: normal;
                                          margin: 0;
                                          Margin-bottom: 15px; }
                                          p li,
                                          ul li,
                                          ol li {
                                            list-style-position: inside;
                                            margin-left: 5px; }
          
                                        a {
                                          color: #3498db;
                                          text-decoration: underline; }
          
                                        /* -------------------------------------
                                            BUTTONS
                                        ------------------------------------- */
                                        .btn {
                                          box-sizing: border-box;
                                          width: 100%; }
                                          .btn > tbody > tr > td {
                                            padding-bottom: 15px; }
                                          .btn table {
                                            width: auto; }
                                          .btn table td {
                                            background-color: #ffffff;
                                            border-radius: 5px;
                                            text-align: center; }
                                          .btn a {
                                            background-color: #ffffff;
                                            border: solid 1px #3498db;
                                            border-radius: 5px;
                                            box-sizing: border-box;
                                            color: #3498db;
                                            cursor: pointer;
                                            display: inline-block;
                                            font-size: 14px;
                                            font-weight: bold;
                                            margin: 0;
                                            padding: 12px 25px;
                                            text-decoration: none;
                                            text-transform: capitalize; }
          
                                        .btn-primary table td {
                                          background-color: #3498db; }
          
                                        .btn-primary a {
                                          background-color: #3498db;
                                          border-color: #3498db;
                                          color: #ffffff; }
          
                                        /* -------------------------------------
                                            OTHER STYLES THAT MIGHT BE USEFUL
                                        ------------------------------------- */
                                        .last {
                                          margin-bottom: 0; }
          
                                        .first {
                                          margin-top: 0; }
          
                                        .align-center {
                                          text-align: center; }
          
                                        .align-right {
                                          text-align: right; }
          
                                        .align-left {
                                          text-align: left; }
          
                                        .clear {
                                          clear: both; }
          
                                        .mt0 {
                                          margin-top: 0; }
          
                                        .mb0 {
                                          margin-bottom: 0; }
          
                                        .preheader {
                                          color: transparent;
                                          display: none;
                                          height: 0;
                                          max-height: 0;
                                          max-width: 0;
                                          opacity: 0;
                                          overflow: hidden;
                                          mso-hide: all;
                                          visibility: hidden;
                                          width: 0; }
          
                                        .powered-by a {
                                          text-decoration: none; }
          
                                        hr {
                                          border: 0;
                                          border-bottom: 1px solid #f6f6f6;
                                          Margin: 20px 0; }
          
                                        /* -------------------------------------
                                            RESPONSIVE AND MOBILE FRIENDLY STYLES
                                        ------------------------------------- */
                                        @media only screen and (max-width: 620px) {
                                          table[class=body] h1 {
                                            font-size: 28px !important;
                                            margin-bottom: 10px !important; }
                                          table[class=body] p,
                                          table[class=body] ul,
                                          table[class=body] ol,
                                          table[class=body] td,
                                          table[class=body] span,
                                          table[class=body] a {
                                            font-size: 16px !important; }
                                          table[class=body] .wrapper,
                                          table[class=body] .article {
                                            padding: 10px !important; }
                                          table[class=body] .content {
                                            padding: 0 !important; }
                                          table[class=body] .container {
                                            padding: 0 !important;
                                            width: 100% !important; }
                                          table[class=body] .main {
                                            border-left-width: 0 !important;
                                            border-radius: 0 !important;
                                            border-right-width: 0 !important; }
                                          table[class=body] .btn table {
                                            width: 100% !important; }
                                          table[class=body] .btn a {
                                            width: 100% !important; }
                                          table[class=body] .img-responsive {
                                            height: auto !important;
                                            max-width: 100% !important;
                                            width: auto !important; }}
          
                                        /* -------------------------------------
                                            PRESERVE THESE STYLES IN THE HEAD
                                        ------------------------------------- */
                                        @media all {
                                          .ExternalClass {
                                            width: 100%; }
                                          .ExternalClass,
                                          .ExternalClass p,
                                          .ExternalClass span,
                                          .ExternalClass font,
                                          .ExternalClass td,
                                          .ExternalClass div {
                                            line-height: 100%; }
                                          .apple-link a {
                                            color: inherit !important;
                                            font-family: inherit !important;
                                            font-size: inherit !important;
                                            font-weight: inherit !important;
                                            line-height: inherit !important;
                                            text-decoration: none !important; }
                                          .btn-primary table td:hover {
                                            background-color: #34495e !important; }
                                          .btn-primary a:hover {
                                            background-color: #34495e !important;
                                            border-color: #34495e !important; } }
          
                                      </style>
                                    </head>
                                    <body class="">
                                      <table border="0" cellpadding="0" cellspacing="0" class="body">
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td class="container">
                                            <div class="content">
          
                                              <!-- START CENTERED WHITE CONTAINER -->
                                              <span class="preheader">Envio de Recuperacion de Cuenta</span>
                                              <table class="main">
          
                                                <!-- START MAIN CONTENT AREA -->
                                                <tr>
                                                  <td class="wrapper">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td>
                                                            <p>Reciba un cordial saludo del <b>Your Ideal Solution</b></p>
                                                            <p>Enviamos la Recuperacion de las credenciales de su cuenta</p>
                                                            <p>En el Sistema de <b>Cuponeria y Ofertas</b></p>
                                                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                                <tbody>
                                                                <tr>
                                                                    <td align="left">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td> <a href="https://web-uis.com/consola/recuperar/recuperar_cuenta?id='.$id.'" target="_blank">Recuperar Cuenta</a> </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <p>'.ucfirst(strtolower(date("d-m-Y"))).', '.date("H:i:s").' </p>
                                                        </td>
                                                        <td>
                                                            <img src="https://www.web-uis.com/assets/images/log.svg" class="image" alt="" />
                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </td>
                                                </tr>
          
                                              <!-- END MAIN CONTENT AREA -->
                                              </table>
          
                                              <!-- START FOOTER -->
                                              <div class="footer">
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td class="content-block">
                                                      <span class="apple-link">Equipo de UIS</span>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </div>
                                              <!-- END FOOTER -->
          
                                            <!-- END CENTERED WHITE CONTAINER -->
                                            </div>
                                          </td>
                                          <td>&nbsp;</td>
                                        </tr>
                                      </table>
                                    </body>
                                  </html>';
                                  if(mail($destino,$asunto,$message,$headers)){
                                        $xdatos['typeinfo'] ="Success";
                                        $xdatos['msg'] = "Link de Recuperacion Enviado Exitosamente.";
                                  }
                                  else{
                                        $xdatos['typeinfo'] ="Error";
                                        $xdatos['msg'] = "No se pudo Completar la Operacion, Intente mas Tarde.";
                                  }  
            }
            else{
                $xdatos['typeinfo'] ="Error";
                $xdatos['msg'] = "No existe ese usuario!";
            }
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "No existe ese usuario!";
        }
        echo json_encode($xdatos);
    }

    function recuperar_cuenta(){
        $id = $this->request->getGet('id');
        $modelo = $this->ElModelo;
        $query = $modelo->verificar_id($id);
        if($query == 0){
            return redirect()->to('login?id_request=2'); 
        }
        else{
            $datos['id_cuenta_recuperar'] = $query;
            $datos1['title'] = 'RECUPERAR';
            $datos1['links'] = null;
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
            $modelo = $this->ElModelo;
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            echo view('header',$datos1);
            $a = rand(1,9999);
            $src = base_url("/assets/js/funciones/funciones_login.js?t".$a."=".$a);
            $datos3['url'] = '<script src="'.$src.'" ></script>';
            echo view('recuperar_cuenta',$datos);
            echo view('footer',$datos3);
        }
    }
    function cambiar(){
        $password = $this->request->getPost('password');
        $id_usuario = $this->request->getPost('id_cuenta_recuperar');
        $modelo = $this->ElModelo;
        $query = $modelo->cambiar_password($password,$id_usuario);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Contraseña Cambiada Con Exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La Contraseña no se pudo Cambiar!";
        }
        echo json_encode($xdatos);
    }
}