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

                            <a href="controlador.php?action=edita_persona&id_persona=<?php echo $result->id_persona; ?>" class="btn btn-primary btn-block"><b>Editar Datos</b></a>
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
                                                    <h3 class="box-title">Evoluciones del paciente <?php echo $result->nombre." ".$result->apellido; ?></h3>
                                                </div>
                                                <?php if($evo_morales){ ?>
                                                <!-- /.box-header -->
                                                <?php foreach ($evo_morales as $e){  ?>
                                                <div class="box-body">
                                                    <div class="box-group" id="accordion">
                                                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                                        <div class="panel box box-success">
                                                            <div class="box-header with-border">
                                                                <h4 class="box-title">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $e->id_evolucion; ?>">
                                                                        <?php echo $e->nombre_usuario." - ".$e->fecha_evolucion; ?>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapse_<?php echo $e->id_evolucion; ?>" class="panel-collapse collapse in">
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
                                    <!-- timeline time label -->
                                    <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-primary btn-xs">Read more</a>
                                                <a class="btn btn-danger btn-xs">Delete</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-user bg-aqua"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                            </h3>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-comments bg-yellow"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                            <div class="timeline-body">
                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <li>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
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