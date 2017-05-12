<?php
/**
 * Created by PhpStorm.
 * User: Jose Ponce
 * Date: 04/08/2016
 * Time: 12:28 PM
 */?>
<div id="get-in-touch" class="get-in-touch">
    <div class="container">
        <div class="get-info text-center">
            <h2><span class="highlight">Estoy</span> en contacto</h2>
            <h3><i>Sientete libre de contactarme</i></h3>
            <div class="underline">
                <img src="images/underline.png" alt=" "/>
            </div>
            <!--            <p>Lorem ipsum dolor amet, libero turpis non cras ligula, id commodo, aenean est in volutpat amet sodales, porttitor bibendum facilisi suspendisse</p>-->
        </div>
    </div>
    <div class="map">
        <div class="nav-icon">
            <!--            <img src="images/9.png" alt=" "/>-->
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3543.0146370830566!2d-55.909817084945175!3d-27.375258282930606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9457be47525e5351%3A0x14f83cc66c23914f!2sGdor.+Barreyro+3037%2C+N3301LEK+Posadas%2C+Misi%C3%B3nes!5e0!3m2!1ses!2sar!4v1470323895963" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
<!-- //get-in -->
<!-- contact-us -->
<div class="contact-us">
    <div class="container">
        <div class="contact-grids">
            <div class="col-md-4 contact-grid text-center">
                <div class="point-icon"></div>
                <p>Gdor. Barreyro 3037 Posadas Misiones Argentina</p>
            </div>
            <div class="col-md-4 contact-grid text-center">
                <div class="mail-icon"></div>
                <p><a href="mail-to:albertojoseponce@gmail.com">albertojoseponce@gmail.com</a></p>
            </div>
            <div class="col-md-4 contact-grid text-center">
                <div class="phone-icon"></div>
                <p>+54 376 4377971</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="contact-info">
            <form method="post" onsubmit="false" action="envia_mail.php">
                <input id="name" type="text" placeholder="Tu nombre" required>
                <input id="email" type="text" placeholder="Tu E-Mail" required>
                <input id="motivo" type="text" placeholder="Motivo" >
                <textarea id="comment" placeholder="Dale contame" required></textarea>
                <input type="button" onclick="enviar_mail()" value="ENVIAR MENSAJE">
            </form>
        </div>
    </div>
</div>
