<div class="content-wrapper">
    <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">

                        <div class="table-container" id="tabla_listado">

                            <?php if($result){
                                foreach ($result as $v) {

                                     ?>


                                    <div class="callout callout-info">
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
</div>
    <!-- /.row -->

    <!-- /.row -->
<script>
setTimeout(turnera(), 5000);
</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
