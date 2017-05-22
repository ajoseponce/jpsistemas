<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de Usuarios
            <small>=</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Listado de Usuarios</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="controlador.php?action=carga_usuarios">Agregar <img src="img/agregar.png"></a>
            </div>
            <?php if($mensaje){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $mensaje ;?><a href="#" class="alert-link"></a>.
                </div>
            <?php } ?>
            <?php if($mensaje_error){ ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $mensaje_error ;?><a href="#" class="alert-link"></a>.
                </div>
            <?php } ?>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Nombre Usuario</th>
                            <th>Rol </th>
                            <th>User </th>
                            <th>Password</th>
                            <th>Dominio</th>
                            <th>
                            </th>
                            <th></th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php if($result){
                            foreach ($result as $v) {
                                //$presentes=$consulta->getPresentePeriodo($v->id_periodo);
                                ?>
                                <tr class="odd gradeX">

                                    <td><?php echo $v->nombre_persona; ?></td>
                                    <td><?php echo ($v->rol=='Admin')?'Administrador':'Secretario/a'; ?></td>
                                    <td><?php echo $v->nombre; ?></td>
                                    <td><?php echo $v->clave; ?></td>
                                    <td><?php echo $v->dominio; ?></td>
                                    <td>
                                        <a href="controlador.php?action=edita_usuario&id_usuario=<?php echo $v->id_usuario; ?>"><img src="img/edit.png"/></a>
                                    </td>

                                    <td><a href="controlador.php?action=elimina_aplicativo_menu&id_relacion=<?php echo $v->id_relacion; ?>"><img src="img/delete.png"/></a></td>

                                </tr>
                            <?php }} ?>
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
<!-- ./wrapper -->
<?php include 'footer.php'; ?>
<!-- /#wrapper -->

<!-- jQuery -->

