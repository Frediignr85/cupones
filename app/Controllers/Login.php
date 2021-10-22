<?php

namespace App\Controllers;
use App\Models\ModeloLogin;
header('Access-Control-Allow-Origin: *');
class Login extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloLogin();
    }
    public function index()
    {
        $datos['hola'] = "perro";
        return view('login',$datos);
    }
    public function registro(){
        $modelo = $this->ElModelo;
        $nombre = $this->request->getPost('nombre');
        $direccion = $this->request->getPost('direccion');
        $telefono = $this->request->getPost('telefono');
        $dui = $this->request->getPost('dui');
        $fecha_nacimiento = $this->request->getPost('fecha_nacimiento');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $query2 = $modelo->verificar_correo($email);
        if(count($query2->getResultArray()) == 0){
            $id_usuario = $modelo->insertar_cliente($nombre, $direccion,$telefono, $dui, $fecha_nacimiento, $email, $password);

            if($id_usuario != 0 || $id_usuario != ""){
                /* ACA INICIA EL PROCESO PARA ENVIAR EMAIL */
                $destino = $email;
                $asunto = "Activacion de Cuenta";
                $headers = "From: soporte@web-uis.com". "\r\n";
                $headers .= "CC:  soporte@web-uis.com";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $id = md5($id_usuario);
                $imagen_src = base_url("/assets/images/log.svg");
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
                                              <span class="preheader">Activacion de la Cuenta</span>
                                              <table class="main">
          
                                                <!-- START MAIN CONTENT AREA -->
                                                <tr>
                                                  <td class="wrapper">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                      <tr>
                                                        <td>
                                                            <p>'.$nombre.' !!!</p>
                                                            <p>Reciba un cordial saludo del <b>Your Ideal Solution</b></p>
                                                            <p>Enviamos el link de Activacion para tu cuenta de <b>Cliente</b></p>
                                                            <p>En el Sistema de <b>Cuponeria y Ofertas</b></p>
                                                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                                <tbody>
                                                                <tr>
                                                                    <td align="left">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td> <a href="https://web-uis.com/login/activar_cuenta?id='.$id.'" target="_blank">Activar Cuenta</a> </td>
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
                                        $xdatos['msg'] = "Cliente registrado con exito! Active la cuenta con su Email!.";
                                  }
                                  else{
                                        $xdatos['typeinfo'] ="Error";
                                        $xdatos['msg'] = "No se puede registrar el cliente por el momento, intente mas tarde!";
                                  }  
            }
            else{
                $xdatos['typeinfo'] ="Error";
                $xdatos['msg'] = "Ya hay un cliente registrado con ese correo!";
            }
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "Ya hay un cliente registrado con ese correo!";
        }
        echo json_encode($xdatos);
    }

    public function login(){
      $username = $this->request->getPost('email');
      $clave = $this->request->getPost('password');
      $modelo = $this->ElModelo;
      $query = $modelo->verificar_username($username);
      if(count($query->getResultArray()) > 0){
          $query2 = $modelo->verificar_credenciales($username,$clave);
          if(count($query2->getResultArray()) > 0){
              $datos = $query2->getResultArray();
              foreach ($datos as $key => $value) {
                  $id_usuario = $value['id_usuario'];
                  $nombre = $value['nombre'];
                  $usuario = $value['usuario'];
                  $id_tipo_usuario = $value['id_tipo_usuario'];
                  $id_dependiente = $value['id_dependiente'];
                  $id_admin_sucursal = $value['id_admin_sucursal'];
                  $activo = $value['activo'];
                  $id_sucursal =$value['id_sucursal'];
                  $id_empresa =$value['id_empresa'];
                  $id_cliente = $value['id_cliente'];
              }
             
              $admin = 0;
              if($id_tipo_usuario == 1){
                  $admin= 1;
              }
              $user_session = [
                  'id_usuario' => $id_usuario,
                  'nombre' => $nombre,
                  'usuario' => $usuario,
                  'id_tipo_usuario' => $id_tipo_usuario,
                  'id_dependiente' => $id_dependiente,
                  'id_admin_sucursal' => $id_admin_sucursal,
                  'activo' => $activo,
                  'id_sucursal' => $id_sucursal,
                  'admin' => $admin,
                  'id_cliente' => $id_cliente
              ];
              $session = session();
              $session->set($user_session);
              $xdatos['typeinfo'] ="Success";
              $xdatos['msg'] = "Bienvenido $nombre!";
          }
          else{
              $xdatos['typeinfo'] ="Error";
              $xdatos['msg'] = "Las credenciales no son las correctas o el usuario esta inactivo!";
          }
      }   
      else{
          $xdatos['typeinfo'] ="Error";
          $xdatos['msg'] = "No existe ese usuario!";
      }
      echo json_encode($xdatos);
  }
    function activar_cuenta(){
        $id = $this->request->getGet('id');
        $modelo = $this->ElModelo;
        $query = $modelo->activar_cuenta($id);
        if($query == false){
          return redirect()->to('login?id_request=0'); 
        }
        else{
          return redirect()->to('login?id_request=1'); 
        }
    }
    
}