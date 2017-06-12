<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result_persona = $consultas->getPersonasbyid($_REQUEST['idpersona']);
if($result_persona){
    echo $result_persona->apellido." ".$result_persona->nombre;
    echo "<input value='".$_REQUEST['idpersona']."' name='id_persona' id='id_persona' type='hidden' />" ;
}
?>
