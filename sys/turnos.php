<div class="modal" id="turnera" style="z-index: 1050;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!--    <div class="modal-dialog" role="document">-->
    <div class="modal-dialog with-border">
        <div class="modal-content">
            <form id="form_datos_turnos">
            <div style="background: #3C8DBC;"  class="modal-header modal-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Asignar turno</h4>

            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Persona: </label>
                        <div id="persona"></div>
                    </div>
                    <div class="form-group" id="motivoDiv">
                        <label>Motivo Turno <img src="img/add.png" onclick="abrir_pop_motivos()" alt=""></label>
                        <select id="motivo" name="motivo" class="form-control" data-placeholder="Seleccione una opcion" style="width: 100%;">
                            
                        </select>
                    </div>
                        <div class="form-group" id="fechaDiv" >
                        <label>Dia:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input id="fecha_turno" name="fecha_turno" class="form-control pull-right " type="text">
                            <input id="tipo_turno" name="tipo_turno" type="hidden" value="PR">
                            <input id="estado" name="estado" type="hidden" value="Asignado">
                            <label id="contador_turnos"></label>
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
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Observaciones ..."></textarea>
                    </div>
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="guardar_turno()" class="btn btn-primary">Dar turno</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".select2").select2();

    $("#fecha_turno").datepicker({
        dateFormat: 'dd-mm-yy',
        minDate: "D",
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        onSelect:  function(dateText) {
            trae_turnos_fecha();
        },
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
    });
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false,
    });
    $("#form_datos").validate({
        rules: {
            fecha: {
                required: true
            },
            hora: {
                required: true
            },
            motivo: {
                required: true
            }
        },
        errorPlacement: function( error, element ) {
            error.insertAfter( element.parent() );
        }
    });
</script>
