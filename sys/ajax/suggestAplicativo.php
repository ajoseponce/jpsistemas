<?php
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT id_aplicativo , nombre_menu FROM aplicativos WHERE nombre_menu LIKE '%".$searchTerm."%' ORDER BY nombre_menu ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['nombre_menu'],
        'id' =>$row['id_aplicativo']
    );

}

//return json data
echo json_encode($data);
?>