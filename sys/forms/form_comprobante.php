<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Comprobante Pago
            <small>Carga</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="col-md-6">
                              <div id="mjs_alert" style="color:red; font-size: 15px;"></div>
                              <?php if ($_REQUEST['id_cliente']){ ?>
                                <div class="ui-widget">
                                    <label>Cliente: </label>
                                    <?php echo $cliente->apellido." ".$cliente->nombre; ?>
                                </div>
                                <div class="ui-widget">
                                    <label>CUIT: </label>
                                    <?php echo $cliente->cuit; ?>
                                </div>
                                <div class="ui-widget">
                                    <label>Cliente: </label>
                                    <?php echo $cliente->razon_social; ?>
                                </div>
                                    <input type="hidden" id="clientes" name="clientes" value="<?php echo $_REQUEST['id_cliente']; ?>">
                              <?php }else{ ?>
                                <div class="ui-widget">
                                    <label>Cliente: </label>
                                    <input class="form-control" id="suggest_clientes"  value="">
                                    <input type="hidden" id="clientes" name="clientes" value="">
                                </div>
                              <?php } ?>
                              <br>
                              <div class="box-body">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                    <th>Buscador</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td><input  name="suggest_prestaciones" id="suggest_prestaciones" class="form-control" style="width:280px; float:left;" value=""/>
                                        <input type="hidden" class="form-control" id="prestaciones" name="prestaciones" value=""/></td>
                                      <td>
                                         <input type="text" class="form-control" readonly id="cantidad"  style="width:80px;" name="cantidad" value="1"/>

                                      </td>
                                      <td>
                                        <input type="text" class="form-control" id="precio_prestaciones"  name="precio_prestaciones" readonly style="width:80px;" value=""/>
                                        <input type="hidden" class="form-control" id="costo_prestaciones"  name="costo_prestaciones" value=""/>
                                      </td>
                                      <td>
                                        <button type="button"  class="btn btn-success "><img src="img/add.png" style="float:left;" onclick="agrega_comprobante()" /></button>
                                        </td>
                                    </tr>
                                  </thead>
                                </table>
                              </div>

                              <div class="box-body">
                                <table id="prestacion_comprobante" class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                    <th>Prestaciones</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  </thead>
                                </table>
                              </div>
                              <div  class="ui-widget" >
                                  <label>Monto a pagar </label>
                                  <input class="form-control" value="0" name="precio_aprox" id="precio_aprox" readonly  style="width:80px;"/>
                              </div>

                              <div  class="ui-widget" >
                                  <label>Nota</label>
                                  <textarea class="form-control"  value="" name="nota" id="nota" placeholder="Ingrese nota"></textarea>
                              </div>
                              <div  class="ui-widget">
                                  <BR>
                                  <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_comprobante'); ?>" id="action" />
                                  <input type="button"  onclick="guardar_datos()" id="graba" class="btn btn-default" value="Grabar Comprobante" />
                                  <button onclick="volver_listado('<?php echo base64_encode('listar_comprobantes'); ?>')" type="reset"  class="btn btn-default">Volver</button>
                              </div>
                        </div>
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
<script>
    $(function() {
        autocomleteINI_datos('clientes', 'ajax/suggClientes.php');
        autocomleteINI_prestacion('prestaciones', 'ajax/suggestPrestaciones.php');

        $('body').on('click', '.btn-borrar-fila', function (){

          $(this).closest("tr").remove();
        });
    });


    $("#form_datos").validate({
        rules: {
            clientes: {
                required: true
            },
            prestacion_reserva: {
                required: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
</script>

<?php include 'footer.php'; ?>
