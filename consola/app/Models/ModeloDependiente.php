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
        $pass = $this->random_str_generator(8);
        $db = \Config\Database::connect();
        $data = [
            'nombre' => $nombre." ".$apellido,
            'usuario'  => $nombre_usuario,
            'password' => MD5($pass),
            'pass' => $pass,
            'id_tipo_usuario' => "3",
            'id_dependiente' =>$id_dependiente,
            'id_admin_sucursal' => '0',
            'id_cliente' => '0',
            'activo' => '1',
            'id_sucursal' => 1,
            'id_empresa' => $id_empresa
        ];
        $db->table('tblusuario')->insert($data);
        $data = $this->db->query("SELECT * FROM tblusuario ORDER BY id_usuario DESC LIMIT 1");
        $data = $data->getResultArray();
        foreach ($data as $key => $value) {
            $id_usuario = $value['id_usuario'];
        }
        $destino = $correo;
        $asunto = "Credenciales de Cuenta";
        $headers = "From: soporte@web-uis.com". "\r\n";
        $headers .= "CC:  soporte@web-uis.com";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $id = md5($id_usuario);
        $imagen_src = base_url("/assets/images/log.svg");
        $message = '<!doctype html>
                        <html>
                            <head>
                                <meta name="viewport" content="width=device-width" />
                                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                <title>Your Ideal Solution</title>
                                <style>
                                /* -------------------------------------
                                    GLOBAL RESETS
                                ------------------------------------- */
                                img {
                                    border: none;
                                    -ms-interpolation-mode: bicubic;
                                    max-width: 100%; }
    
                                body {
                                    background-color: #f6f6f6;
                                    font-family: sans-serif;
                                    -webkit-font-smoothing: antialiased;
                                    font-size: 14px;
                                    line-height: 1.4;
                                    margin: 0;
                                    padding: 0;
                                    -ms-text-size-adjust: 100%;
                                    -webkit-text-size-adjust: 100%; }
    
                                table {
                                    border-collapse: separate;
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    width: 100%; }
                                    table td {
                                    font-family: sans-serif;
                                    font-size: 14px;
                                    vertical-align: top; }
    
                                /* -------------------------------------
                                    BODY & CONTAINER
                                ------------------------------------- */
    
                                .body {
                                    background-color: #f6f6f6;
                                    width: 100%; }
    
                                /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                                .container {
                                    display: block;
                                    Margin: 0 auto !important;
                                    /* makes it centered */
                                    max-width: 580px;
                                    padding: 10px;
                                    width: 580px; }
    
                                /* This should also be a block element, so that it will fill 100% of the .container */
                                .content {
                                    box-sizing: border-box;
                                    display: block;
                                    Margin: 0 auto;
                                    max-width: 580px;
                                    padding: 10px; }
    
                                /* -------------------------------------
                                    HEADER, FOOTER, MAIN
                                ------------------------------------- */
                                .main {
                                    background: #ffffff;
                                    border-radius: 3px;
                                    width: 100%; }
    
                                .wrapper {
                                    box-sizing: border-box;
                                    padding: 20px; }
    
                                .content-block {
                                    padding-bottom: 10px;
                                    padding-top: 10px;
                                }
    
                                .footer {
                                    clear: both;
                                    Margin-top: 10px;
                                    text-align: center;
                                    width: 100%; }
                                    .footer td,
                                    .footer p,
                                    .footer span,
                                    .footer a {
                                    color: #999999;
                                    font-size: 12px;
                                    text-align: center; }
    
                                /* -------------------------------------
                                    TYPOGRAPHY
                                ------------------------------------- */
                                h1,
                                h2,
                                h3,
                                h4 {
                                    color: #000000;
                                    font-family: sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    margin: 0;
                                    Margin-bottom: 30px; }
    
                                h1 {
                                    font-size: 35px;
                                    font-weight: 300;
                                    text-align: center;
                                    text-transform: capitalize; }
    
                                p,
                                ul,
                                ol {
                                    font-family: sans-serif;
                                    font-size: 14px;
                                    font-weight: normal;
                                    margin: 0;
                                    Margin-bottom: 15px; }
                                    p li,
                                    ul li,
                                    ol li {
                                    list-style-position: inside;
                                    margin-left: 5px; }
    
                                a {
                                    color: #3498db;
                                    text-decoration: underline; }
    
                                /* -------------------------------------
                                    BUTTONS
                                ------------------------------------- */
                                .btn {
                                    box-sizing: border-box;
                                    width: 100%; }
                                    .btn > tbody > tr > td {
                                    padding-bottom: 15px; }
                                    .btn table {
                                    width: auto; }
                                    .btn table td {
                                    background-color: #ffffff;
                                    border-radius: 5px;
                                    text-align: center; }
                                    .btn a {
                                    background-color: #ffffff;
                                    border: solid 1px #3498db;
                                    border-radius: 5px;
                                    box-sizing: border-box;
                                    color: #3498db;
                                    cursor: pointer;
                                    display: inline-block;
                                    font-size: 14px;
                                    font-weight: bold;
                                    margin: 0;
                                    padding: 12px 25px;
                                    text-decoration: none;
                                    text-transform: capitalize; }
    
                                .btn-primary table td {
                                    background-color: #3498db; }
    
                                .btn-primary a {
                                    background-color: #3498db;
                                    border-color: #3498db;
                                    color: #ffffff; }
    
                                /* -------------------------------------
                                    OTHER STYLES THAT MIGHT BE USEFUL
                                ------------------------------------- */
                                .last {
                                    margin-bottom: 0; }
    
                                .first {
                                    margin-top: 0; }
    
                                .align-center {
                                    text-align: center; }
    
                                .align-right {
                                    text-align: right; }
    
                                .align-left {
                                    text-align: left; }
    
                                .clear {
                                    clear: both; }
    
                                .mt0 {
                                    margin-top: 0; }
    
                                .mb0 {
                                    margin-bottom: 0; }
    
                                .preheader {
                                    color: transparent;
                                    display: none;
                                    height: 0;
                                    max-height: 0;
                                    max-width: 0;
                                    opacity: 0;
                                    overflow: hidden;
                                    mso-hide: all;
                                    visibility: hidden;
                                    width: 0; }
    
                                .powered-by a {
                                    text-decoration: none; }
    
                                hr {
                                    border: 0;
                                    border-bottom: 1px solid #f6f6f6;
                                    Margin: 20px 0; }
    
                                /* -------------------------------------
                                    RESPONSIVE AND MOBILE FRIENDLY STYLES
                                ------------------------------------- */
                                @media only screen and (max-width: 620px) {
                                    table[class=body] h1 {
                                    font-size: 28px !important;
                                    margin-bottom: 10px !important; }
                                    table[class=body] p,
                                    table[class=body] ul,
                                    table[class=body] ol,
                                    table[class=body] td,
                                    table[class=body] span,
                                    table[class=body] a {
                                    font-size: 16px !important; }
                                    table[class=body] .wrapper,
                                    table[class=body] .article {
                                    padding: 10px !important; }
                                    table[class=body] .content {
                                    padding: 0 !important; }
                                    table[class=body] .container {
                                    padding: 0 !important;
                                    width: 100% !important; }
                                    table[class=body] .main {
                                    border-left-width: 0 !important;
                                    border-radius: 0 !important;
                                    border-right-width: 0 !important; }
                                    table[class=body] .btn table {
                                    width: 100% !important; }
                                    table[class=body] .btn a {
                                    width: 100% !important; }
                                    table[class=body] .img-responsive {
                                    height: auto !important;
                                    max-width: 100% !important;
                                    width: auto !important; }}
    
                                /* -------------------------------------
                                    PRESERVE THESE STYLES IN THE HEAD
                                ------------------------------------- */
                                @media all {
                                    .ExternalClass {
                                    width: 100%; }
                                    .ExternalClass,
                                    .ExternalClass p,
                                    .ExternalClass span,
                                    .ExternalClass font,
                                    .ExternalClass td,
                                    .ExternalClass div {
                                    line-height: 100%; }
                                    .apple-link a {
                                    color: inherit !important;
                                    font-family: inherit !important;
                                    font-size: inherit !important;
                                    font-weight: inherit !important;
                                    line-height: inherit !important;
                                    text-decoration: none !important; }
                                    .btn-primary table td:hover {
                                    background-color: #34495e !important; }
                                    .btn-primary a:hover {
                                    background-color: #34495e !important;
                                    border-color: #34495e !important; } }
    
                                </style>
                            </head>
                            <body class="">
                                <table border="0" cellpadding="0" cellspacing="0" class="body">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="container">
                                    <div class="content">
    
                                        <!-- START CENTERED WHITE CONTAINER -->
                                        <span class="preheader">Envio de Credenciales</span>
                                        <table class="main">
    
                                        <!-- START MAIN CONTENT AREA -->
                                        <tr>
                                            <td class="wrapper">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                <td>
                                                    <p>'.$nombre.' '.$apellido.' !!!</p>
                                                    <p>Reciba un cordial saludo del <b>Your Ideal Solution</b></p>
                                                    <p>Le Adjuntamos las credenciales para ingresar a su cuenta de <b>Dependiente</b></p>
                                                    <p>En el Sistema de <b>Cuponeria y Ofertas</b></p>
                                                    <br>
                                                    <p><b>Usuario: </b>'.$nombre_usuario.'</p>
                                                    <br>
                                                    <p><b>Contraseña: </b>'.$pass.'</p>
                                                    <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                                        <tbody>
                                                        <tr>
                                                            <td align="left">
                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                <tr>
                                                                    <td> <a href="https://web-uis.com/consola" target="_blank">Ir Al Sistema</a> </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    <p>'.ucfirst(strtolower(date("d-m-Y"))).', '.date("H:i:s").' </p>
                                                </td>
                                                <td>
                                                    <img src="https://www.web-uis.com/assets/images/log.svg" class="image" alt="" />
                                                </td>
                                                </tr>
                                            </table>
                                            </td>
                                        </tr>
    
                                        <!-- END MAIN CONTENT AREA -->
                                        </table>
    
                                        <!-- START FOOTER -->
                                        <div class="footer">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                            <td class="content-block">
                                                <span class="apple-link">Equipo de UIS</span>
                                            </td>
                                            </tr>
                                        </table>
                                        </div>
                                        <!-- END FOOTER -->
    
                                    <!-- END CENTERED WHITE CONTAINER -->
                                    </div>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                </table>
                            </body>
                            </html>';
                            mail($destino,$asunto,$message,$headers);
        return 1;
    }

    function random_str_generator ($len_of_gen_str){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()_+}{?><.,:;";
        $var_size = strlen($chars);
        $random_str="";
        for( $x = 0; $x < $len_of_gen_str; $x++ ) {  
            $random_str.= $chars[ rand( 0, $var_size - 1 ) ];  
        }
        return $random_str;
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