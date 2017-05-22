<?php
session_start();

//print_r($_SESSION);
include '../lib/DB_Conectar.php';
include 'classes/consultas.php';
include 'header.php'; ?>


    <!-- Header Navbar: style can be found in header.less -->
    <?php include "nav.php"; ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php include 'menu.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mis Opciones
                <small>Principales</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Princcipal</li>
            </ol>
        </section>
        <?php
        //print_r($_SESSION);
        if($_SESSION['tipo']==2){ ?>
        <!-- Main content -->
            <?php include 'banner_principal_gim.php';?>
        <?php } ?>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b>
        </div>
        <strong> <a href="http://jpsistemas.com">JP Sistemas</a>.</strong> Todito los Derechos Reservados
    </footer>



</div>
<!-- ./wrapper -->
<?php include 'footer.php'; ?>



