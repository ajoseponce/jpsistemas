<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
//include 'header.php';
$result= $consultas->getTurnera();
?>

<?php if($result){
    foreach ($result as $v) {  ?>
        <div class="callout callout-info">
          <h4><?php echo $v->cliente; ?></h4>
        </div>
    <?php }} ?>
