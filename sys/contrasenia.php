<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Ingrese Contraseña actual:</label>
                        <input type="password" class="form-control" id="contrasenia_actual">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="contrasenia_nueva1">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label"> Contraseña actual:</label>
                        <input type="password" class="form-control" id="contrasenia_nueva2">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="guardar_cambio_contrasenia()" class="btn btn-primary">Guardar Cambio</button>
            </div>
        </div>
    </div>
</div>