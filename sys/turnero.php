<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
//include 'header.php';
$result= $consultas->getTurnera($_REQUEST['dominio']);
?>

<?php if($result){
    foreach ($result as $v) {  ?>
        <div class="callout callout-info">
          <?php echo strtoupper ($v->cliente); ?>
        </div>
    <?php }} ?>
