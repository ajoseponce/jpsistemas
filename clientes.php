<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 04/08/2016
 * Time: 11:44 AM
 */?>
<div class="slider">
    <div class="container">
        <!-- responsiveslides -->
        <script src="js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 4
                $("#slider3").responsiveSlides({
                    auto: true,
                    pager: true,
                    nav: false,
                    speed: 500,
                    namespace: "callbacks",
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });
            });
        </script>
        <!-- responsiveslides -->
        <div  id="top" class="callbacks_container">
            <ul class="rslides" id="slider3">
                <li>
                    <div class="slider-info">
                        <div class="col-md-3 slider-left text-center">
                            <img src="images/mi.jpg" alt=" " />
                        </div>
                        <div class="col-md-9 slider-right">
                            <p>Vivo mi trabajo como sinónimo de eficiencia, calidad de servicio y un rápido retorno de la inversión en la creación de un sistema flexible, capaz de responder a las necesidades cada vez más personalizadas de las empresas. </p>
                            <p><i><span class="highlight">Jose Ponce</span><span class="yellow"> - Analista de Sistemas</span></i></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
<div id="clientes" class="clientes">
    <div class="container">
        <div class="our-work-info text-center wow bounceIn" data-wow-delay="0.4s">
            <br>
            <h2><span class="highlight">MIS</span> CLIENTES</h2>
            <h3><i>...</i></h3>
            <div class="underline">
                <img src="images/underline.png" alt=" "/>
            </div>
            <p>Mi compromiso es trabajar todos los días servicio a los clientes, ofreciendo soluciones innovadoras y servicios específicos .</p>
        </div>
        <div class="portfolio-grid">

            <div id="portfoliolist">
                <div class="port-grid">
                    <div class="portfolio card mix_all" data-cat="card" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper ">
                            <a href="#small-dialog" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/karaben.png" alt=""  />
                                <div class="simple-in">

                                    <ul class="social img-one">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>
                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>Estudio Karaben</h4>
                                <p>Soluciones Contables</p>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog1" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/bstb.png" alt=""/>
                                <div class="simple-in one">

                                    <ul class="social img-two">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>
                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>Sistema de Calidad</h4>
                                <p>Banco de Sangre</p>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio card mix_all" data-cat="card" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog6" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">

                                <img class="img-responsive" src="images/l.jpg" alt=""  />
                                <div class="simple-in six">

                                    <ul class="social img-one">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>BRONZE APPS</h4>
                                <p>Mobile Apps</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="port-grid">
                    <div class="portfolio icon mix_all" data-cat="icon" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog2" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/bct.jpeg"  alt="" />
                                <div class="simple-in two">

                                    <ul class="social img-three">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>BCT Quality System</h4>
                                <p>Sistema Informatico</p>

                            </div>
                        </div>
                    </div>
                    <div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper ">
                            <a href="#small-dialog4" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/f.jpg" alt=""  />
                                <div class="simple-in four">

                                    <ul class="social img-two">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>30 ICON MODERN</h4>
                                <p>Graphic</p>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio icon mix_all" data-cat="icon" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog5" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/c.jpg" alt=""  />
                                <div class="simple-in five">

                                    <ul class="social img-three">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>FREE LOGOTYPE</h4>
                                <p>Identity</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="port-grid">
                    <div class="portfolio icon mix_all" data-cat="icon" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog33" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">
                                <img class="img-responsive" src="images/cge.jpg"  alt="" />
                                <div class="simple-in two">

                                    <ul class="social img-three">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>CGE Consultores</h4>
                                <p>Pagina Web</p>

                            </div>
                        </div>
                    </div>
                    <div class="portfolio set mix_all" data-cat="set" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper">
                            <a href="#small-dialog7" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">

                                <img class="img-responsive" src="images/e.jpg" alt=""  />
                                <div class="simple-in seven">

                                    <ul class="social img-one">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>

                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>DIGITAL BRANDING WEBSITE</h4>
                                <p>Website</p>

                            </div>
                        </div>
                    </div>
                    <div class="portfolio app mix_all" data-cat="app" style="display: inline-block; opacity: 1;">
                        <div class="portfolio-wrapper ">
                            <a href="#small-dialog8" class="b-link-stripe b-animate-go  thickbox play-icon popup-with-zoom-anim">

                                <img class="img-responsive" src="images/b.jpg" alt=""  />
                                <div class="simple-in eight">
                                    <ul class="social img-two">
                                        <li><span> </span></li>
                                        <li><span class="text"> </span></li>
                                        <div class="clearfix"> </div>
                                    </ul>
                                </div>
                            </a>
                            <div class="simple-out">
                                <h4>WEDDING INVITATION</h4>
                                <p>Identity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pop-up-box -->
            <!-- script for pop-up-box -->
            <script type="text/javascript" src="js/modernizr.custom.min.js"></script>
            <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
            <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
            <!-- //script for pop-up-box -->
            <div id="small-dialog" class="mfp-hide">
                <div class="image-top">
                    <img src="images/karaben.png" alt="" />
                    <h4>Gestion</h4>
                    <p>Sistema a medida</p>
                </div>
            </div>
            <div id="small-dialog1" class="mfp-hide">
                <div class="image-top">
                    <img src="images/bstb.png" alt="" />
                    <h4>Banco de Sangre Tejidos y Biologicos</h4>
                    <p>Sistema Informatico</p>
                </div>
            </div>
            <div id="small-dialog2" class="mfp-hide">
                <div class="image-top">
                    <img src="images/bct.jpeg" alt="" />
                    <h4>BCT Quaality System</h4>
                    <p>Sistema Informatico</p>
                </div>
            </div>
            <div id="small-dialog33" class="mfp-hide">
                <div class="image-top">
                    <img src="images/cge_grande.png" alt="" />
                    <h4>CGE Consultores</h4>
                    <p>Pagina Web</p>
                </div>
            </div>
            <div id="small-dialog3" class="mfp-hide">
                <div class="image-top">
                    <img src="images/m.jpg" alt="" />
                    <h4>ATOM WEBSITE</h4>
                    <p>Website</p>
                </div>
            </div>
            <div id="small-dialog4" class="mfp-hide">
                <div class="image-top">
                    <img src="images/f.jpg" alt="" />
                    <h4>30 ICON MODERN</h4>
                    <p>Graphic</p>
                </div>
            </div>
            <div id="small-dialog5" class="mfp-hide">
                <div class="image-top">
                    <img src="images/c.jpg" alt="" />
                    <h4>FREE LOGOTYPE</h4>
                    <p>Identity</p>
                </div>
            </div>
            <div id="small-dialog6" class="mfp-hide">
                <div class="image-top">
                    <img src="images/l.jpg" alt="" />
                    <h4>BRONZE APPS</h4>
                    <p>Mobile Apps</p>
                </div>
            </div>
            <div id="small-dialog7" class="mfp-hide">
                <div class="image-top">
                    <img src="images/e.jpg" alt="" />
                    <h4>DIGITAL BRANDING WEBSITE</h4>
                    <p>Website</p>
                </div>
            </div>
            <div id="small-dialog8" class="mfp-hide">
                <div class="image-top">
                    <img src="images/b.jpg" alt="" />
                    <h4>WEDDING INVITATION</h4>
                    <p>Identity</p>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('.popup-with-zoom-anim').magnificPopup({
                        type: 'inline',
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in'
                    });

                });
            </script>
            <!-- //pop-up-box -->
            <!-- Script for gallery Here -->
            <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
            <script type="text/javascript">
                $(function () {
                    var filterList = {
                        init: function () {
                            // MixItUp plugin
                            // http://mixitup.io
                            $('#portfoliolist').mixitup({
                                targetSelector: '.portfolio',
                                filterSelector: '.filter',
                                effects: ['fade'],
                                easing: 'snap',
                                // call the hover effect
                                onMixEnd: filterList.hoverEffect()
                            });
                        },
                        hoverEffect: function () {

                            // Simple parallax effect
                            $('#portfoliolist .portfolio').hover(
                                function () {
                                    $(this).find('.label').stop().animate({bottom: 0}, 200, 'easeOutQuad');
                                    $(this).find('img').stop().animate({top: -30}, 500, 'easeOutQuad');
                                },
                                function () {
                                    $(this).find('.label').stop().animate({bottom: -40}, 200, 'easeInQuad');
                                    $(this).find('img').stop().animate({top: 0}, 300, 'easeOutQuad');
                                }
                            );
                        }
                    };
                    // Run the show!
                    filterList.init();
                });
            </script>
            <!-- Gallery Script Ends -->
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
