<?php

namespace App\Controllers;
use App\Models\ModeloCarrito;
header('Access-Control-Allow-Origin: *');
class Carrito extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloCarrito();
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
        $contenido.="<th>IMAGEN</th>";
        $contenido.="<th>NOMBRE</th>";
        $contenido.="<th>PRECIO UNIT.</th>";
        $contenido.="<th>CANTIDAD</th>";
        $contenido.="<th>CUPONES DISP.</th>";
        $contenido.="<th>TOTAL</th>";
        $contenido.="<th>ACCION</th>";
        $contenido.="</tr>";
        $contenido.="</thead>";
        $contenido.="<tbody>";

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
            $cantidad_cupones = $cantidad_limite_cupones;
            $ilimitado = $value['ilimitado'];
            if($ilimitado){
                $cantidad_cupones = "Ilimitados";
            }

            $contenido.="<tr id=\"$id_carrito\">";
            $contenido.="<td class=\"product__thumbnail\">";
            $contenido.="<a href=\"#\">";
            $contenido.="<img src=\"".$url."\" alt=\"\">";
            $contenido.="</a>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__name\">";
            $contenido.="<a href=\"#\">$titulo_oferta</a>";
            $contenido.="<br><br>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__price\">";
            $contenido.="<div class=\"price\">";
            $contenido.="<span class=\"new__price\">$precio_oferta</span>";
            $contenido.="</div>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__quantity\">";
            $contenido.="<div class=\"input-counter\">";
            $contenido.="<div>";
            $contenido.="<span class=\"minus-btn\" id_carrito=\"$id_carrito\" >";
            $contenido.="<svg>";
            $contenido.=" <use xlink:href=\"".base_url("/assets/images/sprite.svg#icon-minus")."\"></use>";
            $contenido.="</svg>";
            $contenido.="</span>";
            $contenido.="<input   type=\"text\" cantidad_cupones=\"$cantidad_cupones\" id=\"carrito_".$id_carrito."\" min=\"1\" value=\"$cantidad\" max=\"10\" class=\"counter-btn\" onKeyPress=\"return onlyNumberKey(event)\" pattern=\"[0-9]+\">";
            $contenido.="<span class=\"plus-btn\" id_carrito=\"$id_carrito\" cantidad_cupones=\"$cantidad_cupones\">";
            $contenido.="<svg>";
            $contenido.="<use xlink:href=\"".base_url("/assets/images/sprite.svg#icon-plus")."\"></use>";
            $contenido.="</svg>";
            $contenido.="</span>";
            $contenido.="</div>";
            $contenido.="</div>";
            $contenido.="</td>";
            $contenido.="<td>";
            $contenido.="<span class=\"new__price\">$cantidad_cupones</span>";
            $contenido.="</td>";
            $contenido.="<td class=\"product__subtotal\">";
            $contenido.="<div class=\"price\">";
            $contenido.="<span class=\"new__price\" id=\"precio_oferta".$id_carrito."\">$total</span>";
            $contenido.="</div>";
            $contenido.="</td>";
            $contenido.="<td>";
            $contenido.="<a class=\"remove__cart-item\" id_carrito=\"$id_carrito\">";
            $contenido.="<svg>";
            $contenido.="<use xlink:href=\"".base_url("/assets/images/sprite.svg#icon-trash")."\"></use>";
            $contenido.="</svg>";
            $contenido.="</a>";
            $contenido.="</td>";
            $contenido.="</tr>";
        }
        $contenido.="</tbody>";
        $contenido.="</table>";
        $contenido.="</div>";

        $contenido.="<div class=\"cart-btns\">";
        $contenido.="<div class=\"continue__shopping\">";
        $contenido.="<a href=\"inicio\">Continuar Comprando</a>";
        $contenido.="</div>";
        $contenido.="</div>";

        $contenido.="<div class=\"cart__totals\">";
        $contenido.="<h3>Totales de la compra</h3>";
        $contenido.="<ul>";
        $contenido.="<li>";
        $contenido.="Total de Items";
        $contenido.="<span class=\"new__price\" id=\"productos_total"."\">$total_productos</span>";
        $contenido.="</li>";
        $contenido.="<li>";
        $contenido.="Total";
        $contenido.="<span class=\"new__price\" id=\"precio_total\">$total_final</span>";
        $contenido.="</li>";
        $contenido.="</ul>";
        $contenido.="<a href=\"pago/\">PROCEDER A PAGAR</a>";
        $contenido.="</div>";
        $contenido.="</form>";
        $contenido.="</div>";
        $contenido.="</div>";
        $xdatos['result'] = $contenido;
        return view('carrito',$xdatos);
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
            $xdatos['total_oferta'] = "$ ".number_format($total_oferta,2);
            $xdatos['typeinfo'] = "Success";
        }
        else{
            $xdatos['typeinfo'] = "Error";
            $xdatos['msg'] = "No se pudo actualizar la cantidad de la oferta";
        }
        echo json_encode($xdatos);
    }
    function eliminar_item(){
        $session = session(); 
        $modelo = $this->ElModelo;
        $id_cliente = $session->get('id_cliente');
        $id_carrito = $this->request->getPost('id_carrito');
        $query = $modelo->eliminar_item($id_carrito);
        if($query){
            $query2 = $modelo->traer_cantidad_carrito($id_cliente);
            $datosx = $query2->getResultArray();
            foreach ($datosx as $key => $value){
                $total_final = $value['total_final'];
                $total_productos = $value['total_productos'];
            }          
            $xdatos['total_final'] = "$ ".number_format($total_final,2);
            $xdatos['total_productos'] =$total_productos;
            $xdatos['typeinfo'] = "Success";
        }
        else{
            $xdatos['typeinfo'] = "Error";
            $xdatos['msg'] = "No se pudo eliminar el item!";
        }
        echo json_encode($xdatos);   
    }
}
