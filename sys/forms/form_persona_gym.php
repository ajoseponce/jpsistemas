<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Clientes
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Clientes Gimnasio</a></li>


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
                        </div>

                        <div class="form-group">
                            <label>DNI</label>
                            <input class="form-control"  value="<?php echo (isset($result->dni))?$result->dni:""; ?>" name="dni" id="dni" placeholder="Ingrese dni">
                        </div>
                        <div class="form-group">
                            <label>Fecha Nacimiento</label>
                            <input class="form-control" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo (isset($result->fecha_nacimiento))?$result->fecha_nacimiento:""; ?>" id="fecha_nacimiento"  name="fecha_nacimiento" placeholder="Ingrese Fecha Nacimiento" type="text">
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
                            <label>Nro Socio</label>
                            <input class="form-control"  value="<?php echo (isset($result->nro_socio))?$result->nro_socio:""; ?>" name="nro_socio" id="nro_socio" placeholder="Ingrese nro Socio">
                        </div>
                        <div class="form-group">
                            <label>Dia Venc Cuota</label>
                            <select style="width: 200px;"  class="form-control"  name="dia_venc" name="dia_venc">
                              <option value="" <?php echo ($result->dia_venc=="")?"selected":"" ?>>Seleccione una opcion</option>
                              <option value="1" <?php echo ($result->dia_venc=="1")?"selected":"" ?>>1</option>
                              <option value="2" <?php echo ($result->dia_venc=="2")?"selected":"" ?>>2</option>
                              <option value="3" <?php echo ($result->dia_venc=="3")?"selected":"" ?>>3</option>
                              <option value="4" <?php echo ($result->dia_venc=="4")?"selected":"" ?>>4</option>
                              <option value="5" <?php echo ($result->dia_venc=="5")?"selected":"" ?>>5</option>
                              <option value="6" <?php echo ($result->dia_venc=="6")?"selected":"" ?>>6</option>
                              <option value="7" <?php echo ($result->dia_venc=="7")?"selected":"" ?>>7</option>
                              <option value="8" <?php echo ($result->dia_venc=="8")?"selected":"" ?>>8</option>
                              <option value="9" <?php echo ($result->dia_venc=="9")?"selected":"" ?>>9</option>
                              <option value="10" <?php echo ($result->dia_venc=="10")?"selected":"" ?>>10</option>
                              <option value="11" <?php echo ($result->dia_venc=="11")?"selected":"" ?>>11</option>
                              <option value="12" <?php echo ($result->dia_venc=="12")?"selected":"" ?>>12</option>
                              <option value="13" <?php echo ($result->dia_venc=="13")?"selected":"" ?>>13</option>
                              <option value="14" <?php echo ($result->dia_venc=="14")?"selected":"" ?>>14</option>
                              <option value="15" <?php echo ($result->dia_venc=="15")?"selected":"" ?>>15</option>
                              <option value="16" <?php echo ($result->dia_venc=="16")?"selected":"" ?>>16</option>
                              <option value="17" <?php echo ($result->dia_venc=="17")?"selected":"" ?>>17</option>
                              <option value="18" <?php echo ($result->dia_venc=="18")?"selected":"" ?>>18</option>
                              <option value="19" <?php echo ($result->dia_venc=="19")?"selected":"" ?>>19</option>
                              <option value="20" <?php echo ($result->dia_venc=="20")?"selected":"" ?>>20</option>
                              <option value="21" <?php echo ($result->dia_venc=="21")?"selected":"" ?>>21</option>
                              <option value="22" <?php echo ($result->dia_venc=="22")?"selected":"" ?>>22</option>
                              <option value="23" <?php echo ($result->dia_venc=="23")?"selected":"" ?>>23</option>
                              <option value="24" <?php echo ($result->dia_venc=="24")?"selected":"" ?>>24</option>
                              <option value="25" <?php echo ($result->dia_venc=="25")?"selected":"" ?>>25</option>
                              <option value="26" <?php echo ($result->dia_venc=="26")?"selected":"" ?>>26</option>
                              <option value="27" <?php echo ($result->dia_venc=="27")?"selected":"" ?>>27</option>
                              <option value="28" <?php echo ($result->dia_venc=="28")?"selected":"" ?>>28</option>
                              <option value="29" <?php echo ($result->dia_venc=="29")?"selected":"" ?>>29</option>
                              <option value="30" <?php echo ($result->dia_venc=="30")?"selected":"" ?>>30</option>
                              <option value="31" <?php echo ($result->dia_venc=="31")?"selected":"" ?>>31</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Proviene de: </label>
                            <div>
                                <select style="width: 200px;"  class="form-control"  name="id_proviene" name="id_proviene">
                                    <option value="">Seleccione una opcion</option>
                                    <?php foreach ($proviene as $r) { ?>
                                        <option value="<?php echo $r->id_registro; ?>" <?php echo ($r->id_registro==$result->id_proviene)?"selected":"" ?>><?php echo $r->descripcion; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <label>Dias de Actividad</label>
                        <div class="form-group input-group">

                            <label class="checkbox-inline">
                                <input id="lunes" name="lunes" value="S" type="checkbox" <?php echo ($result->lunes=="S")?"checked":""; ?>>
                                Lunes
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="martes" value="S"  name="martes" <?php echo ($result->martes=="S")?"checked":""; ?>>
                                Martes
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="miercoles" value="S"  name="miercoles" <?php echo ($result->miercoles=="S")?"checked":""; ?>>
                                Miercoles
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="jueves" value="S"  name="jueves" <?php echo ($result->jueves=="S")?"checked":""; ?>>
                                Jueves
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="viernes" value="S"  name="viernes" <?php echo ($result->viernes=="S")?"checked":""; ?>>
                                Viernes
                            </label>
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
                        </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Actividades del Cliente
                </div>
                <div class="panel-body">


                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Fecha Inicio</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if($actividadesCliente){
                                foreach ($actividadesCliente as $v) { ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <div id="div_producto_<?php echo $v->id_relacion; ?>">
                                                <?php echo $v->producto; ?>
                                            </div>
                                            <div id="div_producto_edita_<?php echo $v->id_relacion; ?>"  style="display: none;">
                                                <select style="width: 200px;"  class="form-control" id="id_producto_<?php echo $v->id_relacion; ?>" name="id_producto">
                                                    <option value="">SELECCIONE UNA ACTIVIDAD</option>
                                                    <?php foreach ($productos as $p) { ?>
                                                        <option value="<?php echo $p->id_producto; ?>" <?php echo ($p->id_producto==$v->id_producto)?"selected":"" ?>><?php echo $p->descripcion; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                        </td>
                                        <td>
                                            <div id="div_fecha_<?php echo $v->id_relacion; ?>">
                                                <?php echo $v->fecha_inicio; ?>
                                            </div>
                                            <div id="div_fecha_edita_<?php echo $v->id_relacion; ?>" style="display: none;">
                                                <input style="width: 200px;" class="form-control" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo (isset($v->fecha_inicio))?$v->fecha_inicio:date('d-m-Y'); ?>" id="fecha_inicio_<?php echo $v->id_relacion; ?>"  name="fecha_inicio_<?php echo $v->id_relacion; ?>" placeholder="Ingrese Fecha de inicio a la actividad" type="text">
                                            </div>
                                        </td>
                                        <td>
                                            <div id="div_action_<?php echo $v->id_relacion; ?>">
                                                <img style="cursor:pointer;" src="./img/edit.png" onclick="edita_relacion(<?php echo $v->id_relacion; ?>)">
                                            </div>
                                            <div id="div_action_edita_<?php echo $v->id_relacion; ?>" style="display: none;">
                                                <img style="cursor:pointer;" src="./img/guardar.png" onclick="guardar_edicion_relacion(<?php echo $v->id_relacion; ?>)">
                                            </div>
                                            
                                        </td>

                                    </tr>
                                <?php }} ?>

                            <tr>
                                <th><select style="width: 200px;"  class="form-control" id="id_producto" name="id_producto">
                                        <option value="">SELECCIONE UNA ACTIVIDAD</option>
                                        <?php foreach ($productos as $p) { ?>
                                            <option value="<?php echo $p->id_producto; ?>" ><?php echo $p->descripcion; ?></option>
                                        <?php } ?>
                                    </select></th>
                                <th>
                                    <input style="width: 200px;" class="form-control" onKeyUp = "this.value=formateafecha(this.value);" value="<?php echo (isset($result->fecha_inicio))?$result->fecha_inicio:date('d-m-Y'); ?>" id="fecha_inicio"  name="fecha_inicio" placeholder="Ingrese Fecha de inicio a la actividad" type="text">
                                </th>
                                <th>&nbsp;</th>

                            </tr>
                            </tbody>
                        </table>
                    </div>



                    <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_persona_gym');?>" />
                    <input type="hidden" id="id_persona_dias" name="id_persona_dias" value="<?php echo (isset($result->id_persona_dias))?$result->id_persona_dias:""; ?>" />
                    <input type="hidden" id="id_persona" id="id_persona"  name="id_persona" value="<?php echo (isset($result->id_persona))?$result->id_persona:""; ?>" />
                    <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                    <button onclick="volver_listado('<?php echo base64_encode('listar_personas_gym'); ?>')" type="reset"  class="btn btn-default">Volver</button>

                </div>
            </div>
            </form>
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
<!-- InputMask -->

<!-- ./wrapper -->
<?php include 'footer.php'; ?>
