<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de servicios
            <small>-</small>
        </h1>

    </section>
<?php //print_r($_SESSION);?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="controlador.php?action=<?php echo base64_encode('cargar_servicio'); ?>">Agregar <img src="img/agregar.png"></a>
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
                                <td>Obito
                                    <input class="form-control" id="suggest_persona_obito" value="" >
                                    <input type="hidden" id="persona_obito" name="persona_obito" value="" >
                                    <img src="img/limpiar.png"  data-toggle="tooltip" title="ver pagos realizados" onclick="limpiar_filtro_lista_servicios()" />
                                </td>
                                <td>

                                </td>
                            </tr>
                        </table>
                    <div class="table-container" id="tabla_listado">

                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <!-- <th></th> -->
                                
                                <th>Fecha </th>
                                <th>Obito</th>
                                <th>Solicitante</th>
                                <th>Garante</th>
                                <th>Usiario</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php if($result){
                                $cant=0;
                                foreach ($result as $v) {
                                    
                                    ?>
                                    <tr class="odd gradeX">

                                        <td><?php echo $v->fecha_servicio; ?></td>
                                        <td><?php echo $v->obito; ?></td>
                                        <td><?php echo $v->solicitante; ?></td>
                                        <td><?php echo $v->garante; ?></td>
                                        <td><?php echo $v->usuario; ?></td>
                                       <td>
                                        <?php if($_SESSION['id']==$v->id_usuario){ ?>
                                            <a href="controlador.php?action=<?php echo base64_encode('edita_servicio'); ?>&id_servicio=<?php echo $v->id_servicio; ?>"><img src="img/edit.png"/></a>
                                        <?php
                                        } ?>
                                        <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Servicio" onclick="imprimir_servicio('<?php echo $v->id_servicio; ?>')" />
                                        <img src="img/pagos.png"  data-toggle="tooltip" title="ver pagos realizados" onclick="buscar_pagos_servicio('<?php echo $v->id_servicio; ?>')" />
                                        <?php if($v->saldo>0){ ?>
                                        <a href="controlador.php?action=<?php echo base64_encode('carga_pago_servicio'); ?>&id_servicio=<?php echo $v->id_servicio; ?>"><img src="img/carga_pago.png"/></a>
                                       <?php } ?>
                                       </td>
                                    </tr>
                                <?php }} ?>
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
                trae_servicios();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });
        $("#fecha_hasta").datepicker({
            dateFormat: 'dd-mm-yyyy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            onSelect:  function(dateText) {
                trae_servicios();
            },
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
        });

        $(function() {
        autocomleteINI_persona_obito_filtro('persona_obito', 'ajax/suggestPersonaObito.php');
        
    });

</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
