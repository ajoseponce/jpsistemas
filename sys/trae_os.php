<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$motivos = $consultas->getCobertura();
if($motivos){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($motivos as $m){
        echo "<option value='".$m->id_cobertura."'>".$m->descripcion."</option>" ;
    }
}
?>
