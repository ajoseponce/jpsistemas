<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <base href="{{ @BASEHREF }}">

  <title>{{ @titulo }}</title>

  <!--
  _____ _      _                __        __   _
  |  ___| | ___| |__   ___  ___  \ \      / /__| |__
  | |_  | |/ _ \ '_ \ / _ \/ __|  \ \ /\ / / _ \ '_ \
  |  _| | |  __/ |_) |  __/\__ \   \ V  V /  __/ |_) |
  |_|   |_|\___|_.__/ \___||___/    \_/\_/ \___|_.__/
                                       ____  _            _
                                      |  _ \| | ___  ___ | |_ ___  ___
                                      | |_) | |/ _ \/ _ \| __/ _ \/ __|
                                      |  __/| |  __/ (_) | ||  __/ (__
                                      |_|   |_|\___|\___/ \__\___|\___|
  -->

  <meta name="robots" content="noindex,  nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="des.ico">


  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/jstree/default/style.min.css">

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js?{{ @VERSION_INT }}"></script>


  <style>
    @media screen {

      body {
        background-color: #808080 !important;
      }

      .page {
        background-color: #FFF;
        border: 1px solid #000;
        box-shadow: 5px 5px 10px #333;
        margin: 10px auto;

      }

      #print-box {
        background-color: #1e1e1e;
        border-radius: 5px;
        border-color: #000;
        box-shadow: 0 0 5px #000;

        bottom: 2%;
        left: 90%;
        padding: 10px;
        position: fixed;
        width: 100px;
        z-index: 2000;
      }

    }

    @media print {

      body {
        background-color: #FFF !important;
      }

      #print-box {
        display: none;
      }
    }

    @media print, screen {

      @page {
        margin: 0mm;
        size: {{ @pagesize }} {{ @orientacion }};
      }

      .page {
        position: relative !important;
        page-break-after: always !important;
        padding: 10mm;

        height: {{ @orientacion=='landscape' ? @pagewidth : @pageheight }};
        width: {{ @orientacion=='landscape' ? @pageheight : @pagewidth }};
      }

      .sub-page {
        height: 100%;
        position: relative !important;
        width: 100%;
      }

      .header {
        max-height: 35mm;
      }
      .logo-header {
        max-height: 20mm;
      }
      .logo-flebes {
        max-height: 10mm;
      }

      .footer {
        bottom: 0 !important;
        position: absolute !important;
        width: 100%;
      }

      .est-font {
        font-size: 11px;
      }
      .est-cell {
        width: 65px;
      }
      .min-col {
        word-break: keep-all;
        -moz-word-break: keep-all;
        width: 10px;
      }
    }
  </style>

</head>
<body>
<style>
  .form-group input,
  .form-group span {
    font-size: 12px;
  }

  .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4,
  .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10,
  .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6,
  .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12,
  .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8,
  .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3,
  .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    padding-left: 5px;
    padding-right: 5px;
  }
</style>

<script type="text/javascript">
  $(document).ready(function () {
    $('.form-control').attr('readonly', '');
    $('.form-control').css('background-color', '#FFF');
  });
</script>
<div class="content">
    <div class="box" style="margin-top: {{ @MARGINTOP }}px"></div>
    <div class="clearfix"></div>

    <div class="box">
      <div class="form-group col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">Nombre y Apellido</span>
          <input type="text" class="form-control" value="{{ @paciente.nombrecompleto }}">
        </div>
      </div>
    </div>

    <div class="box">
      <div class="form-group col-xs-6">
        <div class="input-group">
          <span class="input-group-addon">C.I.</span>
          <input type="text" class="form-control" value="{{ @paciente.personanrodocumento }}">
        </div>
      </div>
      <div class="form-group col-xs-6">
        <div class="input-group">
          <span class="input-group-addon">F. Nacimiento</span>
          <input type="text" class="form-control" value="{{ @paciente.personafechanacimiento }}">
        </div>
      </div>
    </div>

    <div class="box">
      <div class="form-group col-xs-6">
        <div class="input-group">
          <span class="input-group-addon">Domicilio</span>
          <input type="text" class="form-control" value="{{ @paciente.domicilio }}">
        </div>
      </div>
      <div class="form-group col-xs-6">
        <div class="input-group">
          <span class="input-group-addon">Localidad</span>
          <input type="text" class="form-control" value="{{ @paciente.localidad }}">
        </div>
      </div>
    </div>

    <div class="box">
      <div class="form-group col-xs-12">
        <div class="input-group">
          <span class="input-group-addon">E-mail</span>
          <input type="text" class="form-control" value="{{ @paciente.email }}">
        </div>
      </div>
    </div>

    <div class="box">
      <div class="form-group col-xs-4">
        <div class="input-group">
          <span class="input-group-addon">Tel. particular</span>
          <input type="text" class="form-control" value="{{ @paciente.telefono }}">
        </div>
      </div>
      <div class="form-group col-xs-4">
        <div class="input-group">
          <span class="input-group-addon">Celular</span>
          <input type="text" class="form-control" value="{{ @paciente.celular }}">
        </div>
      </div>
      <div class="form-group col-xs-4">
        <div class="input-group">
          <span class="input-group-addon">Tel. Laboral</span>
          <input type="text" class="form-control" value="{{ @paciente.telefonolaboral }}">
        </div>
      </div>
    </div>

    <div class="box">
      <div class="form-group col-xs-4">
        <div class="input-group">
          <span class="input-group-addon">Ocupación</span>
          <input type="text" class="form-control" value="{{ @paciente.ocupacion }}">
        </div>
      </div>
      <div class="form-group col-xs-8">
        <div class="input-group">
          <span class="input-group-addon">Dirección para la notificación</span>
          <input type="text" class="form-control" value="{{ @paciente.domicilio }}">
        </div>
      </div>
    </div>
  </div>
</body>
