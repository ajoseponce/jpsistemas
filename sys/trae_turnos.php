<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
// $result = $consultas->getTurnos($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'],$_REQUEST['periodo']);
$result= $consultas->getTurnos($id_persona,$_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta']);
?>

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
    <tr>
        <th>&nbsp;</th>
        <th>Fecha</th>
        <th>cliente</th>
        <th>Motivo</th>
        <th>Observacion</th>
        <th>&nbsp;</th>

    </tr>
    </thead>
    <tbody>
    <?php if($result){
        foreach ($result as $v) {
          if($v->estado=='Cancelado'){
            $color_linea='style="background:#f2a4a4;"';
          }
             ?>
            <tr class="odd gradeX" <?php echo $color_linea; ?> >
              <td>
              <?php if($v->estado=='Presente'){ ?>
                  <img src="img/cancela_presente.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
              <?php }else{ ?>
                  <img src="img/presente.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
              <?php } ?>

              </td>

                <td><?php echo $v->fecha; ?></td>
                <td><?php echo $v->cliente; ?></td>
                <td><?php echo $v->motivo; ?></td>
                <td><?php echo $v->observaciones; ?></td>
                <td><?php echo $v->estado; ?></td>
                <td>
                  <?php if($v->estado=='Presente'){ ?>
                      <img src="img/llamando.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                  <?php }else{ ?>
                      <img src="img/atendio.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                  <?php } ?>
                  <img src="img/cancela_turno.png" onclick="cancelar_turno(<?php echo $v->id_turno; ?>)" />
                </td>
            </tr>
        <?php }} ?>
    </tbody>
</table>
