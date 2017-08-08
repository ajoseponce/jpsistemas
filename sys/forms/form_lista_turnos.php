<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de Turnos
            <small>(por defecto del corriente mes)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Turnos</a></li>

            <li class="active">Listado</li>
        </ol>
    </section>

    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="controlador.php?action=<?php echo base64_encode('listar_personas'); ?>">Agregar <img src="img/marcar_turno.png"></a>
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

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" >
                            <tr>
                                <th>Fecha Desde
                                    <input type="text"  value="" id="fecha_desde"  name="fecha_desde" type="text">
                                </th>
                                <th>Fecha Hasta
                                    <input type="text"  value="" id="fecha_hasta"  name="fecha_hasta" type="text">
                                </th>
                            </tr>
                            <tr>
                                <th>Apellido
                                    <input type="text" size="60" onchange="trae_turnos()" value="" id="apellido_filtro"  name="apellido_filtro" type="text">
                                </th>
                                <th>Nombre
                                    <input type="text" size="60" onchange="trae_turnos()" value="" id="nombre_filtro"  name="nombre_filtro" type="text">
                                </th>
                            </tr>
                            <tr>
                                <th>DNI
                                    <input type="text"  value="" id="dni_filtro"  onchange="trae_turnos()" name="dni_filtro" type="text">
                                </th>
                                <th>Motivo <select style="width: 200px;"  onchange="trae_turnos()" id="motivo_filtro" name="motivo_filtro">
                                    <?php $motivos = $consultas->getMotivos();
                                    if($motivos){
                                        echo "<option value=''>Seleccionar una opcion</option>" ;
                                        foreach ($motivos as $m){
                                            echo "<option value='".$m->id_motivo."'>".$m->descripcion."</option>" ;
                                        }
                                    } ?>
                                  </select>
                                </th>
                            </tr>

                        </table>
                        <div class="table-container" id="tabla_listado">

                          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                              <tr>
                                  <th>&nbsp;</th>
                                  <th>Fecha</th>
                                  <th>cliente</th>
                                  <th>Motivo</th>
                                  <th>Observacion</th>
                                  <th>&nbsp;</th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php if($result){
                                  foreach ($result as $v) {
                                    $disabled_cp="";
                                    if($v->fecha!=date('d/m/Y')){
                                      $disabled_='style="display:none;"';
                                      $disabled_cp='style="display:none;"';
                                      $disabled_cll='style="display:none;"';
                                    }else{
                                      $disabled_="";
                                      $disabled_cp="";
                                      $disabled_cll="";
                                    }
                                    if($v->estado=='Cancelado'){
                                      $color_linea='style="background:#f2a4a4;"';
                                    }else{
                                      $color_linea='';
                                    }
                                    switch ($v->estado) {
                                      case "Asignado":
                                          $disabled_='style="display:none;"';
                                      break;
                                      case "Cancelado":
                                          ///$estado='Cancelado';
                                            $disabled_cp='style="display:none;"';
                                            $disabled_cancelar="style=display:none;";
                                      break;
                                      case "Llamando":
                                          ///$estado='Cancelado';
                                            $disabled_cp='style="display:none;"';
                                      break;
                                      case "Atendido":

                                            $disabled_cp="style=display:none;";
                                            $disabled_cancelar="style=display:none;";
                                      break;
                                    }
                                       ?>
                                      <tr class="odd gradeX" <?php echo $color_linea; ?> >
                                        <td>
                                        <?php if($v->estado=='Presente'){ ?>
                                            <img  data-toggle="tooltip" <?php echo $disabled_cp; ?> title="Cancelar Presente!" src="img/cancela_presente.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','cancela_presente')"/>


                                        <?php }else{ ?>
                                            <img src="img/presente.png"  data-toggle="tooltip" title="Dar Presente!" <?php echo $disabled_cp; ?> onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                                        <?php } ?>
                                        <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Comprobante" onclick="imprimir_bono('<?php echo $v->id_turno; ?>')" />

                                        </td>

                                          <td><?php echo $v->fecha; ?></td>
                                          <td><?php echo $v->cliente; ?></td>
                                          <td><?php echo $v->motivo; ?></td>
                                          <td><?php echo $v->observaciones; ?></td>
                                          <td><?php echo $v->estado; ?></td>
                                          <td>
                                            <?php if($v->estado=='Presente'){ ?>
                                                <img src="img/llamando.png"  data-toggle="tooltip" title="LLamar Paciente!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                                            <?php }
                                                if($v->estado=='Llamando'){ ?>
                                                <img src="img/cancelar_llamada.png"  data-toggle="tooltip" title="Cancelar LLamado!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','cancelar_llamada')"/>
                                            <?php }
                                                if($v->estado=='Llamando'){ ?>
                                                <img src="img/atendio.png"  data-toggle="tooltip" title="Atender Paciente!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                                              <?php }
                                            ?>

                                            <img src="img/cancela_turno.png" <?php echo $disabled_cancelar; ?>  data-toggle="tooltip" title="Cancelar Turno !" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','Cancelado')" />
                                            <a href="controlador.php?action=<?php echo base64_encode('carga_comprobante');?>&id_persona=<?php echo $v->id_persona; ?>&id_turno=<?php echo $v->id_turno; ?>"><img src="img/comprobante.png" <?php echo $disabled_cancelar; ?>  data-toggle="tooltip" title="Comprobante !" />
                                          </td>
                                      </tr>
                                  <?php }} ?>
                              </tbody>
                          </table>
                      </div>
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
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
        //$j=jQuery.noConflict();
            $("#fecha_desde").datepicker({
                dateFormat: 'dd-mm-yy',
                dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
                onSelect:  function(dateText) {
                    trae_turnos();
                },
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
            });
            $("#fecha_hasta").datepicker({
                dateFormat: 'dd-mm-yy',
                dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
                onSelect:  function(dateText) {
                    trae_turnos();
                },
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
            });

    </script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
