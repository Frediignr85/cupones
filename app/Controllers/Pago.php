<?php

namespace App\Controllers;
use App\Models\ModeloPago;
use App\Libraries\Fpdf;
use FPDF as GlobalFPDF;

header('Access-Control-Allow-Origin: *');
class Pago extends BaseController
{
    public $db;
    function __construct()
    {
        $this->ElModelo = new ModeloPago();
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

        $id_cliente = $session->get('id_cliente');
        $query = $modelo->traer_productos_carrito($id_cliente);
        $query = $query->getResultArray();
        foreach ($query as $key => $value) {
            $id_oferta = $value['id_oferta'];
            $id_cliente = $value['id_cliente'];
            $titulo_oferta = $value['titulo_oferta'];
            $precio_oferta = "$ ".number_format($value['precio_oferta'],2);
            $url = $value['url'];
            $id_carrito = $value['id_carrito'];
            $cantidad = $value['cantidad'];
            $total_productos = $value['total_productos'];
            $total_final = "$ ". number_format($value['total_final'],2) ;
            $total = "$ ".number_format(($cantidad*$value['precio_oferta']),2);
            $cantidad_limite_cupones = $value['cantidad_limite_cupones'];
            
        }

       

        $contenido.="<div class=\"cart__totals\">";
        $contenido.="<h3>Datos de Pago</h3>";
        $contenido.="<ul>";

        $contenido.="<li>";
        $contenido.="Tarjeta";
        $contenido.="<select class=\"form-control\" name=\"id_tarjeta\" id=\"id_tarjeta\">";
        $contenido.="<option value=\"\">Seleccione Su Tarjeta</option>";
        $query2 = $modelo->traer_tarjetas();
        $query2 = $query2->getResultArray();
        foreach ($query2 as $key => $value) {
            $id_tarjeta = $value['id_tarjeta'];
            $nombre_tarjeta = $value['nombre'];
            $contenido.="<option value=\"".$id_tarjeta."\">".$nombre_tarjeta."</option>";
        }
        $contenido.="</select>";
        $contenido.="</li>";

        $contenido.="<li>";
        $contenido.="Numero de Tarjeta";
        $contenido.="<input type=\"text\" class=\"form-control\" name=\"numero_tarjeta\" id=\"numero_tarjeta\" placeholder=\"Introduzca su Numero de Tarjeta\">";
        $contenido.="</li>";

        $contenido.="<li>";
        $contenido.="Propietario de la Tarjeta";
        $contenido.="<input type=\"text\" class=\"form-control\" name=\"propietario_tarjeta\" id=\"propietario_tarjeta\" placeholder=\"Introduzca el nombre del Propietario\">";
        $contenido.="</li>";
        
        $contenido.="<li>";
        $contenido.="CCV";
        $contenido.="<input type=\"text\" class=\"form-control\" name=\"ccv_tarjeta\" id=\"ccv_tarjeta\" placeholder=\"Introduzca el CCV de la Tarjeta\">";
        $contenido.="</li>";


        $contenido.="<li>";
        $contenido.="Fecha de Expiracion";
        $contenido.="<input type=\"text\" class=\"form-control\" name=\"expiracion_tajeta\" id=\"expiracion_tajeta\" placeholder=\"Introduzca la fecha de expiracion.\">";
        $contenido.="</li>";

        $contenido.="<li>";
        $contenido.="Total";
        $contenido.="<span class=\"new__price\" id=\"precio_total_".$id_carrito."\">$total_final</span>";
        $contenido.="</li>";
        $contenido.="</ul>";
        $contenido.="<a href=\"#\" id=\"btn_pagar\">PAGAR</a>";
        $contenido.="</div>";

        $contenido.="</div>";
        $contenido.="</div>";
        $xdatos['result'] = $contenido;
        return view('pago',$xdatos);
    }
    function actualizar_cantidad(){
        $session = session(); 
        $modelo = $this->ElModelo;
        $id_cliente = $session->get('id_cliente');
        $id_carrito = $this->request->getPost('id_carrito');
        $cantidad = $this->request->getPost('cantidad');
        $query = $modelo->actualizar_cantidad($id_carrito,$cantidad);
        if($query){
            $query2 = $modelo->traer_cantidad_carrito($id_cliente);
            $datosx = $query2->getResultArray();
            foreach ($datosx as $key => $value){
                $total_final = $value['total_final'];
                $total_productos = $value['total_productos'];
            }
            
            $query3 = $modelo->traer_total_oferta($id_carrito);
            $datosx = $query3->getResultArray();
            foreach ($datosx as $key => $value){
                $total_oferta = $value['total_oferta'];
            }

            
            $xdatos['total_final'] = "$ ".number_format($total_final,2);
            $xdatos['total_productos'] =$total_productos;
            $xdatos['total_oferta'] =$total_oferta;
            $xdatos['typeinfo'] = "Success";
        }
        else{
            $xdatos['typeinfo'] = "Error";
            $xdatos['msg'] = "No se pudo actualizar la cantidad de la oferta";
        }
        echo json_encode($xdatos);
    }
    function pagar(){
        $session = session(); 
        $modelo = $this->ElModelo;
        $id_cliente = $session->get('id_cliente');
        $id_tarjeta = $this->request->getPost('id_tarjeta');
        $ccv_tarjeta = $this->request->getPost('ccv_tarjeta');
        $numero_tarjeta = $this->request->getPost('numero_tarjeta');
        $expiracion_tajeta = $this->request->getPost('expiracion_tajeta');
        $propietario_tarjeta = $this->request->getPost('propietario_tarjeta');
        $query = $modelo->generar_pago($id_cliente,$id_tarjeta,$ccv_tarjeta,$numero_tarjeta,$expiracion_tajeta,$propietario_tarjeta);
        if($query){
            $query2 = $modelo->traer_ultimo_id();
            $query2 = $query2->getResultArray();
            foreach ($query2 as $key => $value){
                $id_compra_general = $value['id_compra_general'];
            }

            $xdatos['typeinfo'] = "Success";
            $xdatos['msg'] = "Compra Realizada con Exito!!";
            $xdatos['id_compra_general'] = $id_compra_general;
        }
        else{
            $xdatos['typeinfo'] = "Error";
            $xdatos['msg'] = "No se pudo realizar la compra!!";
        }
        echo json_encode($xdatos);
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
