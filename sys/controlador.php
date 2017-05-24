<?php
error_reporting(E_ALL);
//ini_set("display_errors", 1);
include('lib/functions.php');
requireLogin();
//error_reporting(0);
$action = $_REQUEST["action"];
//print_r($_REQUEST);
    switch ($action) {
        
     //crga el categorias
        case "logout":
            /***************includes******************/
            logOut();
            exit;
        break;
        /*************************************/
        case "guardar_persona":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
//print_r($_REQUEST);
            $id_persona= $consultas->save_persona($_REQUEST);

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getpersonas();
            /*********************/

            $formulario='forms/form_lista_personas.php';
        break;
        case "eliminar_persona":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_persona($_REQUEST['id_persona']);
            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas.php';
            break;
        case "carga_personas":
            //echo "si bueno tibago";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_SESSION);
            include 'header.php';

            include "nav.php";

            include 'menu.php';

//            $productos= $consultas->getproductos();
//            $proviene= $consultas->getProviene();
            $formulario='forms/form_personas.php';
        break;
        case "edita_persona":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);
//            $productos= $consultas->getproductos();
//            $proviene= $consultas->getProviene();
//            $actividadesCliente= $consultas->getRelacionByIDCliente($_REQUEST['id_persona']);
            $formulario='forms/form_personas.php';
        break;
        case "listar_personas":
           // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas.php';
        break;
        /************prodccutos***************/
        case "listar_productos":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getproductos();

            $formulario='forms/form_lista_productos.php';
            break;
        case "carga_productos":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            $formulario='forms/form_productos.php';
            break;
        case "guardar_producto":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $id_producto = $consultas->save_producto($_REQUEST);
            //borrar_relacion($id_producto);

            $id_producto_dias = $consultas->save_dias_productos($id_producto,$_REQUEST);


            $result = $consultas->getproductos();
            /*********************/
            $mensaje="La operacion se realizo correctamente.";
            $formulario='forms/form_lista_productos.php';
            break;
        case "edita_producto":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getProductobyid($_REQUEST['id_producto']);
            $formulario='forms/form_productos.php';
        break;
        /*****************************/
        case "lista_relaciones":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getRelaciones();

            $formulario='forms/form_lista_relaciones.php';
            break;
        case "carga_relacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $productos= $consultas->getproductos();

            $formulario='forms/form_relacion.php';
            break;
        case "guardar_relacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            //print_r($_REQUEST);
            if($consultas->chequeaActividad($_REQUEST['cliente'],$_REQUEST['id_producto'])) {
                $id_producto = $consultas->save_relaciones($_REQUEST);
                $mensaje="La operacion se realizo.";
            }else{
                $mensaje="La operacion no se realizo.";
            }
            $result = $consultas->getRelaciones();
            /*********************/
            //$mensaje="La operacion se realizo correctamente.";
            $formulario='forms/form_lista_relaciones.php';
            echo $mensaje;
            break;
        case "edita_relacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getRelacionbyid($_REQUEST['id_relacion']);
            $productos= $consultas->getproductos();
            $formulario='forms/form_relacion.php';
            break;
        /*****************************/
        case "cargar_pago":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_pagos.php';
            break;
        /*****************************/
        case "buscar_precio":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            $html=array ();
            $result = $consultas->getProductobyid($_REQUEST['id_producto']);
            $html['precio']=$result->precio;
            ////////////////////////////////////////////////////
            $temp1=strtotime(date('2017-'.date('m').'-'.date('d').' 23:59:59')); //segs desde fecha unix
            $temp2=strtotime("2017-".$_REQUEST['periodo']."-10 23:59:59"); //segs desde la fecha unix
            //echo "fecha".$temp1."--fecha". $temp2;
            $diferencia= $temp1-$temp2; //abs=valor absoluto :D
            $dias=floor($diferencia/60/60/24); //floor=redondea hacia arriba :D
            ///////////////////////////////////////
            $cant_pagos = $consultas->getContadorPagosRealizados($_REQUEST['clientes']);
            if($cant_pagos>0) {
                //echo $dias;
                if ($dias > 0) {
                    $html['dias'] = $dias;
                    $precio_por_dia = ($result->incremento_dia * $result->precio) / 100;
                    $html['intereses'] = $precio_por_dia * $dias;
                    $html['precio'] = $html['precio'] + $html['intereses'];
                    //$html['dias']=$dias;
                }
            }else{
                $html['dias'] = 0;
                $html['intereses'] = 0;

            }


            echo  json_encode($html);
            break;
        case "guardar_pago":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            $html=array ();
            $id_pago = $consultas->save_pago($_REQUEST);
            /*********************/
            $mensaje="El pago se realizo correctamente se realizo correctamente.";
            $html['mjs']=$mensaje;
            $html['id_pago']=$id_pago;
            echo  json_encode($html);
            break;
        case "pagos_periodo":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            $html=array ();
            $pagos_periodo = $consultas->getPagosPeriodo($_REQUEST['periodo'],$_REQUEST['cliente']);
            if($pagos_periodo>0){
                $html['cartel']='Este periodo  ya contiene un pago realizado .Desea Continuar? <input type="button"  onclick="acepta_periodo()" class="btn btn-default" value="Si, Continuar" /><input type="button"  onclick="cancelar()" class="btn btn-default" value="Cancelar" />';
            }
            $html['cant_pagos']=$pagos_periodo;

            echo  json_encode($html);
        break;
        case "listar_pagos":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getPagos();
            $formulario='forms/form_lista_pagos.php';
            break;
        case "elimina_pago":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            /*********************/
            $consultas->eliminar_pago($_REQUEST['id_pago']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getPagos();

            $formulario='forms/form_lista_menu.php';
            break;
        case "menu_usuario":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';


            $result= $consultas->getmenues();

            $formulario='forms/form_lista_pagos.php';
            break;
        case "listar_menu":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getmenu();

            $formulario='forms/form_lista_menu.php';
            break;
        case "cargar_menu":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getmenu();

            $formulario='forms/form_menu.php';
            break;
        case "guardar_menu":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            $consultas->save_menu($_REQUEST);
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getmenu();
            /*********************/

            $formulario='forms/form_lista_menu.php';
            break;
        case "edita_menu":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $result= $consultas->getMenubyid($_REQUEST['id_menu']);
            $formulario='forms/form_menu.php';
            break;
        case "elimina_menu":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            /*********************/
            $consultas->eliminar_menu($_REQUEST['id_menu']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getMenu();

            $formulario='forms/form_lista_menu.php';
            break;
            /********************************************/
            /*********************controlador Aplicativos***********************/
            /********************************************/
        case "listar_aplicativo":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getAplicativo();

            $formulario='forms/form_lista_aplicativo.php';
            break;
        case "cargar_aplicativo":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_aplicativo.php';
            break;
        case "guardar_aplicativo":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $consultas->save_aplicativos($_REQUEST);

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getAplicativo();
            /*********************/

            $formulario='forms/form_lista_aplicativo.php';
            break;
        case "edita_aplicativo":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $result= $consultas->getAplicativobyid($_REQUEST['id_aplicativo']);
            $formulario='forms/form_aplicativo.php';
            break;
        case "elimina_aplicativo":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_aplicativo($_REQUEST['id_menu']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getAplicativo();

            $formulario='forms/form_lista_menu.php';
            break;
        /********************************************/
        /*********************controlador menu aaplcativvos***********************/
        /********************************************/
        case "listar_aplicativo_menu":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getAplicativoMenu();

            $formulario='forms/form_lista_aplicativo_menu.php';
            break;
        case "cargar_aplicativo_menu":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_aplicativo_menu.php';
            break;
        case "guardar_aplicativo_menu":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $consultas->save_aplicativo_menu($_REQUEST);

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getAplicativoMenu();
            /*********************/

            $formulario='forms/form_lista_aplicativo_menu.php';
            break;

        case "elimina_aplicativo_menu":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_aplicativo_menu($_REQUEST['id_relacion']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getAplicativoMenu();

            $formulario='forms/form_lista_aplicativo_menu.php';
            break;
        /********************************************/
        /*********************controlador personas aplcativos***********************/
        /********************************************/
        case "listar_aplicativo_persona":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getAplicativoPersonas();

            $formulario='forms/form_lista_aplicativo_persona.php';
            break;
        case "cargar_aplicativo_persona":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_aplicativo_persona.php';
            break;
        case "guardar_aplicativo_persona":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $consultas->save_aplicativo_persona($_REQUEST);

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getAplicativoPersonas();
            /*********************/
            $formulario='forms/form_lista_aplicativo_persona.php';
            break;

        case "elimina_aplicativo_persona":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_aplicativo_Persona($_REQUEST['id_relacion']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getAplicativoPersonas();

            $formulario='forms/form_lista_aplicativo_persona.php';
            break;
        /********************************************/
        /*********************controlador dominios***********************/
        /********************************************/
        case "listar_dominio":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getDominios();

            $formulario='forms/form_lista_dominio.php';
            break;
        case "cargar_dominio":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_dominio.php';
            break;
        case "guardar_dominio":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
//            print_r($_REQUEST);
//            exit;
            $consultas->save_dominio($_REQUEST);

            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getDominios();
            /*********************/

            $formulario='forms/form_lista_dominio.php';
            break;
        case "edita_dominio":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $result= $consultas->getDominobyid($_REQUEST['id_dominio']);
            $formulario='forms/form_dominio.php';
            break;
        case "elimina_dominio":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_dominio($_REQUEST['id_dominio']);
            $mensaje="La eliminacion se realizo correctamente.";
            $result= $consultas->getDominios();

            $formulario='forms/form_lista_dominio.php';
            break;
            /******************persona gym *****************/
        /*************************************/
        case "guardar_persona_gym":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');

            include 'header.php';
            include "nav.php";
            include 'menu.php';

            $id_persona= $consultas->save_persona($_REQUEST);
            $id_persona_dias = $consultas->save_dias_personas($id_persona,$_REQUEST);
            $_REQUEST['clientes']=$id_persona;
            if($_REQUEST['id_producto']){
                if($consultas->chequeaActividad($id_persona,$_REQUEST['id_producto'])){
                    $id_relacion=$consultas->save_relaciones($_REQUEST);

                }
            }
            $mensaje="La operacion se realizo correctamente.";
            $actividadesCliente= $consultas->getRelacionByIDCliente($id_persona);
            $result= $consultas->getPersonasbyid($id_persona);
            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();
            $result= $consultas->getpersonas();
            /*********************/
            $formulario='forms/form_lista_personas_gym.php';
            break;
        case "carga_personas_gym":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_SESSION);
            include 'header.php';
//            echo "gheader";
            include "nav.php";
//echo "bueno";
            include 'menu.php';

            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();
            $formulario='forms/form_persona_gym.php';
            break;
        case "listar_personas_gym":
            // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas_gym.php';
            break;
        case "edita_persona_gym":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);
            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();
            $actividadesCliente= $consultas->getRelacionByIDCliente($_REQUEST['id_persona']);
            $formulario='forms/form_persona_gym.php';
            break;
        /******************USUARIOS ABM *****************/
        /*************************************/
        case "guardar_usuario":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';

            $id_usuario= $consultas->save_usuario($_REQUEST);
            $consultas->eliminar_aplicativos_usuario($id_usuario);
            /**************************/
            $result_au= $consultas->getAplicativoPorTipo($_REQUEST['tipo']);
            $data['usuario']=$id_usuario;
            $_REQUEST['id_usuario']=$id_usuario;
                    foreach ($result_au as $r) {
                    $data['aplicativo']=$r->id_aplicativo;
                    $consultas->save_aplicativo_persona($data);
                }
            /****************************/
            $consultas->eliminar_dominio_usuario($id_usuario);
            $consultas->save_persona_dominio($_REQUEST);
            /************************************/
            $result= $consultas->getUsuarios();
            $mensaje="La operacion se realizo correctamente.";

            $formulario='forms/form_lista_usuarios.php';
            break;
        case "carga_usuarios":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_SESSION);
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_usuarios.php';
            break;
        case "listar_usuarios":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getUsuarios();
            //exit();
            $formulario='forms/form_lista_usuarios.php';
            break;
        case "edita_usuario":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';

            $result= $consultas->getUsuariosByID($_REQUEST['id_usuario']);
            $formulario='forms/form_usuarios.php';
            break;
        /******************************************/

        case "asistencia":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_SESSION);
            include 'header.php';
            $formulario='forms/form_asistencias.php';
            break;
        case "cambiar_contrasenia":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');

            include 'header.php';
            include "nav.php";
            include 'menu.php';
            include 'footer.php';
            ?>
            <script>
                //$('#myModal').modal('show')
            </script>
            <?php
            break;
        case "datos_persona_all":

            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');


            include 'header.php';
            include "nav.php";
            include 'menu.php';
            /******************************************/

            $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);

            $evo_morales= $consultas->getEvoluciones($_REQUEST['id_persona']);
            $turnos= $consultas->getTurnos($_REQUEST['id_persona']);



            /***************************************/
            $formulario='forms/form_persona_all.php';
            break;
        case "guardar_contrasenia_nueva":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');

            $result= $consultas->save_contrasenia($_REQUEST['contrasenia_nueva1']);
            /***************includes******************/

            break;
        case "guardar_turno":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_REQUEST);
            $result= $consultas->save_turno_persona($_REQUEST);
            /***************includes******************/
            echo $result;
            break;
        /***************************************/
    }
   
if($formulario){    
    include($formulario);
}    
//include 'footer.php';
?>   
    