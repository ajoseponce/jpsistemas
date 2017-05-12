<?php
//************************* DECLARACION DE GLOBALES *******************************//
//$DATENOW = date("Y-m-d H:i:s");
$CONN_DEFAULT = 0;
//$DOCUMENT_ROOT = '/src/';
//$SEARCH_DOMAIN = '1';
//global $DOCUMENT_ROOT;
//global $SEARCH_DOMAIN;
//*********************************************************************************//

//************************* DECLARACION DE CONECCION ******************************//
$con_server[0]	=  "localhost";
$con_userid[0] =   "root";
$con_password[0] = "root";
$con_dbase[0]    = "c0580050_jp";

//************************* DECLARACION DE CONECCION ******************************//
//$con_server[0]	=  "10.11.11.50";
//$con_userid[0] =   "";
//$con_password[0] = "";
//$con_dbase[0]    = "bstb";
////*********************************************************************************//

//******************************** INCLUDES ***************************************//
include_once("DB_MySQL.php");
include_once("class.mysql.php");
include_once("class.error.php");
include_once("class.table.php");
//*********************************************************************************//

$conn=new TConnection();
$conn->Connect($con_server[$CONN_DEFAULT], $con_userid[$CONN_DEFAULT], $con_password[$CONN_DEFAULT], $con_dbase[$CONN_DEFAULT]);

$db = new MySQL($con_server[0],$con_dbase[0],$con_userid[0],$con_password[0]);
$error = new Error();
$SQL_EXP = "SHOW TABLES";
$RES_EXP = $conn->execute($SQL_EXP);
?>
