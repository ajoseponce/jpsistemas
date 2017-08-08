<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de pagos
            <small>Realizaos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Pagos</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>
<?php //print_r($_SESSION);?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="controlador.php?action=<?php echo base64_encode('cargar_pago'); ?>">Agregar <img src="img/agregar.png"></a>
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
                            <tr>
                                <td>Periodo
                                    <select style="width: 200px;"  onchange="trae_pagos()" class="form-control" id="periodo" name="periodo">
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
                                </td>
                                <td>&nbsp;
                                </td>
                            </tr>
                        </table>

                    <div class="table-container" id="tabla_listado">

                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <!-- <th></th> -->
                                <th>Cliente</th>
                                <th>Actividad</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                
                                <th>&nbsp;</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if($result){
                                $cant=0;
                                foreach ($result as $v) {

                                    $cant++;
                                    ?>
                                    <tr class="odd gradeX">

                                        <!-- <td><?php echo $cant; ?>  <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir " onclick="imprimir_pago('<?php echo $v->id_pago; ?>')" /></td> -->
                                        <td><?php echo $v->cliente; ?></td>
                                        <td><?php echo $v->actividad; ?></td>
                                        <td><?php echo $v->fecha; ?></td>
                                        <td><?php echo $v->hora; ?></td>

<!--                                        <td><a href="imprimir_comprobante.php?id_comprobante=--><?php //echo $v->id_pago; ?><!--"><img src="./img/printer.png"></a></td>-->
                                        <td><?php if($_SESSION['rol']=='Admin'){ ?>
                                            <img onclick="eliminarPresente(<?php echo $v->id_presente; ?>)" src="./img/delete.png" />
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }} ?>
                            <tr class="odd gradeX">

                                <th colspan="5">Asistencias total : <?php echo $suma; ?></th>

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
                trae_pagos();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });
        $("#fecha_hasta").datepicker({
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_pagos();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });

</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
