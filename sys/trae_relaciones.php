<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getRelaciones($_REQUEST['actividad']);
?>
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
