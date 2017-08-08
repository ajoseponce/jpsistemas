<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPagos($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'],$_REQUEST['periodo']);
?>


<table class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        <th></th>
        <th>Cliente</th>
        <th>Actividad</th>
        <th>Periodo</th>
        <th>Monto</th>
        <th>Fecha de pago</th>
        <th>Recargo&nbsp;</th>
        <th>Dias de Mora</th>
        <th>Nota</th>
        <th></th>
    </tr>
    </thead>

    <tbody>
    <?php if($result){
        $cant=0;
        foreach ($result as $v) {
            $cant++;
            $suma=$v->monto+$suma;
            ?>
            <tr class="odd gradeX">
                <td><?php echo $cant; ?>
                  <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Comprobante" onclick="imprimir_pago('<?php echo $v->id_pago; ?>')" />
                </td>
                <td><?php echo $v->cliente; ?></td>
                <td><?php echo $v->actividad; ?></td>
                <td><?php echo $v->periodo; ?></td>
                <td><?php echo $v->monto; ?></td>
                <td><?php echo $v->fecha_pago; ?></td>
                <td><?php echo $v->dias_retraso; ?></td>
                <td><?php echo $v->monto_incremento; ?></td>
                <td><?php echo $v->nota; ?></td>
                <td><?php if($_SESSION['rol']=='Admin'){ ?>
                        <img onclick="eliminarPago(<?php echo $v->id_pago; ?>)" src="./img/delete.png" />
                    <?php } ?>
                </td>

            </tr>
        <?php }} ?>
    <tr class="odd gradeX">

        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <th><?php echo $suma; ?></th>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>
