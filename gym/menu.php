<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $_SESSION['nombre_dominio']; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['nombre']; ?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="location.href='controlador.php?action=logout'"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="controlador.php?action=listar_personas"><i class="fa fa-table fa-fw"></i> Lista de clientes</a>
                        </li>
                        <li>
                            <a href="controlador.php?action=carga_personas"><i class="fa fa-edit fa-fw"></i> Carga de Nuevo Clientes</a>
                        </li>
                        <li>
                            <a href="controlador.php?action=listar_productos"><i class="fa fa-table fa-fw"></i> Lista de actividades</a>
                        </li>
                        <li>
                            <a href="controlador.php?action=carga_productos"><i class="fa fa-edit fa-fw"></i> Carga de actividades</a>
                        </li>
                        <li>
                            <a href="controlador.php?action=lista_relaciones"><i class="fa fa-edit fa-fw"></i>Relaciones Clientes/Actividades</a>
                        </li>
<!--                        <li>-->
<!--                            <a href="controlador.php?action=carga_relacion"><i class="fa fa-edit fa-fw"></i> Relacion Clientes/Productos</a>-->
<!--                        </li>-->
                        <li>
                            <a href="controlador.php?action=cargar_pago"><i class="fa fa-edit fa-fw"></i>Cargar Pago</a>
                        </li>
                        <li>
                            <a href="controlador.php?action=listar_pagos"><i class="fa fa-edit fa-fw"></i>Listado de Pagos</a>
                        </li>
                        <li>
                            <a href="clientes.php"><i class="fa fa-edit fa-fw"></i>Clientes</a>
                        </li>
                    </ul>
                </div>
                            <!-- /.sidebar-collapse -->
            </div>
            </nav>

        
        <!-- /#page-wrapper -->

    </div>

