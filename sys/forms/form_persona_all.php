<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Datos de la Personas
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
<!--                            <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->

                            <h3 class="profile-username text-center"><?php echo $result->nombre." ".$result->apellido; ?></h3>

<!--                            <p class="text-muted text-center">Software Engineer</p>-->

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Fecha de Nacimiento</b> <a class="pull-right"><?php echo $result->fecha_nacimiento; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Domicilio</b> <a class="pull-right"><?php echo $result->domicilio; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right"><?php echo $result->email; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Numero Telefono</b> <a class="pull-right"><?php echo $result->telefono_celular; ?></a>
                                </li>
                            </ul>

                            <a href="controlador.php?action=<?php echo base64_encode('edita_persona'); ?>&id_persona=<?php echo $_REQUEST['id_persona']; ?>" class="btn btn-primary btn-block"><b>Editar Datos</b></a>
                            <a href="controlador.php?action=<?php echo base64_encode('listar_personas'); ?>" class="btn btn-default btn-block"><b>Volver</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Estudios(Archivos)</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Documento</strong>

                            <p class="text-muted">
                                Estudio realizado año pasado por ej. -(10/05/2016)
                            </p>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Evoluciones</a></li>
                            <li><a href="#timeline" data-toggle="tab">Turnos</a></li>
                            <li><a href="#settings" data-toggle="tab">Indicaciones</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->

                                        <div class="col-md-13">
                                            <div class="box box-solid">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Nueva Evolucion del paciente </h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="box-group" id="accordion">
                                                        <form action="controlador.php" onsubmit="false" id="form_datos_evolucion" method="post">
                                                        <div class="panel box box-success">
                                                          <div class="form-group">
                                                              <label>Diagnostico <img src="img/add.png" onclick="abrir_pop_problemas()" alt=""></label>
                                                              <select id="problemas_persona"  name="problemas_persona" class="form-control select2" multiple="multiple"  data-placeholder="Seleccione una opcion" style="width: 100%;">
                                                              <?php
                                                              if($problemas){
                                                                  foreach ($problemas as $pp){
                                                                    echo "<option value='".$pp->id_problema."'>".$pp->descripcion."</option>" ;
                                                                  }
                                                              }  ?>
                                                              </select>
                                                          </div>
                                                          <div class="form-group">
                                                              <label>Observaciones</label>
                                                              <textarea name="evolucion_texto" id="evolucion_texto" class="form-control" rows="3" placeholder="Evolucion ..."></textarea>
                                                              <input type="hidden" name="action_js" id="action_js" value="guardar_evolucion" />
                                                              <input type="hidden" name="id_persona" id="id_persona" value="<?php echo $_REQUEST['id_persona']; ?>" />

                                                          </div>
                                                          <button class="btn btn-default"  onclick="guardar_evolucion()" type="button">Guardar Evolucion</button>

                                                        </div>
                                                      </form>
                                                    </div>
                                                </div>

                                                <!-- /.box-body -->
                                            </div>
                                            <div class="box box-solid" id="bloque_evoluciones">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Evoluciones del paciente <?php echo $result->nombre." ".$result->apellido; ?></h3>
                                                </div>
                                                <?php if($evo_morales){ ?>
                                                <!-- /.box-header -->
                                                <?php foreach ($evo_morales as $e){
                                                    $problemas_evolucion=$consultas->getProblemasEvolucion($e->id_evolucion);
                                                    ?>
                                                <div class="box-body" style="padding: 2px;">
                                                    <div class="box-group" id="accordion">
                                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                                        <div class="panel box box-success">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $e->id_evolucion; ?>">
                                                                        <?php echo "Usuario: ".$e->nombre_usuario." - Fecha ".$e->fecha_evolucion; ?>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse_<?php echo $e->id_evolucion; ?>" class="panel-collapse collapse in">
                                                              <div class="box-body" class="error">
                                                                <?php foreach ($problemas_evolucion as $pe){
                                                                  echo $pe->descripcion."-" ;
                                                                } ?>
                                                              </div>
                                                              <div class="box-body">
                                                                    <?php echo $e->descripcion; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php }}else{ ?>
                                                    No contiene evoluciones.
                                                <?php } ?>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>

                                <?php ?>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    <?php if($turnos){ ?>
                                    <!-- /.box-header -->
                                    <?php foreach ($turnos as $t){  ?>
                                    <li class="time-label">

                                    <span class="bg-red">
                                        <!-- /.box-header -->
                                        <?php echo $t->fecha;  ?>
                                    </span>
                                    </li>
                                    <li>
                                        <i class="fa fa-clock-o bg-blue"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $t->hora;  ?></span>
                                            <h3 class="timeline-header"><a href="#"><?php echo $t->motivo;  ?></a> </h3>
                                            <div class="timeline-body">
                                                <?php echo ($t->observaciones)?$t->observaciones:"Sin Observaciones";  ?>
                                            </div>
                                            <div class="timeline-footer">
                                              <?php if($t->estado=='Asignado'){ ?>
                                                <a class="btn btn-primary btn-xs" onclick="marcar_presente(<?php echo $t->id_turno; ?>)">Marcar presente</a>
                                              <?php }  ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php }}else{
                                        echo "No Contiene turnos";
                                    } ?>
                                    <li>
<!--                                        <i class="fa fa-clock-o bg-gray"></i>-->
                                        <button class="btn btn-danger"  onclick="abrir_pop_turnos(<?php echo $_REQUEST['id_persona']; ?>)" type="button">Dar Turno</button>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                              <div class="box-body">
                                  <div class="box-group" id="accordion">
                                      <div class="panel box box-success">
                                        <div class="form-group">
                                            <label>Medicamento </label>
                                            <select id="problemas_persona"  name="problemas_persona" class="form-control select2" multiple="multiple"  data-placeholder="Seleccione una opcion" style="width: 100%;">
                                            <?php
                                            if($farmacos){
                                                foreach ($problemas as $m){
                                                  echo "<option value='".$m->id_medicamento."'>".$pp->descripcion."</option>" ;
                                                }
                                            }  ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <textarea name="indica_text" id="indica_text" class="form-control" rows="3" placeholder="Indica texto ..."></textarea>
                                        </div>
                                        <button class="btn btn-default"  onclick="guardar_evolucion()" type="button">Guardar Indicacion Farmacologica</button>

                                      </div>

                                  </div>
                              </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 2.2.3 -->
<?php include 'footer.php'; ?>
