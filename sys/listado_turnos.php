<?php
include('lib/DB_Conectar.php');
include('classes/consultas.php');
include 'header_listado.php';
$result= $consultas->getTurnera($_REQUEST['dominio']);
?>
<div class="content" >
  <div class="col-lg-12">
          <div class="panel panel-default"  >
              <!-- /.panel-heading -->
              <div class="panel-body">

                  <div class="dataTable_wrapper" style="font-size:45px; text-align: center;">

                      LISTADO DE TURNOS
                  </div>
                  <!-- /.table-responsive -->

              </div>
              <!-- /.panel-body -->
          </div>
  </div>
  <div class="col-lg-4">
          <div class="panel panel-default"  >
              <!-- /.panel-heading -->
              <div class="panel-body">
                  <div class="dataTable_wrapper">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="img/slice/dentista1.jpg" alt="Chania">
                                <div class="carousel-caption">
                                    <h3>Circulo Odontologico de Misiones</h3>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/slice/dentista2.jpg" alt="Chania">
                                <div class="carousel-caption">
                                    <h3>Circulo Odontologico de Misiones</h3>
                                </div>
                            </div>
                            <div class="item">
                                <img src="img/slice/dentista3.jpg" alt="Chania">
                                <div class="carousel-caption">
                                  <h3>Circulo Odontologico de Misiones</h3>
                                </div>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previo</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                    </div>
                  </div>
                  <!-- /.table-responsive -->
              </div>
              <!-- /.panel-body -->
          </div>
  </div>
    <div class="col-lg-8">
            <div class="panel panel-default"  >
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">

                        <div class="table-container" id="tabla_listado" style="font-size: 58px;">

                            <?php if($result){
                                foreach ($result as $v) {  ?>
                                  <div class="callout callout-info">
                                      <?php echo $v->cliente; ?>
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
       $("#tabla_listado").load("turnero.php?dominio=<?php echo $_REQUEST['dominio']; ?>");
    }, 5000);
});
</script>
<?php include 'footer.php'; ?>
<!-- /#wrapper -->
