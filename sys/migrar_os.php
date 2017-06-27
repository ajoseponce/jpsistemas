<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getOS();
foreach ($result as $p){

  //$id_os= $consultas->save_cobertura($p->denominacion);
  echo "cobertura ".$id_os." descripcion". $p->denominacion. " </br>";
    $planes = $consultas->getPlanOSMigrar($p->id_programa_medico);
    if($planes){
      foreach ($planes as $pl){
        echo "-->idplan ".$pl->id_plan." descripcion". $pl->descripcion. " </br>";
    //    $id_plan_os= $consultas->save_plan_cobertura($pl->descripcion,$id_os);
      }
    }


}
//echo "si bueno mi pivho";
?>
