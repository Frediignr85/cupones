<?php

namespace App\Controllers;
use App\Models\ModeloDependiente;
use App\Models\ModeloDashboard;
use Config\App;
use \Hermawan\DataTables\DataTable;
header('Access-Control-Allow-Origin: *');
class Dependientes extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloDependiente();
        $this->ElModelo1 = new ModeloDashboard();
        helper('url');
    }
    public function index()
    {
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $modelo1 = $this->ElModelo1;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/");

            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $datos1['title'] = 'Admin Dependiente';
                $datos1['links'] = null;
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/iCheck/custom.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/chosen/chosen.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2-bootstrap.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';

                $btn_add = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/agregar_dependiente");
                $datos2['btn_add'] = "";
                if($btn_add != "NOT" || $admin == "1"){
                    $datos2['btn_add'] = "<a href='".base_url("")."/dependientes/agregar_dependiente"."' class='btn btn-primary' role='button'><i class='fa fa-plus icon-large'></i> Agregar Dependientes</a>";
                }
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_dependiente.js" ></script>';
                $query = $modelo->dependientes($session->get('admin'),$session->get('id_empresa'));
                $datos2['result'] = $query->getResultArray();

                $datos2['permiso_editar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/editar_dependiente");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_editar'] = 1;
                }
                $datos2['permiso_borrar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/borrar_dependiente");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_borrar'] = 1;
                }


                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('admin_dependiente',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    public function agregar_dependiente(){
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $modelo1 = $this->ElModelo1;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/agregar_dependiente");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $title = 'Agregar Dependiente';
                $datos1 = array ();
                $datos1 ['title'] = $title;
                $datos1 ['links'] = null;
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/iCheck/custom.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/chosen/chosen.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2-bootstrap.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/tour/bootstrap-tour.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/timepicki/timepicki.css" rel="stylesheet">';  
    
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_dependiente.js" ></script>';




                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('agregar_dependiente');
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function insertar_dependiente(){
        $session = session();
        $id_empresa = $session->get('id_empresa');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $correo = $this->request->getPost('correo');
        
        $modelo = $this->ElModelo;
        $query = $modelo->insertar_dependiente($nombre,$apellido,$correo,$id_empresa);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Dependiente registrado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El dependiente no se pudo registrar!";
        }
        echo json_encode($xdatos);
    }
    function editar(){
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $modelo1 = $this->ElModelo1;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/editar_dependiente");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_dependiente = $this->request->getGet('id_dependiente');
                $title = 'Editar Dependiente';
                $datos1 = array ();
                $datos1 ['title'] = $title;
                $datos1 ['links'] = null;
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/bootstrap.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/font-awesome/css/font-awesome.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/iCheck/custom.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/chosen/chosen.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/select2/select2-bootstrap.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/plugins/tour/bootstrap-tour.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/animate.css" rel="stylesheet">';
                $datos1 ['links'] .= '<link href="'.base_url("").'/assets/css/style.css" rel="stylesheet">';
                $datos1['links'] .= '<link href="'.base_url("").'/assets/css/plugins/timepicki/timepicki.css" rel="stylesheet">';  
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_dependiente.js" ></script>';
                

                $query = $modelo->traer_datos_dependiente($id_dependiente);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_dependiente'] = $value['id_dependiente'];
                    $datos2['nombres'] = $value['nombres'];
                    $datos2['apellidos'] = $value['apellidos'];
                    $datos2['correo'] = $value['correo'];
                }
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('editar_dependiente',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function modificar_dependiente(){
        $id_dependiente = $this->request->getPost('id_dependiente');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $correo = $this->request->getPost('correo');
        $correo_viejo = $this->request->getPost('correo_viejo');
        $modelo = $this->ElModelo;
        $query = $modelo->modificar_dependiente($nombre,$apellido,$correo,$correo_viejo,$id_dependiente);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Dependiente editado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El dependiente no se pudo editar!";
        }
        echo json_encode($xdatos);
    }

    function borrar(){
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"dependientes/borrar_dependiente");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_dependiente = $this->request->getGet('id_dependiente');
                $query = $modelo->traer_datos_dependiente($id_dependiente);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_dependiente'] = $value['id_dependiente'];
                    $datos2['nombres'] = $value['nombres'];
                    $datos2['apellidos'] = $value['apellidos'];
                    $datos2['correo'] = $value['correo'];
                }
                echo view('borrar_dependiente',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function borrar_dependiente(){
        $modelo = $this->ElModelo;
        $id_dependiente = $this->request->getPost('id_dependiente');
        $query = $modelo->borrar_dependiente($id_dependiente);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Dependiente borrado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El dependiente no se pudo borrar!";
        }
        echo json_encode($xdatos);
    }
}