
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
							<th>ID</th>
							<th><?php echo $id_oferta; ?></th>
						</tr>
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
							<th><?php echo $fecha_inicio; ?></th>
						</tr>
                        <tr>
							<th>Fecha Fin</th>
							<th><?php echo $fecha_fin; ?></th>
						</tr>
                        <tr>
							<th>Cantidad de cupones</th>
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
                    </tbody>		
				</table>
			</div>
		</div>
		</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

