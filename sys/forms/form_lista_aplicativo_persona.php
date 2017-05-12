<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Aplicativos->personas</a></li>

            <li class="active">Alta Relacion</li>
        </ol>
    </section>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Actividades
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
                            <th>Nombre en el persona</th>
                            <th>Nombre en el aplicativo</th>

                            <th>&nbsp;</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if($result){
                            foreach ($result as $v) { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $v->persona; ?></td>
                                    <td><?php echo $v->aplicativo; ?></td>
                                    <td><a href="controlador.php?action=elimina_aplicativo_persona&id_relacion=<?php echo $v->id_registro; ?>"><img src="img/delete.png"/></a></td>
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