<?php
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT id_persona , CONCAT_WS(' ',apellido, nombre) nombre FROM personas WHERE CONCAT_WS(' ',apellido, nombre) LIKE '%".$searchTerm."%' ORDER BY nombre ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['nombre'],
        'id' =>$row['id_persona']
    );

}

//return json data
echo json_encode($data);
?>