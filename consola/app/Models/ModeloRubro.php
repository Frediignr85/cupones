<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloRubro extends Model
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
        //metodo para obtener el nombre del file:
        $nombre_archivo = $filename;
        //verificamos si en la ruta nos han indicado el directorio en el que se encuentra
        if ( strpos($filename, '/') !== FALSE ){
            //de ser asi, lo eliminamos, y solamente nos quedamos con el nombre y su extension
            $nombre_archivo_tmp = explode('/', $filename);
            $nombre_archivo= array_pop($nombre_archivo_tmp );
            $filename = $nombre_archivo;
        }  
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

    function traer_rubros(){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloRubro();
        $rubroModel = model('ModeloRubro', true, $db);
        $rubros = $rubroModel->findAll();
        return $rubros;
    }
    function insertar_rubro($nombre,$descripcion){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloRubro();
        $rubroModel = model('ModeloRubro', true, $db);
        $data = [
            'nombre' => $nombre,
            'descripcion'    => $descripcion,
        ];
        $rubroModel->insert($data);
        return $rubroModel;
    }
    function traer_datos_rubro($id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloRubro();
        $rubroModel = model('ModeloRubro', true, $db);
        $rubro = $rubroModel->find($id_rubro);
        return $rubro;
    }
    function modificar_rubro($nombre,$descripcion,$id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloRubro();
        $rubroModel = model('ModeloRubro', true, $db);   
        $data = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ];
        $rubroModel->update($id_rubro, $data);
        return $rubroModel;
    }
    function eliminar_rubro($id_rubro){
        $db = \Config\Database::connect();
        $rubroModel = new \App\Models\ModeloRubro();
        $rubroModel = model('ModeloRubro', true, $db);  
        return $rubroModel->delete($id_rubro);;
    }
    
}

?>