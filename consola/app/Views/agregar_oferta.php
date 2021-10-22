<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h3 style="color:#194160;"><i class="fa fa-user"></i> <b><?php echo $title;?></b></h3> (Los campos
                    marcados con <span style="color:red;">*</span> son requeridos)
                </div>
                <div class="ibox-content">
                    <form style="justify-content:right;" action="<?php echo base_url('/ofertas/store');?>" name="ajax_form"
                        id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="row">
                            

                            <div class="form-group col-md-6">
                                <img id="blah"
                                    src="https://www.tutsmake.com/wp-content/uploads/2019/01/no-image-tut.png"
                                    class="" width="100" height="100" style="float: right;" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="formGroupExampleInput">Imagen</label>
                                <input type="file" name="file" class="form-control" id="file"
                                    onchange="readURL(this);" accept=".png, .jpg, .jpeg" />
                            </div>
                            <div class="form-group">
                                <button type="submit" id="send_form" class="btn btn-success" style="display: none;">Submit</button>
                            </div>

                    </form>
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
                                <input type="text" placeholder="Ingrese el precio regular de la oferta"
                                    class="form-control precios" id="precio_regular" name="precio_regular" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Precio Oferta:</label>
                                <input type="text" placeholder="Ingrese el precio en oferta"
                                    class="form-control precios" id="precio_oferta" name="precio_oferta" required>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Cantidad de Cupones:</label>
                                <input type="text" placeholder="Ingrese la cantidad limite de cupones"
                                    class="form-control" id="cantidad" name="cantidad">
                            </div>
                            <div class="form-group col-lg-2" >
                                <div class='checkbox i-checks'><br>
                                    <label id='frentex'>
                                        <input type='checkbox' id='limite' name='limite' > <strong> ¿Sin Limite?</strong>
                                    </label>
                                </div>
                                <input type='hidden' id='activo' name='activo' value='0' >
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Fecha Inicio:</label>
                                <input type="text" placeholder="Ingrese la fecha de inicio"
                                    class="form-control datepicker" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Fecha Fin:</label>
                                <input type="text" placeholder="Ingrese la fecha de finalizacion"
                                    class="form-control datepicker" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Fecha Limite:</label>
                                <input type="text" placeholder="Ingrese la fecha limite de canje"
                                    class="form-control datepicker" id="fecha_limite" name="fecha_limite" required>
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

                    <script>
                        function readURL(input, id) {
                            id = id || '#blah';
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $(id)
                                        .attr('src', e.target.result)
                                        .width(200)
                                        .height(150);
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>