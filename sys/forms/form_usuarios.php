<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Listado
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> usuarios</a></li>

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
                                <label>Nombre Persona</label>
                                <input class="form-control" required  value="<?php echo (isset($result->nombre_persona))?$result->nombre_persona:""; ?>" name="nombre_persona" id="nombre_persona" placeholder="Ingrese nombre persona">
                            </div>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input class="form-control"  value="<?php echo (isset($result->nombre))?$result->nombre:""; ?>" name="nombre" id="nombre" placeholder="Ingrese usuario">
                            </div>
                            <div class="form-group">
                                <label>Clave</label>
                                <input class="form-control" type="password"  value="<?php echo (isset($result->clave))?$result->clave:""; ?>" name="clave" id="clave" placeholder="Ingrese clave">
                            </div>
                            <div class="form-group">
                                <label>Tipo Usuario</label>
                                <select style="width: 200px;"  class="form-control" id="tipo" name="tipo">
                                    <option value="">SELECCIONE UN TIPO</option>
                                    <option <?php echo ($result->tipo==1)?"selected":""; ?> value="1">Administrador</option>
                                    <option <?php echo ($result->tipo==2)?"selected":""; ?>  value="2">Gimnasio</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Rol Usuario</label>
                                    <input type="radio" <?php echo ($result->rol=='Admin')?"checked":""; ?> value="Admin" name="rol"/>Administrador
                                    <input type="radio" <?php echo ($result->rol=='Secre')?"checked":""; ?> value="Secre" name="rol"/>Secretario
                            </div>
                            <div class="ui-widget">
                                <label>Dominio: </label>
                                <input class="form-control" id="suggest_dominios" value="<?php echo $result->dominio?>">
                                <input type="hidden" id="dominios" name="dominios" value="<?php echo $result->id_dom?>">
                            </div>
                            <input type="hidden"  name="action" value="guardar_usuario" />
                            <input type="text" id="id_usuario" id="id_usuario"  name="id_usuario" value="<?php echo (isset($result->id_usuario))?$result->id_usuario:""; ?>" />
                            <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                            <button onclick="volver_listado('usuarios')" type="reset"  class="btn btn-default">Volver</button>
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
</style>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    //        $( "#page1" ).on( "pageinit", function() {
    $("#form_datos").validate({
        rules: {
            nombre_usuario: {
                required: true
            },
            user: {
                required: true
            },
            clave: {
                required: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
    //        });

    $("[data-mask]").inputmask();
    $(function() {
        autocomleteINI('dominios', 'ajax/suggestDominios.php');
    });
</script>
<!-- InputMask -->

<!-- ./wrapper -->
<?php include 'footer.php'; ?>

