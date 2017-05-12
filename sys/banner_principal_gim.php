<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $consultas->getcontarpersonas(); ?></h3>

                    <p>Listado de Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="controlador.php?action=carga_personas_gym" class="small-box-footer">Cargar Personas <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $consultas->getcontarproductos(); ?></h3>

                    <p> Actividades</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-gear-outline"></i>
                </div>
                <a href="controlador.php?action=carga_productos" class="small-box-footer">Cargar Actividad <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $consultas->getcontarPagos(); ?></h3>

                    <p>Pagos registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="controlador.php?action=cargar_pago" class="small-box-footer">Cargar Pagos <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
    </div>
    <!-- /.row -->


    <!-- /.col -->

    <!-- /.row -->
</section>