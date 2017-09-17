<div class="modal" id="nueva_persona" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border" style="width:800px;">
        <div class="modal-content">
            <form id="form_obito" action="controlador.php" method="post">
            <div style="background: #3C8DBC;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Formulario Persona</h4>
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
              <div class="form-group">
                  <label>Domicilio</label>
                  <input class="form-control"  value="" name="domicilio" id="domicilio" placeholder="Ingrese domicilio" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Nacionalidad <img src="img/suma.png" onclick="abrir_pop_pais()" alt=""></label>
                  <select id="pais" name="pais" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>

                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label>Ciudad</label>
                  <input class="form-control"  value="" name="localidad" id="localidad" placeholder="Ingrese ciudad" required>

              </div>
              <div class="form-group col-md-6">
                  <label>Estado Civil</label>
                  <input class="form-control"  value="" name="estado_civil" id="estado_civil" placeholder="Ingrese estado civil" required>

              </div>
              <div class="form-group col-md-6">
                  <label>Religion</label>
                  <input class="form-control"  value="" name="religion" id="religion" placeholder="Ingrese religion" required>

              </div>
              <div class="form-group">
                  <label>Profesion</label>
                  <input class="form-control"  value="" name="ocupacion" id="ocupacion" placeholder="Ingrese profesion" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Afiliado a </label>
                  <select id="os" name="os" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>

                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label> Beneficiario Nro: </label>
                  <input class="form-control"  value="" name="numero_cobertura" id="numero_cobertura" placeholder="Ingrese numero cobertura" required>
              </div>
              <div class="form-group col-md-6">
                  <label>Deceso Ocurrido en:  <img src="img/suma.png" onclick="abrir_pop_lugar()" alt=""></label>
                  <select id="lugar_deceso" name="lugar_deceso" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>

                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label>Hora: </label>
                  <input class="form-control"  value="" name="hora_deceso" id="hora_deceso" placeholder="Ingrese hora " required>
              </div>
              <div class="form-group col-md-4">
                  <label>Talla</label>
                  <select id="talla" name="talla" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>
                    <option value="normal">Normal</option>
                    <option value="semi">Semi</option>
                    <option value="extraordinario">Extraordinario</option>
                  </select>
              </div>
              <div class="form-group col-md-4">
                  <label>Peso Kg(Aprox): </label>
                  <input class="form-control"  value="" name="peso" id="peso" placeholder="Ingrese peso" required>
              </div>
              <div class="form-group col-md-4">
                  <label>Causa: </label>
                  <input class="form-control"  value="" name="causa" id="causa" placeholder="Ingrese causa" required>
              </div>
            </div>
            <input value="guardar_persona_obito" type="hidden" name="action_js" id="action_js">
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_obito()" class="btn btn-primary">Guardar Persona</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- <script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script> -->
<script>
    //        $( "#page1" ).on( "pageinit", function() {
    $('#form_obito').validate({
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
