
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
	<h4 class="modal-title">Borrar Tarjeta</h4>
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
							<th>Descripcion></th>
						</tr>
					</thead>
					<tbody>	
                        <tr>
							<th>ID</th>
							<th><?php echo $id_tarjeta; ?></th>
						</tr>
                        <tr>
							<th>Nombre</th>
							<th><?php echo $nombre; ?></th>
						</tr>
                        
                    </tbody>		
				</table>
			</div>
		</div>
		</div>
</div>
<div class="modal-footer">
    <input type="hidden" name="id_tarjeta" id="id_tarjeta" value="<?php echo $id_tarjeta; ?>">
	<button type="button" class="btn btn-primary" id="btnDelete">Eliminar</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

