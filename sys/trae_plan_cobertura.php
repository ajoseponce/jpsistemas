<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result_pln = $consultas->getPlanOS($_REQUEST['id_cobertura']);

$k=0;
if($result_pln){
    foreach ($result_pln as $m) { ?>
        <option value="<?php echo $m->id_plan_cobertura; ?>" ><?php echo $m->descripcion; ?></option>
    <?php }
}
?>
