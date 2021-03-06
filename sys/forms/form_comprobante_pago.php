<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Comprobante
            <small>Carga</small>
        </h1>

    </section>
<?php
//echo "<pre>";
print_r($_POST);
echo "<br>";
foreach ($_POST['producto_reserva'] as $key => $value) {
  # code...['producto']
  echo "producto ".$value." precio ".$_POST['precio_reserva'][$key]. "<br>";
}
//exit;
?>
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

                              <?php }else{ ?>
                                <div class="ui-widget">
                                    <label>Cliente: </label>
                                    <input class="form-control" id="suggest_clientes"  value="">
                                    <input type="hidden" id="clientes" name="clientes" value="">
                                </div>
                              <?php } ?>
                              <br>
                              <div  class="ui-widget">
                                  <label>Buscador de productos</label>
                                  <input class="form-control" id="suggest_productos" value=""/>
                                  <input type="hidden" id="productos" name="productos" value=""/>
                              </div>
                              <div class="box-body">
                                <table id="prestaciones_comprobante" class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                    <th>Prestaciones</th>
                                    <th>Cantidad</th>
                                    <th>Unid/Medida</th>
                                    <th>Precio</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>

                                  </thead>
                                </table>


                              </div>

                              <div  class="ui-widget" >
                                  <label>Monto a pagar</label>
                                  <input class="form-control"  value="" name="precio_pagar" id="precio" placeholder="Ingrese precio">
                              </div>
                              <div  class="ui-widget" >

                                  <label>Fecha de Retiro:</label>
                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" value="<?php echo date('d-m-Y'); ?>"  value="" id="fecha_retiro"  class="form-control pull-right " name="fecha_retiro" type="text">

                                      <label id="contador_turnos"></label>
                                  </div>

                              </div>
                              <div class="bootstrap-timepicker">
                                  <div  class="ui-widget" >
                                      <label>Hora:</label>
                                      <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                          <input type="text" id="hora" name="hora" class="form-control timepicker">


                                      </div>
                                  </div>
                              </div>
                              <div  class="ui-widget" >
                                  <label>Nota</label>
                                  <textarea class="form-control"  value="" name="nota" id="nota" placeholder="Ingrese nota"></textarea>
                              </div>
                              <div  class="ui-widget">
                                  <BR>
                                  <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_pedido'); ?>" id="action" />
                                  <input type="button"  onclick="guardar_datos()" id="graba" class="btn btn-default" value="Grabar Pedido" />
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
        autocomleteINI_datos('clientes', 'ajax/suggestClientes.php');
        autocomleteINI_prod_negocio('productos', 'ajax/suggestProductos.php');

        $('body').on('click', '.btn-borrar-fila', function (){
          $(this).closest("tr").remove();
        });
    });
    $("#fecha_retiro").datepicker({
        dateFormat: 'dd-mm-yy',
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        onSelect:  function(dateText) {
            trae_pagos();
        },
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
    });


    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false,
    });
    $("#form_datos").validate({
        rules: {
            fecha: {
                required: true
            },
            hora: {
                required: true
            },
            motivo: {
                required: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
</script>

<?php include 'footer.php'; ?>
