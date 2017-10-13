<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getSolicitantes($_REQUEST['apellidofiltro'],$_REQUEST['nombrefiltro'],$_REQUEST['dnifiltro']);
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr>
        <!-- <th>&nbsp;</th> -->
        <th>Apellido</th>
        <th>Nombres</th>
        <th>Tel Cel</th>
        <th>DNI</th>
        <th>Fecha Nac.</th>
        <th>Estado</th>
        <th>&nbsp;</th>
    </tr>
    </thead>

    <tbody>
    <?php
    if($result){
        foreach ($result as $v) { ?>
            <tr class="odd gradeX">

                <td><?php echo $v->apellido; ?></td>
                <td><?php echo $v->nombre; ?></td>
                <td><?php echo $v->tel_celular; ?></td>
                <td><?php echo $v->dni; ?></td>
                <td><?php echo $v->fecha_nacimiento; ?></td>
                <td><?php echo ($v->cod_estado=='A')?"Alta":"Baja"; ?></td>
                <td>
                    <a href="controlador.php?action=<?php echo base64_encode('edita_solicitante'); ?>&id_solicitante=<?php echo $v->id_solicitante; ?>"><img src="img/edit.png"/></a>
                    <!-- <img  onclick="eiminaClientesolicitante('<?php echo (int)$v->id_persona ?>')" style="cursor: pointer;" src="img/delete.png"/> -->
                </td>
            </tr>
        <?php }} ?>
    </tbody>
</table>