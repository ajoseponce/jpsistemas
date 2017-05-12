<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado
            <small>Dominios</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dominios</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="controlador.php?action=cargar_dominio">Agregar <img src="img/agregar.png"></a>
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
                            <th>Descripcion</th>

                            <th>Tipo</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if($result){
                            foreach ($result as $v) { ?>
                                <tr class="odd gradeX">

                                    <td><?php echo $v->descripcion; ?></td>
                                    <td><?php echo $v->tipo_dominio; ?></td>
                                    <td><?php echo ($v->estado=='A')?"Alta":"Baja"; ?></td>
                                    <td><a href="controlador.php?action=edita_dominio&id_dominio=<?php echo $v->id_dominio; ?>"><img src="img/edit.png"/></a></td>
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