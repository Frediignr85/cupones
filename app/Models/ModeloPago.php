<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloPago extends Model
{
    function verificar_username($username){
        $data = $this->db->query("SELECT * FROM tblusuario WHERE usuario = '$username' AND id_tipo_usuario = '4'");
        return $data;
    }
    function traer_tarjetas(){
        $data = $this->db->query("SELECT * FROM tbltarjeta WHERE deleted_at is NULL");
        return $data;
    }
    function actualizar_cantidad($id_carrito,$cantidad){
        $db = \Config\Database::connect();
        $builder = $db->table('tblcarrito');
        $data = [
            'cantidad' => $cantidad,
        ];
        $builder->where('id_carrito', $id_carrito);
        $builder->update($data);
        return $builder;
    }
    function traer_productos_carrito($id_cliente){
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tblcliente.id_cliente, tbloferta.titulo_oferta, tbloferta.precio_oferta, tbloferta.url, tblcarrito.id_carrito, tblcarrito.cantidad, (SELECT SUM(tblcarrito.cantidad) FROM tblcarrito WHERE tblcarrito.id_cliente = tblcliente.id_cliente) as 'total_productos', (SELECT SUM(oferta1.precio_oferta*carrito1.cantidad) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente) as 'total_final' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcliente.id_cliente = '$id_cliente' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
        return $data;
    }


    function traer_cantidad_carrito($id_cliente){
        $data = $this->db->query("SELECT (SELECT SUM(tblcarrito.cantidad) FROM tblcarrito WHERE tblcarrito.id_cliente = tblcliente.id_cliente) as 'total_productos', (SELECT SUM(carrito1.cantidad*oferta1.precio_oferta) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente) as 'total_final' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcliente.id_cliente = '$id_cliente' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
        return $data;
    }
    function traer_total_oferta($id_carrito){
        $data = $this->db->query("SELECT (SELECT SUM(oferta1.precio_oferta*carrito1.cantidad) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente AND carrito1.id_carrito = '$id_carrito') as 'total_oferta' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcarrito.id_carrito = '$id_carrito' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
        return $data;
    }
    function generar_pago($id_cliente,$id_tarjeta,$ccv_tarjeta,$numero_tarjeta,$expiracion_tajeta,$propietario_tarjeta){
        $this->db->transStart();
        $data_total = $this->db->query("SELECT  (SELECT SUM(carrito1.cantidad*oferta1.precio_oferta) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente) as 'total_final' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcliente.id_cliente = '$id_cliente' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL LIMIT 1");
        $data_total = $data_total->getResultArray();
        foreach ($data_total as $key => $value) {
            $total_final = $value['total_final'];
        }
        /* QUERY PARA INGRESAR LA COMPRA GENERAL */
        $sql1 = "INSERT INTO tblcompra_general(total_compra, id_cliente, id_tarjeta, nombre_dueno, numero_tarjeta, fecha_expiracion, ccv) VALUES ('".$total_final."','".$id_cliente."',
        '".$id_tarjeta."','".$propietario_tarjeta."','".$numero_tarjeta."', '".$expiracion_tajeta."', '".$ccv_tarjeta."')";
        $this->db->query($sql1);

        /* QUERY PARA OBTENER EL ID DE LA COMPRA GENERAL */
        $consulta_id_compra_general = $this->db->query("SELECT tblcompra_general.id_compra_general FROM tblcompra_general ORDER BY id_compra_general DESC LIMIT 1");
        $consulta_id_compra_generaL = $consulta_id_compra_general->getResultArray();
        foreach ($consulta_id_compra_generaL as $key => $value) {
            $id_compra_general = $value['id_compra_general'];
        }
        /* QUERY PARA OBTENER LOS TOTALES POR EMPRESAS */
        $consulta_carrito_empresa = $this->db->query("SELECT tblempresa_ofertante.id_empresa, SUM(tblcarrito.cantidad*tbloferta.precio_oferta) as 'total_empresa' FROM tblcarrito INNER JOIN tbloferta on tbloferta.id_oferta = tblcarrito.id_oferta INNER JOIN tblempresa_ofertante on tblempresa_ofertante.id_empresa = tbloferta.id_empresa WHERE tblcarrito.id_cliente = '$id_cliente' GROUP BY tblempresa_ofertante.id_empresa ");
        $consulta_carrito_empresa = $consulta_carrito_empresa->getResultArray();
        foreach ($consulta_carrito_empresa as $key => $value) {
            $id_empresa = $value['id_empresa'];
            $total_empresa = $value['total_empresa'];
            $sql2 = "INSERT INTO tblcompra_especifica(id_compra_general, id_empresa, total_compra) VALUES ('".$id_compra_general."','".$id_empresa."','".$total_empresa."')";
            $this->db->query($sql2);
            /* QUERY PARA OBTENER EL ID DE LA COMPRA ESPECIFICA */
            $consulta_id_compra_especifica = $this->db->query("SELECT tblcompra_especifica.id_compra_especifica FROM tblcompra_especifica ORDER BY id_compra_especifica DESC LIMIT 1");
            $consulta_id_compra_especifica = $consulta_id_compra_especifica->getResultArray();
            foreach ($consulta_id_compra_especifica as $key => $value) {
                $id_compra_especifica = $value['id_compra_especifica'];
            }
            /* QUERY PARA RECORRER TODAS LAS OFERTAS COMPRADAS */
            $consulta_carrito_detalle = $this->db->query("SELECT tbloferta.id_oferta, (tbloferta.precio_oferta*tblcarrito.cantidad) as 'total', tbloferta.precio_oferta, tblcarrito.cantidad, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta WHERE tbloferta.id_empresa = '$id_empresa' AND tblcarrito.id_cliente = '$id_cliente'");
            $consulta_carrito_detalle = $consulta_carrito_detalle->getResultArray();
            foreach ($consulta_carrito_detalle as $key => $value1){
                $id_oferta = $value1['id_oferta'];
                $total = $value1['total'];
                $precio_oferta = $value1['precio_oferta'];
                $cantidad = $value1['cantidad'];
                $cantidad_limite_cupones = $value1['cantidad_limite_cupones'];
                $ilimitado = $value1['ilimitado'];
                $sql3 = "INSERT INTO tblcompra_detalle(id_compra_especifica, id_oferta, precio_unitario, cantidad, canjeada, total_compra) VALUES 
                ('".$id_compra_especifica."','".$id_oferta."','".$precio_oferta."','".$cantidad."','0','".$total."')";
                $this->db->query($sql3);
                if($ilimitado == 0){
                    /* PROCESO PARA ACTUALIZAR LA CANTIDAD DE CUPONES EN CASO DE QUE ESTOS NO SEAN ILIMITADOS */
                    $cantidad_nueva = $cantidad_limite_cupones - $cantidad;
                    $sql4 = "UPDATE tbloferta SET cantidad_limite_cupones = '$cantidad_nueva' WHERE id_oferta = '$id_oferta'";
                    $this->db->query($sql4);
                }
            }
        }
        /* QUERY PARA BORRAR TODOS LOS REGISTROS DEL CARRITO DEL CLIENTE EN ESPECIFICO */
        $sql5 = "DELETE FROM tblcarrito WHERE id_cliente = '$id_cliente'";
        $this->db->query($sql5);
        $this->db->transComplete();
        return $this->db->transStatus();
    }

    function traer_ultimo_id(){
        $data = $this->db->query("SELECT * FROM tblcompra_general ORDER BY id_compra_general DESC LIMIT 1");
        return $data;
    }
    function traer_info_compra($id_compra_general){
        $data = $this->db->query("SELECT tblcompra_general.id_compra_general, tblcompra_general.total_compra, tblcompra_general.numero_tarjeta, tblcompra_general.created_at, tblcompra_general.nombre_dueno, tblcliente.nombre, tblcliente.dui FROM tblcompra_general INNER JOIN tblcliente on tblcliente.id_cliente = tblcompra_general.id_cliente WHERE tblcompra_general.id_compra_general = '$id_compra_general'");
        return $data;
    }
}

?>