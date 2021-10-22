
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
	<h4 class="modal-title">Ver Compra General</h4>
</div>
<div class="modal-body">
	<div class="wrapper wrapper-content  animated fadeInRight">
		<div class="row" id="row1">
			<?php
				//permiso del script
			?>
			<div class="col-lg-12">
				<table class="table table-bordered table-striped" id="tableview">
					<thead>
                        <tr>
                            <th>Empresa</th>
							<th>Oferta</th>
							<th>Precio Unitario</th>
                            <th>Cantidad Cupones</th>
                            <th>Total</th>
                            <th>Cajeado</th>
						</tr>
					</thead>
					<tbody>	
                        <?php
                                foreach ($datos as $key => $dato) {
                                    $nombre = $dato['nombre'];
                                    $titulo_oferta = $dato['titulo_oferta'];
                                    $precio_oferta = "$".number_format($dato['precio_oferta'],2);
                                    $cantidad = $dato['cantidad'];
                                    $canjeado = $dato['canjeada'];
                                    $canj = "No";
                                    if($canjeado){
                                        $canj = "Si";
                                    }
                                    $total = $dato['precio_oferta'] * $dato['cantidad'];
                                    $total = "$".number_format($total,2);
                                    ?>
                                        <tr>
                                            <td><?php echo $nombre; ?></td>
                                            <td><?php echo $titulo_oferta; ?></td>
                                            <td><?php echo $precio_oferta; ?></td>
                                            <td><?php echo $cantidad; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $canj; ?></td>
                                        </tr>
                                    <?php
                                }
                        ?>
                    </tbody>		
				</table>
			</div>
		</div>
		</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

