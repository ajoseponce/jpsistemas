<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$preparadores = $consultas->getPreparador();
if($preparadores){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($preparadores as $m){
        echo "<option value='".$m->id_preparador."'>".$m->descripcion."</option>" ;
    }
}
?>