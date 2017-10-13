<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPagosServicios($_REQUEST['id_servicio'],$_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'] );
?>


<table class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        
        <th>Solicitante</th>
        <th>Monto</th>
        <th>Fecha Hora</th>
        <th>Usuario</th>
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
                
                <td><?php echo $v->solicitante; ?></td>
                <td><?php echo $v->monto; ?></td>
                <td><?php echo $v->fecha." ".$v->hora; ?></td>
                <td><?php echo $v->nombre_persona; ?></td>
                <td>
                  <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Comprobante" onclick="imprimir_pago_servicio('<?php echo $v->id_pago_servicio; ?>')" />
                  <img src="img/delete.png"  data-toggle="tooltip" title="Borrar Comprobante" onclick="borrar_pago_servicio('<?php echo $v->id_pago_servicio; ?>')" /> 
                </td>

            </tr>
           
        <?php } ?>
        <tr class="odd gradeX">
            <td>&nbsp;</td>
            <th><?php echo $suma; ?></th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php }else{ ?>
            <tr class="odd gradeX">
                <td colspan="5">No contiene pagos realizados</td>
            </tr>
        <?php } ?>
    
    </tbody>
</table>