<div class="content-wrapper">
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Persona Solicitante</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <form id="form_datos" action="controlador.php" method="post">
                    
                    <div class="modal-body">
                      <div class="row">
                          <div class="form-group col-md-6">
                              <label>Apellido</label>
                              <input class="form-control"  required  value="<?php echo (isset($result->apellido))?$result->apellido:""; ?>" name="apellido" id="apellido" placeholder="Ingrese Apellido" required />
                          </div>
                          <div class="form-group col-md-6">
                              <label>Nombre</label>
                              <input class="form-control"  value="<?php echo (isset($result->nombre))?$result->nombre:""; ?>" name="nombre" id="nombre" placeholder="Ingrese nombre" required />
                            </div>
                      </div>
                      <div class="form-group col-md-6">
                          <label>DNI</label>
                          <input class="form-control"  value="<?php echo (isset($result->dni))?$result->dni:""; ?>" name="dni" id="dni" placeholder="Ingrese dni" required>
                      </div>

                      <div class="form-group col-md-6">
                          <label>F. Nacimiento</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                              <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" type="text" value="<?php echo (isset($result->fecha_nacimiento))?$result->fecha_nacimiento:""; ?>"  required>
                          </div>
                      </div>
                      <div class="form-group col-md-12" >
                          <label>Domicilio</label>
                          <input class="form-control"  value="<?php echo (isset($result->domicilio))?$result->domicilio:""; ?>" name="domicilio" id="domicilio" placeholder="Ingrese domicilio" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Telefono Domicilio</label>
                          <input class="form-control"  value="<?php echo (isset($result->tel_casa))?$result->tel_casa:""; ?>" name="tel_casa" id="tel_casa" placeholder="Ingrese tel casa" required>
                      </div>
                       <div class="form-group col-md-6">
                          <label>Telefono Celular</label>
                          <input class="form-control"  value="<?php echo (isset($result->tel_celular))?$result->tel_celular:""; ?>" name="tel_celular" id="tel_celular" placeholder="Ingrese tel celular" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Ocupacion</label>
                          <input class="form-control"  value="<?php echo (isset($result->ocupacion))?$result->ocupacion:""; ?>" name="ocupacion" id="ocupacion" placeholder="Ingrese profesion" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label>Telefono Laboral</label>
                          <input class="form-control"  value="<?php echo (isset($result->tel_laboral))?$result->tel_laboral:""; ?>" name="tel_laboral" id="tel_laboral" placeholder="Ingrese tel laboral" required>
                      </div>
                      <div class="form-group col-md-12">
                          <label>Parentezco</label>
                          <input class="form-control"  value="<?php echo (isset($result->parentesco))?$result->parentesco:""; ?>" name="parentesco" id="parentesco" placeholder="Ingrese parentesco" required>
                      </div>
                    </div>
                    <input  value="guardar_solicitante" type="hidden" name="action_js" id="action_js">
                    <input type="hidden" id="id_solicitante" name="id_solicitante" value="<?php echo (isset($result->id_solicitante))?$result->id_solicitante:""; ?>" />
                    </form>
                    <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_solicitante'); ?>" />
                        
                        <input type="button"  onclick="guardar_datos()" class="btn btn-default" id="boton_guardar" value="Guardar Datos" />
                        <button onclick="volver_listado('<?php echo base64_encode('listar_solicitantes'); ?>')" type="reset"  class="btn btn-default">Volver</button>
                    <!-- <div class="modal-footer">
                        <button type="button" onclick="guardar_solicitante()" class="btn btn-primary">Guardar Solicitante</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div> -->
              </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->

</div>
</section>
<script>
$('#form_datos').validate({
    rules: {
        
      apellido: {
            minlength: 3,
            maxlength: 33,
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
<?php include 'footer.php'; ?>
