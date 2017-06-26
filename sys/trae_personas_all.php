<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
$result = $consultas->getPersonas($_REQUEST['apellidofiltro'],$_REQUEST['nombrefiltro'],$_REQUEST['dnifiltro']);
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Apellido</th>
                                <th>Nombres</th>
                                <th>DNI</th>
                                <th>Fecha Nac.</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            if($result){
                                foreach ($result as $v) { ?>
                                    <tr class="odd gradeX">
                                        <td width="85">
                                            <a href="controlador.php?action=<?php echo base64_encode('datos_persona_all');?>&id_persona=<?php echo $v->id_persona; ?>"><img src="img/info_all.png"/></a>
                                            <img data-toggle="modal" onclick="abrir_pop_turnos(<?php echo $v->id_persona; ?>)" style="cursor: pointer;" src="img/turnos.png"/>
                                        </td>
                                        <td><?php echo $v->apellido; ?></td>
                                        <td><?php echo $v->nombre; ?></td>
                                        <td><?php echo $v->dni; ?></td>
                                        <td><?php echo $v->fecha_nacimiento; ?></td>
                                        <td><?php echo ($v->cod_estado=='A')?"Alta":"Baja"; ?></td>
                                        <td>
                                            <a href="controlador.php?action=<?php echo base64_encode('edita_persona'); ?>&id_persona=<?php echo $v->id_persona; ?>"><img src="img/edit.png"/></a>
                                            <img  onclick="eiminaCliente('<?php echo (int)$v->id_persona ?>')" style="cursor: pointer;" src="img/delete.png"/>
                                        </td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>