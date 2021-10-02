<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row" id="row1">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <!--load datables estructure html-->
                    <header>
                        <h3><b><?php echo $title;?></b></h3>
                    </header>
                    <section>
                        <table class="table table-striped table-bordered table-hover" id="editable">
                            <thead>
                                <tr>
                                    <th>COD OFERTA.</th>
                                    <th>EMPRESA</th>
                                    <th>TITULO</th>
                                    <th>CUPONES VENDIDOS</th>                                    
                                    <th>CUPONES CAJEADOS</th>
                                    <th>PRECIO ANTERIOR</th>
                                    <th>PRECIO OFERTA</th>
                                    <th>FECHA LIMITE</th>
                                    <th>COMISION POR CUPON</th>
                                    <th>INGRESOS TOTALES</th>
                                    <th>COMISION TOTAL</th>
                                    <th>ACCI&Oacute;N</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    foreach ($result as $key => $value) {
                                        $id_empresa = $value['id_empresa'];
                                        $id_oferta = $value['id_oferta'];
                                        $nombre = $value['nombre'];
                                        $titulo_oferta = $value['titulo_oferta'];
                                        $cantidad_cupones_vendidos = $value['cantidad_cupones_vendidos'];
                                        $cupones_canjeados = $value['cupones_canjeados'];
                                        if($cupones_canjeados == ""){
                                            $cupones_canjeados = 0;
                                        }
                                        $precio_regular = $value['precio_regular'];
                                        $precio_oferta = $value['precio_oferta'];
                                        $fecha_limite = $value['fecha_limite'];
                                        $comision = $value['comision'];
                                        $ingresos_totales = $value['ingresos_totales'];
                                        $comision_total = $value['comision_total'];
                                        echo "<tr>";
                                        echo "<td>$id_oferta</td>";
                                        echo "<td>$nombre</td>";
                                        echo "<td>$titulo_oferta</td>";
                                        echo "<td>$cantidad_cupones_vendidos</td>";
                                        echo "<td>$cupones_canjeados</td>";
                                        echo "<td>$precio_regular</td>";
                                        echo "<td>$precio_oferta</td>";
                                        echo "<td>$fecha_limite</td>";
                                        echo "<td>$comision</td>";
                                        echo "<td>$ingresos_totales</td>";
                                        echo "<td>$comision_total</td>";
                                        $boton = "<td><div class=\"btn-group\">
                                        <a href=\"#\" data-toggle=\"dropdown\" class=\"btn btn-primary dropdown-toggle\"><i class=\"fa fa-user icon-white\"></i> Menu<span class=\"caret\"></span></a>
                                        <ul class=\"dropdown-menu dropdown-primary\">";
                                            if($permiso_ver){
                                                $filename = base_url("ofertas/ver/");
                                                $boton .= "<li><a data-toggle='modal' href='" . $filename."?id_oferta=".$id_oferta. "' data-target='#deleteModal' data-refresh='true'><i class=\"fa fa-eye\"></i> Ver</a></li>";
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