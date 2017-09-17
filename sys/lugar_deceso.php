<div class="modal" id="form_lugar_deceso" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="form_datos_turnos">
            <div style="background: orange;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cargar Nuevo lugar deceso</h4>

            </div>
            <div class="modal-body">

                <div class="form-group" id="descripcionDiv">
                    <label>Descripcion</label>
                    <input type="text" name="descripcion_lugar" id="descripcion_lugar" value="">
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_lugar()" class="btn btn-primary">Guardar Lugar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
