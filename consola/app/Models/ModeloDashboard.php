<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloDashboard extends Model
{
  
    function datos_empresa($id_empresa){
        $data = $this->db->query("SELECT * FROM tblempresa WHERE id_empresa = '$id_empresa'");
        return $data;
    }


    function menu($id_user,$admin){
        $data = $this->db->query("UPDATE tbloferta SET id_estado = '3' WHERE CURDATE() >= fecha_inicio AND id_estado = 2");
        $data = $this->db->query("UPDATE tbloferta SET id_estado = '4' WHERE CURDATE() > fecha_fin AND id_estado = 3");


        
        helper('utilidades'); 
        $retorno = "";
        $icono='fa fa-star-o';
        $sql_menus="SELECT id_menu, nombre, prioridad,icono FROM tblmenu WHERE visible='1' order by prioridad";
        $data = $this->db->query($sql_menus);
        $main_lnk='dashboard.php';
        if($admin=='1')
        {
            $retorno.="<li class='active'>";
            $retorno.="<a href='".base_url("/dashboard")."'><i class='".$icono."'></i> <span class='nav-label'>Inicio</span></a>";
            $retorno.="</li>";
        }
        else
        {
            $retorno.="<li class='active'>";
            $retorno.="<a href='".base_url("/dashboard")."'><i class='".$icono."'></i> <span class='nav-label'>Inicio</span></a>";
            $retorno.="</li>";
        }
        if(count($data->getResult()) > 0){
            foreach ($data->getResult('array') as $value) {
                $menuname=$value['nombre'];
                $id_menu=$value['id_menu'];
                $icono=$value['icono'];
                if($admin=='1')
                {
                    $sql_links="SELECT distinct tblmenu.id_menu, tblmenu.nombre as nombremenu, tblmenu.prioridad,
                    tblmodulo.id_modulo, tblmodulo.nombre as nombremodulo, tblmodulo.descripcion, tblmodulo.filename, tblusuario.id_tipo_usuario
                    FROM tblmenu, tblmodulo, tblusuario
                    WHERE tblusuario.id_usuario='$id_user'
                    AND tblusuario.id_tipo_usuario='1'
                    AND tblmenu.id_menu='$id_menu'
                    AND tblmenu.id_menu=tblmodulo.id_menu_MOD
                    AND tblmodulo.mostrar_menu='1'";
                }
                else
                {
                    $sql_links="
                    SELECT tblmenu.id_menu, tblmenu.nombre as nombremenu, tblmenu.prioridad,
                    tblmodulo.id_modulo,  tblmodulo.nombre as nombremodulo, tblmodulo.descripcion, tblmodulo.filename,
                    tblusuario_modulo.id_usuario,tblusuario.id_tipo_usuario
                    FROM tblmenu, tblmodulo, tblusuario_modulo, tblusuario
                    WHERE tblusuario.id_usuario='$id_user'
                    AND tblmenu.id_menu='$id_menu'
                    AND tblusuario.id_usuario=tblusuario_modulo.id_usuario
                    AND tblusuario_modulo.id_modulo=tblmodulo.id_modulo
                    AND tblmenu.id_menu=tblmodulo.id_menu_MOD
                    AND tblmodulo.mostrar_menu='1'
                    AND tblusuario_modulo.deleted_at is NULL";
                }
                //$retorno.=$sql_links;
                $data2 = $this->db->query($sql_links);
               
                if(count($data2->getResult()) > 0){
                    $retorno.="<li><a href='".$main_lnk."' class='".strtolower(($menuname))."'><i class='".$icono."'></i><span class='nav-label'>".$menuname."</span> <span class='fa arrow'></span></a>";
                    $retorno.=" <ul class='nav nav-second-level'>";
                    foreach ($data2->getResult('array') as $value){
                        $lnk=($value['filename']);
                        if($lnk == "<hoja_membretada>")
                        {
                            $extra = "target='_blank'";
                        }
                        else
                        {
                            $lnk = $lnk;
                            $extra = "";
                        }
                        $modulo=$value['nombremodulo'];
                        $id_modulo=$value['id_modulo'];
                        $retorno.="<li><a href='".base_url()."/".$lnk."' $extra>".ucfirst($modulo)."</a></li>";
                    }
                    $retorno.="</ul>";
                    $retorno.=" </li>";
                }
            }
        }
        return $retorno;
    }

    function traer_clientes(){
        $data = $this->db->query("SELECT * FROM tblcliente WHERE  deleted_at is NULL");
        return $data;
    }
    function traer_empresas(){
        $data = $this->db->query("SELECT * FROM tblempresa_ofertante WHERE deleted_at is NULL");
        return $data;
    }
    function traer_rubros(){
        $data = $this->db->query("SELECT * FROM tblrubro WHERE deleted_at is NULL");
        return $data;
    }
    function traer_dependientes(){
        $data = $this->db->query("SELECT * FROM tbldependiente WHERE deleted_at is NULL");
        return $data;
    }
    function traer_ofertas_pendientes($admin,$id_empresa){
        if($admin){
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '1'");
        }
        else{
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '1' AND id_empresa = '$id_empresa'");
        }
        return $data;
    }
    function traer_ofertas_activas($admin,$id_empresa){
        if($admin){
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '3'");
        }
        else{
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '3' AND id_empresa = '$id_empresa'");
        }
        return $data;
    }
    function traer_ofertas_pasadas($admin,$id_empresa){
        if($admin){
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '4'");
        }
        else{
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '4' AND id_empresa = '$id_empresa'");
        }
        return $data;
    }
    function traer_ofertas_rechazadas($admin,$id_empresa){
        if($admin){
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '5'");
        }
        else{
            $data = $this->db->query("SELECT * FROM tbloferta WHERE deleted_at is NULL AND id_estado = '5' AND id_empresa = '$id_empresa'");
        }
        return $data;
    }
}

?>