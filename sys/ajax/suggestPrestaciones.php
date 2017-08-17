<?php
session_start();
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];
$sql="SELECT id_prestacion , descripcion, precio, costo FROM prestaciones WHERE id_dominio='".$_SESSION['dominio']."' AND descripcion LIKE '%".$searchTerm."%' ORDER BY descripcion ASC";
//get matched data from skills table
// echo $sql;

$query = $db->query($sql);
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['descripcion'],
        'precio' =>$row['precio'],
        'costo' =>$row['costo'],
        'id' =>$row['id_prestacion']
    );

}
echo json_encode($data);
?>
