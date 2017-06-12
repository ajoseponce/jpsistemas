<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
//echo $_SESSION;
$result = $consultas->getCountTurnosDia($_REQUEST['fecha_turno']);
$k=0;
if($result){
    echo "El dia seleccionado contiene ".$result." turnos";
}else {
    echo "El dia seleccionado no contiene turnos";
}
?>
