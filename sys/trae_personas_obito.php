<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPersonasObito($_REQUEST['apellidofiltro'],$_REQUEST['nombrefiltro'],$_REQUEST['dnifiltro']);
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr>
        <th>Apelido</th>
        <th>Nombres</th>
        <th>DNI</th>
        <th>Fecha Nac.</th>
        <th>&nbsp;</th>
    </tr>
    </thead>

    <tbody>
    <?php if($result){
        foreach ($result as $v) {

            ?>
            <tr class="odd gradeX" style="<?php echo  $color; ?>">

                <td><?php echo $v->apellido; ?></td>
                <td><?php echo $v->nombre; ?></td>
                <td><?php echo $v->dni; ?></td>
                <td><?php echo $v->fecha_nacimiento; ?></td>

                <td><?php echo ($v->cod_estado=='A')?"Alta":"Baja"; ?></td>
                <td>
                    <a href="controlador.php?action=<?php echo base64_encode('edita_persona_obito');?>&id_persona=<?php echo $v->id_persona; ?>"><img src="img/edit.png"/></a>
                    <img  onclick="eiminaClienteObito('<?php echo (int)$v->id_persona ?>')" style="cursor: pointer;" src="img/delete.png"/>
                </td>
            </tr>
        <?php }} ?>
    </tbody>
</table>
