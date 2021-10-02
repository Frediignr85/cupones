<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row" id="row1">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <?php
				//if ($admin=='t' && $active=='t'){
				echo "<div class='ibox-title'>";
				echo $btn_add;	
				echo "</div>";
				?>
                <div class="ibox-content">
                    <!--load datables estructure html-->
                    <header>
                        <h3><b><?php echo $title;?></b></h3>
                    </header>
                    <section>
                        <table class="table table-striped table-bordered table-hover" id="editable">
                            <thead>
                                <tr>
                                    <th>COD.</th>
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th>CORREO</th>
                                    <th>EMPRESA</th>
                                    <th>ACCI&Oacute;N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($result as $key => $value) {
                                        $id_dependiente = $value['id_dependiente'];
                                        $nombres = $value['nombres'];
                                        $apellidos = $value['apellidos'];
                                        $correo = $value['correo'];
                                        $nombre = $value['nombre'];
                                        
                                        echo "<tr>";
                                        echo "<td>$id_dependiente</td>";
                                        echo "<td>$nombres</td>";
                                        echo "<td>$apellidos</td>";
                                        echo "<td>$correo</td>";
                                        echo "<td>$nombre</td>";
                                        $boton = "<td><div class=\"btn-group\">
                                        <a href=\"#\" data-toggle=\"dropdown\" class=\"btn btn-primary dropdown-toggle\"><i class=\"fa fa-user icon-white\"></i> Menu<span class=\"caret\"></span></a>
                                        <ul class=\"dropdown-menu dropdown-primary\">";
                                            $filename='editar_empresa';
                                            if($permiso_editar){
                                                $filename = base_url("dependientes/editar/");
                                                $boton .="<li><a href=\"" . $filename."?id_dependiente=".$id_dependiente. "\"><i class=\"fa fa-pencil\"></i> Editar</a></li>";
                                            }
                                            if($permiso_borrar){
                                                $filename = base_url("dependientes/borrar/");
                                                $boton .= "<li><a data-toggle='modal' href='" . $filename."?id_dependiente=".$id_dependiente. "' data-target='#deleteModal' data-refresh='true'><i class=\"fa fa-eraser\"></i> Eliminar</a></li>";
                                            }
                                            
                                            $boton .= "	</ul>
                                                </div>
                                                </td>";
                                        echo $boton;
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="autosave" id="autosave" value="false-0">
                    </section>
                    <!--Show Modal Popups View & Delete -->
                    <div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'
                        aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'></div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'
                        aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <div class='modal-content modal-lg'></div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <!--div class='ibox-content'-->
            </div>
            <!--<div class='ibox float-e-margins' -->
        </div>
        <!--div class='col-lg-12'-->
    </div>
    <!--div class='row'-->
</div>