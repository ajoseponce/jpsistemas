<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de comprobantes
            <small>Realizaos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Comprobantes</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>
<?php //print_r($_SESSION);?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="controlador.php?action=<?php echo base64_encode('carga_comprobante'); ?>">Agregar <img src="img/agregar.png"></a>
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
            <?php }
            //print_r($_SESSION);
            ?>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" >
                            <tr>
                                <td>Fecha Desde
                                    <input type="text"  value="" id="fecha_desde"  name="fecha_desde" type="text">
                                </td>
                                <td>Fecha Hasta
                                    <input type="text"  value="" id="fecha_hasta"  name="fecha_hasta" type="text">
                                </td>
                            </tr>

                        </table>

                    <div class="table-container" id="tabla_listado">

                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th></th>
                                <th>Cliente</th>
                                <th>Fecha </th>
                                <th>Hora</th>
                                <th>Nota</th>
                                <th>Usuario Pedido</th>
                                <th>Estado</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php if($result){
                                $cant=0;
                                foreach ($result as $v) {
                                    $suma=$v->monto+$suma;
                                    $cant++;
                                    ?>
                                    <tr class="odd gradeX">

                                        <td><?php echo $cant; ?></td>
                                        <td><?php echo $v->cliente; ?></td>
                                        <td><?php echo $v->fecha_retiro; ?></td>
                                        <td><?php echo $v->hora_retiro; ?></td>
                                        <td><?php echo $v->nota; ?></td>
                                        <td><?php echo $v->usuario; ?></td>
                                        <td><?php echo $v->estado; ?></td>

                                    </tr>
                                <?php }} ?>
                            <tr class="odd gradeX">
                                <td></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <th><?php echo $suma; ?></th>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.panel -->
</div>
<!-- /.row -->

<!-- /.row -->
<style>
    .table-container
    {
        width: 100%;
        overflow-y: auto;
        _overflow: auto;
        margin: 0 0 1em;
    }
    .table-container::-webkit-scrollbar
    {
        -webkit-appearance: none;
        width: 14px;
        height: 14px;
    }

    .table-container::-webkit-scrollbar-thumb
    {
        border-radius: 8px;
        border: 3px solid #fff;
        background-color: rgba(0, 0, 0, .3);
    }
</style>
<script>

    //$j=jQuery.noConflict();
        $("#fecha_desde").datepicker({
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_comprobantes();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });
        $("#fecha_hasta").datepicker({
            dateFormat: 'dd-mm-yyyy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_comprobantes();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });

</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
