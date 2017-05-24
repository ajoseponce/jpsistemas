<div class="modal fade" id="turnera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Asignar turno</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_datos">
                    <h4 id="myLargeModalLabel" class="modal-title">Persona: Lucas <Perie></Perie></h4>
                        <div class="form-group">
                            <label>Motivo Turno</label>
                            <select class="form-control select2" multiple="multiple" data-placeholder="Seleccione una opcion" style="width: 100%;">
                                <option>Control</option>
                                <option>Ruido eje</option>
                                <option>Amortiguadores</option>
                                <option>Faros</option>
                                <option>Carburador</option>

                            </select>
                        </div>
                    <div class="form-group">
                        <label>Dia:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="fecha" name="fecha" class="form-control pull-right" type="text">
                        </div>
                    </div>
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Hora:</label>

                            <div class="input-group">
                                <input type="text" id="hora" name="hora" class="form-control timepicker">

                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Observaciones ..."></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="guardar_turno()" class="btn btn-primary">Dar turno</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".select2").select2();
    //Date picker
    $('#fecha').datepicker({
        autoclose: true
    });
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false
    });
    $("#form_datos").validate({
        rules: {
            fecha: {
                required: true
            },
            hora: {
                required: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
</script>