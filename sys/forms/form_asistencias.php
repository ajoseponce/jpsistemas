<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">


            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                <div class="panel-heading" style="background-color: white;">
                    <h3 class="panel-title" style="text-align: center">

                            <img src="img/logos/dominio_<?php echo $_SESSION['dominio']; ?>.jpg"/>

                    </h3>
                </div>
                <div class="panel-body">


                    <fieldset>
                        <div id="mjs"  class="ui-widget">

                        </div>
                        <div id="div_dni" class="ui-widget">
                            <label>Ingrese DNI</label>
                            <input class="form-control" placeholder="Ingrese su DNI" name="dni" id="dni" type="number" autofocus>
                        </div>
                        <div  class="ui-widget" id="div_prod" style="display:none;">
                            <label>Actividad</label>
                            <select style="width: 200px;"  class="form-control" id="id_producto" name="id_producto">
                            </select>
                        </div>
                        <div  class="ui-widget">
                            <input id="boton_sig" name="btnSubmit" onclick="trae_actividades_clientes()"  type="button" class="btn btn-lg btn-orange btn-block" value="Siguiente" />
                        </div>
                        <div  class="ui-widget">
                            <input id="boton_guarda"  name="btnSubmit" onclick="presente_cliente()"  style="display: none;" type="button" class="btn btn-lg btn-orange btn-block" value="Dar Presente" />
                        </div>
                        <div  class="ui-widget" >
                            <input id="refrescar"  name="btnSubmit" onclick="refrescar()"  style="display: none;" type="button" class="btn btn-lg btn-orange btn-block" value="Salir" />
                        </div>

                        <!-- Change this to a button or input when using this as a form -->
                        <!--                            <input name="btnSubmit" type="button" class="btn btn-lg btn-orange btn-block" value="Ingresar" />-->
                    </fieldset>
                    <!-- /.col -->
                    <!-- /.form-group -->
                    </div>
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
<?php include 'footer.php'; ?>
