<?php

namespace App\Controllers;
use App\Models\ModeloDashboard;

class Dashboard extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloDashboard();
    }

    public function index()
    {
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('dashboard'); 
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
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            $menu = $modelo->menu($session->get('id_usuario'),$session->get('admin'));
            
            $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_dashboard.js" ></script>';
            $datos['menu'] = $menu;
            echo view('header',$datos1);
            echo view('main_menu',$datos);
            if($session->get('id_tipo_usuario') == 1){
                echo view('dashboard');
            }
            if($session->get('id_tipo_usuario') == 2){
                echo view('dashboard');
            }
            if($session->get('id_tipo_usuario') == 3){
                echo view('dashboard_dependiente');
            }
            echo view('footer',$datos3);
        }
    }
}
