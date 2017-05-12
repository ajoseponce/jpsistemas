
<body>
<script>
    $(function() {
        autocomleteINI('clientes', 'ajax/suggestClientes.php');
    });
</script>
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alta Relacion de Personas/Productos
                </div>
                <div class="panel-body">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
<!--                        <div class="form-group">-->
<!--                            <label>Cliente</label>-->
<!--                            <input class="form-control"  value="--><?php //echo (isset($result->descripcion))?$result->cliente:""; ?><!--" name="cliente" id="cliente" placeholder="Ingrese cliente">-->
<!--                            <input type="hidden"  value="--><?php //echo (isset($result->clienteID))?$result->clienteID:""; ?><!--" name="clienteID" id="clienteID">-->
<!--                        </div>-->
                        <div class="ui-widget">
                            <label>Cliente: </label>
                            <input class="form-control" id="suggest_clientes" value="<?php echo $result->cliente?>">
                            <input type="hidden" id="clientes" name="clientes"value="<?php echo $result->id_persona?>">
                        </div>
                        <div class="ui-widget">
                            <label>Fecha Inicio: </label>
                            <input style="width: 200px;" class="form-control" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo (isset($result->fecha_inicio))?$result->fecha_inicio:""; ?>" id="fecha_inicio"  name="fecha_inicio" placeholder="Ingrese Fecha de inicio a la actividad" type="text">
<!--                            <input type="hidden" id="clientes" name="clientes"value="--><?php //echo $result->id_persona?><!--">-->
                        </div>
                        <?php
                        if($productos){
                            ?>
                            <div  class="ui-widget">
                                <label>Productos</label>
                                <select style="width: 200px;"  class="form-control" id="id_producto" name="id_producto">
                                    <option value="">SELECCIONE UN PRODUCTO</option>
                                    <?php foreach ($productos as $p) { ?>
                                    <option value="<?php echo $p->id_producto; ?>" <?php echo ($p->id_producto==$result->id_producto)?"selected":"" ?>><?php echo $p->descripcion; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php } ?>
                        <div  class="ui-widget">
                            <BR>
                        <input type="hidden"  name="action" value="guardar_relacion" />
                        <input type="hidden" id="id_relacion" name="id_relacion" value="<?php echo (isset($result->id_relacion))?$result->id_relacion:""; ?>" />
                        <input type="button"  onclick="guardar_relacion()" class="btn btn-default" value="Guardar Datos" />
                        <button onclick="location()" type="reset"  class="btn btn-default">Volver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>