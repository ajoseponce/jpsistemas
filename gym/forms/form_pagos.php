
<body>
<script>
    $(function() {
        autocomleteINI_productos('clientes', 'ajax/suggestClientes.php');
    });
</script>
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Carga de pagos
                </div>
                <div class="panel-body">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div id="mjs_alert" style="color:red; font-size: 15px;"></div>
                        <div class="ui-widget">
                            <label>Cliente: </label>
                            <input class="form-control" id="suggest_clientes" value="<?php echo $result->cliente?>">
                            <input type="hidden" id="clientes" name="clientes" value="<?php echo $result->id_persona?>">
                        </div>
                        <div  class="ui-widget">
                            <label>Periodo</label>
                            <select style="width: 200px;"  onchange="trae_pago_periodo(this.value)" class="form-control" id="periodo" name="periodo">
                                <option value="">SELECCIONE UN PERIODO</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div  class="ui-widget">
                            <label>Actividad</label>
                            <select style="width: 200px;" onchange="trae_precio(this.value)"  class="form-control" id="id_producto" name="id_producto">
                            </select>
                        </div>

                        <div  class="ui-widget" >
                            <label>Monto a pagar</label>
                            <input class="form-control"  value="" name="precio" id="precio" placeholder="Ingrese precio">
                        </div>
                        <div  class="ui-widget" >
                            <label>Nota</label>
                            <textarea class="form-control"  value="" name="nota" id="nota" placeholder="Ingrese nota"></textarea>
                        </div>
                        <div  class="ui-widget">
                            <BR>
                            <input type="hidden"  name="action" value="guardar_pago" id="action" />
                            <input type="hidden"  name="dias_retraso" value="0" id="dias_retraso" />
                            <input type="hidden"  name="monto_incremento" value="0" id="monto_incremento" />
                            <input type="button"  onclick="guardar_pago()" id="graba" class="btn btn-default" value="Grabar Pago" />
                            <button onclick="volver_listado_pagos()" type="reset"  class="btn btn-default">Volver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>