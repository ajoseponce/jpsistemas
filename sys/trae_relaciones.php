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
        foreach ($result as $v) { ?>
            <tr class="odd gradeX">
                <td><?php echo $v->persona; ?></td>
                <td><?php echo $v->producto; ?></td>
<!--                        <td><a href="controlador.php?action=edita_relacion&id_relacion=--><?php //echo $v->id_relacion; ?><!--"><img src="img/edit.png"/></a></td>-->
            </tr>
        <?php }} ?>
    </tbody>

  </table>
