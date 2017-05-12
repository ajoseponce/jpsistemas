<?php
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table
$query = $db->query("SELECT id_usuario , nombre_persona FROM usuarios WHERE nombre_persona LIKE '%".$searchTerm."%' ORDER BY nombre_persona ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['nombre_persona'],
        'id' =>$row['id_usuario']
    );

}

//return json data
echo json_encode($data);
?>