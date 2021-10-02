<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloDependiente extends Model
{
    protected $table      = 'tbldependiente';
    protected $primaryKey = 'id_dependiente';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombres', 'apellidos', 'correo','id_empresa'];
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    

    function datos_empresa($id_empresa){
        $data = $this->db->query("SELECT * FROM tblempresa WHERE id_empresa = '$id_empresa'");
        return $data;
    }
    function verificar_username($username){
        $data = $this->db->query("SELECT * FROM tblusuario WHERE usuario = '$username' AND id_tipo_usuario != '4'");
        return $data;
    }
    function verificar_credenciales($username,$password){
        $data = $this->db->query("SELECT * FROM tblusuario WHERE password = '".MD5($password)."' AND usuario = '$username' AND id_tipo_usuario != '4'");
        return $data;
    }

    function verificar_permiso($id_user, $filename){
          
        $sql1="SELECT tblmenu.id_menu, tblmenu.nombre as nombremenu, tblmenu.prioridad,
            tblmodulo.id_modulo,  tblmodulo.nombre as nombremodulo, tblmodulo.descripcion, tblmodulo.filename,
            tblusuario_modulo.id_usuario,tblUsuario.id_tipo_usuario as admin
            FROM tblmenu, tblmodulo, tblusuario_modulo, tblUsuario
            WHERE tblUsuario.id_usuario='$id_user'
            AND tblmenu.id_menu=tblmodulo.id_menu_MOD
            AND tblUsuario.id_usuario=tblusuario_modulo.id_usuario
            AND tblusuario_modulo.id_modulo=tblmodulo.id_modulo
            AND tblmodulo.filename='$filename'
            AND tblusuario_modulo.deleted_at is NULL";
         $data = $this->db->query($sql1);
         if(count($data->getResult()) > 0){
            foreach ($data->getResult('array') as $value){
                $admin=$value['admin'];
                $nombremodulo=$value['nombremodulo'];
                $filename=$value['filename'];
                $name_link=$filename;
            }
         }
         else{
            $name_link='NOT';
         }
         return $name_link;
    }
    function dependientes($admin, $id_empresa){
        if($admin){
            $data = $this->db->query("SELECT tbldependiente.id_dependiente, tbldependiente.nombres, tbldependiente.apellidos, tbldependiente.correo, tblempresa_ofertante.nombre FROM tbldependiente INNER JOIN tblempresa_ofertante on tblempresa_ofertante.id_empresa = tbldependiente.id_empresa WHERE tbldependiente.deleted_at is NULL");
        }
        else{
            $data = $this->db->query("SELECT tbldependiente.id_dependiente, tbldependiente.nombres, tbldependiente.apellidos, tbldependiente.correo, tblempresa_ofertante.nombre FROM tbldependiente INNER JOIN tblempresa_ofertante on tblempresa_ofertante.id_empresa = tbldependiente.id_empresa WHERE tbldependiente.deleted_at is NULL AND tbldependiente.id_empresa = '$id_empresa'");
        }
        return $data;
    }
    function rubros(){
        $data = $this->db->query("SELECT * FROM tblrubro WHERE deleted_at is NULL");
        return $data;
    }
    function municipios_libre(){
        $data = $this->db->query("SELECT * FROM tblmunicipio WHERE deleted_at is NULL");
        return $data;
    }
    function municipios($id_departamento){
        $data = $this->db->query("SELECT * FROM tblmunicipio WHERE deleted_at is NULL AND id_departamento_MUN = '$id_departamento'");
        return $data;
    }
    function departamentos(){
        $data = $this->db->query("SELECT * FROM tbldepartamento WHERE deleted_at is NULL");
        return $data;
    }

    function insertar_dependiente($nombre,$apellido,$correo, $id_empresa){
        $db = \Config\Database::connect();
        $dependienteModel = new \App\Models\ModeloDependiente();
        $dependienteModel = model('ModeloDependiente', true, $db);
        $data = [
            'nombres' => $nombre,
            'apellidos' => $apellido,
            'correo' => $correo,
            'id_empresa' => $id_empresa
        ];
        $dependienteModel->insert($data);
        $id_dependiente = $dependienteModel->getInsertID();
        $nombre_usuario="";
        if(strstr($nombre, " ") != false) {
            $div_nombre = explode(" ",$nombre);
            $nombre_usuario.=$div_nombre[0]."_";
        }
        else{
            $nombre_usuario.=$nombre."_";
        }
        if(strstr($apellido, " ") != false) {
            $div_apellido = explode(" ",$apellido);
            $nombre_usuario.=$div_apellido[0];
        }
        else{
            $nombre_usuario.=$apellido;
        }
        $nombre_usuario.="_".$id_dependiente;
        $db = \Config\Database::connect();
        $data = [
            'nombre' => $nombre." ".$apellido,
            'usuario'  => $nombre_usuario,
            'password' => MD5("123456789"),
            'id_tipo_usuario' => "3",
            'id_dependiente' =>$id_dependiente,
            'id_admin_sucursal' => '0',
            'id_cliente' => '0',
            'activo' => '0',
            'id_sucursal' => 1,
            'id_empresa' => $id_empresa
        ];
        return $db->table('tblusuario')->insert($data);
    }
    function traer_datos_dependiente($id_dependiente){
        $data = $this->db->query("SELECT * FROM tbldependiente WHERE id_dependiente = '$id_dependiente'");
        return $data;
    }
    function modificar_dependiente($nombre,$apellido,$correo,$correo_viejo,$id_dependiente){
        $db = \Config\Database::connect();
        $builder = $db->table('tbldependiente');
        $data = [
            'nombres' => $nombre,
            'apellidos'  => $apellido,
            'correo' => $correo
        ];
        $builder->where('id_dependiente', $id_dependiente);
        $builder->update($data);
        $builder2 = 1;
        if($correo != $correo_viejo){
            $builder2 = $db->table('tblusuario');
            $data2 = [
                'activo' => 0,
            ];
            $builder2->where('id_dependiente', $id_dependiente);
            $builder2->update($data2);
        }
        if($builder && $builder2){
            return 1;
        }
        else{
            return 0;
        }
    }
    function borrar_dependiente($id_dependiente){
        $dependienteModel = new \App\Models\ModeloDependiente();
        $db = \Config\Database::connect();
        $dependienteModel = model('ModeloDependiente', true, $db);
        return $dependienteModel->delete($id_dependiente);
    }

}

?>