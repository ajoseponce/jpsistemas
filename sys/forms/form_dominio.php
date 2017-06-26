<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dominio
            <small>-</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dominio</a></li>

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
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input class="form-control" required  value="<?php echo (isset($result->descripcion))?$result->descripcion:""; ?>" name="descripcion" id="descripcion" placeholder="Ingrese descripcion">
                            </div>
                            <div class="form-group">
                                <label>Aplicativo</label>
                                <input class="form-control"   value="<?php echo (isset($result->aplicativo))?$result->aplicativo:""; ?>" name="aplicativo" id="aplicativo" placeholder="Ingrese aplicativo">
                            </div>
                            <div class="form-group">
                                <label>Tipo Dominio</label>
                                <select style="width: 200px;"  class="form-control" id="tipo" name="tipo">
                                    <option value="">SELECCIONE UN TIPO</option>
                                    <option <?php echo ($result->tipo==1)?"selected":""; ?> value="1">Administrador</option>
                                    <option <?php echo ($result->tipo==2)?"selected":""; ?>  value="2">Gimnasio</option>
                                </select>
                            </div>
                            <?php
                            if($result->id_dominio){
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
                            <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_dominio'); ?>" />
                            <input type="text" id="id_dominio" id="id_dominio"  name="id_dominio" value="<?php echo (isset($result->id_dominio))?$result->id_dominio:""; ?>" />
                            <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                            <button onclick="volver_listado('<?php echo base64_encode('listar_dominio'); ?>')" type="reset"  class="btn btn-default">Volver</button>
                            <!-- /.form-group -->
                        </div>
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
</style>\
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

</script>
<!-- InputMask -->

<!-- ./wrapper -->
<?php include 'footer.php'; ?>

