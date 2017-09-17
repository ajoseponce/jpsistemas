<div class="modal" id="form_paises" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="form_datos_turnos">
            <div style="background: green;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cargar Nuevo Pais</h4>

            </div>
            <div class="modal-body">

                <div class="form-group" id="descripcionDiv">
                    <label>Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="">
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_pais()" class="btn btn-primary">Guardar Pais</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
