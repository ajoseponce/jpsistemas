<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$id_ataud = $consultas->getIDAtaudPorCombinacion($_REQUEST['id_tipo'],$_REQUEST['medida'],$_REQUEST['ancho']);
if($id_ataud->cantidad>0){
    ?>
    <input type="hidden" id="id_ataud" name="id_ataud" value="<?php echo $id_ataud->id_ataud; ?>" >
    <?php
}else{
	echo "No lo tiene en stock " ;
	// <input type="text" id="id_ataud" name="id_ataud" value="" required >
}
?>