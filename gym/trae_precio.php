<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getProductobyid($_REQUEST['id_producto']);
?>

<?php
$k=0;
if($result){
    echo $result->precio;
    ?>

<?php
}
?>