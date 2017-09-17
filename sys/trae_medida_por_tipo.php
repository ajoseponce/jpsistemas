<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$medidas = $consultas->getMedidasAtaudPorTipo($_REQUEST['id_tipo']);
if($medidas){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($medidas as $m){
        echo "<option value='".$m->medida."'>".$m->medida."</option>" ;
    }
}else{
	echo "<option value=''>No contiene en stock</option>" ;
}
?>