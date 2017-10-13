<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getServicios($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'],$_REQUEST['obito']);
?>
<table class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        <!-- <th></th> -->
        
        <th>Fecha </th>
        <th>Obito</th>
        <th>Solicitante</th>
        <th>Garante</th>
        <th>Usiario</th>

    </tr>
    </thead>

    <tbody>
    <?php if($result){
        $cant=0;
        foreach ($result as $v) {
            
            ?>
            <tr class="odd gradeX">

                <td><?php echo $v->fecha_servicio; ?></td>
                <td><?php echo $v->obito; ?></td>
                <td><?php echo $v->solicitante; ?></td>
                <td><?php echo $v->garante; ?></td>
                <td><?php echo $v->usuario; ?></td>
               <td>
                <?php if($_SESSION['id']==$v->id_usuario){ ?>
                    <a href="controlador.php?action=<?php echo base64_encode('edita_servicio'); ?>&id_servicio=<?php echo $v->id_servicio; ?>"><img src="img/edit.png"/></a>
                <?php
                } ?>
                <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Servicio" onclick="imprimir_servicio('<?php echo $v->id_servicio; ?>')" />
                <img src="img/pagos.png"  data-toggle="tooltip" title="ver pagos realizados" onclick="buscar_pagos_servicio('<?php echo $v->id_servicio; ?>')" />
                <?php if($v->saldo>0){ ?>
                <a href="controlador.php?action=<?php echo base64_encode('carga_pago_servicio'); ?>&id_servicio=<?php echo $v->id_servicio; ?>"><img src="img/carga_pago.png"/></a>
               <?php } ?>
               </td>
            </tr>
        <?php }} ?>
    </tbody>
</table>