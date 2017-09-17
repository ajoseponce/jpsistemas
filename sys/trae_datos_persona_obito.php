<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPersonaObitaByid($_REQUEST['id_persona_obito']);

if($result){
    ?>
    <div class="row">
        <div class="form-group col-md-6">
            <label>Apellido</label>
            <?php echo $result->apellido; ?>
        </div>
        <div class="form-group col-md-6">
            <label>Nombre</label>
            <?php echo $result->nombre; ?>
          </div>
    </div>
    <div class="form-group col-md-6">
        <label>DNI</label>
        <?php echo $result->dni ?>
    </div>

    <div class="form-group col-md-6">
        <label>F. Nacimiento</label>
        <?php echo $result->fecha_nacimiento; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Domicilio</label>
        <?php echo $result->domicilio; ?>
    </div>
     <div class="form-group col-md-6">
        <label>Ciudad</label>
      <?php echo $result->localidad; ?>

    </div>
    <div class="form-group col-md-6">
        <label>Nacionalidad</label>
        <?php echo $result->pais_nombre; ?>
    </div>
   
    <div class="form-group col-md-6">
        <label>Estado Civil</label>
        <?php echo $result->estado_civil; ?>

    </div>
    <div class="form-group col-md-6">
        <label>Religion</label>
        <?php echo $result->religion; ?>

    </div>
    <div class="form-group col-md-6">
        <label>Profesion</label>
        <?php echo $result->ocupacion; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Afiliado a </label>
        <?php echo $result->cobertura_nombre; ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label> Beneficiario Nro: </label>
        <?php echo $result->numero_cobertura; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Deceso Ocurrido en: </label>
        <?php echo $result->lugar_deceso_nombre; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Hora: </label>
        <?php echo $result->hora_deceso; ?>
    </div>
    <div class="form-group col-md-4">
        <label>Talla</label>
        <?php echo $result->talla; ?>
    </div>
    <div class="form-group col-md-4">
        <label>Peso Kg(Aprox): </label>
        <?php echo $result->peso; ?>
    </div>
    <div class="form-group col-md-4">
        <label>Causa: </label>
        <?php echo $result->causa; ?>
    </div>
  </div>

    <?php
}
?>
