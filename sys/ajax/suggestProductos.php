<?php
session_start();
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];
$sql="SELECT id_producto_stock , descripcion, precio, unidad_medida FROM productos_stock WHERE id_dominio='".$_SESSION['dominio']."' AND descripcion LIKE '%".$searchTerm."%' ORDER BY descripcion ASC";
//get matched data from skills table
// echo $sql;

$query = $db->query($sql);
while ($row = $query->fetch_assoc()) {
  switch ($row['unidad_medida']) {
    case "1":
        $unidad="Kg";
    break;
    case "2":
        $unidad="1/2 doc.";
    break;
    case "3":
        $unidad="Unid";
    break;
    case "4":
        $unidad="Doc.";
    break;
  }
    $data[] = array(
        'label' =>$row['descripcion'],
        'precio' =>$row['precio'],
        'unidad' =>$row['unidad_medida'],
        'unidad_div' =>$unidad,
        'id' =>$row['id_producto_stock']
    );

}

//return json data
echo json_encode($data);
?>
