<?php

namespace App\Controllers;
use App\Models\ModeloInicio;
header('Access-Control-Allow-Origin: *');
class Inicio extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloInicio();
        helper('url');
    }
    public function index()
    {
        $session = session(); 
        $modelo = $this->ElModelo;
        $query = $modelo->todas_las_ofertas();
        $result = $query->getResultArray();
        $contenido = "";
        foreach ($result as $key => $value) {
            $contenido.="<div class=\"product\">";
            $contenido.="<div class=\"product__header\">";
            $contenido.="<img src=\"".$value['url']."\" alt=\"product\">";
            $contenido.="</div>";
            $contenido.="<div class=\"product__footer\">";         
            $titulo = $value['titulo_oferta'];
            if(strlen($titulo) > 30){
                $titulo =  substr($titulo, 0, 26)."..."; 
            }
            $contenido.="<h3>$titulo</h3>";
            $contenido.="<div class=\"rating\">";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="</div>";
            $contenido.="<div class=\"product__price\">";
            $contenido.="<h4>$ ".number_format($value['precio_oferta'],2)."</h4>";
            $contenido.="</div>";
            if(is_numeric($session->get('id_usuario'))){
                $id_oferta = $value['id_oferta'];
                $id_cliente = $session->get('id_cliente');
                $queryx = $modelo->verificar_existencia_carrito($id_oferta,$id_cliente);
                if($queryx){
                    $contenido.="<a class=\"\" id=\"".$value['id_oferta']."\"><button type=\"submit\" class=\"product__btn agregar_carrito_hijo\">Listo Para Comprar</button></a>";
                }
                else{
                    $contenido.="<a class=\"btn_agregar_carrito\" id=\"".$value['id_oferta']."\"><button type=\"submit\" class=\"product__btn agregar_carrito_hijo\">Agregar al Carrito</button></a>";
                }
            }
            
            $contenido.="</div>";
            $contenido.="<ul>";
            $contenido.="<li>";
            $contenido.="<a  data-toggle='modal' href=\"".base_url("/inicio/ver_oferta?id_oferta=".$value['id_oferta'])."\"  data-target='#deleteModal' data-refresh='true'>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("/assets/images/sprite.svg#icon-eye")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="</a>";
            $contenido.="</li>";
            $contenido.="</ul>";
            $contenido.="</div>";
        }
        $datos['result'] = $contenido;
        $query2 = $modelo->traer_ultimas_ofertas();
        $query2 = $query2->getResultArray();
        $contenido = "";
        foreach ($query2 as $key => $value) {
            $contenido.="<li class=\"glide__slide\">";
            $contenido.="<div class=\"product\">";
            $contenido.="<div class=\"product__header\">";
            $contenido.="<img src=\"".$value['url']."\" alt=\"product\">";
            $contenido.="</div>";
            $contenido.="<div class=\"product__footer\">";         
            $titulo = $value['titulo_oferta'];
            if(strlen($titulo) > 30){
                $titulo =  substr($titulo, 0, 26)."..."; 
            }
            $contenido.="<h3>$titulo</h3>";
            $contenido.="<div class=\"rating\">";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("assets/images/sprite.svg#icon-star-full")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="</div>";
            $contenido.="<div class=\"product__price\">";
            $contenido.="<h4>$ ".number_format($value['precio_oferta'],2)."</h4>";
            $contenido.="</div>";
            if(is_numeric($session->get('id_usuario'))){
                $id_oferta = $value['id_oferta'];
                $id_cliente = $session->get('id_cliente');
                $queryx = $modelo->verificar_existencia_carrito($id_oferta,$id_cliente);
                if($queryx){
                    $contenido.="<a class=\"\" id=\"".$value['id_oferta']."\"><button type=\"submit\" class=\"product__btn agregar_carrito_hijo\">Listo Para Comprar</button></a>";
                }
                else{
                    $contenido.="<a class=\"btn_agregar_carrito\" id=\"".$value['id_oferta']."\"><button type=\"submit\" class=\"product__btn agregar_carrito_hijo\">Agregar al Carrito</button></a>";
                }
            }
            
            $contenido.="</div>";
            $contenido.="<ul>";
            $contenido.="<li>";
            $contenido.="<a  data-toggle='modal' href=\"".base_url("/inicio/ver_oferta?id_oferta=".$value['id_oferta'])."\"  data-target='#deleteModal' data-refresh='true'>";
            $contenido.="<svg>";
            $contenido.="<use";
            $contenido.=" xlink:href=\"".base_url("/assets/images/sprite.svg#icon-eye")."\">";
            $contenido.="</use>";
            $contenido.="</svg>";
            $contenido.="</a>";
            $contenido.="</li>";
            $contenido.="</ul>";
            $contenido.="</div>";
            $contenido.="</li>";
        }
        $datos['result2'] = $contenido;
        $query3 = $modelo->traer_2_random();
        $query3 = $query3->getResultArray();
        $contenido = "";
        foreach ($query3 as $key => $value) {
            $contenido.="<div class=\"collection__box\">";
            $contenido.="<div class=\"img__container\">";
            $contenido.="<img class=\"collection_02\" src=\"".$value['url']."\" alt=\"producto\">";
            $contenido.=" </div>";
            $contenido.="<div class=\"collection__content\">";
            $contenido.="<div class=\"collection__data\">";
            $contenido.="<span>".$value['titulo_oferta']."</span>";
            $contenido.="<h1 style=\"color:green;\">$ ".number_format($value['precio_oferta'],2)."</h1>";
            if(is_numeric($session->get('id_usuario'))){
                $id_oferta = $value['id_oferta'];
                $id_cliente = $session->get('id_cliente');
                $queryx = $modelo->verificar_existencia_carrito($id_oferta,$id_cliente);
                if($queryx){
                    $contenido.="<a class=\"\" id=\"".$value['id_oferta']."\"><button class=\"hero__btn agregar_carrito_hijo\">Listo Para Comprar</button></a>";
                }
                else{
                    $contenido.="<a class=\"btn_agregar_carrito\" id=\"".$value['id_oferta']."\"><button class=\"hero__btn agregar_carrito_hijo\">Agregar al Carrito</button></a>";
                }
            }
            $contenido.="</div>";
            $contenido.="</div>";
            $contenido.="</div>";
        }
        $datos['result3'] =$contenido;
        $query4 = $modelo->traer_5_random();
        $query4 = $query4->getResultArray();
        $contenido = "";
        foreach ($query4 as $key => $value) {
            $contenido.="<li class=\"glide__slide\">";
            $contenido.="<div class=\"hero__center\">";
            $contenido.="<div class=\"hero__left\">";
            $contenido.="<span class=\"\" style=\"color:green;\">$ ".number_format($value['precio_oferta'],2)."</span>";
            $contenido.="<h1 class=\"\">".$value['titulo_oferta']."</h1>";
            $contenido.="<p>".$value['descripcion']."</p>";
            if(is_numeric($session->get('id_usuario'))){
                $id_oferta = $value['id_oferta'];
                $id_cliente = $session->get('id_cliente');
                $queryx = $modelo->verificar_existencia_carrito($id_oferta,$id_cliente);
                if($queryx){
                
                    $contenido.="<a class=\"\" id=\"".$value['id_oferta']."\"><button class=\"hero__btn agregar_carrito_hijo\">Listo Para Comprar</button></a>";
                }
                else{
                    $contenido.="<a class=\"btn_agregar_carrito\" id=\"".$value['id_oferta']."\"><button class=\"hero__btn agregar_carrito_hijo\">Agregar al Carrito</button></a>";
                }
            }
            $contenido.="</div>";
            $contenido.="<div class=\"hero__right\">";
            $contenido.="<div class=\"hero__img-container\">";
            $contenido.="<img class=\"banner_01\" src=\"".$value['url']."\" alt=\"banner2\" />";
            $contenido.="</div>";
            $contenido.="</div>";
            $contenido.="</div>";
            $contenido.="</li>";
        }
        $datos['result4'] = $contenido;
        return view('inicio',$datos);
    }
    function ver_oferta(){
        $modelo = $this->ElModelo;
        $id_oferta = $this->request->getGet('id_oferta');
        $query = $modelo->traer_datos_oferta($id_oferta);
        $datosx = $query->getResultArray();
        foreach ($datosx as $key => $value) {
            $datos2['id_oferta'] = $value['id_oferta'];
            $datos2['titulo'] = $value['titulo_oferta'];
            $datos2['precio_regular'] = $value['precio_regular'];
            $datos2['precio_oferta'] = $value['precio_oferta'];
            $datos2['fecha_inicio'] = ($value['fecha_inicio']);
            $datos2['fecha_fin'] = ($value['fecha_fin']);
            $datos2['fecha_limite'] = ($value['fecha_limite']);
            $datos2['cantidad_limite_cupones'] = $value['cantidad_limite_cupones'];
            $datos2['descripcion'] = $value['descripcion'];
            $datos2['otros_detalles'] = $value['otros_detalles'];
            $datos2['ilimitado'] = $value['ilimitado'];
        }
        echo view('ver_oferta',$datos2);
    }
    function agregar_carrito(){
        $modelo = $this->ElModelo;
        $session = session(); 
        $id_cliente = $session->get('id_cliente');
        $id_oferta = $this->request->getPost('id_oferta');
        $query = $modelo->agregar_carrito($id_oferta,$id_cliente);
        if($query){
            $query2 = $modelo->traer_cantidad_carrito($id_cliente);
            $datosx = $query2->getResultArray();
            foreach ($datosx as $key => $value){
                $cantidad = $value['cantidad'];
            }
            $datosx['typeinfo'] = "Success";
            $datosx['msg'] ="Producto Agregado con Exito!";
            $datosx['cantidad'] =$cantidad;
        }
        else{
            $datosx['typeinfo'] = "Error";
            $datosx['msg'] ="No se pudo Agregar el Producto porque ya esta en el carrito!";
        }
        echo json_encode($datosx);
    }
    function actualizar_carrito(){
        $modelo = $this->ElModelo;
        $session = session(); 
        $id_cliente = $session->get('id_cliente');
        $query2 = $modelo->traer_cantidad_carrito($id_cliente);
        $datosx = $query2->getResultArray();
        foreach ($datosx as $key => $value){
            $cantidad = $value['cantidad'];
        }
        $datosx['cantidad'] =$cantidad;
        echo json_encode($datosx);
    }
}
