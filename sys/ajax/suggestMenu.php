<?php
include('../../lib/DB_Conectar.php');
//include('classes/consultas.php');
//get search term
$searchTerm = $_GET['term'];
$query = $db->query("SELECT id_menu , descripcion FROM menu WHERE descripcion LIKE '%".$searchTerm."%' ORDER BY descripcion ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'label' =>$row['descripcion'],
        'id' =>$row['id_menu']
    );

}
echo json_encode($data);
?>
