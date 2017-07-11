<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            marcas
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> marcas</a></li>

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
                        <?php
                        if($result->id_marca){
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
                        <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_marca'); ?>" />
                        <input type="hidden" id="id_marca" name="id_marca" value="<?php echo (isset($result->id_marca))?$result->id_marca:""; ?>" />
                        <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                        <button onclick="volver_listado('<?php echo base64_encode('listar_marcas'); ?>')" type="reset"  class="btn btn-default">Volver</button>
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
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
    //        });
</script>

<?php include 'footer.php'; ?>
