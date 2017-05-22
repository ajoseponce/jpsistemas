<?php

/**
  * Funcion destruye todas las variables de la sesion
  * @return Void
*/
function logOut(){
	session_start();
	$_SESSION = array();
	session_destroy();
    $filename = '../login.php';
    redirect($filename);
         //header('Location: index.php');
}

function checkLogin($user, $pass, $count=0){
	global $conn;

//$pass = md5($pass);

	$SQL = "SELECT COUNT(*) AS C FROM  c0580050_jp.usuarios WHERE nombre='".mysql_real_escape_string($user)."' AND clave='".mysql_real_escape_string($pass)."' AND estado='A'";
	echo $SQL;
        //exit;
        $res=$conn->Execute($SQL);
        //echo "result field".$res->field(C);
	return ($res->field(C) != $count )?true:false;
}
function redirect($filename){
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}
/**
 * Funcion que controla el login del usuario y valida la Session
 *
 * @return
 */
function requireLogin(){
    $filename = 'login.php';

	session_start();
	return (is_null($_SESSION['id']))? redirect($filename):"";
}

function ajaxPHP($descrip, $flag){

	switch($flag){
		case "A":// Busqueda de Agendas

			$res = getAgendas($id, $descrip);

			if($res->numrows != 0){
				$html = "<table cellspacing=5>";
				for(;!$res->eof; $res->movenext()){

					$html.= "<tr><td>". $res->field(ID_ATENCION) . "</td><td>". $res->field(DESCRIPCION) . "</td><td><a href='Agenda.php?AgendaID=".$res->field(ID_ATENCION)."'>[Modificar]</a></td><td> [Eliminar] </td></tr>";
				}
				$html.= "</table>";
			} else {
				$html = "No se encontraron resultados con ese criterio.";
			}
			echo $html;

		break;
                case "AP":// Busqueda de Agendas

			$res = getAplicaciones($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_aplicativo')."\", \"value\": \"".ucwords(strtolower($res->field('nombre_menu')))."\", \"info\": \" Id Aplicativo: ".ucwords(strtolower($res->field('id_aplicativo')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;


		break;
                case "TE":// Busqueda de Agendas

			$res = getTipoEquipo($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_tipo_equipo')."\", \"value\": \"".ucwords(strtolower($res->field('descripcion')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;


		break;
                case "P":// Busqueda de Lugar de Atencion
			$res=getPersonas($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_persona')."\", \"value\": \"".ucwords(strtolower($res->field('apellido')))." ".ucwords(strtolower($res->field('nombre')))."\", \"info\": \" Id Persona: ".ucwords(strtolower($res->field('id_persona')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                case "PU":// Busqueda de Lugar de Atencion
			$res=getPersonasUsuarios($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_usuario')."\", \"value\": \"".ucwords(strtolower($res->field('apellido')))." ".ucwords(strtolower($res->field('nombre')))."\", \"info\": \" Id Persona: ".ucwords(strtolower($res->field('id_persona')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                 case "Ar":// Busqueda de Lugar de Atencion
			$res=  getAreas($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_area')."\", \"value\": \"".ucwords(strtolower($res->field('descripcion')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                 case "E":// Busqueda de Lugar de Atencion
			$res=  getExamenes($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_examen')."\", \"value\": \"".ucwords(strtolower($res->field('descripcion')))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                case "Po":// Busqueda de Lugar de Atencion
			$res= getPoes($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_poe')."\", \"value\": \"".ucwords(strtolower(utf8_encode($res->field('descripcion'))))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                case "L":// Busqueda de Lugar de Atencion
			$res= getLugares($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_lugar')."\", \"value\": \"".ucwords(strtolower(utf8_encode($res->field('descripcion'))))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                case "PV":// Busqueda de Lugar de Atencion
			$res= getProveedores($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_proveedor')."\", \"value\": \"".ucwords(strtolower(utf8_encode($res->field('descripcion'))))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
                case "M":// Busqueda de Lugar de Atencion
			$res= getMarcas($descrip);

			$return = "{\"results\": [";

			if($res->numrows!=0){
				for(;!$res->eof; $res->movenext()) $arr[] = "{\"id\": \"".$res->field('id_marca')."\", \"value\": \"".ucwords(strtolower(utf8_encode($res->field('descripcion'))))."\"}";

				$return.= implode(", ", $arr);
			}

			$return.= "]}";

			return $return;

		break;
		
	}
}
function getPersonas($descrip){
	global $conn;

	$SQL="SELECT * FROM   c0580050_jp.personas WHERE CONCAT(nombre,' ',apellido) LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
function getPersonasUsuarios($descrip){
	global $conn;

	$SQL="SELECT p.*, u.id_usuario FROM   c0580050_jp.personas p "
                . " INNER JOIN usuarios u ON u.id_persona=p.id_persona"
                . " WHERE (CONCAT(p.nombre,' ',p.apellido) LIKE '%".$descrip."%') OR (p.dni='".$descrip."')";
        //echo $SQL;

	return $conn->execute($SQL);
}

function getAreas($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.areas WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
function getTipoEquipo($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.tipo_equipo WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
function getLugares($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.lugar WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
function getProveedores($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.proveedor WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}

function getMarcas($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.marcas WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
function getAplicaciones($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.aplicativos WHERE nombre_menu LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
        
function getPoes($descrip){
	global $conn;

	$SQL="SELECT pc.* FROM   c0580050_jp.poe_cabecera pc "
                . " LEFT JOIN  c0580050_jp.examen e ON e.id_poe=pc.id_poe"
                . " WHERE 1 AND pc.descripcion LIKE '%".$descrip."%'";
        return $conn->execute($SQL);
}
function getExamenes($descrip){
	global $conn;

	 $SQL="SELECT * FROM   c0580050_jp.examen WHERE descripcion LIKE '%".$descrip."%'";
        //echo $SQL;

	return $conn->execute($SQL);
}
?>