<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 02/08/2016
 * Time: 02:03 PM
 */?>
<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 02/08/2016
 * Time: 02:02 PM
 */?>
<div class="navigation">
    <div class="container">
        <div class="fixed-header">
            <div class="nav-left">
                <a href="#"><img src="images/logo_chico.png" alt="" /></a>
            </div>
            <div class="nav-right">
                <span class="menu"><img src="images/menu.png" alt="" /></span>
                <nav class="cl-effect-1">
                    <ul class="nav1">
                        <li><a class="scroll" href="#home">Inicio</a></li>
                        <li><a class="scroll" href="#services">Servicios</a></li>
                        <li><a class="scroll" href="#about-us">JP</a></li>
                        <li><a class="scroll" href="#clientes">Clientes</a></li>
                        <li><a class="scroll" href="#redes">Redes</a></li>
                        <li><a class="scroll" href="#get-in-touch">Contacto</a></li>
                        <li><a  href="login.php">Login</a></li>
                    </ul>
                </nav>

                <!-- script for menu -->
                <script>
                    $( "span.menu" ).click(function() {
                        $( "ul.nav1" ).slideToggle( 300, function() {
                            // Animation complete.
                        });
                    });
                </script>
                <!-- //script for menu -->
                <!-- script-for sticky-nav -->
                <script>
                    $(document).ready(function() {
                        var navoffeset=$(".navigation").offset().top;
                        $(window).scroll(function(){
                            var scrollpos=$(window).scrollTop();
                            if(scrollpos >=navoffeset){
                                $(".navigation").addClass("fixed");
                            }else{
                                $(".navigation").removeClass("fixed");
                            }
                        });

                    });
                </script>
                <!-- /script-for sticky-nav -->

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

