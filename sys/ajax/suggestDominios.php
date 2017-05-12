<?php
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT id_dominio , descripcion FROM dominio WHERE descripcion LIKE '%".$searchTerm."%' ORDER BY descripcion ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['descripcion'],
        'id' =>$row['id_dominio']
    );

}

//return json data
echo json_encode($data);
?>