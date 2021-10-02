<?php

namespace App\Controllers;
use App\Models\ModeloOfertasDescartadas;
use App\Models\ModeloDashboard;
use Config\App;
use \Hermawan\DataTables\DataTable;
class Ofertas_Descartadas extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloOfertasDescartadas();
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
                $datos1['title'] = 'Admin Ofertas Descartadas';
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
                /* ESTE CODIGO SIRVE PARA TRAER EL MENU DEL LADO IZQUIERD0 */
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                /* ACA LE PASAMOS EL SCRIPT QUE ADMINISTRARA DEL LADO DEL CLIENTE A LA PAGINA */
                $datos3['url'] = '<script src="'.base_url("").'/assets/js/funciones/funciones_oferta.js" ></script>';
                /* ACA TRAIGO TODAS LAS OFERTAS PENNDIENTES QUE SE ENCUENTRAN ACTUALMENTE */
                $query = $modelo->ofertas_descartadas();
                $datos2['result'] = $query->getResultArray();

                /* ACA MANDAMOS A LLAMAR LAS VISTAS */
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('admin_ofertas_descartadas',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
}