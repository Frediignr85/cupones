<?php

namespace App\Controllers;
use App\Models\ModeloPassword;
header('Access-Control-Allow-Origin: *');
class Password extends BaseController
{
    function __construct()
    {
        $this->ElModelo = new ModeloPassword();
        helper('url');
    }
    public function index()
    {
        echo view('password');
    }
    function cambiar_password(){
        $modelo = $this->ElModelo;
        $session = session(); 
        $id_usuario = $session->get('id_usuario');
        $oldpass = $this->request->getPost('oldpass');
        $newpass = $this->request->getPost('newpass');
        $query = $modelo->verificar_password($oldpass,$id_usuario);
        if($query){
            $query2 = $modelo->cambiar_password($newpass,$id_usuario);
            if($query2){
                $xdatos['typeinfo'] = "Success";
                $xdatos['msg'] = "Contraseña cambiada con exito.";
            }
            else{
                $xdatos['typeinfo'] = "Error";
                $xdatos['msg'] = "No se pudo cambiar La contraseña intente mas tarde.";
            }
        }   
        else{
            $xdatos['typeinfo'] = "Error";
            $xdatos['msg'] = "La contraseña vieja no coincide.";
        }
        echo json_encode($xdatos);
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
