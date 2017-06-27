<?php
session_start();
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];
$sql="SELECT c.id_cobertura , c.descripcion FROM cobertura AS c WHERE 1 AND c.descripcion LIKE '%".$searchTerm."%' ORDER BY c.descripcion ASC";
//echo $sql;
//get matched data from skills table
$query = $db->query($sql);
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['descripcion'],
        'id' =>$row['id_cobertura']
    );

}
echo json_encode($data);
?>
