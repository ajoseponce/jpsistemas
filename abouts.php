<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 04/08/2016
 * Time: 01:34 PM
 */?>
<div id="about-us" class="about-us">
    <div class="container">
        <div class="about-info text-center">
            <h2><span class="highlight">HAY</span> </h2>
            <h3><i>Un poco de lo que brindo</i></h3>
            <div class="underline">
                <img src="images/underline2.png" alt=" "/>
            </div>
<!--            <p>Lorem ipsum dolor amet, libero turpis non cras ligula, id commodo, aenean est in volutpat amet sodales,-->
<!--                porttitor bibendum facilisi suspendisse</p>-->
        </div>
    </div>
    <div class="about-grids">
        <div class="col-md-6 about-left">
            <div class="about-image">
                <img src="images/3.jpg" alt=" "/>
            </div>
        </div>
        <div class="col-md-6 about-right">
<!--            <p>Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum.</p>-->
            <div class="about-right-list">
                <div class="tab1 wow bounceIn" data-wow-delay="0.4s">
                    <ul>
                        <li><span> </span></li>
                        <li class="text">OBJETIVOS</li>
                    </ul>
                    <p>Nuestro objetivo es probar y verificar los clientes, antes de la compra o instalación, las ventajas de las soluciones propuestas.</p>
                </div>
                <div class="tab2 wow bounceIn" data-wow-delay="0.4s">
                    <ul>
                        <li><span class="circle"> </span></li>
                        <li class="text">TECNNOLOGIA</li>

                    </ul>
                    <p>Productos, servicios y soluciones de alto contenido tecnológico y a bajo costo, lo que garantiza a nuestros clientes la mejor experiencia del cliente y la máxima protección de la inversión.</p>
                </div>
                <div class="tab3 wow bounceIn" data-wow-delay="0.4s">
                    <ul>
                        <li><span class="tv"> </span></li>
                        <li class="text">INNOVACION</li>

                    </ul>
                    <p>El profesionalismo, la apertura a la innovación y la atención a las necesidades del cliente son la base de mi decisión de poner a disposición de las empresas de seis HPE Centro de Competencia de demostración que operan en el territorio Trivéneto.
                        .</p>
                </div>
<!--                <div class="tab4 wow bounceIn" data-wow-delay="0.4s">-->
<!--                    <ul>-->
<!--                        <li><span class="bulb"> </span></li>-->
<!--                        <li class="text">AWESOME SUPPORT</li>-->
<!--                    </ul>-->
<!--                    <p>Lorem ipsum dolor amet, libero turpis non cras ligula, id commodo, aenean est in volutpat amet sodales,-->
<!--                        porttitor bibendum facilisi suspendisse, aliquam ipsum ante morbi sed ipsum mollis.</p>-->
<!--                </div>-->
            </div>
            <!-- script for tabs -->
            <script>
                $(document).ready(function(){
                    $(".tab1 p").hide();
                    $(".tab2 p").hide();
                    $(".tab3 p").hide();
                    $(".tab4 p").hide();
                    $(".tab1 ul").click(function(){
                        $(".tab1 p").slideToggle(300);
                        $(".tab2 p").hide();
                        $(".tab3 p").hide();
                        $(".tab4 p").hide();
                    })
                    $(".tab2 ul").click(function(){
                        $(".tab2 p").slideToggle(300);
                        $(".tab1 p").hide();
                        $(".tab3 p").hide();
                        $(".tab4 p").hide();
                    })
                    $(".tab3 ul").click(function(){
                        $(".tab3 p").slideToggle(300);
                        $(".tab4 p").hide();
                        $(".tab2 p").hide();
                        $(".tab1 p").hide();
                    })
                    $(".tab4 ul").click(function(){
                        $(".tab4 p").slideToggle(300);
                        $(".tab3 p").hide();
                        $(".tab2 p").hide();
                        $(".tab1 p").hide();
                    })
                });
            </script>
            <!-- script for tabs -->
        </div>
        <div class="clearfix"></div>
    </div>

</div>
