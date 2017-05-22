<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 02/08/2016
 * Time: 11:44 AM
 */?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!Doctype html>
<html>
<?php include 'header.php';?>
<body>
<!-- banner -->
<div id="home" class="banner">
    <div class="container">
        <div class="banner-info">
            <h1>Bienvenido a <span class="colon">:</span>Sistemas JP</h1>
            <p>Si lo podes pensar, lo podes crear.</p>
<!--            <div class="view"><a href="#">View Portfolio</a></div>-->
        </div>
        <div class="banner-grids">
            <div class="col-md-4 banner-grid text-center">
                <div class="banner-left">
                    <ul>
                        <li><label> </label></li>
                        <li>Tienes una pregunta? Llamame<span>+54 376 4377971</span> </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 banner-grid text-center">
                <div class="banner-middle">
                    <ul>
                        <li><label> </label></li>
                        <li>Atencion<span>Lun - Vie 07:00 - 21:00</span> </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 banner-grid text-center">
                <div class="banner-right">
                    <ul>
                        <li><label> </label></li>
                        <li>¿Necesita ayuda?<span><a href="mail-to:ayuda@sistemasjp.com">ayuda@sistemasjps.com</a></span></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //banner -->
<!-- navigation -->
<?php include 'menu.php'?>
<!-- //navigation -->
<!-- our services -->
<?php include 'servicios.php'; ?>
<!-- //our services -->
<!-- about-us -->
<?php include 'abouts.php';?>
<!-- //about-us -->
<!-- about-bottom -->

<!-- //about-bottom -->
<!-- our-works -->
<?php include 'clientes.php'?>
<!-- //our-works -->
<!-- slider -->
<?php include 'redes.php'; ?>
<!-- //twitt-slider -->
<!-- get-in -->
<?php include 'contacto.php'; ?>
<!-- //contact-us -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-left">
            <p>Desarrollado por <a href="http://sistemasjp.com/">Sistemas JP</a></p>
        </div>
        <div class="footer-right">
            <ul>
                <li><a class="facebook" href="#"></a></li>
                <li><a class="twitter" href="#"></a></li>
                <li><a class="linkedin" href="#"></a></li>
<!--                <li><a class="pininterest" href="#"></a></li>-->
                <li><a class="google" href="#"></a></li>
<!--                <li><a class="dribble" href="#"></a></li>-->
<!--                <li><a class="linkedin" href="#"></a></li>-->
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- //footer -->
<!-- smooth scrolling -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */
        $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
</body>
</html>

