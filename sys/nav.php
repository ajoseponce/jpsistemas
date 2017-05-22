
<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>JP</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>JP</b>Sistema</span>
    </a>
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="img/logos/dominio_<?php echo $_SESSION['dominio']; ?>.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="img/logos/dominio_<?php echo $_SESSION['dominio']; ?>.jpg" class="img-circle" alt="Imagen Dominio">
                            <p>
                                <?php echo $_SESSION['nombre']; ?>
                                <small>-</small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
<!--                                <button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>-->
                                <a href="#"  data-toggle="modal" data-target="#myModal" class="btn btn-default btn-flat">Contrase&nacute;a</a>
                            </div>
                            <div class="pull-right">
                                <a href="controlador.php?action=logout" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>