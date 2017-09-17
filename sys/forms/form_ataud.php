<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ataud
            
        </h1>
        
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Alta</h3>

                
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Ancho Cajon</label>
                            <select style="width: 200px;"  class="form-control" id="tipo_ataud" name="tipo_ataud" onchange="buscar_combinacion_ataud()" required>
                                    <option value="">SELECCIONE UN TIPO CAJON</option>
                                    <?php 
                                    if($tipo){
                                        foreach ($tipo as $t) { ?>
                                            <option  <?php echo ($result->id_tipo==$t->id_tipo_ataud)?"selected":""; ?> value="<?php echo $t->id_tipo_ataud; ?>"><?php echo $t->descripcion; ?></option>
                                        <?php }
                                    }
                                    ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Medida</label>
                            <select style="width: 200px;"  class="form-control" id="medida" name="medida" onchange="buscar_combinacion_ataud()" required>
                                    <option value="">SELECCIONE UN MEDIDA</option>
                                    <option <?php echo ($result->medida==1)?"selected":""; ?> value="1">1</option>
                                    <option <?php echo ($result->medida==2)?"selected":""; ?>  value="2">2</option>
                                    <option <?php echo ($result->medida==3)?"selected":""; ?>  value="3">3</option>
                                    <option <?php echo ($result->medida==4)?"selected":""; ?>  value="4">4</option>
                                    <option <?php echo ($result->medida==5)?"selected":""; ?>  value="5">5</option>
                                    <option <?php echo ($result->medida==6)?"selected":""; ?>  value="6">6</option>
                                    <option <?php echo ($result->medida==7)?"selected":""; ?>  value="7">7</option>
                                    <option <?php echo ($result->medida==8)?"selected":""; ?>  value="8">8</option>
                                    <option <?php echo ($result->medida==9)?"selected":""; ?>  value="9">9</option>
                                    <option <?php echo ($result->medida==10)?"selected":""; ?>  value="10">10</option>
                                    <option <?php echo ($result->medida==11)?"selected":""; ?>  value="11">11</option>
                                    <option <?php echo ($result->medida==12)?"selected":""; ?>  value="12">12</option>
                                    <option <?php echo ($result->medida==13)?"selected":""; ?>  value="13">13</option>
                                    <option <?php echo ($result->medida==14)?"selected":""; ?>  value="14">14</option>
                                    <option <?php echo ($result->medida==15)?"selected":""; ?>  value="15">15</option>
                                    <option <?php echo ($result->medida==16)?"selected":""; ?>  value="16">16</option>
                            </select>

                        </div>
                         <div class="form-group">
                            <label>Ancho</label>
                            <select style="width: 200px;"  class="form-control" id="ancho" name="ancho" onchange="buscar_combinacion_ataud()" required>
                                    <option value="">SELECCIONE UN ANCHO</option>
                                    <option <?php echo ($result->ancho=='Estandar')?"selected":""; ?> value="Estandar">Estandar</option>
                                    <option <?php echo ($result->ancho=='Semi')?"selected":""; ?>  value="Semi">Semi</option>
                                    <option <?php echo ($result->ancho=='superMedida')?"selected":""; ?>  value="superMedida">SuperMedida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cantidad</label>
                            <input class="form-control"  value="<?php echo (isset($result->cantidad))?$result->cantidad:""; ?>" name="cantidad" id="cantidad" placeholder="Ingrese cantidad" required>

                        </div>
                        <?php
                        if($result->id_ataud){
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
                        <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_ataud'); ?>" />
                        <input type="text" id="id_ataud" name="id_ataud" value="<?php echo (isset($result->id_ataud))?$result->id_ataud:""; ?>" />
                        <input type="button"  onclick="guardar_datos()" class="btn btn-default" id="boton_guardar" value="Guardar Datos" />
                        <button onclick="volver_listado('<?php echo base64_encode('listar_ataud'); ?>')" type="reset"  class="btn btn-default">Volver</button>
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
            tipo_ataud: {
                required: true
            },
            medida: {
                required: true
            },
            ancho: {
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
