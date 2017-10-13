<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content">
<div class="row">
     <div class="col-md-12">
     <form id="form_datos" action="controlador.php" method="post">
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Persona obitada</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">


                <div class="row">
                  <div class="form-group col-md-12" id="buscador_obito">
                      <label>Persona Obito: </label>
                      <input class="form-control" id="suggest_persona_obito" value="<?php echo $result->persona_obito?>" required>
                      <input type="hidden" id="persona_obito" name="persona_obito" value="<?php echo $result->id_persona_obito?>" required>
                  </div>
                  <div class="ui-widget col-md-12" id='datos_persona_obito'>
                      <?php 
                          if($result->id_persona_obito){
                            ?>
                            <script type="text/javascript"> 
                                $("#datos_persona_obito").load('trae_datos_persona_obito.php?id_persona_obito='+<?php echo $result->id_persona_obito?>);
                                $("#buscador_obito").hide();
                            </script>  
                            <?php
                          }
                      ?>
                  </div>
                </div>
              </div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Caracteristica Servicio</h3>
            </div>
            <div class="box-body">
              <?php
              if($result->entierro=="Cremacion"){
                $required="";
              }else{
                $required="required";
              }
               ?>
                <div class="row" id="box_ataud">
                  <div class="form-group col-md-4">
                     
                      <div class="input-group date">
                            <div class="input-group-addon">
                                Tipo Ataud
                            </div>
                            <select style="width: 200px;" onchange="trae_medidas_ataud(this.value)"  class="form-control" id="tipo_ataud" name="tipo_ataud" <?php echo $required; ?>>
                            <option value="">Seleccionar una opcion</option>
                            <?php if($tipo_ataud){
                                  foreach ($tipo_ataud as $t) { ?>
                                        <option <?php echo ($t->id_tipo_ataud==$ataud->id_tipo)?"selected":""; ?>  value="<?php echo $t->id_tipo_ataud; ?>"><?php echo $t->descripcion; ?></option>
                                   <?php }
                                  }?>   
                            </select>

                      </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="input-group date">
                            <div class="input-group-addon">
                                Medida
                            </div>
                      <!-- <label>medida</label> -->
                            <select style="width: 200px;" onchange="trae_anchos_ataud(this.value)"  class="form-control" id="medida_ataud" name="medida_ataud" <?php echo $required; ?>>
                            <?php if($ataud->medida){ ?>
                              <option value="<?php echo $ataud->medida; ?>"><?php echo $ataud->medida; ?></option>
                            <?php 
                            }else{ ?>
                              <option value="">Seleccionar una opcion</option>
                            <?php } ?>
                            </select>
                      </div>
                  </div>
                  <div class="form-group col-md-4">
                      <div class="input-group date">
                            <div class="input-group-addon">
                                Ancho
                            </div>
                            <select style="width: 200px;" onchange="trae_id_ataud(this.value)"  class="form-control" id="ancho_ataud" name="ancho_ataud" <?php echo $required; ?>>
                            <?php if($ataud->ancho){ ?>
                             <option value="<?php echo $ataud->ancho; ?>"><?php echo $ataud->ancho; ?></option>
                            <?php 
                            }else{ ?>
                            <option value="">Seleccionar una opcion</option>
                             
                            <?php 
                            }  
                            ?>
                            </select>
                      <div id='div_id_ataud'>
                       <?php
                            if($ataud->id_ataud){ ?>
                              <input type="text" id="id_ataud" name="id_ataud" value="<?php echo $ataud->id_ataud; ?>">
                            <?php } ?>
                      </div>
                      </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="form-group col-md-4">
                    <label>Tipo Entierro</label>
                    <select style="width: 200px;" class="form-control"  onchange="Seleccionar_lugar_entierro(this.value)" id="lugar_entierro" name="lugar_entierro" required>
                      <option value="">Seleccionar una opcion</option>
                      <option <?php echo ($result->entierro=='Tierra')?"selected":""; ?>  value="Tierra">Tierra</option>
                      <option <?php echo ($result->entierro=='Nicho')?"selected":""; ?> value="Nicho">Nicho</option>
                      <option <?php echo ($result->entierro=='Cremacion')?"selected":""; ?> value="Cremacion">Cremacion</option>
                    </select>
                  </div>
                  
                  <div class="form-group col-md-4">
                      <label>Velatorio sala</label>
                      <select style="width: 200px;" onchange="selecciona_sala(this.value)"  class="form-control" id="sala" name="sala" required>
                        <option value="">Seleccionar una opcion</option>
                        <option <?php echo ($result->sala=='A')?"selected":""; ?> value="A">A</option>
                        <option <?php echo ($result->sala=='B')?"selected":""; ?> value="B">B</option>
                        <option <?php echo ($result->sala=='Garupa')?"selected":""; ?> value="Garupa">Garupa</option>
                        <option <?php echo ($result->sala=='D')?"selected":""; ?> value="D">Domicilio</option>
                      </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Capilla ardiente</label>
                    <select style="width: 200px;"  class="form-control" id="capilla" name="capilla" required>
                      <option <?php echo ($result->capilla=='-')?"selected":""; ?> value="-">Ninguna</option>
                      <option <?php echo ($result->capilla=='Capilla Vip')?"selected":""; ?> value="Capilla Vip">Capilla Vip</option>
                      <option <?php echo ($result->capilla=='Capilla Economica')?"selected":""; ?> value=Capilla Economica">Capilla Economica</option>
                      <option <?php echo ($result->capilla=='Capilla Estandar')?"selected":""; ?> value=Capilla Estandar">Capilla Estandar</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                      <label>Domicilio</label>
                    <input class="form-control" id="domicilio_velatorio" value="<?php echo $result->domicilio_velatorio?>"  disabled="disabled" />
                  </div>
                  <div class="form-group col-md-12">
                      <label> Preparador<img src="img/suma.png" onclick="abrir_pop_preparador()" alt=""></label>
                      <select style="width: 300px;"  class="form-control" id="preparador" name="preparador">
                        <option value="">Seleccionar una opcion</option>
                            <?php if($preparador){
                                  foreach ($preparador as $t) { ?>
                                        <option <?php echo ($t->id_preparador==$result->preparador)?"selected":""; ?>  value="<?php echo $t->id_preparador; ?>"><?php echo $t->descripcion; ?></option>
                                   <?php }
                                  }?>   
                      </select>
                  </div>
                  <div class="form-group col-md-3">
                      <label>Tipo Preparacion</label>
                      <select style="width: 200px;"  class="form-control" id="tipo_preparacion" name="tipo_preparacion">
                        <option value="">Seleccionar una opcion</option>
                        <option <?php echo ($result->tipo_preparacion=='te')?"selected":""; ?>  value="te">Tanatoestetica</option>
                        <option <?php echo ($result->tipo_preparacion=='tp')?"selected":""; ?>  value="tp">Tanatopraxia</option>
                      </select>
                  </div>
                  <div class="col-md-3">

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" <?php echo ($result->furgon=='S')?"checked":""; ?>  name="furgon" value="S">
                          Furgon Sanitario
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" <?php echo ($result->coche_funebbre=='S')?"checked":""; ?>  name="coche_funebbre" value="S">
                          Coche Funebre
                        </label>
                      </div>


                    </div>
                    <div class="col-md-3">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" <?php echo ($result->coche_porta=='S')?"checked":""; ?>  name="coche_porta" value="S">
                          Coche Porta Corona
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" <?php echo ($result->coche_acompana=='S')?"checked":""; ?>  name="coche_acompana" value="S">
                          Coche de Acompaniamiento
                        </label>
                      </div>
                    </div>
                    <div class="col-md-3">

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" <?php echo ($result->refrigerio=='S')?"checked":""; ?>  name="refrigerio" value="S">
                          Refrigerio
                        </label>
                      </div>
                    </div>
                  </div>

                    <div class="form-group col-md-3">
                        <label>Tipo Servicio</label>
                        <select class="form-control" onchange="Seleccionar_tipo_entierro(this.value)" id="cementerio_cremacion" name="cementerio_cremacion">
                          <option value="">Seleccionar una opcion</option>
                          <option <?php echo ($result->cementerio_cremacion=='CM')?"selected":""; ?>  value="CM">Cementerio</option>
                          <option <?php echo ($result->cementerio_cremacion=='CR')?"selected":""; ?>  value="CR">Cremacion</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Lugar<img src="img/suma.png" onclick="abrir_pop_cementerio()" alt=""></label>
                        <select class="form-control"  id="cementerio" name="cementerio"  required>
                          <?php 
                          if($result->id_persona_obito){
                              if($cementerio){
                                  foreach ($cementerio as $t) { ?>
                                        <option <?php echo ($t->id_lugar_entierro==$result->cementerio)?"selected":""; ?>  value="<?php echo $t->id_lugar_entierro; ?>"><?php echo $t->descripcion; ?></option>
                                   <?php }
                              } 
                          }
                          ?>
                          
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Fecha</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="fecha_inhumacion"  value="<?php echo $result->fecha_inhumacion?>" name="fecha_inhumacion" class="form-control pull-right " type="text" >
                        </div>
                    </div>
                    <div class="bootstrap-timepicker  col-md-3">
                        <div class="form-group">
                            <label>Hora:</label>
                            <div class="input-group">
                                <input type="text" value="<?php echo $result->hora_inhumacion; ?>" id="hora_inhumacion" name="hora_inhumacion" class="form-control timepicker" >

                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Traslado</label>
                        <input type="text" id="traslado" name="traslado" class="form-control" value="<?php echo $result->traslado; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Hasta</label>
                        <input type="text" id="traslado_hasta" name="traslado_hasta" class="form-control" value="<?php echo $result->traslado_hasta; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>KM:</label>
                        <input type="text" id="km" name="km" class="form-control"  value="<?php echo $result->km; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Importe $</label>
                        <input type="text" id="importe"  value="<?php echo $result->importe; ?>" name="importe" class="form-control" onchange="calcula_precio()">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Entrega $</label>
                        <input type="text" id="entrega" value="<?php echo $result->entrega; ?>" name="entrega" class="form-control"  onchange="calcula_precio()">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Saldo $</label>
                        <input type="text" id="saldo" name="saldo"  value="<?php echo $result->saldo; ?>" class="form-control" onchange="calcula_precio()">
                    </div>

                    <div class="form-group col-md-12">
                        <label>Forma de Pago Saldo Deudor</label>
                        <input type="text" id="forma_pago" name="forma_pago"  value="<?php echo $result->forma_pago; ?>" class="form-control">
                    </div>
                </div>
              </div>
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title"> DATOS DEL SOLICITANTE</h3>
                    </div>
                    <div class="box-body">
                    <div class="row">
                      <div class="form-group col-md-12" id="buscador_solicitante">
                          <label>Buscador de solicitante: </label>
                          <input class="form-control" id="suggest_solicitante" value="" required>
                          <input type="hidden" id="solicitante" name="solicitante" value="<?php echo $result->id_solicitante; ?>" required>
                      </div>
                      <div class="ui-widget col-md-12" id='datos_solicitante'>
                      <?php 
                          if($result->id_solicitante){
                            ?>
                            <script type="text/javascript"> 
                                $("#datos_solicitante").load('trae_datos_solicitante.php?id_solicitante='+<?php echo $result->id_solicitante?>);
                                $("#buscador_solicitante").hide();
                            </script>  
                            <?php
                          }
                      ?>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Parentesco</label>
                        <input type="text" id="parentesco" name="parentesco"  value="<?php echo $result->parentesco; ?>" class="form-control">
                    </div>
                    </div>

            </div>
            
            <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"> DATOS DEL GARANTE</h3>
                  </div>
                  <div class="box-body">
                  <div class="row">
                      <div class="form-group col-md-12" id="buscador_garante">
                          <label>Buscador Garante: </label>
                          <input class="form-control" id="suggest_garante" value="" required>
                          <input type="hidden" id="garante" name="garante" value="<?php echo $result->id_garante; ?>" required>
                      </div>
                      <div class="ui-widget col-md-12" id='datos_garante'>
                      <?php 
                          if($result->id_garante){
                            ?>
                            <script type="text/javascript"> 
                                $("#datos_garante").load('trae_datos_garante.php?id_solicitante='+<?php echo $result->id_garante; ?>);
                                $("#buscador_garante").hide();
                            </script>  
                            <?php
                          }
                      ?>
                      
                      </div>
                    </div>
                </div>
              </div>
              <div class="box-footer">
                <input type="hidden" id="id_cliente" id="id_servicio"  name="id_servicio" value="<?php echo (isset($result->id_servicio))?$result->id_servicio:$_REQUEST['id_servicio']; ?>" />

                <input type="hidden"  name="action" value="<?php echo base64_encode('guardar_servicio'); ?>" id="action" />
                <input type="button"  onclick="guardar_datos()" id="graba" class="btn btn-default" value="Grabar Servicio" />
                <button onclick="volver_listado('<?php echo base64_encode('listar_servicios'); ?>')" type="reset"  class="btn btn-default">Volver</button>
              </div>
            </form>
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
$("#fecha_inhumacion").datepicker({
    dateFormat: 'dd-mm-yy',
    minDate: "D",
    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
    onSelect:  function(dateText) {
        //trae_turnos_fecha();
    },
    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
});
//Timepicker
$(".timepicker").timepicker({
    showInputs: false,
    showMeridian: false,
});
    $(function() {
        autocomleteINI_persona_obito('persona_obito', 'ajax/suggestPersonaObito.php');
        autocomleteINI_solicitante('solicitante', 'ajax/suggestSolicitante.php');
        autocomleteINI_garante('garante', 'ajax/suggestSolicitante.php');
    });

    function selecciona_sala(sala){
      if(sala=='D'){
        $('#domicilio_velatorio').removeAttr("disabled");
      }else{
        $('#domicilio_velatorio').attr('disabled','disabled'); 

      }

    }

    function Seleccionar_tipo_entierro(sala){
      if(sala=='CM'){
        $("#cementerio").load('trae_cementerios.php?tipo=CM');
      }else{
        $("#cementerio").load('trae_cementerios.php?tipo=CR');
      }

    }
    function Seleccionar_lugar_entierro(lugar){
      if(lugar=='Cremacion'){
        //$("#cementerio").load('trae_cementerios.php?tipo=CM');
        $('#tipo_ataud').removeAttr("required");
        $('#medida_ataud').removeAttr("required");
        $('#ancho_ataud').removeAttr("required");
        // $('#box_ataud').hide();

      }else{
        $('#tipo_ataud').attr('required','required'); 
        $('#medida_ataud').attr('required','required'); 
       $('#ancho_ataud').attr('required','required'); 
        // $('#box_ataud').show();
      }

    }
    function calcula_precio(){
     var importe =$('#importe').val(); 
     var entrega =$('#entrega').val(); 
        if(entrega!=''){
          v1=parseFloat(entrega);
          var entrega=v1.toFixed(2);
        }else{
          var entrega=0;
        }
      
        v2=parseFloat(importe);
        importe=v2.toFixed(2);
         
          v3=v2-entrega;
          $("#saldo").val(v3.toFixed(2));

    }

</script>
<?php include 'footer.php'; ?>
