<?php
    if(!function_exists("validar_sesion")){
        function validar_sesion($id_usuario){
            if($id_usuario == ""){
                redirect("login","refresh");
            }
        }
    }
    if(!function_exists("quitar_tildes")){
        function quitar_tildes($cadena)
        {
            $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹"," ");
            $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E","_");
            $texto = str_replace($no_permitidas, $permitidas ,$cadena);
            return $texto;
        }
    }
    if(!function_exists("get_name_script")){
        function get_name_script($url){
            //metodo para obtener el nombre del file:
            $nombre_archivo = $url;
            //verificamos si en la ruta nos han indicado el directorio en el que se encuentra
            if ( strpos($url, '/') !== FALSE ){
                //de ser asi, lo eliminamos, y solamente nos quedamos con el nombre y su extension
                $nombre_archivo_tmp = explode('/', $url);
                $nombre_archivo= array_pop($nombre_archivo_tmp );
                return  $nombre_archivo;
            }  
        }
    }
    if(!function_exists("permission_usr")){
    
        function permission_usr($id_user,$filename){
            $sql1="SELECT tblmenu.id_menu, tblmenu.nombre as nombremenu, tblmenu.prioridad,
            tblmodulo.id_modulo,  tblmodulo.nombre as nombremodulo, tblmodulo.descripcion, tblmodulo.filename,
            tblusuario_modulo.id_usuario,tblUsuario.id_tipo_usuario as admin
            FROM tblmenu, tblmodulo, tblusuario_modulo, tblUsuario
            WHERE tblUsuario.id_usuario='$id_user'
            AND tblmenu.id_menu=tblmodulo.id_menu_MOD
            AND tblUsuario.id_usuario=tblusuario_modulo.id_usuario
            AND tblusuario_modulo.id_modulo=tblmodulo.id_modulo
            AND tblmodulo.filename='$filename'
            AND tblusuario_modulo.deleted_at is NULL
            ";
            $result1=_query($sql1);
            $count1=_num_rows($result1);
            if($count1 >0){
                $row1=_fetch_array($result1);
                $admin=$row1['admin'];
                $nombremodulo=$row1['nombremodulo'];
                $filename=$row1['filename'];
                $name_link=$filename;
            }
            else $name_link='NOT';
                return $name_link;
            
        }
    }
    
    
    
?>