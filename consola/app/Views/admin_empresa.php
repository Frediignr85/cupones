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
                                    <th>NOMBRE</th>
                                    <th>CONTACTO</th>
                                    <th>TELEFONO</th>
                                    <th>RUBRO</th>
                                    <th>OFERTA APRO</th>
                                    <th>OFERTA REPRO</th>
                                    <th>INGRESOS</th>
                                    <th>COMISION</th>
                                    <th>ACCI&Oacute;N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($result as $key => $value) {
                                        $id_empresa = $value['id_empresa'];
                                        $codigo = $value['codigo'];
                                        $nombre = $value['nombre'];
                                        $nombre_contacto = $value['nombre_contacto'];
                                        $telefono = $value['telefono'];
                                        $nombre_rubro = $value['nombre_rubro'];
                                        $ofertas_aprobadas = $value['ofertas_aprobadas'];
                                        $ofertas_reprobadas = $value['ofertas_reprobadas'];
                                        $ingresos = $value['ingresos'];
                                        $comision = $value['comision'];
                                        echo "<tr>";
                                        echo "<td>$codigo</td>";
                                        echo "<td>$nombre</td>";
                                        echo "<td>$nombre_contacto</td>";
                                        echo "<td>$telefono</td>";
                                        echo "<td>$nombre_rubro</td>";
                                        echo "<td>$ofertas_aprobadas</td>";
                                        echo "<td>$ofertas_reprobadas</td>";
                                        echo "<td>$ingresos</td>";
                                        echo "<td>$comision</td>";
                                        $boton = "<td><div class=\"btn-group\">
                                        <a href=\"#\" data-toggle=\"dropdown\" class=\"btn btn-primary dropdown-toggle\"><i class=\"fa fa-user icon-white\"></i> Menu<span class=\"caret\"></span></a>
                                        <ul class=\"dropdown-menu dropdown-primary\">";
                                            $filename='editar_empresa';
                                            if($permiso_editar){
                                                $filename = base_url("empresa/editar/");
                                                $boton .="<li><a href=\"" . $filename."?id_empresa=".$id_empresa. "\"><i class=\"fa fa-pencil\"></i> Editar</a></li>";
                                            }
                                            if($permiso_borrar){
                                                $filename = base_url("empresa/borrar/");
                                                $boton .= "<li><a data-toggle='modal' href='" . $filename."?id_empresa=".$id_empresa. "' data-target='#deleteModal' data-refresh='true'><i class=\"fa fa-eraser\"></i> Eliminar</a></li>";
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