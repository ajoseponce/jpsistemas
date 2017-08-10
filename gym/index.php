<?php
session_start();
/**************INCLUDES*****************************/
include('lib/DB_Conectar.php');
include('lib/functions.php');
/******************************************************/
if(isset($_SESSION['id'])){
  header('Location: principal.php');
}
//$alerta="none";
if(isset($_POST["btnSubmit"])){
//    echo "entro";
//    exit;
    if(checkLogin($_POST["usuario"], $_POST["password"])){
        //session_start();
        $sql = "SELECT * FROM usuarios WHERE nombre='".$_POST['usuario']."'";

        echo $sql;
        $usuario_datos=@mysql_query($sql);
        $_SESSION["_userName"] = $_POST["usuario"];
        $_SESSION["_userPass"] = md5($_POST["password"]);
        $usuario=mysql_fetch_array($usuario_datos);

        $id_user=$usuario[0];
        $_SESSION['id']=$usuario[0];
        $_SESSION['id_persona']=$usuario[3];

        $nombre=@mysql_query("SELECT * FROM personas WHERE id_persona='".$usuario[3]."'");
        $nombre_comp=mysql_fetch_array($nombre);
        $_SESSION['nombre']=$nombre_comp['nombre'].' '.$nombre_comp['apellido'];
        //header('Location:index_dominio.php');
        header('Location:principal.php');
    }
    else{
        session_start();
        session_destroy(); //hago esto para poder destruir la session y probar si me niega el acceso a una pagina que tenga requireLogin
        //$error->add('',LEVEL_ERROR_WARNING,'Su usuario o contraseña son incorrectos.');
        //$error = "error";
        $alerta="";
    }
}
?>
<html lang="en">

<?php include 'header.php'; ?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading" style="background-color: white;">
                        <h3 class="panel-title" style="text-align: center"><img src="img/logo.jpg"></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php" method="post" id="login-form" >
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="usuario" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input name="btnSubmit" type="submit" class="btn btn-lg btn-orange btn-block" value="Ingresar" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>

</html>
