<?php

namespace App\Controllers;
use App\Models\ModeloRubro;
use App\Models\ModeloDashboard;
use Config\App;
class Rubros extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloRubro();
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
                $datos1['title'] = 'Admin Rubros';
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
                $btn_add = $modelo->verificar_permiso($session->get('id_usuario'),"agregar_rubro");
                $datos2['btn_add'] = "";
                if($btn_add != "NOT" || $admin == "1"){
                    $datos2['btn_add'] = "<a href='".base_url("")."/rubros/agregar_rubro"."' class='btn btn-primary' role='button'><i class='fa fa-plus icon-large'></i> Agregar Rubro</a>";
                }
                /* VERIFICAMOS QUE HAYA PERMISO PARA EDITAR RUBROS */
                $datos2['permiso_editar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"editar_empresa");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_editar'] = 1;
                }
                /* VERIFICAMOS QUE HAYA PERMISO PARA BORRAR RUBROS */
                $datos2['permiso_borrar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"borrar_empresa");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_borrar'] = 1;
                }
                /* EN ESTA PARTE TRAEMOS EL MENU */
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_rubros.js" ></script>';
                /* ACA TRAEMOS A TODOS LOS RUBROS*/
                $query = $modelo->traer_rubros();
                $datos2['result'] = $query;
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('admin_rubro',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }

    public function agregar_rubro(){
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
                $title = 'Agregar Rubro';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_rubros.js" ></script>';
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('agregar_rubro');
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function insertar_rubro(){
        $nombre = $this->request->getPost('nombre');
        $descripcion = $this->request->getPost('descripcion');
        $modelo = $this->ElModelo;
        $query = $modelo->insertar_rubro($nombre,$descripcion);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Rubro registrado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El Rubro no se pudo registrar!";
        }
        echo json_encode($xdatos);
    }
    function editar_rubro(){
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
                $id_rubro = $this->request->getGet('id_rubro');
                $title = 'Editar Rubro';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_rubros.js" ></script>';
                

                $query = $modelo->traer_datos_rubro($id_rubro);
                $datos2['id_rubro'] = $query['id_rubro'];
                $datos2['nombre'] = $query['nombre'];
                $datos2['descripcion'] = $query['descripcion'];
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('editar_rubro',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }

    function modificar_rubro(){
        $id_rubro = $this->request->getPost('id_rubro');
        $nombre = $this->request->getPost('nombre');
        $descripcion = $this->request->getPost('descripcion');
        $modelo = $this->ElModelo;
        $query = $modelo->modificar_rubro($nombre,$descripcion,$id_rubro);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Rubro editado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El rubro no se pudo editar!";
        }
        echo json_encode($xdatos);
    }

    function borrar_rubro(){
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
                $id_rubro = $this->request->getGet('id_rubro');
                $query = $modelo->traer_datos_rubro($id_rubro);
                $datos2['id_rubro'] = $query['id_rubro'];
                $datos2['nombre'] = $query['nombre'];
                $datos2['descripcion'] = $query['descripcion'];
                echo view('borrar_rubro',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function eliminar_rubro(){
        $modelo = $this->ElModelo;
        $id_rubro = $this->request->getPost('id_rubro');
        $query = $modelo->eliminar_rubro($id_rubro);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Rubro eliminado con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "El rubro no se pudo borrar!";
        }
        echo json_encode($xdatos);
    }
    
}