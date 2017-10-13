<div class="content-wrapper">
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Persona Obito</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- <div class="row"> -->
              <form id="form_datos" action="controlador.php" method="post">
            
                <div class="modal-body">
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label>Apellido</label>
                          <input class="form-control" required  value="<?php echo (isset($result->apellido))?$result->apellido:""; ?>" name="apellido" id="apellido" placeholder="Ingrese Apellido" required />
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
                  <div class="form-group">
                      <label>Domicilio</label>
                      <input class="form-control"  value="<?php echo (isset($result->domicilio))?$result->domicilio:""; ?>" name="domicilio" id="domicilio" placeholder="Ingrese domicilio" required>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Nacionalidad <img src="img/suma.png" onclick="abrir_pop_pais()" alt=""></label>
                      <select id="pais" name="pais" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>
                          <?php 
                          if($paises){
                              foreach ($paises as $t) { ?>
                                 <option <?php echo ($t->id_pais==$result->pais_nacimiento)?"selected":""; ?>  value="<?php echo $t->id_pais; ?>"><?php echo $t->descripcion; ?></option>
                                 <?php 
                              }
                          }?> 
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Ciudad</label>
                      <input class="form-control"  value="<?php echo (isset($result->localidad))?$result->localidad:""; ?>" name="localidad" id="localidad" placeholder="Ingrese ciudad" required>

                  </div>
                  <div class="form-group col-md-6">
                      <label>Estado Civil</label>
                      <input class="form-control"  value="<?php echo (isset($result->estado_civil))?$result->estado_civil:""; ?>" name="estado_civil" id="estado_civil" placeholder="Ingrese estado civil" required>

                  </div>
                  <div class="form-group col-md-6">
                      <label>Religion</label>
                      <input class="form-control"  value="<?php echo (isset($result->religion))?$result->religion:""; ?>" name="religion" id="religion" placeholder="Ingrese religion" required>

                  </div>
                  <div class="form-group">
                      <label>Profesion</label>
                      <input class="form-control"  value="<?php echo (isset($result->ocupacion))?$result->ocupacion:""; ?>" name="ocupacion" id="ocupacion" placeholder="Ingrese profesion" required>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Afiliado a </label>
                      <select id="os" name="os" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>
                          <?php 
                          if($cobertura){
                              foreach ($cobertura as $t) { ?>
                                 <option <?php echo ($t->id_cobertura==$result->cobertura)?"selected":""; ?>  value="<?php echo $t->id_cobertura; ?>"><?php echo $t->descripcion; ?></option>
                                 <?php 
                              }
                          }?>
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label> Beneficiario Nro: </label>
                      <input class="form-control"  value="<?php echo (isset($result->numero_cobertura))?$result->numero_cobertura:""; ?>" name="numero_cobertura" id="numero_cobertura" placeholder="Ingrese numero cobertura" required>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Deceso Ocurrido en:  <img src="img/suma.png" onclick="abrir_pop_lugar()" alt=""></label>
                      <select id="lugar_deceso" name="lugar_deceso" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;" required>
                          <?php 
                          if($lugar_deceso){
                              foreach ($lugar_deceso as $t) { ?>
                                 <option <?php echo ($t->id_lugar_deceso==$result->lugar_deceso)?"selected":""; ?>  value="<?php echo $t->id_lugar_deceso; ?>"><?php echo $t->descripcion; ?></option>
                                 <?php 
                              }
                          }?>
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label>Hora: </label>
                      <input class="form-control"  value="<?php echo (isset($result->hora_deceso))?$result->hora_deceso:""; ?>" name="hora_deceso" id="hora_deceso" placeholder="Ingrese hora " required>
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
                      <input class="form-control"  value="<?php echo (isset($result->peso))?$result->peso:""; ?>" name="peso" id="peso" placeholder="Ingrese peso" required>
                  </div>
                  <div class="form-group col-md-4">
                      <label>Causa: </label>
                      <input class="form-control"  value="<?php echo (isset($result->causa))?$result->causa:""; ?>" name="causa" id="causa" placeholder="Ingrese causa" required>
                  </div>
                </div>
                <input value="guardar_persona_obito" type="hidden" name="action_js" id="action_js">
                <input type="hidden" id="id_persona_obito" name="id_persona_obito" value="<?php echo (isset($result->id_persona_obito))?$result->id_persona_obito:""; ?>" />
            </form>
                <input type="button"  onclick="guardar_datos()" class="btn btn-default" id="boton_guardar" value="Guardar Datos" />
                <button onclick="volver_listado('<?php echo base64_encode('listar_personas_obito'); ?>')" type="reset"  class="btn btn-default">Volver</button>
            
            </div>
        </div>
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
