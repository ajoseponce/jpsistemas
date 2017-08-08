<div class="modal modal-success" id="mensaje">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Correcto!</h4>
            </div>
            <div class="modal-body">
                <p id="mjs"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <input name="id_turno" id="id_turno" value="" type="hidden" />
                <button type="button" class="btn btn-outline pull-left" onclick="imprimir_bono()" style="display:none;" id="boton_impresion" >Imprimir Bono</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
