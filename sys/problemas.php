<div class="modal" id="problemas" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="form_datos_turnos">
            <div style="background: #009688;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cargar Nuevo Diagnostico</h4>

            </div>
            <div class="modal-body">

                <div class="form-group" id="descripcionDiv">
                    <label>Descripcion</label>
                    <input type="text" name="descripcion_problema" id="descripcion_problema" value="">
                </div>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Tipo Diagnostico</label>
                  </br>
                  <input value='PA' type="radio" class="minimal" name="tipo_diagnostico" id="tipo_diagnostico" checked> Activo
                  </br>
                  <input value='CB' type="radio" name="tipo_diagnostico" id="tipo_diagnostico" class="minimal">Comorbilidades
                </label>

              </div>

            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_problema()" class="btn btn-primary">Guardar Problema</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
