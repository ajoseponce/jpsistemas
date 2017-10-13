<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de pagos por servicios
            <small>Realizaos</small>
        </h1>
        
    </section>
<?php //print_r($_SESSION);?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            
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
                                
                                <th>Solicitante</th>
                                <th>Monto</th>
                                <th>Fecha Hora</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if($result){
                                $cant=0;
                                foreach ($result as $v) {
                                    $cant++;
                                    $suma=$v->monto+$suma;
                                    ?>
                                    <tr class="odd gradeX">
                                        
                                        <td><?php echo $v->solicitante; ?></td>
                                        <td><?php echo $v->monto; ?></td>
                                        <td><?php echo $v->fecha." ".$v->hora; ?></td>
                                        <td><?php echo $v->nombre_persona; ?></td>
                                        <td>
                                          <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Comprobante" onclick="imprimir_pago_servicio('<?php echo $v->id_pago_servicio; ?>')" />
                                          <img src="img/delete.png"  data-toggle="tooltip" title="Borrar Comprobante" onclick="borrar_pago_servicio('<?php echo $v->id_pago_servicio; ?>')" /> 
                                        </td>

                                    </tr>
                                   
                                <?php } ?>
                                <tr class="odd gradeX">
                                    <td>&nbsp;</td>
                                    <th><?php echo $suma; ?></th>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php }else{ ?>
                                    <tr class="odd gradeX">
                                        <td colspan="5">No contiene pagos realizados</td>
                                    </tr>
                                <?php } ?>
                            
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

<script>

    //$j=jQuery.noConflict();
        $("#fecha_desde").datepicker({
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_pagos_servicios();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });
        $("#fecha_hasta").datepicker({
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_pagos_servicios();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });

</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
