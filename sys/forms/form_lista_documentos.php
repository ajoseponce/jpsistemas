<!DOCTYPE html>
<html lang="en">

<body>

    <div id="page-wrapper">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Documentos
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
                                            <th>&nbsp;</th>
                                            <th>Descripcion</th>
                                            <th>Nombre Archivo</th>
                                            <th>Tipo Archivo</th>
                                            <th>Categoria</th>
                                            <th>Estado</th>
                                            <th>&nbsp;</th>                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php if($result){
                                        foreach ($result as $v) { ?>    
                                        <tr class="odd gradeX">
                                            <td><?php echo $v->id_registro; ?></td>
                                            <td><?php echo $v->descripcion; ?></td>
                                            <td><?php echo $v->archivo_nombre; ?></td>
                                            <td><?php echo $v->archivo_extension; ?></td>
                                            <td><?php echo $v->categoria; ?></td>
                                            <td><?php echo ($v->estado=='A')?"Alta":"Baja"; ?></td>
                                            <td><a href="controlador.php?action=edita_documentos&id_registro=<?php echo $v->id_registro; ?>&archivo_nombre=<?php echo $v->archivo_nombre; ?>"><img src="img/edit.png"/></a></td>
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
            <!-- /.row -->
            
            <!-- /.row -->
        </div>
    <?php include 'footer.php'; ?>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
