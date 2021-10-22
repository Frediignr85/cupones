<?php

namespace App\Controllers;
use App\Models\ModeloTarjeta;
use App\Models\ModeloDashboard;
use Config\App;
header('Access-Control-Allow-Origin: *');
class Tarjetas extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloTarjeta();
        $this->ElModelo1 = new ModeloDashboard();
    }
    public function index()
    {
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            /* OBJETO PARA LLAMAR AL MODELO RUBRO */
            $modelo = $this->ElModelo;
            /* OBJETO PARA LLAMAR AL MODELO DASHBOARD */
            $modelo1 = $this->ElModelo1;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            /* VERIFICAMOS SI HAY PERMISOS PARA ESTE USUARIO */
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo1->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $datos1['title'] = 'Admin Tarjetas';
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
                /* VERIFICAMOS QUE HAYA PERMISO PARA AGREGAR RUBROS */
                $btn_add = $modelo->verificar_permiso($session->get('id_usuario'),"agregar_tarjeta");
                $datos2['btn_add'] = "";
                if($btn_add != "NOT" || $admin == "1"){
                    $datos2['btn_add'] = "<a href='".base_url("")."/tarjetas/agregar_tarjeta"."' class='btn btn-primary' role='button'><i class='fa fa-plus icon-large'></i> Agregar Tarjeta</a>";
                }
                /* VERIFICAMOS QUE HAYA PERMISO PARA EDITAR RUBROS */
                $datos2['permiso_editar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"editar_tarjeta");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_editar'] = 1;
                }
                /* VERIFICAMOS QUE HAYA PERMISO PARA BORRAR RUBROS */
                $datos2['permiso_borrar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"borrar_tarjeta");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_borrar'] = 1;
                }
                /* EN ESTA PARTE TRAEMOS EL MENU */
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_tarjetas.js" ></script>';
                /* ACA TRAEMOS A TODOS LOS RUBROS*/
                $query = $modelo->traer_tarjetas();
                $datos2['result'] = $query;
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('admin_tarjeta',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }

    public function agregar_tarjeta(){
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo1->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $title = 'Agregar Tarjeta';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_tarjetas.js" ></script>';
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('agregar_tarjeta');
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function insertar_tarjeta(){
        $nombre = $this->request->getPost('nombre');
        $modelo = $this->ElModelo;
        $query = $modelo->insertar_tarjeta($nombre);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Tarjeta registrada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La Tarjeta no se pudo registrar!";
        }
        echo json_encode($xdatos);
    }
    function editar_tarjeta(){
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo1->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_tarjeta = $this->request->getGet('id_tarjeta');
                $title = 'Editar Tarjeta';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_tarjetas.js" ></script>';
                

                $query = $modelo->traer_datos_tarjeta($id_tarjeta);
                $datos2['id_tarjeta'] = $query['id_tarjeta'];
                $datos2['nombre'] = $query['nombre'];
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('editar_tarjeta',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }

    function modificar_tarjeta(){
        $id_tarjeta = $this->request->getPost('id_tarjeta');
        $nombre = $this->request->getPost('nombre');
        $modelo = $this->ElModelo;
        $query = $modelo->modificar_tarjeta($nombre,$id_tarjeta);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Tarjeta editada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La tarjeta no se pudo editar!";
        }
        echo json_encode($xdatos);
    }

    function borrar_tarjeta(){
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo1->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_tarjeta = $this->request->getGet('id_tarjeta');
                $query = $modelo->traer_datos_tarjeta($id_tarjeta);
                $datos2['id_tarjeta'] = $query['id_tarjeta'];
                $datos2['nombre'] = $query['nombre'];
                echo view('borrar_tarjeta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function eliminar_tarjeta(){
        $modelo = $this->ElModelo;
        $id_tarjeta = $this->request->getPost('id_tarjeta');
        $query = $modelo->eliminar_tarjeta($id_tarjeta);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Tarjeta eliminada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La tarjeta no se pudo borrar!";
        }
        echo json_encode($xdatos);
    }
    
}