<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 
    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Carga de Pago de Servicio</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal">
                        <div class="col-md-6">
                        
                        <div class="ui-widget">
                            <label>Solicitante: </label>
                            <select id="solicitante" name="solicitante" class="form-control" >
                                <option value="<?php echo $result->id_solicitante; ?>"><?php echo $solicitante->apellido.' '.$solicitante->nombre; ?></option>
                                <option value="<?php echo $result->id_garante; ?>"><?php echo $garante->apellido.' '.$garante->nombre; ?></option>
                            </select>
                            
                        </div>
                        

                        <div  class="ui-widget" >
                            <label>Monto a pagar</label>
                            <input class="form-control"  value="" name="monto" id="precio"  placeholder="Ingrese precio" required>
                        </div><br>
                        <div  class="ui-widget" >
                            <label style="color: red;">El saldo  pagar aun es de <?php echo $result->saldo; ?></label>
                        </div><br>
                        <div  class="ui-widget" >
                            <label>Nota</label>
                            <textarea class="form-control"  value="" name="nota" id="nota" placeholder="Ingrese nota"></textarea>
                        </div><br>
                        <div  class="ui-widget">
                            <BR>
                            <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_pago_servicio'); ?>" id="action" />
                            <input type="hidden"  name="id_servicio" value="<?php echo $result->id_servicio?>" id="id_servicio" />
                            <input type="hidden"  name="saldo" value="<?php echo $result->saldo?>" id="saldo" />
                            <!-- <?php echo $result->saldo; ?> -->
                            <input type="submit"  class="btn btn" value="Grabar Pago Servicio" />
                            <button onclick="volver_listado('<?php echo base64_encode('listar_servicios'); ?>')" type="reset"  class="btn btn-default">Volver</button>
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
<script>
    //        $( "#page1" ).on( "pageinit", function() {
    $('#form_datos').validate({
        rules: {
            monto: {
                min: 0,
                max: <?php echo $result->saldo; ?>,
                required: true
            }
          
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        }
    });
   

</script>


<!-- /.row -->

</section>
<!-- /.content -->
</div>

<?php include 'footer.php'; ?>