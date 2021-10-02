<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloOfertasDescartadas extends Model
{
    protected $table      = 'tblofertas';
    protected $primaryKey = 'id_oferta';

    protected $useAutoIncrement = true;

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
    function ofertas_descartadas(){
        $data = $this->db->query("SELECT tbloferta.id_oferta, tblempresa_ofertante.nombre, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.precio_regular, tbloferta.precio_oferta, tbloferta.fecha_inicio, tbloferta.fecha_fin, tbloferta.fecha_limite, (tblempresa_ofertante.porcentaje * tbloferta.precio_oferta /100) as 'comision', tblempresa_ofertante.id_empresa FROM tbloferta INNER JOIN tblempresa_ofertante on tbloferta.id_empresa = tblempresa_ofertante.id_empresa WHERE tbloferta.id_estado = 6");
        return $data;
    }
    
}

?>