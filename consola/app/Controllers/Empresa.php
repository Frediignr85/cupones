<?php

namespace App\Controllers;
use App\Models\ModeloEmpresa;
use App\Models\ModeloDashboard;
use Config\App;
use \Hermawan\DataTables\DataTable;
class Empresa extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloEmpresa();
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);

            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $datos1['title'] = 'Admin Empresa';
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

                $btn_add = $modelo->verificar_permiso($session->get('id_usuario'),"agregar_empresa");
                $datos2['btn_add'] = "";
                if($btn_add != "NOT" || $admin == "1"){
                    $datos2['btn_add'] = "<a href='".base_url("")."/empresa/agregar_empresa"."' class='btn btn-primary' role='button'><i class='fa fa-plus icon-large'></i> Agregar Empresa</a>";
                }

                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_empresa_ofertante.js" ></script>';
                $datos3['datatable'] = "1";
                $datos3['ruta_datatable'] = "empresa/datatable";
                $query = $modelo->empresas_ofertantes();
                $datos2['result'] = $query->getResultArray();
                $datos2['permiso_editar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"editar_empresa");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_editar'] = 1;
                }
                $datos2['permiso_borrar'] = 0;
                $links2 = $modelo->verificar_permiso($session->get('id_usuario'),"borrar_empresa");
                if ($links2!='NOT' || $admin=='1' ){
                    $datos2['permiso_borrar'] = 1;
                }
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('admin_empresa',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    public function agregar_empresa(){
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
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $title = 'Agregar Empresa';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_empresa_ofertante.js" ></script>';

                $query = $modelo->rubros();
                $datos2['result_rubros'] = $query->getResultArray();

                $query = $modelo->departamentos();
                $datos2['result_departamentos'] = $query->getResultArray();


                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('agregar_empresa',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function municipio(){
        $modelo = $this->ElModelo;
        $id_departamento = $this->request->getPost('id_departamento');
        $query = $modelo->municipios($id_departamento);
        $datos = $query->getResultArray();
        $cadena = "";
        foreach ($datos as $key => $value) {
            $id_municipio = $value['id_municipio'];
            $nombre_municipio = $value['municipio'];
            $cadena.="<option value='".$id_municipio."'>".$nombre_municipio."</option>";
        }
        echo $cadena;
    }
    function insertar_empresa(){
        $nombre = $this->request->getPost('nombre');
        $rubro = $this->request->getPost('rubro');
        $encargado = $this->request->getPost('encargado');
        $telefono = $this->request->getPost('telefono');
        $correo = $this->request->getPost('correo');
        $departamento = $this->request->getPost('departamento');
        $municipio = $this->request->getPost('municipio');
        $porcentaje = $this->request->getPost('porcentaje');
        $direccion = $this->request->getPost('direccion');
        $modelo = $this->ElModelo;
        $query = $modelo->insertar_empresa($nombre,$rubro,$encargado,$telefono,$correo,$departamento,$municipio,$porcentaje,$direccion);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Empresa registrada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La empresa no se pudo registrar!";
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_empresa = $this->request->getGet('id_empresa');
                $title = 'Editar Empresa';
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
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_empresa_ofertante.js" ></script>';
                $query = $modelo->rubros();
                $datos2['result_rubros'] = $query->getResultArray();
                $query = $modelo->departamentos();
                $datos2['result_departamentos'] = $query->getResultArray();
                $query = $modelo->municipios_libre();
                $datos2['result_municipios'] = $query->getResultArray();
                $query = $modelo->departamentos();
                $datos2['result_departamentos'] = $query->getResultArray();

                $query = $modelo->traer_datos_empresa($id_empresa);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_empresa'] = $value['id_empresa'];
                    $datos2['nombre'] = $value['nombre'];
                    $datos2['id_rubro'] = $value['id_rubro'];
                    $datos2['nombre_contacto'] = $value['nombre_contacto'];
                    $datos2['telefono'] = $value['telefono'];
                    $datos2['correo'] = $value['correo'];
                    $datos2['direccion'] = $value['direccion'];
                    $datos2['id_departamento'] = $value['id_departamento'];
                    $datos2['id_municipio'] = $value['id_municipio'];
                    $datos2['porcentaje'] = $value['porcentaje'];
                }
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('editar_empresa',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function modificar_empresa(){
        $id_empresa = $this->request->getPost('id_empresa');
        $nombre = $this->request->getPost('nombre');
        $rubro = $this->request->getPost('rubro');
        $encargado = $this->request->getPost('encargado');
        $telefono = $this->request->getPost('telefono');
        $correo = $this->request->getPost('correo');
        $departamento = $this->request->getPost('departamento');
        $municipio = $this->request->getPost('municipio');
        $porcentaje = $this->request->getPost('porcentaje');
        $direccion = $this->request->getPost('direccion');
        $modelo = $this->ElModelo;
        $query = $modelo->modificar_empresa($nombre,$rubro,$encargado,$telefono,$correo,$departamento,$municipio,$porcentaje,$direccion,$id_empresa);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Empresa editada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La empresa no se pudo editar!";
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),$uri);
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_empresa = $this->request->getGet('id_empresa');
                $query = $modelo->traer_datos_empresa($id_empresa);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_empresa'] = $value['id_empresa'];
                    $datos2['nombre'] = $value['nombre'];
                    $datos2['id_rubro'] = $value['id_rubro'];
                    $datos2['nombre_contacto'] = $value['nombre_contacto'];
                    $datos2['telefono'] = $value['telefono'];
                    $datos2['correo'] = $value['correo'];
                    $datos2['direccion'] = $value['direccion'];
                    $datos2['id_departamento'] = $value['id_departamento'];
                    $datos2['id_municipio'] = $value['id_municipio'];
                    $datos2['porcentaje'] = $value['porcentaje'];
                    $datos2['codigo'] = $value['codigo'];
                }
                echo view('borrar_empresa',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function borrar_empresa(){
        $modelo = $this->ElModelo;
        $id_empresa = $this->request->getPost('id_empresa');
        $query = $modelo->borrar_empresa($id_empresa);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Empresa borrada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La empresa no se pudo borrar!";
        }
        echo json_encode($xdatos);
    }
}