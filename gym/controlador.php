<?php
error_reporting(E_ALL);
//ini_set("display_errors", 1);
include('../lib/functions.php');
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
            include ('header.php');
            include ('menu.php');

            $id_persona= $consultas->save_persona($_REQUEST);
            $id_persona_dias = $consultas->save_dias_personas($id_persona,$_REQUEST);
            $_REQUEST['clientes']=$id_persona;
            if($_REQUEST['id_producto']){
                if($consultas->chequeaActividad($id_persona,$_REQUEST['id_producto'])){
                    $consultas->save_relaciones($_REQUEST);

                }
            }
            $mensaje="La operacion se realizo correctamente.";
            $actividadesCliente= $consultas->getRelacionByIDCliente($id_persona);
            $result= $consultas->getPersonasbyid($id_persona);
            /*********************/
            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();

            $formulario='forms/form_personas.php';
        break;
        case "eliminar_persona":
            /***************includes******************/
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include('header.php');
            include('menu.php');
            /*********************/
            $consultas->eliminar_persona($_REQUEST['id_persona']);
            $mensaje="La operacion se realizo correctamente.";
            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas.php';
            break;
        case "carga_personas":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();
            $formulario='forms/form_personas.php';
        break;
        case "edita_persona":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php'); 
            $result= $consultas->getPersonasbyid($_REQUEST['id_persona']);
            $productos= $consultas->getproductos();
            $proviene= $consultas->getProviene();
            $actividadesCliente= $consultas->getRelacionByIDCliente($_REQUEST['id_persona']);
            $formulario='forms/form_personas.php';
        break;
        case "listar_personas":
           // echo "bueno";
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php'); 
            
            $result= $consultas->getpersonas();

            $formulario='forms/form_lista_personas.php';
        break;
        /************prodccutos***************/
        case "listar_productos":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');

            $result= $consultas->getproductos();

            $formulario='forms/form_lista_productos.php';
            break;
        case "carga_productos":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
            $formulario='forms/form_productos.php';
            break;
        case "guardar_producto":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
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
            include ('header.php');
            include ('menu.php');
            $result= $consultas->getProductobyid($_REQUEST['id_producto']);
            $formulario='forms/form_productos.php';
        break;
        /*****************************/
        case "lista_relaciones":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
            $result= $consultas->getRelaciones();

            $formulario='forms/form_lista_relaciones.php';
            break;
        case "carga_relacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
            $productos= $consultas->getproductos();

            $formulario='forms/form_relacion.php';
            break;
        case "guardar_relacion":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
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
            include ('header.php');
            include ('menu.php');
            $result= $consultas->getRelacionbyid($_REQUEST['id_relacion']);
            $productos= $consultas->getproductos();
            $formulario='forms/form_relacion.php';
            break;
        /*****************************/
        case "cargar_pago":
            include('../lib/DB_Conectar.php');
            include('classes/consultas.php');
            include ('header.php');
            include ('menu.php');
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
            include ('header.php');
            include ('menu.php');

            $result= $consultas->getPagos();

            $formulario='forms/form_lista_pagos.php';
            break;
    }
   
if($formulario){    
    include($formulario);
}    
//include 'footer.php';
?>   
    