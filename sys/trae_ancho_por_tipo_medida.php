<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$medidas = $consultas->getAnchoAtaudPorTipo($_REQUEST['id_tipo'],$_REQUEST['medida']);
if($medidas){
    echo "<option value=''>Seleccionar una opcion</option>" ;
    foreach ($medidas as $m){
        echo "<option value='".$m->ancho."'>".$m->ancho."</option>" ;
    }
}else{
	echo "<option value=''>No contiene en stock</option>" ;
}
?>