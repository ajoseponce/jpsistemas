<!DOCTYPE html>
<html lang="en">

<body>

<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alta productos
                </div>
                <div class="panel-body">
                    <form action="controlador.php" id="form_datos" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input class="form-control"  value="<?php echo (isset($result->descripcion))?$result->descripcion:""; ?>" name="descripcion" id="descripcion" placeholder="Ingrese descripcion">

                        </div>
                        <label>Precio</label>
                        <div class="form-group input-group">
                            <input class="form-control" style="width: 60px;" maxlength="4" value="<?php echo (isset($result->precio))?$result->precio:""; ?>" name="precio" id="precio" placeholder="Ingrese precio">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Ingreso 10 < 15</label>
                        <div class="form-group input-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso10_15))?$result->ingreso10_15:""; ?>" name="ingreso10_15" id="ingreso10_15" placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Ingreso 15 < 20</label>
                        <div class="form-group input-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso15_20))?$result->ingreso15_20:""; ?>" name="ingreso15_20" id="ingreso15_20" placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Ingreso 20 < 25</label>
                        <div class="form-group input-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso20_25))?$result->ingreso20_25:""; ?>" name="ingreso20_25" id="ingreso20_25" placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Ingreso 25 < 30</label>
                        <div class="form-group input-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->ingreso25_30))?$result->ingreso25_30:""; ?>" name="ingreso25_30" id="ingreso25_30" placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Incremento Dia de Atraso</label>
                        <div class="form-group input-group">
                            <input class="form-control"  style="width: 50px;" maxlength="3" value="<?php echo (isset($result->incremento_dia))?$result->incremento_dia:""; ?>" name="incremento_dia" id="incremento_dia" placeholder="">
                            <span class="input-group-addon">%</span>
                        </div>
                        <label>Dias de Actividad</label>
                        <div class="form-group input-group">

                            <label class="checkbox-inline">
                                <input id="lunes" name="lunes" value="S" type="checkbox" <?php echo ($result->lunes=="S")?"checked":""; ?>>
                                Lunes
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="martes" value="S"  name="martes" <?php echo ($result->martes=="S")?"checked":""; ?>>
                                Martes
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="miercoles" value="S"  name="miercoles" <?php echo ($result->miercoles=="S")?"checked":""; ?>>
                                Miercoles
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="jueves" value="S"  name="jueves" <?php echo ($result->jueves=="S")?"checked":""; ?>>
                                Jueves
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" id="viernes" value="S"  name="viernes" <?php echo ($result->viernes=="S")?"checked":""; ?>>
                                Viernes
                            </label>
                        </div>

                        <?php
                        if($result->id_producto){
                            ?>
                            <div class="form-group">
                                <label>Estado</label>
                                <select style="width: 200px;"  class="form-control" id="estado" name="estado">
                                    <option value="">SELECCIONE UN ESTADO</option>
                                    <option <?php echo ($result->estado=='A')?"selected":""; ?> value="A">ALTA</option>
                                    <option <?php echo ($result->estado=='B')?"selected":""; ?>  value="B">BAJA</option>
                                </select>
                            </div>
                        <?php } ?>
                        <input type="hidden"  name="action" value="guardar_producto" />
                        <input type="hidden" id="id_producto" name="id_producto" value="<?php echo (isset($result->id_producto))?$result->id_producto:""; ?>" />
                        <input type="hidden" id="id_producto_dias" name="id_producto_dias" value="<?php echo (isset($result->id_producto_dias))?$result->id_producto_dias:""; ?>" />
                        <input type="button"  onclick="guardar_producto()" class="btn btn-default" value="Guardar" />
                        <button onclick="volver_listado_productos()" type="reset"  class="btn btn-default">Volver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>