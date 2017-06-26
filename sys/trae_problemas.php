<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$problemas = $consultas->getProblemas();
if($problemas){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($problemas as $m){
        echo "<option value='".$m->id_problema."'>".$m->descripcion."</option>" ;
    }
}
?>
