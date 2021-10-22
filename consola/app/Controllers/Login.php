<?php

namespace App\Controllers;
use App\Models\ModeloLogin;
use App\Models\ModeloDashboard;
header('Access-Control-Allow-Origin: *');
class Login extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloLogin();
        $this->ElModelo1 = new ModeloDashboard();
    }

    public function index()
    {
        $session = session();     
        if($session->get('id_usuario') == ""){
            $datos1['title'] = 'LOGIN';
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
            echo view('login',$datos);
            $a = rand(1,9999);
		    $src = base_url("/assets/js/funciones/funciones_login.js?t".$a."=".$a);
            $datos3['url'] = '<script src="'.$src.'" ></script>';
            echo view('footer',$datos3);
        }
        else{
            $datos1['title'] = 'Dashboard';
            $datos1['links'] = null;
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/iCheck/custom.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/chosen/chosen.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';
            $datos1['links'] .= '<link href="'.base_url("").'/assets/css/estilo_dashboard.css" rel="stylesheet">';
            $modelo = $this->ElModelo;
            $modelo1 = $this->ElModelo1;
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
            $datos['menu'] = $menu;
            echo view('header',$datos1);
            echo view('main_menu',$datos);
            echo view('dashboard');
            $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_dashboard.js" ></script>';
            echo view('footer',$datos3);
        }
        
    }
    public function login(){
        $username = $this->request->getPost('username');
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
                    'id_empresa' => $id_empresa
                ];
                $session = session();
                $session->set($user_session);

                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id_tipo_usuario'] = $id_tipo_usuario;
                $_SESSION['id_dependiente'] = $id_dependiente;
                $_SESSION['id_admin_sucursal'] = $id_admin_sucursal;
                $_SESSION['activo'] = $activo;
                $_SESSION['id_sucursal'] = $id_sucursal;
                $_SESSION['admin'] = $admin;
                $_SESSION['id_empresa'] = $id_empresa;
                
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
    
}
