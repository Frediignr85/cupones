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
                            <div class="form-group col-lg-6">
                                <label>Nombre de la Empresa:</label>
                                <input type="text" placeholder="Ingrese el nombre de la empresa" class="form-control"
                                    id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Rubro:</label>
                                <select class="col-md-12 select" id="rubro" name="rubro">
                                    <option value="">Seleccione</option>
                                    <?php
                                        foreach ($result_rubros as $key => $value) {
                                            echo "<option value='".$value["id_rubro"]."'";
                                            if($value['id_rubro'] == $id_rubro){
                                                echo " selected  ";
                                            }
                                            echo ">".$value["nombre"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Nombre del Encargado:</label>
                                <input type="text" placeholder="Ingrese el nombre del encargado" class="form-control"
                                    id="encargado" name="encargado" value="<?php echo $nombre_contacto; ?>" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Telefono de contacto:</label>
                                <input type="text" placeholder="Ingrese el telefono de contacto" class="form-control"
                                    id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Correo de Contacto:</label>
                                <input type="email" placeholder="Ingrese el correo de contacto" class="form-control"
                                    id="correo" name="correo" value="<?php echo $correo; ?>" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Direccion:</label>
                                <input type="text" placeholder="Ingrese la direccion de la empresa" class="form-control"
                                    id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Departamento:</label>
                                <select class="col-md-12 select" id="departamento" name="departamento">
                                    <option value="">Seleccione</option>
                                    <?php
                                        foreach ($result_departamentos as $key => $value) {
                                            echo "<option value='".$value["id_departamento"]."'";
                                            if($value['id_departamento'] == $id_departamento){
                                                echo " selected ";
                                            }
                                            echo ">".$value["nombre_departamento"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Municipio:</label>
                                <select class="col-md-12 select" id="municipio" name="municipio">
                                    <?php
                                        foreach ($result_municipios as $key => $value) {
                                            echo "<option value='".$value["id_municipio"]."'";
                                            if($value['id_municipio'] == $id_municipio){
                                                echo " selected ";
                                            }
                                            echo ">".$value["municipio"]."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Porcentaje de Comision:</label>
                                <input type="text" placeholder="Ingrese el porcentaje de comision" class="form-control"
                                    id="porcentaje" name="porcentaje" value="<?php echo $porcentaje; ?>"  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-actions col-lg-12">
                                <input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $id_empresa; ?>">
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