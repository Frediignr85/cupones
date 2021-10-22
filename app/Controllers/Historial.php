<?php

namespace App\Controllers;
use App\Models\ModeloHistorial;
use App\Libraries\Fpdf;
use FPDF as GlobalFPDF;

header('Access-Control-Allow-Origin: *');
class Historial extends BaseController
{
    public $db;
    function __construct()
    {
        $this->ElModelo = new ModeloHistorial();
        $this->db = \Config\Database::connect();
        helper('url');
    }
    public function index()
    {
        $session = session(); 
        $modelo = $this->ElModelo;

        $contenido = "";
        $contenido.="<div class=\"container\">";
        $contenido.="<div class=\"responsive__cart-area\">";
        $contenido.="<form class=\"cart__form\">";
        $contenido.="<div class=\"cart__table table-responsive\">";
        $contenido.="<table width=\"100%\" class=\"table\">";
        $contenido.="<thead>";
        $contenido.="<tr>";
        $contenido.="<th>ID</th>";
        $contenido.="<th>TOTAL ($)</th>";
        $contenido.="<th>N. CUENTA</th>";
        $contenido.="<th>CANTIDAD CUPONES</th>";
        $contenido.="<th>CUP. CANJEADOS</th>";
        $contenido.="<th>CUP. NO CANJEADOS</th>";
        $contenido.="<th>CUP. VENCIDOS</th>";
        $contenido.="<th>ACCION</th>";
        $contenido.="</tr>";
        $contenido.="</thead>";
        $contenido.="<tbody>";

        $id_cliente = $session->get('id_cliente');
        $query = $modelo->traer_historial_compras($id_cliente);
        $query = $query->getResultArray();
        foreach ($query as $key => $value) {
            $id_compra_general = $value['id_compra_general'];
            $total_compra = "$ ".number_format($value['total_compra'],2);
            $numero_tarjeta = $value['numero_tarjeta'];
            $cantidad_cupones = $value['cantidad_cupones'];
            $cupones_canjeados = $value['cupones_canjeados'];
            if($cupones_canjeados == ""){
                $cupones_canjeados = 0;
            }
            $cupones_no_canjeados = $value['cupones_no_canjeados'];
            if($cupones_no_canjeados == ""){
                $cupones_no_canjeados = 0;
            }
            $cupones_vencidos = $value['cupones_vencidos'];
            if($cupones_vencidos == ""){
                $cupones_vencidos = 0;
            }
            $contenido.="<tr>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$id_compra_general</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            


            $contenido.="<td class=\"product__price\">";
            $contenido.="<div class=\"price\">";
            $contenido.="<span class=\"new__price\">$total_compra</span>";
            $contenido.="</div>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$numero_tarjeta</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$cantidad_cupones</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$cupones_canjeados</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$cupones_no_canjeados</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$cupones_vencidos</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td>";
            $contenido.="<a class=\"remove__cart-item\" data-toggle='modal' href=\"".base_url("/historial/ver_compra_general?id_compra_general=".$id_compra_general)."\"  data-target='#deleteModal' data-refresh='true'>";
            $contenido.="<svg>";
            $contenido.="<use xlink:href=\"".base_url("/assets/images/sprite.svg#icon-eye")."\"></use>";
            $contenido.="</svg>";
            $contenido.="</a>";
            $contenido.="<a class=\"remove__cart-item\" href=\"".base_url("/historial/imprimir_reporte?id_compra_general=".$id_compra_general)."\">";
            $contenido.="<svg>";
            $contenido.="<use xlink:href=\"".base_url("/assets/images/sprite.svg#icon-paperplane")."\"></use>";
            $contenido.="</svg>";
            $contenido.="</a>";
            $contenido.="</td>";
            $contenido.="</tr>";
        }
        $contenido.="</tbody>";
        $contenido.="</table>";
        $contenido.="</div>";
        $contenido.="</form>";
        $contenido.="</div>";
        $contenido.="</div>";
        $xdatos['result'] = $contenido;
        return view('historial',$xdatos);
    }
    function ver_compra_general(){
        $modelo = $this->ElModelo;
        $id_compra_general = $this->request->getGet('id_compra_general');
        $query = $modelo->traer_datos_compra_general($id_compra_general);
        $datosx = $query->getResultArray();
        $datos2['datos'] = $datosx;
        echo view('ver_compra_general',$datos2);
    }

    function imprimir_reporte(){
        $id_compra_general = $this->request->getGet('id_compra_general');
        $modelo = $this->ElModelo;
        $query = $modelo->traer_info_compra($id_compra_general);
        $query = $query->getResultArray();
        foreach ($query as $key => $value) {
            $xdatos['id_compra_general'] = $value['id_compra_general'];
            $xdatos['total_compra'] = "$ ".number_format($value['total_compra'],2);
            $xdatos['numero_tarjeta'] = $value['numero_tarjeta'];
            $xdatos['nombre_dueno'] = $value['nombre_dueno'];
            $xdatos['nombre'] = $value['nombre'];
            $xdatos['dui'] = $value['dui'];
            $xdatos['created_at'] = $value['created_at'];
        }
        $dompdf = new \Dompdf\Dompdf(); 
        
        // Sending data to view file
        $dompdf->loadHtml(view('pdf/template-compra', $xdatos));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Download pdf
        $dompdf->stream(); 
        // to give pdf file name
        // $dompdf->stream("myfile");

        //return redirect()->to(base_url('inicio'));
    }
}
