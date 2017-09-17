<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$motivos = $consultas->getPaises();
if($motivos){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($motivos as $m){
        echo "<option value='".$m->id_pais."'>".$m->descripcion."</option>" ;
    }
}
?>
