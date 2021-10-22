<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloInicio extends Model
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
    public function traer_ultimas_ofertas()
    {
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.precio_oferta, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tbloferta.url FROM tbloferta WHERE tbloferta.deleted_at is NULL AND tbloferta.id_estado = 3 ORDER BY tbloferta.id_oferta DESC LIMIT 10");
        return $data;
    }
    public function traer_2_random()
    {
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.precio_oferta, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tbloferta.url FROM tbloferta WHERE tbloferta.deleted_at is NULL AND tbloferta.id_estado = 3 ORDER BY RAND() limit 2");
        return $data;
    }
    public function traer_5_random()
    {
        $data = $this->db->query("SELECT tbloferta.id_oferta, tbloferta.descripcion, tbloferta.precio_oferta, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.ilimitado, tbloferta.url FROM tbloferta WHERE tbloferta.deleted_at is NULL AND tbloferta.id_estado = 3 ORDER BY RAND() limit 5");
        return $data;
    }

    function traer_datos_oferta($id_oferta){
        $data = $this->db->query("SELECT * FROM tbloferta WHERE id_oferta = '$id_oferta'");
        return $data;
    }
    function traer_cantidad_carrito($id_cliente){
        $data = $this->db->query("SELECT SUM(cantidad) as 'cantidad' FROM tblcarrito WHERE id_cliente = '$id_cliente'");
        return $data;
    }
    function agregar_carrito($id_oferta,$id_cliente){
        $data = $this->db->query("SELECT * FROM tblcarrito WHERE id_cliente = ' $id_cliente' AND id_oferta = '$id_oferta'");
        $data = $data->getResultArray();
        $contador = 0;
        foreach ($data as $key => $value) {
            $contador++;
        }
        if($contador == 0){
            $db = \Config\Database::connect();
            $data = [
                'id_cliente' => $id_cliente,
                'id_oferta'  => $id_oferta,
                'cantidad' => 1,
            ];
            return $db->table('tblcarrito')->insert($data);
        }
        else{
            return 0;
        }
    }
    function verificar_existencia_carrito($id_oferta,$id_cliente){
        $data = $this->db->query("SELECT * FROM tblcarrito WHERE id_cliente = '$id_cliente' AND id_oferta = '$id_oferta'");
        $data = $data->getResultArray();
        $contador = 0;
        foreach ($data as $key => $value) {
            $contador++;
        }
        if($contador == 0){
            return 0;
        }
        else{
            return 1;
        }
    }

}

?>