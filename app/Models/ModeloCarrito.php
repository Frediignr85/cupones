<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloCarrito extends Model
{
    function verificar_username($username){
        $data = $this->db->query("SELECT * FROM tblusuario WHERE usuario = '$username' AND id_tipo_usuario = '4'");
        return $data;
    }
    function verificar_credenciales($username,$password){
        $data = $this->db->query("SELECT * FROM tblusuario WHERE password = '".MD5($password)."' AND usuario = '$username' AND id_tipo_usuario = '4' AND activo = 1");
        return $data;
    }
    function verificar_correo($email){
        $data = $this->db->query("SELECT * FROM tblcliente WHERE correo = '$email' AND deleted_at is NULL");
        return $data;
    }
    public function todas_las_ofertas()
    {
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.precio_oferta, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tbloferta.url FROM tbloferta WHERE tbloferta.deleted_at is NULL AND tbloferta.id_estado = 3 ");
        return $data;
    }
    function traer_productos_carrito($id_cliente){
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tblcliente.id_cliente, tbloferta.titulo_oferta, tbloferta.precio_oferta, tbloferta.url, tblcarrito.id_carrito, tblcarrito.cantidad, (SELECT SUM(tblcarrito.cantidad) FROM tblcarrito WHERE tblcarrito.id_cliente = tblcliente.id_cliente) as 'total_productos', (SELECT SUM(oferta1.precio_oferta*carrito1.cantidad) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente) as 'total_final' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcliente.id_cliente = '$id_cliente' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
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
    function traer_cantidad_carrito($id_cliente){
        $data = $this->db->query("SELECT (SELECT SUM(tblcarrito.cantidad) FROM tblcarrito WHERE tblcarrito.id_cliente = tblcliente.id_cliente) as 'total_productos', (SELECT SUM(carrito1.cantidad*oferta1.precio_oferta) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente) as 'total_final' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcliente.id_cliente = '$id_cliente' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
        return $data;
    }
    function traer_total_oferta($id_carrito){
        $data = $this->db->query("SELECT (SELECT SUM(oferta1.precio_oferta*carrito1.cantidad) FROM tbloferta as oferta1 INNER JOIN tblcarrito as carrito1 on oferta1.id_oferta = carrito1.id_oferta WHERE carrito1.id_cliente = tblcliente.id_cliente AND carrito1.id_carrito = '$id_carrito') as 'total_oferta' FROM tbloferta INNER JOIN tblcarrito on tblcarrito.id_oferta = tbloferta.id_oferta INNER JOIN tblcliente on tblcliente.id_cliente = tblcarrito.id_cliente WHERE tblcarrito.id_carrito = '$id_carrito' and tblcarrito.deleted_at is NULL AND tbloferta.deleted_at is NULL");
        return $data;
    }
    function eliminar_item($id_carrito){
        $this->db->transStart();
        $sql5 = "DELETE FROM tblcarrito WHERE id_carrito = '$id_carrito'";
        $this->db->query($sql5);
        $this->db->transComplete();
        return $this->db->transStatus();
    }
}

?>