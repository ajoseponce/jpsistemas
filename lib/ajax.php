<?php
										
/********************INCLUSIONES**********************/
include('DB_Conectar.php');
include('functions.php');
/*****************************************************/
if($_GET['flag'] == "A") //Si se busca una agenda, se guardan los datos en $_SESSION para utilizarlos nuevamente 
{
	session_start();
	$_SESSION["searchDescription"] = $_GET['search'];
	$_SESSION["searchId"] = $_GET['id'];
}	

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header ("Pragma: no-cache"); // HTTP/1.0

$response= ajaxPHP($_GET['search'], $_REQUEST['flag']);		

echo $response;

?>