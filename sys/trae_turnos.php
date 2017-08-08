<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
//print_r($_REQUEST);
// $result = $consultas->getTurnos($_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'],$_REQUEST['periodo']);
$result= $consultas->getTurnos($id_persona,$_REQUEST['fecha_desde'],$_REQUEST['fecha_hasta'],$_REQUEST['apellido_filtro'],$_REQUEST['nombre_filtro'],$_REQUEST['dni_filtro'],$_REQUEST['motivo_filtro']);
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
          $disabled_cp="";
          if($v->fecha!=date('d/m/Y')){
            $disabled_='style="display:none;"';
            $disabled_cp='style="display:none;"';
            $disabled_cll='style="display:none;"';
          }else{
            $disabled_="";
            $disabled_cp="";
            $disabled_cll="";
          }
          if($v->estado=='Cancelado'){
            $color_linea='style="background:#f2a4a4;"';
          }else{
            $color_linea='';
          }
          switch ($v->estado) {
            case "Asignado":
                $disabled_='style="display:none;"';
            break;
            case "Cancelado":
                ///$estado='Cancelado';
                  $disabled_cp='style="display:none;"';
                  $disabled_cancelar="style=display:none;";
            break;
            case "Llamando":
                ///$estado='Cancelado';
                  $disabled_cp='style="display:none;"';
            break;
            case "Atendido":

                  $disabled_cp="style=display:none;";
                  $disabled_cancelar="style=display:none;";
            break;
          }
             ?>
            <tr class="odd gradeX" <?php echo $color_linea; ?> >
              <td>
              <?php if($v->estado=='Presente'){ ?>
                  <img  data-toggle="tooltip" <?php echo $disabled_cp; ?> title="Cancelar Presente!" src="img/cancela_presente.png" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','cancela_presente')"/>


              <?php }else{ ?>
                  <img src="img/presente.png"  data-toggle="tooltip" title="Dar Presente!" <?php echo $disabled_cp; ?> onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
              <?php } ?>
              <img src="img/printer.png"  data-toggle="tooltip" title="Imprimir Comprobante" onclick="imprimir_bono('<?php echo $v->id_turno; ?>')" />
              </td>

                <td><?php echo $v->fecha; ?></td>
                <td><?php echo $v->cliente; ?></td>
                <td><?php echo $v->motivo; ?></td>
                <td><?php echo $v->observaciones; ?></td>
                <td><?php echo $v->estado; ?></td>
                <td>
                  <?php if($v->estado=='Presente'){ ?>
                      <img src="img/llamando.png"  data-toggle="tooltip" <?php echo $disabled_cll; ?> title="LLamar Paciente!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                  <?php }
                      if($v->estado=='Llamando'){ ?>
                      <img src="img/cancelar_llamada.png"  data-toggle="tooltip"  <?php echo $disabled_cll; ?> title="Cancelar LLamado!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','cancelar_llamada')"/>
                  <?php }
                      if($v->estado=='Llamando'){ ?>
                      <img src="img/atendio.png"  data-toggle="tooltip" <?php echo $disabled_cll; ?> title="Atender Paciente!" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','<?php echo $v->estado; ?>')"/>
                    <?php }
                  ?>

                  <img src="img/cancela_turno.png" <?php echo $disabled_cancelar; ?>   data-toggle="tooltip" title="Cancelar Turno !" onclick="edita_estado_turno('<?php echo $v->id_turno; ?>','Cancelado')" />
                </td>
            </tr>
        <?php }} ?>
    </tbody>
</table>
