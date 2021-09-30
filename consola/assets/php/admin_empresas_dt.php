<?php

$requestData= $_REQUEST;
require("ssp.customized.class.php");
// DB table to use
$table = 'tblempresa_ofertante';
// Table's primary key
$primaryKey = 'id_empresa';

// MySQL server connection information
$sql_details = array(
    'user' => "root",
    'pass' => "",
    'db'   => "cupones",
    'host' => "localhost"
);

//permiso del script
$id_user= $_SESSION['id_usuario'];
$admin= $_SESSION['admin'];
$id_sucursal= $_SESSION['id_sucursal'];

$joinQuery = " FROM tblempresa_ofertante";

$extraWhere = " tblempresa_ofertante.deleted_at is NULL";

$columns = array(
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 0, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 1, 'field' => 'id_empresa'  ),  
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 2, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 3, 'field' => 'id_empresa'  ),   
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 4, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 5, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 6, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 7, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 8, 'field' => 'id_empresa'  ),
array( 'db' => '`tblempresa_ofertante`.`id_empresa`', 'dt' => 9, 'formatter' => function ($id_empresa) {
    $id_user=$_SESSION["id_usuario"];
    $admin=$_SESSION["admin"];
    $tabla="<td class='col col col-lg-1'><div class=\"btn-group\">
    <a href=\"#\" data-toggle=\"dropdown\" class=\"btn btn-primary dropdown-toggle\"><i class=\"fa fa-user icon-white\"></i> Menu<span class=\"caret\"></span></a>
    <ul class=\"dropdown-menu dropdown-primary\">";
    
        $tabla.= "<li><a href=\"editar_docente.php?id_empresa=".$id_empresa."\"><i class=\"fa fa-pencil\"></i> Editar</a></li>";
  
        $tabla.= "<li><a data-toggle='modal' href='borrar_docente.php?id_empresa=".$id_empresa."' data-target='#deleteModal' 
        data-refresh='true'><i class=\"fa fa-trash\"></i> Eliminar</a></li>";
   
    $tabla.= "	</ul>
            </div>
            </td>
            </tr>";
        return $tabla;
} , 'field' => 'id_empresa' )

);
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);

?>