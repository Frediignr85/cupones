<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloOfertasPasadas extends Model
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
    function ofertas_pasadas($admin,$id_empresa){
        if($admin){
            $data = $this->db->query("SELECT tbloferta.id_oferta, 
            tblempresa_ofertante.id_empresa, 
            tblempresa_ofertante.nombre, 
            tbloferta.titulo_oferta, 
            tbloferta.cantidad_limite_cupones, 
            tbloferta.precio_regular, 
            tbloferta.precio_oferta, 
            tbloferta.fecha_limite, 
            (tblempresa_ofertante.porcentaje * tbloferta.precio_oferta /100) as 'comision', 
            (SELECT SUM(tblcompra_detalle.total_compra) FROM tblcompra_detalle INNER JOIN tbloferta as ofer1 on ofer1.id_oferta = tblcompra_detalle.id_oferta WHERE tbloferta.id_oferta = ofer1.id_oferta ) as 'ingresos_totales', 
            (SELECT (SUM(tblcompra_detalle.total_compra)* empresa1.porcentaje /100) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa) as 'comision_total', 
            (SELECT (SUM(tblcompra_detalle.cantidad)) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa) as 'cantidad_cupones_vendidos', 
            (SELECT  SUM(tblcanje_oferta.cantidad) FROM tblcanje_oferta INNER JOIN tbloferta as ofer3 on ofer3.id_oferta = tblcanje_oferta.id_oferta WHERE tbloferta.id_oferta = ofer3.id_oferta) as 'cupones_canjeados'  FROM tbloferta INNER JOIN tblempresa_ofertante on tbloferta.id_empresa = tblempresa_ofertante.id_empresa WHERE tbloferta.id_estado = 4 AND tbloferta.deleted_at is NULL");
        }
        else{
            $data = $this->db->query("SELECT tbloferta.id_oferta, 
            tblempresa_ofertante.id_empresa, 
            tblempresa_ofertante.nombre, 
            tbloferta.titulo_oferta, 
            tbloferta.cantidad_limite_cupones, 
            tbloferta.precio_regular, 
            tbloferta.precio_oferta, 
            tbloferta.fecha_limite, 
            (tblempresa_ofertante.porcentaje * tbloferta.precio_oferta /100) as 'comision', 
            (SELECT SUM(tblcompra_detalle.total_compra) FROM tblcompra_detalle INNER JOIN tbloferta as ofer1 on ofer1.id_oferta = tblcompra_detalle.id_oferta WHERE tbloferta.id_oferta = ofer1.id_oferta ) as 'ingresos_totales', 
            (SELECT (SUM(tblcompra_detalle.total_compra)* empresa1.porcentaje /100) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa) as 'comision_total', 
            (SELECT (SUM(tblcompra_detalle.cantidad)) FROM tblcompra_detalle INNER JOIN tbloferta as ofer2 on ofer2.id_oferta = tblcompra_detalle.id_oferta INNER JOIN tblempresa_ofertante as empresa1 on empresa1.id_empresa = ofer2.id_empresa WHERE tbloferta.id_oferta = ofer2.id_oferta AND tblempresa_ofertante.id_empresa = empresa1.id_empresa) as 'cantidad_cupones_vendidos', 
            (SELECT  SUM(tblcanje_oferta.cantidad) FROM tblcanje_oferta INNER JOIN tbloferta as ofer3 on ofer3.id_oferta = tblcanje_oferta.id_oferta WHERE tbloferta.id_oferta = ofer3.id_oferta) as 'cupones_canjeados'  FROM tbloferta INNER JOIN tblempresa_ofertante on tbloferta.id_empresa = tblempresa_ofertante.id_empresa WHERE tbloferta.id_estado = 4 AND tbloferta.deleted_at is NULL AND tbloferta.id_empresa = '$id_empresa'");
        }
        return $data;
    }
    
}

?>