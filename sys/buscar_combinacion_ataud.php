<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getIDAtaudPorCombinacion($_REQUEST['tipo'],$_REQUEST['medida'],$_REQUEST['ancho']);
if($result){
    echo 0;
}else{
	echo 1;
}
?>