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
                                    <th>NOMBRE</th>
                                    <th>DUI</th>
                                    <th>TELEFONO</th>
                                    <th>CUPONES COMPRADOS</th>
                                    <th>CUPONES CANJEADOS</th>
                                    <th>CUPONES SIN CANJEAR</th>
                                    <th>CUPONES VENCIDOS</th>
                                    <th>MONTO COMPRADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($result as $key => $value) {
                                        $id_cliente = $value['id_cliente'];
                                        $nombre = $value['nombre'];
                                        $dui = $value['dui'];
                                        $telefono1 = $value['telefono1'];
                                        $total_cupones = $value['total_cupones'];
                                        $cupones_canjeados = $value['cupones_canjeados'];
                                        $cupones_no_canjeados = $value['cupones_no_canjeados'];
                                        $cupones_vencidos = $value['cupones_vencidos'];
                                        $total_comprado = $value['total_comprado'];
                                        echo "<tr>";
                                        echo "<td>$nombre</td>";
                                        echo "<td>$dui</td>";
                                        echo "<td>$telefono1</td>";
                                        echo "<td>$total_cupones</td>";
                                        echo "<td>$cupones_canjeados</td>";
                                        echo "<td>$cupones_no_canjeados</td>";
                                        echo "<td>$cupones_vencidos</td>";
                                        echo "<td>$".number_format($total_comprado,2)."</td>";

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