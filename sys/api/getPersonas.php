<?php
include('../lib/DB_Conectar.php');
$query = $db->query("SELECT id_persona , CONCAT_WS(' ',apellido,nombre) persona, date_format(fecha_nacimiento, '%d/%m/%Y') fecha_nacimiento FROM personas WHERE 1 ORDER BY persona ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = array(
        'persona' =>$row['persona'],
        'fecha_nacimiento' =>$row['fecha_nacimiento'],
        'id' =>$row['id_persona']
    );

}
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//return json data
echo json_encode($data);
?>
