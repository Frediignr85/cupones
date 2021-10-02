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
                                <label>Nombres del dependiente:</label>
                                <input type="text" placeholder="Ingrese los nombres del dependiente" class="form-control"
                                    id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Apellidos del dependiente:</label>
                                <input type="text" placeholder="Ingrese los apellidos del dependiente" class="form-control"
                                    id="apellido" name="apellido" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Correo:</label>
                                <input type="email" placeholder="Ingrese el correo del dependiente" class="form-control"
                                    id="correo" name="correo" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-actions col-lg-12">
                                <input type="hidden" name="process" id="process" value="insert">
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