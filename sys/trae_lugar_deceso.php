<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$lugar = $consultas->getLugaresDeceso();
if($lugar){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($lugar as $m){
        echo "<option value='".$m->id_lugar_deceso."'>".$m->descripcion."</option>" ;
    }
}
?>
