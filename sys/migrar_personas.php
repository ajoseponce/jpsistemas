<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getpersonasDos();
foreach ($result as $p){
    $persona_dia = $consultas->getpersonasDiaDos($p->id_persona);

    echo "persona: ".$p->nombre." ".$p->apellido." ".$p->dni." --- ".$persona_dia->lunes." --- ".$persona_dia->martes." --- ".$persona_dia->miercoles." --- ".$persona_dia->jueves." --- ".$persona_dia->viernes." </br></br>";
    $id_persona_nueva = $consultas->save_persona_migrada($p);
    $id_persona_dia_nuueva = $consultas->save_dias_personas_dos($id_persona_nueva,$persona_dia);

}
?>