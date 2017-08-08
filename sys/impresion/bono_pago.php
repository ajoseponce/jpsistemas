<!DOCTYPE html>
<html lang="en">
<?php include 'header_print.php';
include('../../lib/DB_Conectar.php');
include('../classes/consultas.php');


$id_pago = $_REQUEST["pago"];
$r= $consultas->getDatosPago($id_pago);

 ?>
<body>
<style>
  .form-group input,
  .form-group span {
    font-size: 12px;
  }

  .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4,
  .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10,
  .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
  .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12,
  .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8,
  .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3,
  .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    padding-left: 5px;
    padding-right: 5px;
  }
</style>
<script src="JsBarcode.all.js"></script>
<script>
  Number.prototype.zeroPadding = function(){
    var ret = "" + this.valueOf();
    return ret.length == 1 ? "0" + ret : ret;
  };
</script>
<script type="text/javascript">
  $(document).ready(function () {
     $('.form-control').attr('readonly', '');
    $('.form-control').css('background-color', '#FFF');
  });
</script>
  <div class="page">
      <div class="sub-page">
          <div class="header">
            <div class="row">
              <div class="form-group col-xs-6">
                <h3>Comprobante de Pago</h3>
              </div>
              <div class="col-xs-6"><img class="logo-header logo" src="../img/logos/dominio_<?php echo $_SESSION['dominio']; ?>.jpg" alt="logo" style="max-height: 65px;"></div>
            </div>
          </div><!-- /div.header -->
          <div class="content">
              <div class="box" >

              </div>
              <div class="box">
                <div class="form-group col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon">Nombre y Apellido</span>
                    <input type="text" class="form-control" value="<?php echo  $r->cliente; ?>">
                  </div>
                </div>
              </div>

              <div class="box">
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Documento.</span>
                    <input type="text" class="form-control" value="<?php echo  $r->dni; ?>">
                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Periodo</span>
                    <input type="text" class="form-control" value="<?php echo  $r->periodo; ?>">

                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Actividad</span>
                    <input type="text" class="form-control" value="<?php echo  $r->actividad; ?>">

                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Fecha Pago</span>
                    <input type="text" class="form-control" value="<?php echo  $r->fecha; ?>">

                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Hora Pago</span>
                    <input type="text" class="form-control" value="<?php echo  $r->hora; ?>">

                  </div>
                </div>
                <div class="form-group col-xs-6">
                  <div class="input-group">
                    <span class="input-group-addon">Monto Pago</span>
                    <input type="text" class="form-control" value="<?php echo  $r->monto; ?>">

                  </div>
                </div>
              </div>


              <div class="box">

                <div class="form-group col-xs-12">
                  <div class="input-group">
                    <span class="input-group-addon">Nota</span>
                    <input type="text" class="form-control" value="<?php echo  $r->nota; ?>">

                  </div>
                </div>
              </div>

          </div>
      </div>
  </div>
  <div id="print-box">
    <div class="row">
      <div class="col-xs-12 text-center">
        <span class="btn-group">
          <button  type="button" title="Imprimir" onclick="window.print();"><img src="../img/printer.png" /></button>
          <button type="button" title="Cerrar ventana" onclick="window.close();"><img src="../img/cancel_print.png" /></button>
        </span>
      </div>
    </div>
  </div>
</body>

<script>
//$("#codigo_presente").load("cod_barra.php");
</script>
