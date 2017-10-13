<div class="modal" id="nueva_solicitante" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border" style="width:800px;">
        <div class="modal-content">
            <form id="form_solicitante" action="controlador.php" method="post">
            <div style="background: #3C8DBC;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Formulario Solicitante</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="form-group col-md-6">
                      <label>Apellido</label>
                      <input class="form-control" required  value="" name="apellido" id="apellido" placeholder="Ingrese Apellido" required />
                  </div>
                  <div class="form-group col-md-6">
                      <label>Nombre</label>
                      <input class="form-control"  value="" name="nombre" id="nombre" placeholder="Ingrese nombre" required />
                    </div>
              </div>
              <div class="form-group col-md-6">
                  <label>DNI</label>
                  <input class="form-control"  value="" name="dni" id="dni" placeholder="Ingrese dni" required>
              </div>

              <div class="form-group col-md-6">
                  <label>F. Nacimiento</label>
                  <div class="input-group">
                      <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                      <input class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" type="text" value=""  required>
                  </div>
              </div>
              <div class="form-group col-md-12" >
                  <label>Domicilio</label>
                  <input class="form-control"  value="" name="domicilio" id="domicilio" placeholder="Ingrese domicilio" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Telefono Domicilio</label>
                  <input class="form-control"  value="" name="tel_casa" id="tel_casa" placeholder="Ingrese tel casa" required>
              </div>
               <div class="form-group col-md-6">
                  <label>Telefono Celular</label>
                  <input class="form-control"  value="" name="tel_celular" id="tel_celular" placeholder="Ingrese tel celular" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Ocupacion</label>
                  <input class="form-control"  value="" name="ocupacion" id="ocupacion" placeholder="Ingrese profesion" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Telefono Laboral</label>
                  <input class="form-control"  value="" name="tel_laboral" id="tel_laboral" placeholder="Ingrese tel laboral" required>
              </div>
             <!--  <div class="form-group col-md-12">
                  <label>Parentezco</label>
                  <input class="form-control"  value="" name="parentesco" id="parentesco" placeholder="Ingrese parentesco" required>
              </div> -->
            </div>
            <input  value="guardar_solicitante" type="hidden" name="action_js" id="action_js">
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_solicitante()" class="btn btn-primary">Guardar Solicitante</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    //        $( "#page1" ).on( "pageinit", function() {
    $('#form_solicitante').validate({
        rules: {
            nombre: {
                minlength: 3,
                maxlength: 35,
                required: true
            },
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
    //        });
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("[data-mask]").inputmask();

</script>
