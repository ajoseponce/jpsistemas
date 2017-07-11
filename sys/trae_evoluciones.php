<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$evo_morales = $consultas->getEvoluciones($_REQUEST['id_persona']);
?>
<div class="box-header with-border">
    <h3 class="box-title">Evoluciones del paciente </h3>
</div>
<?php if($evo_morales){
    foreach ($evo_morales as $e){
    $problemas_evolucion=$consultas->getProblemasEvolucion($e->id_evolucion);
    ?>
<div class="box-body">
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $e->id_evolucion; ?>">
                        <?php echo "Usuario: ".$e->nombre_usuario." - Fecha ".$e->fecha_evolucion; ?>
                    </a>
                </h4>
            </div>
            <div id="collapse_<?php echo $e->id_evolucion; ?>" class="panel-collapse collapse in">
              <div class="box-body" class="error">
                <?php foreach ($problemas_evolucion as $pe){
                  echo $pe->descripcion."-" ;
                } ?>
              </div>
              <div class="box-body">
                    <?php echo $e->descripcion; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php }}else{ ?>
    No contiene evoluciones.
<?php } ?>
