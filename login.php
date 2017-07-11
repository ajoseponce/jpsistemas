<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
/**************INCLUDES*****************************/
include('lib/DB_Conectar.php');
include('lib/functions.php');
include('classes/consultas.php');



/******************************************************/
if(isset($_SESSION['id'])){
    //$usuario=$consultas->getUser($_POST['_userName'], $_POST["_userPass"]);
    $filename = $_SESSION['aplicativo']."/principal.php";
    redirect($filename);
}
//$alerta="none";
if(isset($_POST["btnSubmit"])){

    if($consultas->checkLogin($_POST["usuario"], $_POST["password"])){

        $usuario=$consultas->getUser($_POST['usuario'], $_POST["password"]);
       // exit;
        $_SESSION["_userName"] = $_POST["usuario"];
        $_SESSION["_userPass"] = md5($_POST["password"]);
        $_SESSION['id']=$usuario->id_usuario;
        $_SESSION['persona']=$usuario->nombre_persona;
        $_SESSION['dominio']=$usuario->id_dominio;
        $_SESSION['tipo']=$usuario->tipo;
        $_SESSION['tipo_dominio']=$usuario->tipo_dominio;
        $_SESSION['nombre_dominio']=$usuario->nombre_dominio;
        $_SESSION['aplicativo']=$usuario->aplicativo;
        $_SESSION['rol']=$usuario->rol;

        $_SESSION['nombre']=$usuario->nombre_persona;
//        print_r($_SESSION);
//        exit;
        $filename = $usuario->aplicativo."/principal.php";
        redirect($filename);


    }
    else{
        //session_start();
        session_destroy(); //hago esto para poder destruir la session y probar si me niega el acceso a una pagina que tenga requireLogin
        //$error->add('',LEVEL_ERROR_WARNING,'Su usuario o contraseña son incorrectos.');
        //$error = "error";
        $alerta="Ustede ingreso incorrectmente su usuario y passord";
    }
}
?>
<html lang="en">

<?php include 'header.php'; ?>

<body>
<div id="home" class="banner">
    <div class="container">

        <div class="row" style="margin-top: 34%;">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <?php if($alerta){ ?>
                        <div class="alert alert-danger alert-dismissable">

                            <?php echo $alerta ;?><a href="#" class="alert-link"></a>.
                        </div>
                    <?php } ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresar</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post" id="login-form" >

                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="usuario" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input name="btnSubmit" type="submit" class="btn btn-info" value="Ingresar" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>

</html>
