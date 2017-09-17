<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPersonaSolicitanteByid($_REQUEST['id_solicitante']);

if($result){
    ?>
    <div class="row">
        <div class="form-group col-md-12">
        <img src="img/registro.png" onclick="ver_buscador_solicitante()">
            <label>Apellido</label>
            <?php echo $result->apellido." ".$result->nombre; ?>
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
        <label>Telefono</label>
        <?php echo $result->telefono; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Celular</label>
        <?php echo $result->celular; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Domicilio</label>
        <?php echo $result->domicilio; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Trabajo en</label>
        <?php echo $result->ocupacion; ?>
   </div>
    <div class="form-group col-md-6">
        <label>Tel Laboral</label>
        <?php echo $result->tel_laboral; ?>
    </div>
    <div class="form-group col-md-6">
        <label>Parentezco</label>
        <?php echo $result->parentesco; ?>
    </div>
 

    <?php
}
?>
