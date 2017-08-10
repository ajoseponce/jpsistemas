<!DOCTYPE html>
<html lang="en">

<body>
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
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alta de Clientes
                </div>
                <?php if($mensaje){ ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $mensaje ;?><a href="#" class="alert-link"></a>.
                </div>
                <?php } ?>
                <div class="panel-body">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Actividades del Cliente
                </div>
                <div class="panel-body">


                            <div class="dataTable_wrapper">
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



                        <input type="hidden"  name="action" value="guardar_persona" />
                    <input type="hidden" id="id_persona_dias" name="id_persona_dias" value="<?php echo (isset($result->id_persona_dias))?$result->id_persona_dias:""; ?>" />
                        <input type="hidden" id="id_persona" id="id_persona"  name="id_persona" value="<?php echo (isset($result->id_persona))?$result->id_persona:""; ?>" />
                        <input type="button"  onclick="guardar_datos()" class="btn btn-default" value="Guardar Datos" />
                        <button onclick="volver_listado()" type="reset"  class="btn btn-default">Volver</button>

                </div>
            </div>
            </form>
    </div>
</div>
<script>

</script>
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
                    },
                    mail: {
                        email: true
                    }
                },
                errorPlacement: function( error, element ) {
                    error.insertAfter( element.parent() );
                }
            });
//        });
    </script>
<?php include 'footer.php'; ?>