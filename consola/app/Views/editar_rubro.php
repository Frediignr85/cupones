<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                <h3 style="color:#194160;"><i class="fa fa-user"></i> <b><?php echo $title;?></b></h3> (Los campos marcados con <span style="color:red;">*</span> son requeridos)
                </div>
                <div class="ibox-content">
                    <form name="formulario" id="formulario">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Nombre del rubro:</label>
                                <input type="text" placeholder="Ingrese el nombre del rubro" class="form-control"
                                    id="nombre" name="nombre"  value="<?php echo $nombre; ?>" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Descripcion del rubro:</label>
                                <input type="text" placeholder="Ingrese la desripcion del rubro" class="form-control"
                                    id="descripcion" name="descripcion"  value="<?php echo $descripcion; ?>" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-actions col-lg-12">
                                <input type="hidden" name="id_rubro" id="id_rubro" value="<?php echo $id_rubro; ?>">
                                <input type="hidden" name="process" id="process" value="edited">
                                <input type="submit" id="submit1" name="submit1" value="Guardar"
                                    class="btn btn-primary m-t-n-xs pull-right" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>