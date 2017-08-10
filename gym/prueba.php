<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Prueba de cámara Web</title>
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    
    <!--<script type="text/javascript" src="jquery-1.8.2.min.js"></script>-->
    <style type="text/css">
        .contenedor{ width: 350px; float: left;}
        .titulo{ font-size: 12pt; font-weight: bold;}
        #camara, #foto{
            width: 320px;
            min-height: 240px;
            border: 1px solid #008000;
        }
    </style>
    <script type="text/javascript">
        //Nos aseguramos que estén definidas
//algunas funciones básicas
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || function(){alert('Su navegador no soporta navigator.getUserMedia().');};
 
$(document).ready(function(){
    //Este objeto guardará algunos datos sobre la cámara
    window.datosVideo = {
        'StreamVideo': null,
        'url' : null
    };
     
    $('#botonIniciar').on('click', function(e){
        //Pedimos al navegador que nos de acceso a 
        //algún dispositivo de video (la webcam)
        navigator.getUserMedia({'audio':false, 'video':true}, function(streamVideo){
            datosVideo.StreamVideo = streamVideo;
            datosVideo.url = window.URL.createObjectURL(streamVideo);
            $('#camara').attr('src', datosVideo.url);
        }, function(){
            alert('No fue posible obtener acceso a la cámara.');
        });
 
    });
 
    $('#botonDetener').on('click', function(e){
        if(datosVideo.StreamVideo){
            datosVideo.StreamVideo.stop();
            window.URL.revokeObjectURL(datosVideo.url);
        };
    });
});
        //El código Javascript está en la siguiente sección del post
        $('#botonFoto').on('click', function(e){
           // alert('osea llega');
    var oCamara, 
        oFoto,
        oContexto,
        w, h;
         
    oCamara = $('#camara');
    oFoto = $('#foto');
    w = oCamara.width();
    h = oCamara.height();
    oFoto.attr({'width': w, 'height': h});
    oContexto = oFoto[0].getContext('2d');
    oContexto.drawImage(oCamara[0], 0, 0, w, h);
 
});
    </script>
</head>
<body>
    <div id='botonera'>
        <input id='botonIniciar' type='button' value = 'Iniciar'></input>
        <input id='botonDetener' type='button' value = 'Detener'></input>
        <input id='botonFoto' type='button' value = 'Foto'></input>
    </div>
    <div class="contenedor">
        <div class="titulo">Cámara</div>
        <video id="camara" autoplay controls></video>
    </div>
    <div class="contenedor">
        <div class="titulo">Foto</div>
        <canvas id="foto" ></canvas>
    </div>    
</body>
</html>