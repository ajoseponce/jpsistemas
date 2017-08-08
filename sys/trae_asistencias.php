<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getAsistencias($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta']);
?>
<table class="table table-striped table-bordered table-hover" >
    <thead>
    <tr>
        <!-- <th></th> -->
        <th>Cliente</th>
        <th>Actividad</th>
        <th>Fecha</th>
        <th>Hora</th>

        <th>&nbsp;</th>
    </tr>
    </thead>

    <tbody>
    <?php if($result){
        $cant=0;
        foreach ($result as $v) {

            $cant++;
            ?>
            <tr class="odd gradeX">

                <!-- <td><?php echo $cant; ?>  <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir " onclick="imprimir_pago('<?php echo $v->id_pago; ?>')" /></td> -->
                <td><?php echo $v->cliente; ?></td>
                <td><?php echo $v->actividad; ?></td>
                <td><?php echo $v->fecha; ?></td>
                <td><?php echo $v->hora; ?></td>

<!--                                        <td><a href="imprimir_comprobante.php?id_comprobante=--><?php //echo $v->id_pago; ?><!--"><img src="./img/printer.png"></a></td>-->
                <td><?php if($_SESSION['rol']=='Admin'){ ?>
                    <img onclick="eliminarPresente(<?php echo $v->id_presente; ?>)" src="./img/delete.png" />
                    <?php } ?>
                </td>
            </tr>
        <?php }} ?>
    <tr class="odd gradeX">

        <th colspan="5">Asistencias total : <?php echo $cant; ?></th>

    </tr>
    </tbody>
</table>
