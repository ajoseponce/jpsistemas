<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include('lib/functions.php');
requireLogin();

//error_reporting(0);
if(isset($_REQUEST["action_js"])){
     $_REQUEST["action"]=base64_encode($_REQUEST["action_js"]);
      }
$action = base64_decode($_REQUEST["action"]);

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

            $id_persona= $consultas->save_persona($_REQUEST);

            $id_persona_persona= $consultas->save_persona_cobertura($_REQUEST['id_persona_cobertura'],$id_persona,$_REQUEST);

            if($_REQUEST['patente']){
                if($consultas->chequeaPatente($id_persona,$_REQUEST['marca'],$_REQUEST['patente'])){
                    $consultas->save_persona_auto($id_persona,$_REQUEST);
                }
            }

            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas.php';
        break;
        case "eliminar_persona_gym":
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

            $formulario='forms/form_lista_personas_gym.php';
        break;
        case "eliminar_vehiculo_persona":
              /***************includes******************/
              include('../lib/DB_Conectar.php');
              include('classes/consultas.php');
              include 'header.php';

              include "nav.php";

              include 'menu.php';

              /*********************/
              $consultas->eliminar_vehiculo_persona($_REQUEST['id_relacion']);
              $mensaje="La operacion se realizo correctamente.";
              $marcas= $consultas->getMarcas();

              $autoCliente= $consultas->getAutoByPersona($_REQUEST['id_persona']);

              $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);

              $formulario='forms/form_personas.php';
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
            $marcas= $consultas->getMarcas();
            $formulario='forms/form_personas.php';
        break;
        case "edita_persona":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';
            $marcas= $consultas->getMarcas();

            $autoCliente= $consultas->getAutoByPersona($_REQUEST['id_persona']);

            $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);
            //$planes= $consultas->getPersonasbyid($_REQUEST['id_persona']);

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

        /************marcas***************/
        case "listar_marcas":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getMarcas();

            $formulario='forms/form_lista_marcas.php';
            break;
        case "carga_marcas":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            $formulario='forms/form_marcas.php';
            break;
        case "guardar_marca":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $id_producto = $consultas->save_marca($_REQUEST);
            //borrar_relacion($id_producto);
            $result = $consultas->getMarcas();
            /*********************/
            $mensaje="La operacion se realizo correctamente.";
            $formulario='forms/form_lista_marcas.php';
            break;
        case "edita_marca":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getMarcabyid($_REQUEST['id_marca']);
            $formulario='forms/form_marcas.php';
        break;
        /*****************************/
        case "lista_relaciones":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            $productos= $consultas->getproductos();
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

          //  include('../lib/DB_Conectar.php');
            //include('classes/consultas.php');
            //print_r($_SESSION);
            //include 'header.php';
            $_REQUEST['dominio']=$_SESSION[dominio];
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
            /**********problemas***********/
            $problemas= $consultas->getProblemas();
            $problemas_persona= $consultas->getProblemasByPersona($_REQUEST['id_persona']);

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
            case "listar_turnos_pelu":
                   // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getTurnosClientes();

                $formulario='forms/form_lista_turnos_pelu.php';
            break;
        case "listar_turnos":
               // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getTurnos();

            $formulario='forms/form_lista_turnos.php';
        break;
        case "cancelar_turnos":
               // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');

            $result= $consultas->cancelar_turno($_REQUEST['turno']);
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getTurnos();

            $formulario='forms/form_lista_turnos.php';
        break;
        case "guardar_motivo":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            echo $consultas->save_motivo($_REQUEST);

            break;
        case "guardar_problema":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                echo $consultas->save_problema($_REQUEST);
            break;
        case "guardar_evolucion":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                //$html=array ();

                //print_r($_REQUEST);
                $id_evolucion = $consultas->save_evolucion($_REQUEST);
                $diag=explode(',', $_REQUEST['problemas_diagnosticos']) ;
                foreach ($diag as $key => $value) {
                  $consultas->save_evolucion_problemas($id_evolucion, $value);
                }
                echo  json_encode($id_evolucion);
        break;
        case "edita_estado_turno":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                $consultas->presente_turno($_REQUEST['turno'],$_REQUEST['estado']);
                echo "1";
            break;
        case "listado_turnos":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getTurnera();

                $formulario='forms/form_turnera.php';
        break;
        /************prestaciones***************/
        case "listar_prestaciones":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getPrestaciones();

            $formulario='forms/form_lista_prestaciones.php';
            break;
        case "carga_prestaciones":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            $formulario='forms/form_prestaciones.php';
            break;
        case "guardar_prestacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $id_producto = $consultas->save_prestaciones($_REQUEST);
            //borrar_relacion($id_producto);
            $result = $consultas->getPrestaciones();
            /*********************/
            $mensaje="La operacion se realizo correctamente.";
            $formulario='forms/form_lista_prestaciones.php';
            break;
        case "edita_prestacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getPrestacionesByid($_REQUEST['id_prestacion']);
            $formulario='forms/form_prestaciones.php';
        break;

        /*****************Clientes********************/
        case "guardar_cliente":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';

            $id_cliente= $consultas->save_cliente($_REQUEST);
              $mensaje="El cliente se guardo correctamente se realizo correctamente.";
            $result= $consultas->getClientes();

            $formulario='forms/form_lista_clientes.php';
        break;
        case "eliminar_clientes":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            /*********************/
            $consultas->eliminar_cliente($_REQUEST['id_cliente']);
            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getClientes();

            $formulario='forms/form_lista_clientes.php';
            break;
        case "carga_clientes":
            //echo "si bueno tibago";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            //print_r($_SESSION);
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $formulario='forms/form_clientes.php';
        break;
        case "edita_cliente":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';
            include "nav.php";
            include 'menu.php';

            $result= $consultas->getClientesByid($_REQUEST['id_cliente']);

            $formulario='forms/form_clientes.php';
        break;
        case "listar_clientes":
           // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getClientes();

            $formulario='forms/form_lista_clientes.php';
        break;
        /*******************solicitud de pedidos***************************/
        case "cargar_pedido":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $cliente= $consultas->getClientesByid($_REQUEST['id_cliente']);

            $formulario='forms/form_pedido.php';
        break;
        /*******************solicitud de pedidos***************************/
        case "guardar_pedido":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $id_pedido= $consultas->save_pedido($_REQUEST);
            foreach ($_POST['producto_reserva'] as $key => $value) {
              # code...['producto']
              $consultas->save_pedido_detalle($id_pedido, $value, $_POST['cantidad'][$key], $_POST['unidad'][$key], $_POST['precio'][$key]);
              // echo "producto ".$value." precio ".$_POST['precio'][$key]. " unidad ".$_POST['unidad'][$key]. " cantidad ".$_POST['cantidad'][$key]. "<br>";
            }
            $result= $consultas->getPedidos();
          $formulario='forms/form_lista_pedido.php';
        break;
        case "listar_pedido":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getPedidos();
          $formulario='forms/form_lista_pedidos.php';
        break;
        case "estadistica_act_personas":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            //$result= $consultas->getPedidos();
          $formulario='forms/form_estadistica_actividades.php';
        break;
        /*******************comprobantes  de prestaciones***************************/
        case "guardar_comprobante":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $id_comprobante= $consultas->save_comprobante($_REQUEST);
            foreach ($_POST['prestacion_reserva'] as $key => $value) {
              # code...['producto']
              $consultas->save_comprobante_detalle($id_comprobante, $value, $_POST['cantidad'][$key], $_POST['costo'][$key], $_POST['precio'][$key]);
            }

            $result= $consultas->getComprobantes();
          $formulario='forms/form_lista_comprobante.php';
        break;
        case "listar_comprobantes":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getComprobantes();
          $formulario='forms/form_lista_comprobantes.php';
        break;
        case "carga_comprobante":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';
            $cliente= $consultas->getClientesByid($_REQUEST['id_cliente']);
          //  $result= $consultas->getComprobanteByID();
          $formulario='forms/form_comprobante.php';
        break;
        /********************Asistencias istema de gimnacios*******************/
        case "listar_asistencias":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getAsistencias();
            //exit();
            $formulario='forms/form_lista_asistencias.php';
            break;
            /********************productos stock****************/
            case "listar_producto_stock":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getStock();
              $formulario='forms/form_lista_stock.php';
            break;
            case "cargar_stock":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

              $formulario='forms/form_producto_stock.php';
            break;
            case "guardar_producto_stock":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $consultas->save_stock($_REQUEST);
                $result = $consultas->getStock();
                /*********************/
                $mensaje="La operacion se realizo correctamente.";
             $formulario='forms/form_lista_stock.php';
            break;
            case "eliminar_relacion":
                /***************includes******************/
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                /*********************/
                $consultas->eliminar_relacion($_REQUEST['idRelacion']);
                $mensaje="Se elimino la relacion correctamente.";
                $result= $consultas->getPersonasbyid($_REQUEST['idPersona']);
                $productos= $consultas->getproductos();
                $proviene= $consultas->getProviene();
                $actividadesCliente= $consultas->getRelacionByIDCliente($_REQUEST['idPersona']);
                $formulario='forms/form_persona_gym.php';
            break;
            /*******************************cliente peluquerias*********************/
            /*****************Clientes********************/
            case "guardar_cliente_pelu":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $id_cliente= $consultas->save_cliente($_REQUEST);
                  $mensaje="El cliente se guardo correctamente se realizo correctamente.";
                $result= $consultas->getClientes();

                $formulario='forms/form_lista_clientes.php';
            break;
            case "eliminar_clientes_pelu":
                /***************includes******************/
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                /*********************/
                $consultas->eliminar_cliente($_REQUEST['id_cliente']);
                $mensaje="La operacion se realizo correctamente.";
                $result= $consultas->getClientes();

                $formulario='forms/form_lista_clientes.php';
                break;
            case "carga_clientes_pelu":
                //echo "si bueno tibago";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                //print_r($_SESSION);
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $formulario='forms/form_clientes.php';
            break;
            case "edita_cliente_pelu":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $result= $consultas->getClientesByid($_REQUEST['id_cliente']);

                $formulario='forms/form_clientes.php';
            break;
            case "listar_clientes_pelu":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getClientes();

                $formulario='forms/form_lista_clientes_pelu.php';
            break;
            /********************************************/
            /*************************************/
            case "guardar_persona_obito":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';
                //echo "holaa";
                $consultas->save_persona_obito($_REQUEST);

                $result= $consultas->getPersonasObito();

                $formulario='forms/form_lista_persona_obito.php';
            break;
            case "eliminar_persona_obito":
                /***************includes******************/
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                /*********************/
                $consultas->eliminar_persona_obito($_REQUEST['id_persona']);
                $mensaje="La operacion se realizo correctamente.";
                $result= $consultas->getPersonasObito();

                $formulario='forms/form_lista_personas_obito.php';
            break;
            case "carga_personas_obito":
                //echo "si bueno tibago";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                //print_r($_SESSION);
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $formulario='forms/form_persona_obito.php';
            break;
            case "edita_persona_obito":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';
                $paises=$consultas->getPaises();
                $cobertura=$consultas->getCobertura();
                $lugar_deceso=$consultas->getLugaresDeceso();

                $result= $consultas->getPersonaObitaByid($_REQUEST['id_persona_obito']);
                //$planes= $consultas->getPersonasbyid($_REQUEST['id_persona']);

                $formulario='forms/form_persona_obito.php';
            break;
            case "listar_personas_obito":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getPersonasObito();

                $formulario='forms/form_lista_persona_obito.php';
            break;
            case "guardar_pais":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                echo $consultas->save_pais($_REQUEST);

                break;
            case "guardar_lugar":
                    include('../lib/DB_Conectar.php');
                    include('classes/consultas.php');
                    echo $consultas->save_lugar_deceso($_REQUEST);
            break;
            
            case "listar_servicios":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getServicios();

                $formulario='forms/form_lista_servicios.php';
            break;
            case "cargar_servicio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $preparador= $consultas->getPreparador();
                $tipo_ataud= $consultas->getTipoAtaud();
                $formulario='forms/form_servicio.php';
            break;
            case "listar_solicitantes":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getSolicitantes();

                $formulario='forms/form_lista_solicitantes.php';
            break;
            case "edita_solicitante":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $result= $consultas->getSolicitanteByID($_REQUEST['id_solicitante']);
                $formulario='forms/form_solicitante.php';
            break;
            case "listar_garantes":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getGarantes();

                $formulario='forms/form_lista_garantes.php';
            break;
            case "guardar_garante":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $consultas->save_persona_garante($_REQUEST);

                $result= $consultas->getGarantes();

                $formulario='forms/form_lista_garantes.php';
            break;
            case "guardar_solicitante":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $consultas->save_persona_solicitante($_REQUEST);

                $result= $consultas->getSolicitantes();

                $formulario='forms/form_lista_solicitantes.php';
            break;
            case "guardar_servicio":
            // print_r($_REQUEST);
            // exit;
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';
                include "nav.php";
                include 'menu.php';

                $id_servicio=$consultas->save_servicio($_REQUEST);
                if($_REQUEST['id_servicio']==null){
                    if($_REQUEST['entrega']>0){
                        $_REQUEST['monto']=$_REQUEST['entrega'];
                        $_REQUEST['id_servicio']=$id_servicio;
                        $_REQUEST['numero_pago']=1;
                        $id_pago_servicio=$consultas->save_pago_servicio($_REQUEST);
                    ?>
                        <script type="text/javascript">
                            imprimir_pago_servicio('<?php echo $id_pago_servicio; ?>')
                           //imprimir_('<?php echo $v->id_servicio; ?>')
                        </script>    
                          
                    <?php 
                    }
                } 
                $result= $consultas->getServicios();

                $formulario='forms/form_lista_servicios.php';
            break;
           /*********************ATAUD*******************/
            case "listar_tipo_ataud":
           
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include 'header.php';

            include "nav.php";

            include 'menu.php';

            $result= $consultas->getTipoAtaud();

            $formulario='forms/form_lista_tipo_ataud.php';
            break;
            case "listar_ataud":
           
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getAtaud();

                $formulario='forms/form_lista_ataud.php';
            break;

            case "carga_tipo_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $formulario='forms/form_tipo_ataud.php';
            break;
            case "cargar_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $tipo = $consultas->getTipoAtaud();

                $formulario='forms/form_ataud.php';
            break;
            
            case "guardar_tipo_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $consultas->save_tipo_ataud($_REQUEST);
                //borrar_relacion($id_producto);
                $result = $consultas->getTipoAtaud();
                /*********************/
                $mensaje="La operacion se realizo correctamente.";
                $formulario='forms/form_lista_tipo_ataud.php';
                break;

             case "guardar_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $consultas->save_ataud($_REQUEST);
                //borrar_relacion($id_producto);
                $result = $consultas->getAtaud();
                /*********************/
                $mensaje="La operacion se realizo correctamente.";
                $formulario='forms/form_lista_ataud.php';
                break;   
            case "edita_tipo_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getTipoAtaudByid($_REQUEST['id_tipo_ataud']);
                $formulario='forms/form_tipo_ataud.php';
            break;
            case "edita_ataud":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $tipo = $consultas->getTipoAtaud();
                $result= $consultas->getAtaudByid($_REQUEST['id_ataud']);
                $formulario='forms/form_ataud.php';
            break;
            case "edita_servicio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $tipo_ataud= $consultas->getTipoAtaud();
                $preparador= $consultas->getPreparador();

                $result= $consultas->getServicioByid($_REQUEST['id_servicio']);
                /******************todo con respecto a ala ataud**************/
                $ataud= $consultas->getAtaudByid($result->id_ataud);
                $cementerio=$consultas->getLugar_CM_CR($result->cementerio_cremacion);
                /******************todo con respecto a ala ataud**************/
                
                $formulario='forms/form_servicio.php';
            break;
            case "guardar_preparador":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                echo $consultas->save_preparador($_REQUEST);

            break;
            case "guardar_cementerio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                echo $consultas->save_lugar_servicio($_REQUEST);

            break;
            case "carga_pago_servicio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
                $result= $consultas->getServicioByid($_REQUEST['id_servicio']);
                $solicitante= $consultas->getSolicitanteByID($result->id_solicitante);
                $garante= $consultas->getSolicitanteByID($result->id_garante);
                
                $formulario='forms/form_pago_servicio.php';
            break;
            case "guardar_pago_servicio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';
// exit;
                $numero_pago=$consultas->getNumeroPagosServicios($_REQUEST['id_servicio']);
                $_REQUEST['numero_pago']=$numero_pago+1;
                $id_pago_servicio=$consultas->save_pago_servicio($_REQUEST);
                $servicio= $consultas->getServicioByid($_REQUEST['id_servicio']);
                $saldo=$servicio->saldo - $_REQUEST['monto'];
                $consultas->update_saldo_servicio($_REQUEST['id_servicio'], $saldo)
                ?>
                <script type="text/javascript">
                    imprimir_pago_servicio('<?php echo $id_pago_servicio; ?>')
                </script>    
                    
                <?php
                $result= $consultas->getServicios();

                $formulario='forms/form_lista_servicios.php';
            break;
            case "listar_pagos_servicios":
               // echo "bueno";
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                include 'header.php';

                include "nav.php";

                include 'menu.php';

                $result= $consultas->getPagosServicios();

                $formulario='forms/form_lista_pagos_servicios.php';
            break;
            case "borrar_pago_servicio":
                include('../lib/DB_Conectar.php');
                include('classes/consultas.php');
                
                $consultas->update_baja_pago_servicio($_REQUEST['idPagoServicio']);
                
            break;

    }

if($formulario){
    include($formulario);
}
//include 'footer.php';
?>
