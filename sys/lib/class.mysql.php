<?php 

/**
* @package PHP Framework
* @copyright Copyright (C) 2009. All rights reserved.
* @version 1.1
*/


class MySQL {
    var $host;
    var $dbUser;
    var $dbPass;
    var $dbName;
    var $dbConn;
    var $connectError;
		/*var $errorMsg;
                var $errorNro;*/

    function MySQL($con_server,$con_dbase,$con_userid,$con_password) {
    	$this->host 	= $con_server;
        $this->dbUser 	= $con_userid;
        $this->dbPass	= $con_password;
        $this->dbName	= $con_dbase;
        $this->connect();
    }

    function connect() {
    // Make connection to MySQL server
    //if ( !$this->dbConn = @mysql_connect($this->host, $this->dbUser, $this->dbPass) ){
        if ( !$this->dbConn = mysqli_connect($this->host, $this->dbUser, $this->dbPass, $this->dbName) ) {
            die(mysqli_connect_error().". The class can't connect with the DB");
        }
        mysqli_query($this->dbConn, "SET NAMES 'utf8'");
        return true;
    }

        function autocommit($bool) {
            mysqli_autocommit($this->dbConn, $bool);
        }
        function commit() {
            mysqli_commit($this->dbConn);
            $this->autocommit(true);
        }
        function rollback() {
            mysqli_rollback($this->dbConn);
            $this->autocommit(true);
        }


	function setError() {
        $nro=mysqli_errno($this->dbConn);
        if($nro!=0)
            echo mysqli_error($this->dbConn);
    }

 /*   function setError() {
        $nro=mysqli_errno($this->dbConn);
        if($nro!=0)
            $this->Error->setTemporalError('', LEVEL_ERROR_FATAL, mysqli_error($this->dbConn),$nro);
    }*/

    function query($sql) {
        mysqli_query($this->dbConn, "SET NAMES 'utf8'");
        if ( !$this->query = @mysqli_query($this->dbConn, $sql) ) {
            $this->setError();
            return false;
        }
        //$this->errorMsg = 'Query failed: ' . mysql_error($this->dbConn) . ' SQL: ' . $sql;
        return $this->query;
    }

    function MySQLResult(& $mysql,$query) {
        $this->mysql	=	& $mysql;
        $this->query	=	$query;
    }

    function fetchRow($query) {
        if ($row = $query->fetch_assoc()){
            return $row;
        }
        else
            return false;
    }

    function select($sql) {
        mysqli_query($this->dbConn, "SET NAMES 'utf8'");
        if (!$query = mysqli_query($this->dbConn,$sql)) {
            $this->setError();
            //$this->errorMsg = 'Query failed: ' . mysql_error($this->dbConn) . ' SQL: ' . $sql;
            return false;
        }
        if(mysqli_affected_rows($this->dbConn)>0) {  //        if ( @mysql_num_rows($query) > 0 ) {
            $resultado = array();
            while ( $row = $query->fetch_row(MYSQL_ASSOC) ) {
                $auxRow = array();
                foreach($row as $key => $value)
                    $auxRow[$key] = stripslashes($value);
                array_push($resultado,$auxRow);
            }
        }
        else {
            $this->setError();
            return false;
        }
        return $resultado;
    }

    function numRows($query) {
        return mysqli_affected_rows($this->dbConn);
    }

    function numFields($query) {
        return mysqli_field_count($this->dbConn);
    }
/*
    function fetchField($query,$i) {
        if ( mysql_field_flags($query,$i) == "primary_key" ) {
            $row	=	@mysql_field_name($query,$i);
            $rs	=	array($row,1);
            return $rs;
        }
        if ( $row = @mysql_field_name($query,$i) ) {
            $rs = array($row,0);
            return $rs;
        }
        else if ( $this->numFields($query) > 0 ) {
                @mysql_data_seek($query,0);
                return false;
            }
            else
                return false;
    }*/

    function insertID() {
        return mysqli_insert_id($this->dbConn);
    }
/*
    function insert($strSQL,$getLastID = true) {
    // Funcion para realizar consultas insert, si la consulta pasada como parametro no es
    // una consulta insert se termina la ejecucion y se informa el error.
    // Si la consulta se realiza con exito y el parametro $getLastId = false, se retorna
    // true en caso de haber podido realizar la insersion y false en caso contrario.
    // Si la consulta se realiza con exito y el parametro $getLastId = true, se retorna el
    // id de la ultima insersion.

        if ( strtolower(substr(trim($strSQL),0,6)) != "insert" )
            die ("An error has happened in the insert function in MySQL class. "
                ."A INSERT query was expected <br/> The query was $strSQL" );

        $this->connect();

        $resource = @mysql_query($strSQL);
        if ( !$resource ) {
            $mysql_error = mysql_error();
            // 				$this->close();
            die ("An error has happened in the insert function in MySQL class. "
                ."$mysql_error <br/> The query was $strSQL" );
        }

        $this->rows		=	NULL;
        $this->lastOperation	=	'insert';
        $this->numOfRows	=	0;
        $this->actualRow	=	0;

        if ( $getLastID == false )
            return true;
        else {
            $lastID = mysql_insert_id();
            return $lastID;
        }
    }

    function update($strSQL) {
    // Funcion para realizar consultas update, si la consulta pasada como parametro no es
    // una consulta update se termina la ejecucion y se informa el error.
    // Si la consulta se realiza con exito esta funcion retorna el numero de filas afectadas
    // por esta actualizacion (solo el numero de filas realmente actualizadas, y no aquellas que
    // cumplan con la clausula WHERE y posean el mismo valor que el valor a actualizar)

        if ( strtolower(substr(trim($strSQL),0,6)) != "update" )
            die ("An error has happened in the update function in MySQL class. "
                ."A UPDATE query was expected <br/> The query was $strSQL" );

        $this->connect();

        $resource = @mysql_query($strSQL);
        if ( !$resource ) {
            $mysql_error = mysql_error();
            // 				$this->close();
            die ("An error has happened in the update function in MySQL class. "
                ."$mysql_error <br/> The query was $strSQL" );
        }
        $affectedRows		=	mysql_affected_rows();
        $this->rows		=	NULL;
        $this->lastOperation	=	'update';
        $this->numOfRows	=	0;
        $this->actualRow	=	0;
        return $affectedRows;
    }

    function delete($strSQL) {
    // Funcion para realizar consultas delete, si la consulta pasada como parametro no es
    // una consulta delete se termina la ejecucion y se informa el error.
    // Si la consulta se realiza con exito esta funcion retorna el numero de filas eliminadas

        if ( strtolower(substr(trim($strSQL),0,6)) != "delete" )
            die ("An error has happened in the delete function in MySQL class. "
                ."A DELETE query was expected <br/> The query was $strSQL" );

        $this->connect();

        $resource = @mysql_query($strSQL);
        if ( !$resource ) {
            $mysql_error = mysql_error();
            die ("An error has happened in the delete function in MySQL class. "
                ."$mysql_error <br/> The query was $strSQL" );
        }
        $affectedRows		=	mysql_affected_rows();
        $this->rows		=	NULL;
        $this->lastOperation	=	'delete';
        $this->numOfRows	=	0;
        $this->actualRow	=	0;
        return $affectedRows;
    }
 
 */
    
	/**
	* This global function loads the first row of a query into an object
	*
	* @access	public
	* @return 	object
	*/
	function loadObject( $sql )
	{
		if (!($cur = $this->query($sql))) {
			return null;
		}
		$ret = null;
		if ($object = mysqli_fetch_object( $cur )) {
			$ret = $object;
		}
		mysqli_free_result( $cur );
		return $ret;
	}

	/**
	* Load a list of database objects
	*
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*
	* @access	public
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadObjectList( $sql, $key='' )
	{
		if (!($cur = $this->query($sql))) {
			return null;
		}
		$array = array();
		while ($row = mysqli_fetch_object( $cur )) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		mysqli_free_result( $cur );
		return $array;
	}
	
	/**
	 * Get a database escaped string
	 *
	 * @param	string	The string to be escaped
	 * @param	boolean	Optional parameter to provide extra escaping
	 * @return	string
	 * @access	public
	 * @abstract
	 */
	function getEscaped( $text, $extra = false )
	{
		$result = mysql_real_escape_string( $text, $this->_resource );
		if ($extra) {
			$result = addcslashes( $result, '%_' );
		}
		return $result;
	}	
    
}

?>