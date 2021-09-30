<?php
include_once "_core.php";

function initial() {
	// Page setup	
	$_PAGE = array ();
	$_PAGE ['title'] = 'Editar Servicios';
	$_PAGE['links'] = null;
$_PAGE['links'] .= '<link href="css/bootstrap.min.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="font-awesome/css/font-awesome.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/iCheck/custom.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/chosen/chosen.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">';
$_PAGE['links'] .= '<link href="css/animate.css" rel="stylesheet">';
//$_PAGE['links'] .= '<link href="css/style.css" rel="stylesheet">';

	include_once "header.php";
	include_once "main_menu.php";	
	$id_servicio= $_REQUEST['id_servicio'];
  
     $sql="SELECT * FROM servicio
     WHERE 
     id_servicio='$id_servicio'";
     $result=_query($sql);
     $count=_num_rows($result);
	
	

?>
 
            <div class="row wrapper border-bottom white-bg page-heading">
                
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Registrar Servicios</h5>
                        </div>
                        <div class="ibox-content">
                                <form name="formulario" id="formulario">
                                  <?php
                if ($count>0){
                
                  for($i=0;$i<$count;$i++){
                    $row=_fetch_array($result);
                    $descripcion=$row['descripcion'];
                    $id_servicio=$row['id_servicio'];
                    $precio=$row['precio'];
                    $costo=$row['costo'];
                    $estado=$row['estado'];
                    $id_categoria=$row['id_categoria'];
                    
                    } 
                  }
                  
                ?>
                              
                                 
                                  <div class="form-group has-info single-line">
                                  	 <label>Categoría Servicio</label>
                                  <div class="input-group">
                              		<select name="cat_servicios" id="cat_servicios"  style="width:350px;">
                                   <option value=''>Select</option>
                                   <?php
                                   $qcat=_query("SELECT *FROM categoria ORDER BY nombre ");
                                   while($row_cat=_fetch_array($qcat))
                                   {
                                    //$id_categoria=$row_cat["id_categoria"];
                                    $nombre=$row_cat["nombre"];

                                      if($id_categoria==$row_cat['id_categoria'])
                                      {
                                      echo "<option value='".$row_cat['id_categoria']."' selected>".$row_cat['nombre']."</option>";
                                      }
                                      else
                                      {
                                      echo "<option value='".$row_cat['id_categoria']."'>".$row_cat['nombre']."</option>";
                                      }   
                                 
                                   }
                                   ?>
                              	</select>
                                </div>
                               </div>    
                              <div class="form-group has-info single-line"><label>Descripción</label> <input type="text" placeholder="Ingresa la descripción" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion ?> "></div>
                              <div class="form-group has-info single-line"><label>Costo</label> <input type="text" placeholder="Ingrese costo" class="form-control" id="costo" name="costo" value="<?php echo $costo ?> "></div>
                              <div class="form-group has-info single-line"><label>Precio</label> <input type="text" placeholder="Ingrese Precio " class="form-control" id="precio" name="precio" value="<?php echo $precio ?> "></div>
                             	 
                                     <div class="form-group has-info single-line">
                                    <div class="form-group"><label class="col-sm-2 control-label">Active </label>
                                    <div class="col-sm-10">
                                      <?php
                                      if($estado==1){
                                        echo "<div class=\"checkbox i-checks\"><label> <input type=\"checkbox\"  id=\"activo\" name=\"activo\" value=\"1\" checked> <i></i>  </label></div>";   
                                      }
                                      else
                                      {
                                        echo "<div class=\"checkbox i-checks\"><label> <input type=\"checkbox\"  id=\"activo\" name=\"activo\" value=\"1\"> <i></i>  </label></div>";                                                                      
                                      }
                                      ?>
                                    </div>
                                  </div>
                                   <input type="hidden" name="process" id="process" value="edited"><br>
                                </div>
                    				    
                                <input type="hidden" name="id_servicio" id="id_servicio" value="<?php echo $_REQUEST['id_servicio']?> ">
                                    
                                <div>
                                  <input type="submit" id="submit1" name="submit1" value="Submit" class="btn btn-primary m-t-n-xs" />
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
   
<?php
include_once ("footer.php");
echo "<script src='js/funciones/funciones_servicios.js'></script>";

}


function edited(){
  $id_servicio=$_POST["id_servicio"];    
  $id_categoria=$_POST["id_categoria"];    
    $descripcion=$_POST["descripcion"];  
    $costo=$_POST["costo"];
    $precio=$_POST["precio"];
    $estado=$_POST["estado"];
    $table = 'servicio';

    $form_data = array (
    'id_servicio' => $id_servicio,
    'id_categoria' => $id_categoria,
    'descripcion' => $descripcion,
    'costo' => $costo,
    'precio' => $precio,
    'estado' => $estado
    );    
      
   $where_clause = "id_servicio='" . $id_servicio . "'";
  $updates = _update ( $table, $form_data, $where_clause );
    if($updates){
      $xdatos['typeinfo']='Success';
      $xdatos['msg']='Registro autualizado ';
      $xdatos['process']='edited';
    } 
    else{
      $xdatos['typeinfo']='Error';
      $xdatos['msg']='Registro no editado';
    }                     
  echo json_encode($xdatos);
}



if(!isset($_POST['process'])){
	initial(); 
}
else
{
if(isset($_POST['process'])){	
switch ($_POST['process']) {
	case 'edited':
		edited();
		break;		
	
	} 
}			
}
?>
