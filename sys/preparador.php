<div class="modal" id="preparador_form" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="preparador_form">
            <div style="background: red;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Cargar Nuevo Preparador</h4>

            </div>
            <div class="modal-body">

                <div class="form-group" id="decripcion_preparadorDiv">
                    <label>Descripcion</label>
                    <input type="text" name="decripcion_preparador" id="decripcion_preparador" value="">
                </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_preparador()" class="btn btn-primary">Guardar Preparador</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
