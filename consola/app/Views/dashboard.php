<script src="<?php echo base_url("/assets/js/highcharts.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/data.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/drilldown.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/exporting.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/export-data.js"); ?>"></script>
<script src="<?php echo base_url("/assets/js/accessibility.js"); ?>"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/clientes"); ?>">
                        <div class="widget style1 bg-success">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Clientes</span>
                                    <h2 class="font-bold"><?php echo $clientes; ?></h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/empresa"); ?>">
                        <div class="widget style1 bg-warning">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-university fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Empresas</span>
                                    <h2 class="font-bold"><?php echo $empresas; ?></h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/rubros"); ?>">
                        <div class="widget style1 bg-info">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-glass fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Rubros</span>
                                    <h2 class="font-bold">
                                    <?php echo $rubros; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/dependientes"); ?>">
                        <div class="widget style1 bg-green">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Dependientes</span>
                                    <h2 class="font-bold">
                                    <?php echo $dependientes; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/ofertas_Pendientes"); ?>">
                        <div class="widget style1 bg-dorado">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-hand-paper-o fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Ofertas Pendientes</span>
                                    <h2 class="font-bold">
                                    <?php echo $ofertas_pendientes; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/ofertas_Activas"); ?>">
                        <div class="widget style1 bg-danger">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-check  fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Ofertas Activas</span>
                                    <h2 class="font-bold">
                                    <?php echo $ofertas_activas; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/ofertas_Pasadas"); ?>">
                        <div class="widget style1 bg-naranja">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-backward fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Ofertas Pasadas</span>
                                    <h2 class="font-bold">
                                    <?php echo $ofertas_pasadas; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-3">
                    <a href="<?php echo base_url("/ofertas_Rechazadas"); ?>">
                        <div class="widget style1 bg-success">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-times fa-5x"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span>Ofertas Rechazadas</span>
                                    <h2 class="font-bold">
                                    <?php echo $ofertas_rechazadas; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title bg-green">
                        <h5 style="color:#FFF;">TOTAL DE COMPRAS REALIZADAS POR MES ($)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up" style="color:#FFF;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="margin-top: 1.8px;">
                        <div id="container1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title bg-green">
                        <h5 style="color:#FFF;">TOTAL DE UTILIDADES GENERADAS POR MES ($)</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up" style="color:#FFF;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="margin-top: 1.8px;">
                        <div id="container2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>