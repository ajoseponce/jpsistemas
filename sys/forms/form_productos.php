<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Productos
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Productos</a></li>

            <li class="active">Alta</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Alta</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input class="form-control"  value="<?php echo (isset($result->descripcion))?$result->descripcion:""; ?>" name="descripcion" id="descripcion" placeholder="Ingrese descripcion">

                        </div>
                        <label>Precio</label>
                            <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input class="form-control" style="width: 60px;" maxlength="4" value="<?php echo (isset($result->precio))?$result->precio:""; ?>" name="precio" id="precio" placeholder="Ingrese precio">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Ingreso 10 < 15</label>
                            <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso10_15))?$result->ingreso10_15:""; ?>" name="ingreso10_15" id="ingreso10_15" placeholder="">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Ingreso 15 < 20</label>
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso15_20))?$result->ingreso15_20:""; ?>" name="ingreso15_20" id="ingreso15_20" placeholder="">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Ingreso 20 < 25</label>
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso20_25))?$result->ingreso20_25:""; ?>" name="ingreso20_25" id="ingreso20_25" placeholder="">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Ingreso 25 < 30</label>
                        <div class="form-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso25_30))?$result->ingreso25_30:""; ?>" name="ingreso25_30" id="ingreso25_30" placeholder="">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Incremento Dia de Atraso</label>
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->incremento_dia))?$result->incremento_dia:""; ?>" name="incremento_dia" id="incremento_dia" placeholder="">
<!--                            <span class="input-group-addon">%</span>-->
                        </div>
                        <label>Dias de Actividad</label>
                        <div class="form-group">

                            <label>
                                <input id="lunes" name="lunes" value="S" type="checkbox" <?php echo ($result->lunes=="S")?"checked":""; ?>/>
                                Lunes
                            </label>
                            <label>
                                <input type="checkbox" id="martes" value="S"  name="martes" <?php echo ($result->martes=="S")?"checked":""; ?>/>
                                Martes
                            </label>
                            <label>
                                <input type="checkbox" id="miercoles" value="S"  name="miercoles" <?php echo ($result->miercoles=="S")?"checked":""; ?>/>
                                Miercoles
                            </label>
                            <label>
                                <input type="checkbox" id="jueves" value="S"  name="jueves" <?php echo ($result->jueves=="S")?"checked":""; ?>/>
                                Jueves
                            </label>
                            <label>
                                <input type="checkbox" id="viernes" value="S"  name="viernes" <?php echo ($result->viernes=="S")?"checked":""; ?>/>Viernes
                            </label>
                        </div>

                        <?php
                        if($result->id_producto){
                            ?>
                            <div class="form-group">
                                <label>Estado</label>
                                <select style="width: 200px;"  class="form-control" id="estado" name="estado">
                                    <option value="">SELECCIONE UN ESTADO</option>
                                    <option <?php echo ($result->estado=='A')?"selected":""; ?> value="A">ALTA</option>
                                    <option <?php echo ($result->estado=='B')?"selected":""; ?>  value="B">BAJA</option>
                                </select>
                            </div>
                        <?php } ?>
                        <input type="hidden"  name="action" value="guardar_producto" />
                        <input type="hidden" id="id_producto" name="id_producto" value="<?php echo (isset($result->id_producto))?$result->id_producto:""; ?>" />
                        <input type="hidden" id="id_producto_dias" name="id_producto_dias" value="<?php echo (isset($result->id_producto_dias))?$result->id_producto_dias:""; ?>" />
                        <input type="button"  onclick="guardar_producto()" class="btn btn-default" value="Guardar Datos" />
                        <button onclick="volver_listado('productos')" type="reset"  class="btn btn-default">Volver</button>
                    </form>
                    <!-- /.col -->
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->

</div>
<!-- /.box -->

<!-- /.row -->

</section>
<!-- /.content -->
</div>
<style>
    label.error {
        color: red;
        font-size: 16px;
        font-weight: normal;
        line-height: 1;
        margin-top: 0em;
        width: 100%;
        float: none;
    }
    @media screen and (orientation: portrait) {
        label.error {
            margin-left: 0;
            display: block;
        }
    }
    @media screen and (orientation: landscape) {
        label.error {
            display: inline-table;
            margin-left: 2%;
        }
    }
    em {
        color: red;
        font-weight: bold;
        padding-right: .25em;
    }
</style>
<script>
    //        $( "#page1" ).on( "pageinit", function() {
    $("#form_datos").validate({
        rules: {
            descripcion: {
                required: true
            },
            incremento_dia: {
                required: true
            },
            precio: {
                number: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
    //        });
</script>

<?php include 'footer.php'; ?>