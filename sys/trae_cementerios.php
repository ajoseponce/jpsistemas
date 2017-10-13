<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$lugar_CM_CR = $consultas->getLugar_CM_CR($_REQUEST["tipo"]);
if($lugar_CM_CR){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($lugar_CM_CR as $m){
        echo "<option value='".$m->id_lugar_entierro."'>".$m->descripcion."</option>" ;
    }
}
?>
