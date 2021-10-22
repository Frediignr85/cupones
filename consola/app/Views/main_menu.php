<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
					<span>
                    	<img alt="image" style="width:100%; margin-left:-3px;" id='logo_menu' class="logo" src="<?php echo base_url("")."/assets/".$result[0]['logo']; ?>" style="width:120%; margin-left:-12%;">
                    </span>
                </div>
                <div class="logo-element">
                    SG
                </div>
            </li>
        	<?php echo $menu ?>
        </ul>
    </div>
</nav>
<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        	<div class="navbar-header">
            	<a class="navbar-minimalize minimalize-styl-2 btn btn-white"><i class="fa fa-bars"></i> </a>
        	</div>
        	<ul class="nav navbar-top-links navbar-left">
        		<li>
        			<br>
                    <span class="m-r-sm text-muted welcome-message"><b><?php echo $result[0]['nombre']; ?></b></span>
                </li>
        	</ul>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"><b>Bienvenid@</b> <b><?php echo $_SESSION["nombre"] ?> </b></span>
                </li>
                <li>
                <a data-toggle='modal' href="<?php echo base_url("/password") ?>" data-target='#viewModalpw' data-refresh='true'>
                        <i class="fa fa-lock"></i> Contraseña
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo base_url("logout"); ?>">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
    </div>
	<div class='modal fade' id='viewModalpw' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
