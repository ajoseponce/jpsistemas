<?php
session_start();
include('../../lib/DB_Conectar.php');
$searchTerm = $_GET['term'];
$sql="SELECT id_garante , CONCAT_WS(' ',apellido, nombre) nombre FROM personas_garante WHERE id_dominio='".$_SESSION['dominio']."' AND CONCAT_WS(' ',apellido, nombre) LIKE '%".$searchTerm."%' ORDER BY nombre ASC";
//get matched data from skills table
//echo $sql;
$query = $db->query($sql);
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['nombre'],
        'id' =>$row['id_garante']
    );

}
echo json_encode($data);
?>
