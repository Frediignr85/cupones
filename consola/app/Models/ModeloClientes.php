<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloClientes extends Model
{
    protected $table      = 'tblrubro';
    protected $primaryKey = 'id_rubro';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombre', 'descripcion'];
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

    function traer_clientes(){
        $sql = "SELECT tblcliente.id_cliente, 
        tblcliente.nombre, 
        tblcliente.direccion, 
        tblcliente.telefono1, 
        tblcliente.correo, 
        tblcliente.fecha_nacimiento, 
        tblcliente.dui, 
        (SELECT SUM(tblcompra_detalle.cantidad) FROM tblcompra_detalle INNER JOIN tblcompra_especifica on tblcompra_especifica.id_compra_especifica = tblcompra_detalle.id_compra_especifica INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general WHERE tblcompra_general.id_cliente = tblcliente.id_cliente)as 'total_cupones',
        (SELECT SUM(tblcompra_detalle.cantidad) FROM tblcompra_detalle INNER JOIN tblcompra_especifica on tblcompra_especifica.id_compra_especifica = tblcompra_detalle.id_compra_especifica INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general WHERE tblcompra_general.id_cliente = tblcliente.id_cliente AND tblcompra_detalle.canjeada = 1)as 'cupones_canjeados',
        (SELECT SUM(tblcompra_detalle.cantidad) FROM tblcompra_detalle INNER JOIN tblcompra_especifica on tblcompra_especifica.id_compra_especifica = tblcompra_detalle.id_compra_especifica INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general INNER JOIN tbloferta on tbloferta.id_oferta = tblcompra_detalle.id_oferta WHERE tblcompra_general.id_cliente = tblcliente.id_cliente AND tblcompra_detalle.canjeada = 0 AND CURDATE()<= tbloferta.fecha_limite)as 'cupones_no_canjeados',
        (SELECT SUM(tblcompra_detalle.cantidad) FROM tblcompra_detalle INNER JOIN tblcompra_especifica on tblcompra_especifica.id_compra_especifica = tblcompra_detalle.id_compra_especifica INNER JOIN tblcompra_general on tblcompra_general.id_compra_general = tblcompra_especifica.id_compra_general INNER JOIN tbloferta on tbloferta.id_oferta = tblcompra_detalle.id_oferta WHERE tblcompra_general.id_cliente = tblcliente.id_cliente AND tblcompra_detalle.canjeada = 0 AND CURDATE()> tbloferta.fecha_limite)as 'cupones_vencidos',
        (SELECT SUM(tblcompra_general.total_compra) FROM tblcompra_general WHERE tblcompra_general.id_cliente = tblcliente.id_cliente)as 'total_comprado' FROM tblcliente";
        $data = $this->db->query($sql);
        return $data;
    }
    function insertar_rubro($nombre,$descripcion){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloClientes();
        $rubroModel = model('ModeloClientes', true, $db);
        $data = [
            'nombre' => $nombre,
            'descripcion'    => $descripcion,
        ];
        $rubroModel->insert($data);
        return $rubroModel;
    }
    function traer_datos_rubro($id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloClientes();
        $rubroModel = model('ModeloClientes', true, $db);
        $rubro = $rubroModel->find($id_rubro);
        return $rubro;
    }
    function modificar_rubro($nombre,$descripcion,$id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloClientes();
        $rubroModel = model('ModeloClientes', true, $db);   
        $data = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ];
        $rubroModel->update($id_rubro, $data);
        return $rubroModel;
    }
    function eliminar_rubro($id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloClientes();
        $rubroModel = model('ModeloClientes', true, $db);  
        return $rubroModel->delete($id_rubro);;
    }
    
}

?>