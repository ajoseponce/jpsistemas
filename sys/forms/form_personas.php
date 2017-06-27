<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Persona
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Personas</a></li>

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
                                <label>Apellido</label>
                                <input class="form-control" required  value="<?php echo (isset($result->apellido))?$result->apellido:""; ?>" name="apellido" id="apellido" placeholder="Ingrese Apellido">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control"  value="<?php echo (isset($result->nombre))?$result->nombre:""; ?>" name="nombre" id="nombre" placeholder="Ingrese nombre">
                            </div><div class="form-group">
                                <label>DNI</label>
                                <input class="form-control"  value="<?php echo (isset($result->dni))?$result->dni:""; ?>" name="dni" id="dni" placeholder="Ingrese dni">
                            </div>
                            <div class="input-group">
<!--                                <label>Fecha Nacimiento</label>-->
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" type="text" value="<?php echo (isset($result->fecha_nacimiento) && $result->fecha_nacimiento!="00/00/0000")?$result->fecha_nacimiento:""; ?>" >
                            </div>
                            <div class="form-group">
                                <label>Domicilio</label>
                                <input class="form-control"  value="<?php echo (isset($result->domicilio_dni))?$result->domicilio_dni:""; ?>" name="domicilio" id="domicilio" placeholder="Ingrese domicilio">
                            </div>
                            <div class="form-group">
                                <label>Telefono Celular</label>
                                <input class="form-control"  value="<?php echo (isset($result->telefono_celular))?$result->telefono_celular:""; ?>" name="telefono_celular" id="telefono_celular" placeholder="Ingrese telefono celular">
                            </div>
                            <div class="form-group">
                                <label>Telefono Particulr</label>
                                <input class="form-control"  value="<?php echo (isset($result->telefono_particular))?$result->telefono_particular:""; ?>" name="telefono_particular" id="telefono_particular" placeholder="Ingrese telefono particular">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control"  value="<?php echo (isset($result->mail))?$result->mail:""; ?>" name="mail" id="mail" placeholder="Ingrese mail">
                            </div>
                            <div class="form-group">
                                  <label>Cobertura</label>
                                  <input class="form-control" id="suggest_cobertura" value="<?php echo $result->cobertura?>">
                                  <input type="hidden" id="cobertura" name="cobertura" value="<?php echo $result->id_cobertura?>">
                            </div>
                            <div class="form-group">
                                  <label>Plan Cobertura</label>
                                  <select style="width: 200px;"  class="form-control" id="plan_cobertura" name="plan_cobertura">
                                      <option value="<?php echo $result->id_plan_cobertura; ?>"><?php echo $result->plan_cobertura; ?></option>
                                  </select>
                            </div>
                            <div class="form-group">
                                  <label>Numero Afiliado</label>
                                  <input class="form-control"  type="text" id="numero_cobertura" name="numero_cobertura" value="<?php echo $result->numero_cobertura?>">
                            </div>

                            <?php
                            if($result->id_persona){
                                ?>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select style="width: 200px;"  class="form-control" id="estado" name="estado">
                                        <option value="">SELECCIONE UN ESTADO</option>
                                        <option <?php echo ($result->cod_estado=='A')?"selected":""; ?> value="A">ALTA</option>
                                        <option <?php echo ($result->cod_estado=='B')?"selected":""; ?>  value="B">BAJA</option>
                                    </select>
                                </div>
                            <?php } ?>
                            <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_persona'); ?>" />
                            <input type="hidden" id="id_persona_dias" name="id_persona_dias" value="<?php echo (isset($result->id_persona_dias))?$result->id_persona_dias:""; ?>" />
                            <input type="hidden" id="id_persona_cobertura" name="id_persona_cobertura" value="<?php echo (isset($result->id_persona_cobertura))?$result->id_persona_cobertura:""; ?>" />
                            <input type="hidden" id="id_persona" id="id_persona"  name="id_persona" value="<?php echo (isset($result->id_persona))?$result->id_persona:""; ?>" />
                            <input type="button"  onclick="guardar_datos()" class="btn btn-primary" value="Guardar Datos" />
                            <button onclick="volver_listado('<?php echo base64_encode('listar_personas'); ?>')" type="reset"  class="btn btn-default">Volver</button>
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
            nombre: {
                required: true
            },
            apellido: {
                required: true
            },
            dni: {
                number: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
    //        });
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("[data-mask]").inputmask();
</script>
<script>
    $(function() {
        autocomleteINI_coberturas('cobertura', 'ajax/suggestCobertura.php');
    });
</script>
<!-- InputMask -->

<!-- ./wrapper -->
<?php include 'footer.php'; ?>
