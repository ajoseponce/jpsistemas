<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
include 'header.php';
$result= $consultas->getTurnera();
?>
<div class="content-wrapper">
    <div class="col-lg-12">
            <div class="panel panel-default"  >
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">

                        <div class="table-container" id="tabla_listado" style="font-size: 58px;">

                            <?php if($result){
                                foreach ($result as $v) {  ?>
                                    <div style='font-size:24px;' class="callout callout-info">
                                      <h4><?php echo $v->cliente; ?></h4>
                                    </div>
                                <?php }} ?>

                      </div>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
            </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.panel -->

    <!-- /.row -->

    <!-- /.row -->
<script>
//setTimeout(turnera(), 5000);
$(document).ready(function(){
    setInterval(function(){
    //  $("#tabla_listado").html("");
       $("#tabla_listado").load("turnero.php");
    }, 5000);
});
</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
