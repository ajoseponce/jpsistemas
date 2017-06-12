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
                    <a href="controlador.php?action=cargar_turno">Agregar <img src="img/agregar.png"></a>
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
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
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
                                  if($v->estado=='Cancelado'){
                                    $color_linea='style="background:red;"';
                                  }
                                     ?>
                                    <tr class="odd gradeX" <?php echo $color_linea; ?> >

                                        <td><?php echo $v->fecha; ?></td>
                                        <td><?php echo $v->cliente; ?></td>
                                        <td><?php echo $v->motivo; ?></td>
                                        <td><?php echo $v->observaciones; ?></td>
                                        <td>
                                          <a href="controlador.php?action=cancelar_turno&id_turno=<?php echo $v->id_turno; ?>"><img src="img/delete.png"/></a>
                                          <a href="controlador.php?action=cargar_datos_turno&id_turno=<?php echo $v->id_turno; ?>"><img src="img/mantenimiento.png"/></a>
                                        </td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
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

<?php include 'footer.php'; ?>
<!-- /#wrapper -->
