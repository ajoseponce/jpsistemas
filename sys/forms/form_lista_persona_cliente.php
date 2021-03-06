<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado de Personas
            <small>=</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Listado de personas</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   <a href="controlador.php?action=<?php echo base64_encode('carga_personas'); ?>">Agregar <img src="img/agrega_persona.png"></a>
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
                    <table class="table table-striped table-bordered table-hover" >
                    <tr>
                        <th>Apellido
                            <input type="text" size="60" onchange="busca_persona_all()" value="" id="apellido_filtro"  name="apellido_filtro" type="text">
                        </th>
                        <th>Nombre
                            <input type="text" size="60" onchange="busca_persona_all()" value="" id="nombre_filtro"  name="nombre_filtro" type="text">
                        </th>
                    </tr>
                    <tr>
                        <th>DNI
                            <input type="text"  value="" id="dni_filtro"  onchange="busca_persona_all()" name="dni_filtro" type="text">
                        </th>
                        <th>&nbsp;
                        </th>
                    </tr>
                </table>
                <div class="table-container" id="tabla_listado">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Apellido</th>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Fecha Nac.</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            if($result){
                                foreach ($result as $v) { ?>
                                    <tr class="odd gradeX">
                                        <td width="85">
                                            <a href="controlador.php?action=<?php echo base64_encode('datos_persona_all');?>&id_persona=<?php echo $v->id_persona; ?>"><img src="img/info_all.png"/></a>
                                            <img data-toggle="modal" onclick="abrir_pop_turnos(<?php echo $v->id_persona; ?>)" style="cursor: pointer;" src="img/turnos.png"/>
                                        </td>
                                        <td><?php echo $v->apellido; ?></td>
                                        <td><?php echo $v->nombre; ?></td>
                                        <td><?php echo $v->dni; ?></td>
                                        <td><?php echo $v->fecha_nacimiento; ?></td>
                                        <td><?php echo ($v->cod_estado=='A')?"Alta":"Baja"; ?></td>
                                        <td>
                                            <a href="controlador.php?action=<?php echo base64_encode('edita_persona'); ?>&id_persona=<?php echo $v->id_persona; ?>"><img src="img/edit.png"/></a>
                                            <img  onclick="eiminaCliente('<?php echo (int)$v->id_persona ?>')" style="cursor: pointer;" src="img/delete.png"/>
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
