<?php

namespace App\Controllers;
use App\Models\ModeloOfertas;
use App\Models\ModeloDashboard;
use Config\App;
use \Hermawan\DataTables\DataTable;
header('Access-Control-Allow-Origin: *');
class Ofertas extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloOfertas();
        $this->ElModelo1 = new ModeloDashboard();
        helper('url');
    }
    public function index()
    {
        return redirect()->to('dashboard');
    }

    public function agregar_oferta(){
        $session = session();     
        if($session->get('id_admin_sucursal') == ""){
            return redirect()->to('dashboard'); 
        }
        else{
            $modelo = $this->ElModelo;
            $modelo1 = $this->ElModelo1;
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            $title = 'Agregar Oferta';
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

            $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
            $datos['menu'] = $menu;
            $a = rand(1,9999);
		    $src = base_url("/assets/js/funciones/funciones_oferta.js?t".$a."=".$a);
            $datos3['url'] = '<script src="'.$src.'" ></script>';
            echo view('header',$datos1);
            echo view('main_menu',$datos);
            echo view('agregar_oferta');
            echo view('footer',$datos3);
        }
    }


    function insertar_oferta(){
        helper('utilidades'); 
        $session = session(); 
        $id_empresa = $session->get('id_empresa');
        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
        $precio_regular = $this->request->getPost('precio_regular');
        $precio_oferta = $this->request->getPost('precio_oferta');
        $cantidad = $this->request->getPost('cantidad');
        $fecha_inicio = MD($this->request->getPost('fecha_inicio'));
        $fecha_fin = MD($this->request->getPost('fecha_fin'));
        $fecha_limite = MD($this->request->getPost('fecha_limite'));
        $detalles = $this->request->getPost('detalles');
        $sin_limite = $this->request->getPost('sin_limite');
        $modelo = $this->ElModelo;
        $query = $modelo->insertar_oferta($titulo,$descripcion,$precio_regular,$precio_oferta,$cantidad,$fecha_inicio,$fecha_fin,$fecha_limite,$id_empresa,$detalles,$sin_limite);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta registrada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo registrar!";
        }
        echo json_encode($xdatos);
    }

    public function store()
    {  

        helper(['form', 'url']);
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbloferta ORDER BY id_oferta DESC LIMIT 1');
        $data = $query->getResultArray();
        foreach ($data as $key => $value) {
            $id_oferta = $value['id_oferta'];
        }

        $db = \Config\Database::connect();
        $builder = $db->table('tbloferta');
        $validated = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,4096]',
            ],
        ]);
 
        $msg = 'Please select a valid file';
  
        if ($validated) {
            $avatar = $this->request->getFile('file');
            $avatar->move('../assets/images');

            $url = "https://www.cupones.web-uis.com/assets/images/".$avatar->getClientName();
            $query2 = $db->query('UPDATE tbloferta SET url = \''.$url.'\' WHERE tbloferta.id_oferta = \''.$id_oferta.'\'');
        }
        return redirect()->to('dashboard');
 
    }
    /* FUNCION DEL CONTROLADOR PARA EDITAR LA OFERTA */

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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"ofertas/editar_oferta");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_oferta = $this->request->getGet('id_oferta');
                $title = 'Editar Oferta';
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
                $menu = $modelo1->menu($session->get('id_usuario'),$session->get('admin'));
                $datos['menu'] = $menu;
                $a = rand(1,9999);
                $src = base_url("/assets/js/funciones/funciones_oferta.js?t".$a."=".$a);
                $datos3['url'] = '<script src="'.$src.'" ></script>';

                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                    $datos2['ilimitado'] = $value['ilimitado'];
                }
                echo view('header',$datos1);
                echo view('main_menu',$datos);
                echo view('editar_oferta',$datos2);
                echo view('footer',$datos3);
            }
            else{
                return redirect()->to('dashboard'); 
            }
           
        }
    }
    function modificar_oferta(){
        $id_oferta = $this->request->getPost('id_oferta');
        $titulo = $this->request->getPost('titulo');
        $descripcion = $this->request->getPost('descripcion');
        $precio_regular = $this->request->getPost('precio_regular');
        $precio_oferta = $this->request->getPost('precio_oferta');
        $cantidad = $this->request->getPost('cantidad');
        $fecha_inicio = MD($this->request->getPost('fecha_inicio'));
        $fecha_fin = MD($this->request->getPost('fecha_fin'));
        $fecha_limite = MD($this->request->getPost('fecha_limite'));
        $detalles = $this->request->getPost('detalles');
        $sin_limite = $this->request->getPost('sin_limite');
        $modelo = $this->ElModelo;
        $query = $modelo->modificar_oferta($titulo,$descripcion,$precio_regular,$precio_oferta,$cantidad,$fecha_inicio,$fecha_fin,$fecha_limite,$id_oferta,$detalles,$sin_limite);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta editada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo editar!";
        }
        echo json_encode($xdatos);
    }
    function ver(){
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"ofertas/borrar_oferta");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                    $datos2['ilimitado'] = $value['ilimitado'];
                }
                echo view('ver_oferta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
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
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"ofertas/borrar_oferta");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                }
                echo view('borrar_oferta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function borrar_oferta(){
        $modelo = $this->ElModelo;
        $id_oferta = $this->request->getPost('id_oferta');
        $query = $modelo->borrar_oferta($id_oferta);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta borrada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo borrar!";
        }
        echo json_encode($xdatos);
    }

    function aprobar(){
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
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                }
                echo view('aprobar_oferta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }

    function aprobar_oferta(){
        $modelo = $this->ElModelo;
        $id_oferta = $this->request->getPost('id_oferta');
        $query = $modelo->aprobar_oferta($id_oferta);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta aprobada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo aprobar!";
        }
        echo json_encode($xdatos);
    }

    function rechazar(){
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
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                }
                echo view('rechazar_oferta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function rechazar_oferta(){
        $modelo = $this->ElModelo;
        $id_oferta = $this->request->getPost('id_oferta');
        $justificacion = $this->request->getPost('justificacion');
        $query = $modelo->rechazar_oferta($id_oferta, $justificacion);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta rechazada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo rechazar!";
        }
        echo json_encode($xdatos);
    }
    function ver_justificacion(){
        helper('utilidades'); 
        $session = session();     
        if($session->get('id_usuario') == ""){
            return redirect()->to('login'); 
        }
        else{
            $modelo = $this->ElModelo;
            $uri = $_SERVER['SCRIPT_NAME'];
            $admin = $session->get('admin');
            $links = $modelo->verificar_permiso($session->get('id_usuario'),"ofertas/ver_justificacion");
            $query = $modelo->datos_empresa(1);
            $datos['result'] = $query->getResultArray();
            if ($links!='NOT' || $admin=='1' ){
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                    $datos2['justificacion'] = $value['justificacion'];
                }
                echo view('ver_justificacion',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function descartar(){
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
                $id_oferta = $this->request->getGet('id_oferta');
                $query = $modelo->traer_datos_oferta($id_oferta);
                $datosx = $query->getResultArray();
                foreach ($datosx as $key => $value) {
                    $datos2['id_oferta'] = $value['id_oferta'];
                    $datos2['titulo'] = $value['titulo_oferta'];
                    $datos2['precio_regular'] = $value['precio_regular'];
                    $datos2['precio_oferta'] = $value['precio_oferta'];
                    $datos2['fecha_inicio'] = ED($value['fecha_inicio']);
                    $datos2['fecha_fin'] = ED($value['fecha_fin']);
                    $datos2['fecha_limite'] = ED($value['fecha_limite']);
                    $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
                    $datos2['descripcion'] = $value['descripcion'];
                    $datos2['otros_detalles'] = $value['otros_detalles'];
                }
                echo view('descartar_oferta',$datos2);
            }
            else{
                return redirect()->to('dashboard'); 
            }
        }
    }
    function descartar_oferta(){
        $modelo = $this->ElModelo;
        $id_oferta = $this->request->getPost('id_oferta');
        $query = $modelo->descartar_oferta($id_oferta);
        if($query){
            $xdatos['typeinfo'] ="Success";
            $xdatos['msg'] = "Oferta descartada con exito!";
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "La oferta no se pudo descartar!";
        }
        echo json_encode($xdatos);
    }
    function canjear_oferta(){
        $modelo = $this->ElModelo;
        $session = session();    
        $id_empresa =$session->get('id_empresa');
        $codigo = $this->request->getPost('codigo');
        $query = $modelo->verificar_codigo($codigo);
        if(count($query->getResultArray()) > 0){
            $query2 = $modelo->verificar_canjeo($codigo,$id_empresa);
            if(count($query2->getResultArray()) == 0){
                $cadena_devolver = "";
                $cadena_devolver.='<input type="hidden" name="codigo_cupon_canje" id="codigo_cupon_canje" value="'.$codigo.'">';
                $cadena_devolver.="<table class=\"table\">";
                $cadena_devolver.="<thead class=\"thead-dark\">";
                $cadena_devolver.="<tr>";
                $cadena_devolver.="<th scope=\"col\">#</th>";
                $cadena_devolver.="<th scope=\"col\">Oferta</th>";
                $cadena_devolver.="<th scope=\"col\">Precio Uni.</th>";
                $cadena_devolver.="<th scope=\"col\">Cantidad</th>";
                $cadena_devolver.="<th scope=\"col\">Total</th>";
                $cadena_devolver.="</tr>";
                $cadena_devolver.="</thead>";
                $cadena_devolver.="<tbody>";
                $query3 = $modelo->canejar_codigo($codigo,$id_empresa);
                $datosx = $query3->getResultArray();
                $count = 1;
                $total_comprax = 0;
                foreach ($datosx as $key => $value) {
                    $titulo_oferta = $value['titulo_oferta'];
                    $precio_uitario = "$".number_format($value['precio_unitario'],2);
                    $cantidad = $value['cantidad'];
                    $total_compra = "$".number_format($value['total_compra'],2);
                    $nombre_cliente = $value['nombre'];
                    $dui = $value['dui'];
                    $total_comprax += $value['total_compra'];
                    $cadena_devolver.="<tr>";
                    $cadena_devolver.="<th scope=\"row\">$count</th>";
                    $cadena_devolver.="<td>$titulo_oferta</td>";
                    $cadena_devolver.="<td>$precio_uitario</td>";
                    $cadena_devolver.="<td>$cantidad</td>";
                    $cadena_devolver.="<td>$total_compra</td>";
                    $cadena_devolver.="</tr>";
                }
                $total_comprax = "$".number_format($total_comprax,2);
                $cadena_devolver.="</tbody>";
                $cadena_devolver.="<thead class=\"thead-dark\">";
                $cadena_devolver.="<tr>";
                $cadena_devolver.="<th scope=\"col\">CLIENTE:</th>";
                $cadena_devolver.="<th scope=\"col\">$nombre_cliente</th>";
                $cadena_devolver.="<th scope=\"col\">DUI:</th>";
                $cadena_devolver.="<th scope=\"col\">$dui</th>";
                $cadena_devolver.="<th scope=\"col\">$total_comprax</th>";
                $cadena_devolver.="</tr>";
                $cadena_devolver.="</thead>";
                $cadena_devolver.="</table>";
                $cadena_devolver.="<br>";
                $cadena_devolver.="<br>";
                $cadena_devolver.="<button type=\"button\" id=\"btnCanjearOferta\" style=\"margin:10px;\" class=\"btn btn-success\">Canjear</button>";
                $cadena_devolver.="<button type=\"button\" id=\"btnLimpiarOferta\" style=\"margin:10px;\" class=\"btn btn-danger\">Canjear Otro</button>";
                $xdatos['typeinfo'] ="Success";
                $xdatos['msg'] = "Codigo Correcto!";
                $xdatos['contenido'] = $cadena_devolver;
            }
            else{
                $xdatos['typeinfo'] ="Error";
                $xdatos['msg'] = "Ese codigo ya fue canjeado!";
            }
        }
        else{
            $xdatos['typeinfo'] ="Error";
            $xdatos['msg'] = "No existe ese codigo!";
        }
        echo json_encode($xdatos);
    }
    function canje_cupon(){
        $modelo = $this->ElModelo;
        $session = session();    
        $id_empresa =$session->get('id_empresa');
        $codigo = $this->request->getPost('codigo');
        $query = $modelo->canje_final($codigo,$id_empresa);
        $xdatos['typeinfo'] ="Success";
        $xdatos['msg'] = "Codigo Canjeado correctamente!";
        echo json_encode($xdatos);
    }
}