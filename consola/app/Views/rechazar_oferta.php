
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
	<h4 class="modal-title">Rechazar Oferta</h4>
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
							<th>Cantidad</th>
							<th><?php echo $cantidad_limite_cupones; ?></th>
						</tr>
                    </tbody>		
				</table>
			</div>
            <div class="col-lg-12">
                <label>Justificacion:</label>
                <br>
                <textarea name="justificacion" id="justificacion" style="width:100%" rows="3"></textarea>
            </div>
		</div>
		</div>
</div>
<div class="modal-footer">
    <input type="hidden" name="id_oferta" id="id_oferta" value="<?php echo $id_oferta; ?>">
	<button type="button" class="btn btn-primary" id="btnRechazar">Rechazar</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>

