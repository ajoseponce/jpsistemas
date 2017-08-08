<head>
  <meta charset="UTF-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <base>

  <title>Bono Turno</title>

  <meta name="robots" content="noindex,  nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="des.ico">


  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/jstree/default/style.min.css">

  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>


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

        height: 125.6mm;
        width: 215.1mm;
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
