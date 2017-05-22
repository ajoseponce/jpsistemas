<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 02/08/2016
 * Time: 11:46 AM
 */?>
<head>
    <title>JP Sistemas</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--fonts-->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <link href="gym/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Sistemas JP" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <!-- js -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- js -->
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <script type="text/javascript" src="js/funciones.js"></script>

<!--    /var/www/html/jpsistemas/gym/bower_components/bootstrap/dist/css/bootstrap.css-->
    <!-- start-smoth-scrolling -->

</head>
