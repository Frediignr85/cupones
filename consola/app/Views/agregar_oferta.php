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
                                <label>Titulo de la Oferta:</label>
                                <input type="text" placeholder="Ingrese el titulo de la oferta" class="form-control"
                                    id="titulo" name="titulo" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Descripcion:</label>
                                <br>
                                <textarea name="descripcion" id="descripcion" style="width:100%" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Precio Regular:</label>
                                <input type="text" placeholder="Ingrese el precio regular de la oferta" class="form-control precios"
                                    id="precio_regular" name="precio_regular" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Precio Oferta:</label>
                                <input type="text" placeholder="Ingrese el precio en oferta" class="form-control precios"
                                    id="precio_oferta" name="precio_oferta" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Cantidad Limite de Cupones:</label>
                                <input type="text" placeholder="Ingrese la cantidad limite de cupones" class="form-control"
                                    id="cantidad" name="cantidad" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Fecha Inicio:</label>
                                <input type="text" placeholder="Ingrese la fecha de inicio" class="form-control datepicker"
                                    id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Fecha Fin:</label>
                                <input type="text" placeholder="Ingrese la fecha de finalizacion" class="form-control datepicker"
                                    id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Fecha Limite:</label>
                                <input type="text" placeholder="Ingrese la fecha limite de canje" class="form-control datepicker"
                                    id="fecha_limite" name="fecha_limite" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label>Otros Detalles:</label>
                                <br>
                                <textarea name="detalles" id="detalles" style="width:100%" rows="3"></textarea>
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