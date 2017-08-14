<?php
include('../lib/DB_Conectar.php');
include('classes/consultas.php');
  $problemas= $consultas->getProblemas();
  ?>
<div class="form-group">
    <label>Diagnostico <img src="img/add.png" onclick="abrir_pop_problemas()" alt=""></label>
    <select id="problemas_persona"  name="problemas_persona" class="form-control select2" multiple="multiple"  data-placeholder="Seleccione una opcion" style="width: 100%;">
    <?php
    if($problemas){
        foreach ($problemas as $pp){
          echo "<option value='".$pp->id_problema."'>".$pp->descripcion."</option>" ;
        }
    }  ?>
    </select>
</div>
<div class="form-group">
    <label>Observaciones</label>
    <textarea name="evolucion_texto" id="evolucion_texto" class="form-control" rows="3" placeholder="Evolucion ..."></textarea>
    <input type="hidden" name="action_js" id="action_js" value="guardar_evolucion" />
    <input type="hidden" name="id_persona" id="id_persona" value="<?php echo $_REQUEST['id_persona']; ?>" />

</div>
<button class="btn btn-default"  onclick="guardar_evolucion()" type="button">Guardar Evolucion</button>
