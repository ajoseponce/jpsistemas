<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de Asistencias
            <small>=</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Listado de Asistencias</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

    <div class="col-lg-12">
        <div class="panel panel-default">

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Fecha Hora</th>
                            <th>Actividad</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($result){
                            foreach ($result as $v) { ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $v->persona; ?></td>
                                    <td><?php echo $v->fecha_hora; ?></td>
                                    <td><?php echo $v->actividad; ?></td>
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

