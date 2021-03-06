<!DOCTYPE html>
<html lang="en">

<body>

<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado De Pagos Realizados
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
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
                                <th></th>
                                <th>Cliente</th>
                                <th>Actividad</th>
                                <th>Periodo</th>
                                <th>Monto</th>
                                <th>Fecha de pago</th>
                                <th>Recargo&nbsp;</th>
                                <th>Dias de Mora</th>
                                <th>Nota</th>
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
                                        <td><?php echo $v->actividad; ?></td>
                                        <td><?php echo $v->periodo; ?></td>
                                        <td><?php echo $v->monto; ?></td>
                                        <td><?php echo $v->fecha_pago; ?></td>
                                        <td><?php echo $v->dias_retraso; ?></td>
                                        <td><?php echo $v->monto_incremento; ?></td>
                                        <td><?php echo $v->nota; ?></td>

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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <!-- /.row -->
</div>
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
    $(function() {
        //alert('bueno');
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
    });
    //        function  ver_cambio(){
    //
    //        }
</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->