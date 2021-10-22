
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
	<h4 class="modal-title">Ver Oferta</h4>
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
							<th>Campo</th>
							<th>Descripcion</th>
						</tr>
					</thead>
					<tbody>	
                        <tr>
							<th>Titulo</th>
							<th><?php echo $titulo; ?></th>
						</tr>
                        <tr>
							<th>Descripcion</th>
							<th><?php echo $descripcion; ?></th>
						</tr>
                        <tr>
							<th>Fecha Inicio</th>
							<th><?php echo ED($fecha_inicio); ?></th>
						</tr>
                        <tr>
							<th>Fecha Fin</th>
							<th><?php echo ED($fecha_fin); ?></th>
						</tr>
                        <tr>
							<th>Cantidad Disponible</th>
							<?php 
                                if($ilimitado == 1){
                            ?>
							<th>Ilimitados</th>
                            <?php
                                }
                                else{
                            ?>
							<th><?php echo $cantidad_limite_cupones; ?></th>
                            <?php
                                }
                            ?>
						</tr>
                        <tr>
							<th>Precio Regular</th>
							<th><?php echo "$ ".number_format($precio_regular,2); ?></th>
						</tr>
                        <tr>
                            <th>Precio Oferta</th>
							<th><?php echo "$ ".number_format($precio_oferta,2); ?></th>
						</tr>
                        <tr>
							<th>Porcentaje de Descuento</th>
							<?php 
                                $porcentaje = 100 - (($precio_oferta/$precio_regular)*100);
                                $porcentaje = number_format($porcentaje,2)." %";
                            ?>
							<th><?php echo $porcentaje; ?></th>
                            
						</tr>
                    </tbody>		
				</table>
			</div>
		</div>
		</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

