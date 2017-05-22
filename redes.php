<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 04/08/2016
 * Time: 02:13 PM
 */?>

<!-- //slider -->

<div class="twitt-slider" id="redes">
    <div class="container">
        <!-- responsiveslides -->
        <script src="js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 4
                $("#slider4").responsiveSlides({
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
            <ul class="rslides" id="slider4">
                <li>
                    <div class="twitt-info">
                        <img src="images/14.png" alt=" "/>
                        <p>Siempre que te pregunten si puedes hacer un trabajo, contesta que sí y ponte enseguida a aprender como se hace....</p>
                        <h3>Sigueme en  Twitter : <span class="highlight">@ajoseponce</span></h3>
                    </div>
                </li>

                <div class="twitt-info">
                    <img src="images/google.png" alt=" "/>
                    <p>Un síntoma de que te acercas a una crisis nerviosa es creer que tu trabajo es tremendamente importante. </p>
                    <h3>Sigueme en  Google : <span class="highlight">@ajoseponce</span></h3>
                </div>
                </li>
                <li>
                    <div class="twitt-info">
                        <img src="images/facebook.png" alt=" "/>
                        <p>Elige un trabajo que te guste y no tendrás que trabajar ni un día de tu vida. </p>
                        <h3>Sigueme en  Facebook : <span class="highlight">@ajoseponce</span></h3>
                    </div>
                </li>
            </ul>
        </div>



    </div>
</div>
