<?php 
error_reporting(0);
session_start();
include 'header.php'; ?>

<body>
    <!-- /.navbar-top-links -->

    <?php include 'menu.php'; ?>
            <!-- /.navbar-static-side -->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $_SESSION['nombre_dominio']; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
        </div>    
    <!-- /#wrapper -->

    <!-- jQuery -->
    <?php include 'footer.php'; ?>

</body>

</html>
