<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloTarjeta extends Model
{
    protected $table      = 'tbltarjeta';
    protected $primaryKey = 'id_tarjeta';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombre'];
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function verificar_permiso($id_user, $filename){
          
        $sql1="SELECT tblmenu.id_menu, tblmenu.nombre as nombremenu, tblmenu.prioridad,
            tblmodulo.id_modulo,  tblmodulo.nombre as nombremodulo, tblmodulo.descripcion, tblmodulo.filename,
            tblusuario_modulo.id_usuario,tblusuario.id_tipo_usuario as admin
            FROM tblmenu, tblmodulo, tblusuario_modulo, tblusuario
            WHERE tblusuario.id_usuario='$id_user'
            AND tblmenu.id_menu=tblmodulo.id_menu_MOD
            AND tblusuario.id_usuario=tblusuario_modulo.id_usuario
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

    function traer_tarjetas(){
        $db = \Config\Database::connect();
        $tarjetaModel = new \App\Models\ModeloTarjeta();
        $tarjetaModel = model('ModeloTarjeta', true, $db);
        $rubros = $tarjetaModel->findAll();
        return $rubros;
    }
    function insertar_tarjeta($nombre){
        $db = \Config\Database::connect();
        $tarjetaModel = new \App\Models\ModeloTarjeta();
        $tarjetaModel = model('ModeloTarjeta', true, $db);
        $data = [
            'nombre' => $nombre,
        ];
        $tarjetaModel->insert($data);
        return $tarjetaModel;
    }
    function traer_datos_tarjeta($id_tarjeta){
        $db = \Config\Database::connect();
        $tarjetaModel = new \App\Models\ModeloTarjeta();
        $tarjetaModel = model('ModeloTarjeta', true, $db);
        $rubro = $tarjetaModel->find($id_tarjeta);
        return $rubro;
    }
    function modificar_tarjeta($nombre,$id_tarjeta){
        $db = \Config\Database::connect();
        $tarjetaModel = new \App\Models\ModeloTarjeta();
        $tarjetaModel = model('ModeloTarjeta', true, $db);   
        $data = [
            'nombre' => $nombre,
        ];
        $tarjetaModel->update($id_tarjeta, $data);
        return $tarjetaModel;
    }
    function eliminar_tarjeta($id_tarjeta){
        $db = \Config\Database::connect();
        $tarjetaModel = new \App\Models\ModeloTarjeta();
        $tarjetaModel = model('ModeloTarjeta', true, $db);  
        return $tarjetaModel->delete($id_tarjeta);;
    }
    
}

?>