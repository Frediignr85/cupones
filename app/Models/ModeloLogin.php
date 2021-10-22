<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloLogin extends Model
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
    function insertar_cliente($nombre, $direccion,$telefono, $dui, $fecha_nacimiento, $email, $password){
        $data = $this->db->query("UPDATE tbloferta SET id_estado = '3' WHERE CURDATE() >= fecha_inicio AND id_estado = 2");
        $data = $this->db->query("UPDATE tbloferta SET id_estado = '4' WHERE CURDATE() > fecha_fin AND id_estado = 3");
        $db = \Config\Database::connect();
        $data = [
            'nombre' => $nombre,
            'direccion'  => $direccion,
            'telefono1' => $telefono,
            'dui'  => $dui,
            'fecha_nacimiento' => $fecha_nacimiento,
            'correo'  => $email,
        ];
        $db->table('tblcliente')->insert($data);
        $data = $this->db->query("SELECT * FROM tblcliente ORDER BY id_cliente DESC LIMIT 1");
        $data = $data->getResultArray();
        foreach ($data as $key => $value) {
            $id_cliente = $value['id_cliente'];
        }
        $db = \Config\Database::connect();
        $password1 = md5($password);
        $data = [
            'nombre' => $nombre,
            'usuario'  => $email,
            'password' => $password1,
            'pass'=> $password,
            'id_tipo_usuario'  => '4',
            'id_dependiente' => '0',
            'id_admin_sucursal' => '0',
            'id_cliente' => $id_cliente,
            'activo' => 0,
            'id_sucursal' => 1,
            'id_empresa' => 0
        ];
        $db->table('tblusuario')->insert($data);
        $data = $this->db->query("SELECT * FROM tblusuario ORDER BY id_usuario DESC LIMIT 1");
        $data = $data->getResultArray();
        foreach ($data as $key => $value) {
            $id_usuario = $value['id_usuario'];
        }
        return $id_usuario;
    }
    function activar_cuenta($id){
        $db = \Config\Database::connect();
        $data = $this->db->query("SELECT * FROM tblusuario WHERE activo = 0 ORDER BY id_usuario DESC ");
        $data = $data->getResultArray();
        $id_usuario_x = 0;
        foreach ($data as $key => $value) {
            if($id == md5($value['id_usuario'])){
                $id_usuario_x = $value['id_usuario'];
            }
        }
        if($id_usuario_x == 0){
            return false;
        }   
        else{
            $builder = $db->table('tblusuario');
            $data = [
                'activo' => '1',
            ];
            $builder->where('id_usuario', $id_usuario_x);
            $builder->update($data);
            return $builder;
        }
        
    }
}

?>