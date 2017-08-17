<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Informe de Personas por actividad
        </h1>

    </section>

    <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" >
                          <tr>
                              <td>Actividades
                                <select style="width: 200px;"  class="form-control" id="actividad" name="actividad" onchange="trae_relaciones()">
                                        <option value="">SELECCIONE UNA ACTIVIDAD</option>
                                        <?php foreach ($productos as $p) { ?>
                                            <option value="<?php echo $p->id_producto; ?>" ><?php echo $p->descripcion; ?></option>
                                        <?php } ?>
                                    </select>
                              </td>

                          </tr>
                      </table>
                      <div class="table-container" id="tabla_listado">

                      <table id="tabla_listado" class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                          <tr>
                              <th>Cliente</th>
                              <th>Producto</th>
                          </tr>
                          </thead>

                          <tbody>
                          <?php if($result){
                              foreach ($result as $v) {
                                  $cant_pagos = $consultas->getContadorPagosRealizados($v->id_persona,date('m'));
                                 ?>
                                  <tr class="odd gradeX">
                                      <td><?php echo $v->persona; ?></td>
                                      <td><?php echo $v->producto; ?></td>
                                      <td><?php echo ($cant_pagos>0)?"<img src='img/ok_pago.png'/>":""; ?></td>
                                  </tr>
                              <?php }} ?>
                          </tbody>

                        </table>
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


<?php include 'footer.php'; ?>
<!-- /#wrapper -->
