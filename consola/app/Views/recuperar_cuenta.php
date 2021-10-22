<div class="loginColumns animated fadeInUp">
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-bold"></h2>
            <p>
                Consola para recuperar su contraseña.
            </p>
            <div>
                <center>
                    <img alt="image" style="width:50%;" ; class="img-responsive"
                        src="<?php echo "".base_url("")."/assets/".$result[0]['logo'].""; ?>"
                        style="width:100%; margin-right:5%; margin-top:5%;">
                </center>
            </div>
        </div>
        <div class="col-sm-6 b-r">
            <div class="ibox-content">
                <p class="m-t">
                    <?php
							if(isset($error_msg)){
								echo "<strong>$error_msg</strong>";
							}
							?>
                </p>
                <form class="m-t" method="POST" id="recuperar_contra" name="recuperar_contra">
                    <div class="form-group">
                        <label for="User Name">Contraseña</label>
                        <input type="text" class="form-control" placeholder="Introduzca su Contraseña" required=""
                            id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="User Name">Repetir Contraseña</label>
                        <input type="text" class="form-control" placeholder="Repita su Contraseña" required=""
                            id="repetir_password" name="repetir_password">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Recuperar</button>
                    <br>
                    <p class="social-text">Ingrese sus nevas credenciales</p>
                    <input type="hidden" name="id_cuenta_recuperar" id="id_cuenta_recuperar" value="<?php echo $id_cuenta_recuperar; ?>">
                </form>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <?php echo $result[0]['nombre'];  ?>
        </div>
        <div class="col-md-6 text-right">
            <small>Todos los derechos reservados <a href="https://www.univo.edu.sv/"
                    target="_blank"><?php echo $result[0]['nombre'];  ?></a> © <?=date('Y');?></small>
        </div>
    </div>
</div>