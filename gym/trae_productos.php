<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result_cloen = $consultas->getProductosByClientes($_REQUEST['id_cliente']);
?>
    <option value="" >SELECCIONE UN PRODUCTO</option>
<?php
$k=0;
if($result_cloen){
    foreach ($result_cloen as $m) { ?>
        <option value="<?php echo $m->id_producto; ?>" ><?php echo $m->producto; ?></option>
    <?php }
}
?>