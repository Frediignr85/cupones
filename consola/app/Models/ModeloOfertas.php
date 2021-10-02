<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloOfertas extends Model
{
    protected $table      = 'tbloferta';
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
    function ofertas_activas(){
        $data = $this->db->query("SELECT tbloferta.id_oferta, tblempresa_ofertante.id_empresa, tblempresa_ofertante.nombre, tbloferta.titulo_oferta, tbloferta.cantidad_limite_cupones, tbloferta.precio_regular, tbloferta.precio_oferta, tbloferta.fecha_fin, (tblempresa_ofertante.fecha_limite * tbloferta.precio_oferta /100) as 'comision', (SELECT SUM(tblcompra_detalle.total_compra) FROM tblcompra_detalle INNER JOIN tbloferta as ofer1 on ofer1.id_oferta = tblcompra_detalle.id_oferta WHERE tbloferta.id_oferta = ofer1.id_oferta ) as 'ingresos_totales', (SELECT (SUM(tblcompra_detalle.total_compra)* empresa1.fecha_limite /100) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa = tblempresa_ofertante.id_empresa) as 'comision_total', (SELECT (SUM(tblcompra_detalle.cantidad)) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa = tblempresa_ofertante.id_empresa) as 'cantidad_cupones_vendidos'  FROM tbloferta INNER JOIN tblempresa_ofertante on tbloferta.id_empresa = tblempresa_ofertante.id_empresa WHERE tbloferta.id_estado = 3");
        return $data;
    }

    /*FUNCION PARA INSERTAR UNA NUEVA OFERTA */
    function insertar_oferta($titulo,$descripcion,$precio_regular,$precio_oferta,$cantidad,$fecha_inicio,$fecha_fin,$fecha_limite,$id_empresa,$otros_detalles){
        $db = \Config\Database::connect();
        $ilimitado = 0;
        if($cantidad == ""){
            $ilimitado = 1;
        }
        $data = [
            'titulo_oferta' => $titulo,
            'precio_regular'  => $precio_regular,
            'precio_oferta'  => $precio_oferta,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'fecha_limite' =>$fecha_limite,
            'cantidad_limite_cupones' => $cantidad,
            'descripcion' => $descripcion,
            'otros_detalles' => $otros_detalles,
            'id_estado' => 1,
            'id_empresa' => $id_empresa,
            'ilimitado' => $ilimitado
        ];
        return $db->table('tbloferta')->insert($data);
    }
    /* ESTA FUNCION ES PARA TRAER LOS DATOS DE LA OFERTA */

    function traer_datos_oferta($id_oferta){
        $data = $this->db->query("SELECT * FROM tbloferta WHERE id_oferta = '$id_oferta'");
        return $data;
    }
    function modificar_oferta($titulo,$descripcion,$precio_regular,$precio_oferta,$cantidad,$fecha_inicio,$fecha_fin,$fecha_limite,$id_oferta,$detalles){
        $db = \Config\Database::connect();
        $builder = $db->table('tbloferta');
        $data = [
            'titulo_oferta' => $titulo,
            'precio_regular'  => $precio_regular,
            'precio_oferta'  => $precio_oferta,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'fecha_limite' =>$fecha_limite,
            'cantidad_limite_cupones' => $cantidad,
            'descripcion' => $descripcion,
            'otros_detalles' => $detalles,
        ];
        $builder->where('id_oferta', $id_oferta);
        $builder->update($data);
        return $builder;
    }
    function borrar_oferta($id_oferta){
        $ofertaModel = new \App\Models\ModeloOfertas();
        $db = \Config\Database::connect();
        $ofertaModel = model('ModeloOfertas', true, $db);
        return $ofertaModel->delete($id_oferta);;
    }
    function aprobar_oferta($id_oferta){
        $db = \Config\Database::connect();
        $builder = $db->table('tbloferta');
        $data = [
            'id_estado' => '2',
        ];
        $builder->where('id_oferta', $id_oferta);
        $builder->update($data);
        return $builder;
    }
    function rechazar_oferta($id_oferta,$justificacion){
        $db = \Config\Database::connect();
        $builder = $db->table('tbloferta');
        $data = [
            'id_estado' => '5',
            'justificacion' => $justificacion
        ];
        $builder->where('id_oferta', $id_oferta);
        $builder->update($data);
        return $builder;
    }
    function descartar_oferta($id_oferta){
        $db = \Config\Database::connect();
        $builder = $db->table('tbloferta');
        $data = [
            'id_estado' => '6',
        ];
        $builder->where('id_oferta', $id_oferta);
        $builder->update($data);
        return $builder;
    }
}

?>