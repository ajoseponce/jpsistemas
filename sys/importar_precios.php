<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
// echo "hola";
//print_r($_FILES);
//exit;
$uploaddir = "archivos/precio.xls";
$uploadfile = $uploaddir;
//echo $uploaddir;
//    . basename($_FILES['archivo']['name']);
// echo "hola1";
require_once 'classes/PHPExcel.php';
// echo "hola2";
//cargamos el archivo que deseamos leer
$objPHPExcel = PHPExcel_IOFactory::load($uploadfile);
//btenemos los datos de la hoja activa (la primera)
$objHoja = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
//recorremos las filas obtenidas
$c = 0;

foreach ($objHoja as $iIndice => $celda) {
  if($c>0){
    $producto = $celda['A'];
    $unidad = $celda['B'];
    $precio = $celda['H'];
    $output  = str_replace('$', '', $precio);
    $unidad = ucfirst($unidad);
    switch ($unidad) {
      case "Kg":
          $unidad=1;
      break;
      case "1/2 doc.":
          $unidad=2;
      break;
      case "Unid":
          $unidad=3;
      break;
      case "Doc.":
          $unidad=4;
      break;
    }

    //echo "producto ".$producto." unidad".$unidad." precio".$output;
  //  $consultas->save_importar_stock($producto,$unidad,$output);
    //cho "<br>";
  }

//  $id_horario_detalle = $consultas->save_importar_stok($producto,$unidad,$fecha);
    //echo "persona".$id_persona_reloj." fecha".$fecha."<br><br><br>";

    $c++;
}
echo "Registros insertados correctamente".$c ;
//die();
