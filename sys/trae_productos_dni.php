<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result_cloen = $consultas->getProductosByClientesDNI($_REQUEST['dni_cliente'], $_REQUEST['dominio']);
?>
    <option value="" >SELECCIONE UN PRODUCTO</option>
<?php
$k=0;
if($result_cloen){
    foreach ($result_cloen as $m) { ?>
        <option selected value="<?php echo $m->id_producto; ?>" ><?php echo $m->producto; ?></option>
    <?php }
}
?>
