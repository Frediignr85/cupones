<?php

namespace App\Controllers;
use App\Models\ModeloDashboard;
use Config\App;
use \Hermawan\DataTables\DataTable;
header('Access-Control-Allow-Origin: *');
class Dashboard extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloDashboard();
        helper('url');
    }

    public function index()
    {
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
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
                $query = $modelo->traer_clientes();
                $cantidades['clientes']=count($query->getResultArray());
                $query = $modelo->traer_empresas();
                $cantidades['empresas']=count($query->getResultArray());
                $query = $modelo->traer_rubros();
                $cantidades['rubros']=count($query->getResultArray());
                $query = $modelo->traer_dependientes();
                $cantidades['dependientes']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_pendientes(1,0);
                $cantidades['ofertas_pendientes']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_activas(1,0);
                $cantidades['ofertas_activas']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_pasadas(1,0);
                $cantidades['ofertas_pasadas']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_rechazadas(1,0);
                $cantidades['ofertas_rechazadas']=count($query->getResultArray());
                echo view('dashboard',$cantidades);
            }
            if($session->get('id_tipo_usuario') == 2){
                $id_empresa = $session->get('id_empresa');
                $query = $modelo->traer_ofertas_pendientes(0, $id_empresa);
                $cantidades['ofertas_pendientes']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_activas(0, $id_empresa);
                $cantidades['ofertas_activas']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_pasadas(0, $id_empresa);
                $cantidades['ofertas_pasadas']=count($query->getResultArray());
                $query = $modelo->traer_ofertas_rechazadas(0, $id_empresa);
                $cantidades['ofertas_rechazadas']=count($query->getResultArray());

                echo view('dashboard_empresa',$cantidades);
            }
            if($session->get('id_tipo_usuario') == 3){
                echo view('dashboard_dependiente');
            }
            echo view('footer',$datos3);
        }
    }

    function grafica1(){
        helper('utilidades'); 
        $db = \Config\Database::connect();
        $inicio = restar_meses(date("Y-m-d"),4);
        $data = array();
        for($i=0; $i<5; $i++)
        {
            $a = explode("-",$inicio)[0];
            $m = explode("-",$inicio)[1];
            $ult = cal_days_in_month(CAL_GREGORIAN, $m, $a);
            $ini = "$a-$m-01";
            $fin = "$a-$m-$ult";
    
            $query = $db->query("SELECT SUM(total_compra)  as total FROM tblcompra_general WHERE deleted_at is NULL AND fecha BETWEEN '$ini' AND '$fin'");
            $datax = $query->getResultArray();
            foreach ($datax as $key => $value) {
                $total = $value["total"];
            }
            
            $data[] = array(
                "total" => $total,  
                "producto" => meses($m), 
            );
            $inicio = sumar_meses($ini,1);
        }
        echo json_encode($data);
    }
    function grafica2(){
        helper('utilidades'); 
        $db = \Config\Database::connect();
        $inicio = restar_meses(date("Y-m-d"),4);
        $data = array();
        for($i=0; $i<5; $i++)
        {
            $a = explode("-",$inicio)[0];
            $m = explode("-",$inicio)[1];
            $ult = cal_days_in_month(CAL_GREGORIAN, $m, $a);
            $ini = "$a-$m-01";
            $fin = "$a-$m-$ult";
            $sql = "SELECT (SUM(tblcompra_especifica.total_compra*tblempresa_ofertante.porcentaje)/100) as 'total' FROM tblcompra_especifica INNER JOIN tblempresa_ofertante on tblempresa_ofertante.id_empresa = tblcompra_especifica.id_empresa INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general WHERE tblcompra_general.deleted_at IS NULL AND  tblcompra_general.fecha BETWEEN '$ini' AND '$fin'";
            
            $query = $db->query($sql);
            $datax = $query->getResultArray();
            foreach ($datax as $key => $value) {
                $total = $value["total"];
            }
            $data[] = array(
                "total" => $total,  
                "producto" => meses($m), 
            );
            $inicio = sumar_meses($ini,1);
        }
        echo json_encode($data);
    }
    function grafica3(){
        $session = session();    
        $id_empresa = $session->get('id_empresa');
        helper('utilidades'); 
        $db = \Config\Database::connect();
        $inicio = restar_meses(date("Y-m-d"),4);
        $data = array();
        for($i=0; $i<5; $i++)
        {
            $a = explode("-",$inicio)[0];
            $m = explode("-",$inicio)[1];
            $ult = cal_days_in_month(CAL_GREGORIAN, $m, $a);
            $ini = "$a-$m-01";
            $fin = "$a-$m-$ult";
    
            $query = $db->query("SELECT SUM(tblcompra_especifica.total_compra) as total FROM tblcompra_especifica WHERE tblcompra_especifica.id_empresa = '$id_empresa' AND deleted_at is NULL AND fecha BETWEEN '$ini' AND '$fin'");
            $datax = $query->getResultArray();
            foreach ($datax as $key => $value) {
                $total = $value["total"];
            }
            
            $data[] = array(
                "total" => $total,  
                "producto" => meses($m), 
            );
            $inicio = sumar_meses($ini,1);
        }
        echo json_encode($data);
    }
    function grafica4(){
        $session = session();    
        $id_empresa = $session->get('id_empresa');
        helper('utilidades'); 
        $db = \Config\Database::connect();
        $inicio = restar_meses(date("Y-m-d"),4);
        $data = array();
        for($i=0; $i<5; $i++)
        {
            $a = explode("-",$inicio)[0];
            $m = explode("-",$inicio)[1];
            $ult = cal_days_in_month(CAL_GREGORIAN, $m, $a);
            $ini = "$a-$m-01";
            $fin = "$a-$m-$ult";
            $sql = "SELECT (SUM(tblcompra_especifica.total_compra) - (SUM(tblcompra_especifica.total_compra*tblempresa_ofertante.porcentaje)/100)) as 'total' FROM tblcompra_especifica INNER JOIN tblempresa_ofertante on tblempresa_ofertante.id_empresa = tblcompra_especifica.id_empresa INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general WHERE tblcompra_general.deleted_at IS NULL AND  tblcompra_especifica.fecha BETWEEN '$ini' AND '$fin' AND tblcompra_especifica.id_empresa = '$id_empresa'";
            
            $query = $db->query($sql);
            $datax = $query->getResultArray();
            foreach ($datax as $key => $value) {
                $total = $value["total"];
            }
            $data[] = array(
                "total" => $total,  
                "producto" => meses($m), 
            );
            $inicio = sumar_meses($ini,1);
        }
        echo json_encode($data);
    }
}
