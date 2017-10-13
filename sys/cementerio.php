<div class="modal" id="cementerio_form" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="form_lugar_cementerio" >
            <div style="background: red;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cargar Nuevo Lugar</h4>

            </div>
            <div class="modal-body">
                <div class="form-group">
                        <label>Tipo Servicio</label>
                        <select class="form-control" id="cementerio_cremacion_abm" name="cementerio_cremacion_abm">
                          <option value="CM">Cementerio</option>
                          <option value="CR">Cremacion</option>
                        </select>
                    </div>
                <div class="form-group" id="decripcion_preparadorDiv">
                    <label>Descripcion</label>
                    <input type="text" name="decripcion_cementerio" id="decripcion_cementerio" value="">
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_cementerio()" class="btn btn-primary">Guardar Lugar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
