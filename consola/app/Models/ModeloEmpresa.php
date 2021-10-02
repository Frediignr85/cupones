<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeloEmpresa extends Model
{
    protected $table      = 'tblempresa_ofertante';
    protected $primaryKey = 'id_empresa';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nombre', 'codigo', 'direccion','id_municipio','id_departamento', 'nombre_contacto', 'telefono','correo', 'id_rubro','id_estado', 'porcentaje'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    

    public function datos_empresa($id_empresa)
    {
        $data = $this->db->query("SELECT * FROM tblempresa WHERE id_empresa = '$id_empresa'");
        return $data;
    }
    public function verificar_username($username)
    {
        $data = $this->db->query("SELECT * FROM tblusuario WHERE usuario = '$username' AND id_tipo_usuario != '4'");
        return $data;
    }
    public function verificar_credenciales($username, $password)
    {
        $data = $this->db->query("SELECT * FROM tblusuario WHERE password = '".MD5($password)."' AND usuario = '$username' AND id_tipo_usuario != '4'");
        return $data;
    }

    public function verificar_permiso($id_user, $filename)
    {
        //metodo para obtener el nombre del file:
        $nombre_archivo = $filename;
        //verificamos si en la ruta nos han indicado el directorio en el que se encuentra
        if (strpos($filename, '/') !== false) {
            //de ser asi, lo eliminamos, y solamente nos quedamos con el nombre y su extension
            $nombre_archivo_tmp = explode('/', $filename);
            $nombre_archivo= array_pop($nombre_archivo_tmp);
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
        if (count($data->getResult()) > 0) {
            foreach ($data->getResult('array') as $value) {
                $admin=$value['admin'];
                $nombremodulo=$value['nombremodulo'];
                $filename=$value['filename'];
                $name_link=$filename;
            }
        } else {
            $name_link='NOT';
        }
        return $name_link;
    }
    public function empresas_ofertantes()
    {
        $data = $this->db->query("SELECT tblempresa_ofertante.id_empresa, tblempresa_ofertante.codigo, tblempresa_ofertante.nombre, tblempresa_ofertante.nombre_contacto, tblempresa_ofertante.telefono, tblrubro.nombre as 'nombre_rubro', (SELECT COUNT(*) FROM tbloferta INNER JOIN tblempresa_ofertante as teo1 on teo1.id_empresa = tbloferta.id_empresa WHERE tbloferta.id_estado = 2 AND teo1.id_empresa = tblempresa_ofertante.id_empresa) as 'ofertas_aprobadas',  (SELECT COUNT(*) FROM tbloferta INNER JOIN tblempresa_ofertante as teo2 on teo2.id_empresa = tbloferta.id_empresa WHERE tbloferta.id_estado = 3 AND teo2.id_empresa = tblempresa_ofertante.id_empresa)  as 'ofertas_reprobadas', (SELECT SUM(tblcompra_especifica.total_compra) FROM tblcompra_especifica INNER JOIN tblempresa_ofertante as teo3 on teo3.id_empresa = tblcompra_especifica.id_empresa WHERE teo3.id_empresa = tblempresa_ofertante.id_empresa) as 'ingresos', (SELECT SUM(tblcompra_especifica.total_compra)* tblempresa_ofertante.porcentaje/100  FROM tblcompra_especifica INNER JOIN tblempresa_ofertante as teo4 on teo4.id_empresa = tblcompra_especifica.id_empresa WHERE teo4.id_empresa = tblempresa_ofertante.id_empresa) as 'comision' FROM tblempresa_ofertante INNER JOIN tblrubro ON tblrubro.id_rubro = tblempresa_ofertante.id_rubro");
        return $data;
    }
    public function rubros()
    {
        $data = $this->db->query("SELECT * FROM tblrubro WHERE deleted_at is NULL");
        return $data;
    }
    public function municipios_libre()
    {
        $data = $this->db->query("SELECT * FROM tblmunicipio WHERE deleted_at is NULL");
        return $data;
    }
    public function municipios($id_departamento)
    {
        $data = $this->db->query("SELECT * FROM tblmunicipio WHERE deleted_at is NULL AND id_departamento_MUN = '$id_departamento'");
        return $data;
    }
    public function departamentos()
    {
        $data = $this->db->query("SELECT * FROM tbldepartamento WHERE deleted_at is NULL");
        return $data;
    }

    public function insertar_empresa($nombre, $rubro, $encargado, $telefono, $correo, $departamento, $municipio, $porcentaje, $direccion)
    {
        $db = \Config\Database::connect();
        $empresaModel = new \App\Models\ModeloEmpresa();
        $empresaModel = model('ModeloEmpresa', true, $db);
        $salir = false;
        $codigo = "";
        while (!$salir) {
            $permitted_chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $permitted_chars2 = '0123456789';
            $codigo1 = substr(str_shuffle($permitted_chars1), 0, 3);
            $codigo2 = substr(str_shuffle($permitted_chars2), 0, 3);
            $codigo = $codigo1.$codigo2;
            $data = $this->db->query("SELECT * FROM tblempresa_ofertante WHERE codigo = '$codigo'");
            $data->getNumRows();
            if ($data->getNumRows() == 0) {
                $salir = true;
            }
        }
        $data = [
            'nombre' => $nombre,
            'codigo'  => $codigo,
            'direccion'  => $direccion,
            'id_municipio' => $municipio,
            'id_departamento' => $departamento,
            'nombre_contacto' =>$encargado,
            'telefono' => $telefono,
            'correo' => $correo,
            'id_rubro' => $rubro,
            'id_estado' => 1,
            'porcentaje' => $porcentaje
        ];
        $empresaModel->insert($data);
        $id_empresa = $empresaModel->getInsertID();
        $nombre_usuario="";
        if (strstr($encargado, " ") != false) {
            $div_nombre = explode(" ", $encargado);
            $nombre_usuario.=$div_nombre[0];
            if (isset($div_nombre[1])) {
                $nombre_usuario.="_".$div_nombre[1];
            }
        } else {
            $nombre_usuario.=$nombre;
        }
        $nombre_usuario.="_".$id_empresa;
        $db = \Config\Database::connect();
        $data = [
            'nombre' => $encargado,
            'usuario'  => $nombre_usuario,
            'password' => MD5("123456789"),
            'id_tipo_usuario' => "2",
            'id_dependiente' =>'0',
            'id_admin_sucursal' => $id_empresa,
            'id_cliente' => '0',
            'activo' => '0',
            'id_sucursal' => 1,
            'id_empresa' => $id_empresa
        ];
        $db->table('tblusuario')->insert($data);
        $data = $this->db->query("SELECT * FROM tblusuario ORDER BY id_usuario DESC LIMIT 1");
        $data = $data->getResultArray();
        foreach ($data as $key => $value) {
            $id_usuario = $value['id_usuario'];
        }
        


        $permisos_admin_empresa = [77,78,79,80,81,82,83,84,85,86,87,88,89,90];
        foreach ($permisos_admin_empresa as $key ) {
            $db = \Config\Database::connect();
            $data = [
                'id_modulo' => $key,
                'id_usuario'  => $id_usuario,
            ];
            $db->table('tblusuario_modulo')->insert($data);
        }
        return 1;
    }

    function traer_datos_empresa($id_empresa){
        $data = $this->db->query("SELECT * FROM tblempresa_ofertante WHERE id_empresa = '$id_empresa'");
        return $data;
    }
    function modificar_empresa($nombre,$rubro,$encargado,$telefono,$correo,$departamento,$municipio,$porcentaje,$direccion,$id_empresa){
        $db = \Config\Database::connect();
        $builder = $db->table('tblempresa_ofertante');
        $data = [
            'nombre' => $nombre,
            'direccion'  => $direccion,
            'id_municipio' => $municipio,
            'id_departamento' => $departamento,
            'nombre_contacto' =>$encargado,
            'telefono' => $telefono,
            'id_rubro' => $rubro,
            'id_estado' => 1,
            'porcentaje' => $porcentaje
        ];
        $builder->where('id_empresa', $id_empresa);
        $builder->update($data);
        return $builder;
    }
    function borrar_empresa($id_empresa){
        $empresaModel = new \App\Models\ModeloEmpresa();
        $db = \Config\Database::connect();
        $empresaModel = model('ModeloEmpresa', true, $db);
        return $empresaModel->delete($id_empresa);;
    }

    public function generar_codigo(){
        $salir = false;
        $codigo = "";
        while(!$salir){
            $permitted_chars1 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $permitted_chars2 = '0123456789';
            $codigo1 = substr(str_shuffle($permitted_chars1), 0, 3);
            $codigo2 = substr(str_shuffle($permitted_chars2), 0, 3);
            $codigo = $codigo1.$codigo2;
            $data = $this->db->query("SELECT * FROM tblempresa_ofertante WHERE codigo = '$codigo'");
            $data->getNumRows();
            if($data->getNumRows() == 0){
                $salir = true;
            }
        }
        return $codigo;
    }
}

?>