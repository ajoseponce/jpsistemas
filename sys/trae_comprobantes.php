<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getComprobantes($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta']);
?>
<table class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        <th></th>
        <th>Cliente</th>
        <th>Fecha </th>
        <th>Hora</th>
        <th>Nota</th>
        <th>Usuario</th>
        <th>Estado</th>

    </tr>
    </thead>

    <tbody>
    <?php if($result){
        $cant=0;
        foreach ($result as $v) {
            $suma=$v->monto+$suma;
            $cant++;
            ?>
            <tr class="odd gradeX">

                <td><?php echo $cant; ?></td>
                <td><?php echo $v->cliente; ?></td>
                <td><?php echo $v->fecha; ?></td>
                <td><?php echo $v->hora; ?></td>
                <td><?php echo $v->nota; ?></td>
                <td><?php echo $v->usuario; ?></td>
                <td><?php echo $v->estado; ?></td>

            </tr>
        <?php }} ?>
    <tr class="odd gradeX">
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <th><?php echo $suma; ?></th>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

    </tr>
    </tbody>
</table>
