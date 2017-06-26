<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Menu
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Alta</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <?php if($mensaje){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $mensaje ;?><a href="#" class="alert-link"></a>.
                </div>
            <?php } ?>
            <?php if($mensaje_error){ ?>
                <div class="alert alert-error alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $mensaje_error ;?><a href="#" class="alert-link"></a>.
                </div>
            <?php } ?>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-6">
                        <div id="mjs_alert" style="color:red; font-size: 15px;"></div>
                        <div class="ui-widget">
                            <label>Cliente: </label>
                            <input class="form-control" id="suggest_clientes" value="<?php echo $result->cliente?>">
                            <input type="hidden" id="clientes" name="clientes" value="<?php echo $result->id_persona?>">
                        </div>
                        <div  class="ui-widget">
                            <label>Periodo</label>
                            <select style="width: 200px;"  onchange="trae_pago_periodo(this.value)" class="form-control" id="periodo" name="periodo">
                                <option value="">SELECCIONE UN PERIODO</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div  class="ui-widget">
                            <label>Actividad</label>
                            <select style="width: 200px;" onchange="trae_precio(this.value)"  class="form-control" id="id_producto" name="id_producto">
                            </select>
                        </div>

                        <div  class="ui-widget" >
                            <label>Monto a pagar</label>
                            <input class="form-control"  value="" name="precio" id="precio" placeholder="Ingrese precio">
                        </div>
                        <div  class="ui-widget" >
                            <label>Nota</label>
                            <textarea class="form-control"  value="" name="nota" id="nota" placeholder="Ingrese nota"></textarea>
                        </div>
                        <div  class="ui-widget">
                            <BR>
                            <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_pago'); ?>" id="action" />
                            <input type="hidden"  name="dias_retraso" value="0" id="dias_retraso" />
                            <input type="hidden"  name="monto_incremento" value="0" id="monto_incremento" />
                            <input type="button"  onclick="guardar_pago()" id="graba" class="btn btn-default" value="Grabar Pago" />
                            <button onclick="volver_listado('<?php echo base64_encode('listar_pagos'); ?>')" type="reset"  class="btn btn-default">Volver</button>
                        </div>
                    </div>
                    </form>
                    <!-- /.col -->
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->

</div>
<!-- /.box -->


<!-- /.row -->

</section>
<!-- /.content -->
</div>
<script>
    $(function() {
        autocomleteINI_productos('clientes', 'ajax/suggestClientes.php');
    });
</script>
<?php include 'footer.php'; ?>