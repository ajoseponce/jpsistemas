<?php
session_start();
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];
$sql="SELECT id_persona , CONCAT_WS(' ',apellido, nombre) nombre FROM personas WHERE id_dominio='".$_SESSION['dominio']."' AND CONCAT_WS(' ',apellido, nombre) LIKE '%".$searchTerm."%' ORDER BY nombre ASC";
//get matched data from skills table
$query = $db->query($sql);
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['nombre'],
        'id' =>$row['id_persona']
    );

}

//return json data
echo json_encode($data);
?>