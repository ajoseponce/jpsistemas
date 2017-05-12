<?php

/**
 * @package PHP Framework
 * @copyright Copyright (C) 2009. All rights reserved.
 * @version 1.1
 */

class Table {
	var $DB;
	var $table = NULL;
	var $primary_key = NULL;
	var $id = NULL;
	var $debug = false;
	var $fields = array ();
	
	function Table(&$DB, $table = NULL) {
		$this->DB = &$DB;
		$this->table = $table;
		if ($this->table == NULL)
			die ( 'A table must be supplied as an argument to the contructor.' );
		$this->clear ();
	}
	
	function clear() {
		$this->fields = array ();
		$this->id = NULL;
		$this->primary_key = NULL;
		
		// describe the table in a query result
		$sql = "DESCRIBE $this->table";
		$result = $this->DB->query ( $sql );
		// loop through all the columns
		while ( $row = $this->DB->fetchRow ( $result ) ) {
			// set object variables = default value in database
			$this->$row ['Field'] = $row ['Default'];
			// add field to fields array
			array_push ( $this->fields, $row ['Field'] );
			// set primary key
			if ($row ['Key'] == 'PRI')
				$this->primary_key = $row ['Field'];
		}
	}
	
	function setDebug($val) {
		$this->debug = $val;
	}
	
	function find($id) {
		$sql = "SELECT * FROM $this->table WHERE $this->primary_key = '$id' LIMIT 1";
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		if ($this->DB->numRows ( $result ) > 0) {
			$this->id = $id;
			// found - set all class variables to row values
			$row = $this->DB->fetchRow ( $result );
			foreach ( $row as $field_name => $field_value ) {
				$this->$field_name = $field_value;
			}
			return true;
		} else {
			$this->clear ();
			return false;
		}
	}
	
	function find2($id) {
		$sql = "SELECT * FROM $this->table WHERE $this->primary_key = '$id' LIMIT 1";
		$result = $this->DB->query ( $sql );
		if ($this->DB->numRows ( $result ) > 0) {
			$this->id = $id;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * @author Long, Sebastian
	 * @version 1.0
	 * @return <array/empty>
	 * @
	 */
	function findCount($where = '', $orderby = '', $other = '') {
		$sql = "SELECT COUNT(DISTINCT `" . $this->table . "`.id) as amount FROM $this->table $where $orderby $other";
		$result = $this->DB->query ( $sql );
		if ($this->DB->numRows ( $result ) != 1)
			return false;
		else {
			$row = $this->DB->fetchRow ( $result );
			return $row ["amount"];
		}
	}
	
	function findMany($where = '', $orderby = '', $other = '') {
		$all = array ();
		//			$sql = "SELECT ".$this->table.".".$this->primary_key." FROM $this->table $where $orderby $other";
		$sql = "SELECT DISTINCT " . $this->table . ".* FROM $this->table $where $orderby $other";
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		if ($this->DB->numRows ( $result ) > 0) {
			while ( $row = $this->DB->fetchRow ( $result ) ) {
				$t = '';
				foreach ( $row as $k => $v ) {
					$t->$k = $v;
				}
				/* modified to optimized the code
					$t =& new table($this->DB, $this->table);
					$row[$this->primary_key];
					$t->find($row[$this->primary_key]);
					$all[] = $t;
                    */
				$all [] = $t;
			
			}
			return $all;
		} else {
			return false;
		}
	}
	
	function updateAttr($attr, $id = NULL) {
		// if $id is not null, then set the variable id to it and
		// set all the other class variables with a find() call
		if ($id != NULL) {
			$this->id = $id;
			$this->find ( $id );
		}
		
		// if its an array then loop through and create the sql
		if (is_array ( $attr )) {
			$sql = "UPDATE $this->table SET ";
			foreach ( $attr as $key => $val ) {
				// under no circumstance update the primary key
				if ($this->primary_key != $attr) {
					$sql .= "`$key` = '" . $val . "',";
					$this->$key = $val;
					#changed by Ernesto by not use allways the clase table
				/*$sql .= "$key = '".addslashes($val)."',";
						$this->$key = addslashes($val);*/
				}
			}
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 ); // remove trailing comma
			$sql .= " WHERE $this->primary_key = $this->id";
			$result = $this->DB->query ( $sql );
			if ($result == false)
				return false;
				/*if ($this->debug)
				{
					echo '<p><strong>Update Attr SQL:</strong> ' . $sql . '</p>';
					if ($this->DB->isError())
					{
						echo $this->DB->getErrorMsg();
						return false;
					}
				}*/
			return true;
			
		// else it won't work so return false
		} else {
			/*if ($this->debug)
					echo '<p><strong style="color:red">Error:</strong> The function argument $attr must be an array. What you passed is not.</p>';
*/
			return false;
		}
	}
	
	function save() {
		
		if ($this->id == NULL) {
			// there hasn't been a find so we are inserting
			$sql = "INSERT INTO $this->table (`" . implode ( '`, `', $this->fields ) . "`) VALUES (";
			
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "'" . addslashes ( $this->$field ) . "',";
					else
						$sql .= "NULL,";
				} else {
					if ($this->$field == '')
						$sql .= "NULL,";
					else
						$sql .= "'" . addslashes ( $this->$field ) . "',";
				}
			}
			
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= ")"; //var_dump($sql);
			if ($this->DB->query ( $sql )) {
				$this->find ( $this->DB->insertID () );
				return true;
			} else
				return false;
		} else {
			// update
			$sql = "UPDATE $this->table SET ";
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "`$field`='" . addslashes ( $this->$field ) . "' ,";
					else
						$sql .= "`$field`=NULL,";
				}
			}
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= " WHERE $this->primary_key = '$this->id' LIMIT 1";
			return $this->DB->query ( $sql );
		}
	}
	
	function save2() {
		
		if ( ! $this->find2($this->id) ) {
			// there hasn't been a find so we are inserting
			$sql = "INSERT INTO $this->table (`" . implode ( '`, `', $this->fields ) . "`) VALUES (";
			
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "'" . addslashes ( $this->$field ) . "',";
					else
						$sql .= "NULL,";
				} else {
					if ($this->$field == '')
						$sql .= "NULL,";
					else
						$sql .= "'" . addslashes ( $this->$field ) . "',";
				}
			}
			
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= ")"; 
			if ($this->DB->query ( $sql )) {
				$this->find ( $this->DB->insertID () );
				return true;
			} else
				return false;
		} else {
			// update
			$sql = "UPDATE $this->table SET ";
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "`$field`='" . addslashes ( $this->$field ) . "' ,";
					else
						$sql .= "`$field`=NULL,";
				}
			}
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= " WHERE $this->primary_key = '$this->id' LIMIT 1";
			return $this->DB->query ( $sql );
		}
	}
	
	function save_temp() {
		// there hasn't been a find so we are inserting
		$sql = "INSERT INTO $this->table (`" . implode ( '`, `', $this->fields ) . "`) VALUES (";
		
		foreach ( $this->fields as $field ) {
			if ($field != $this->primary_key) {
				if ($this->$field != '')
					$sql .= "'" . addslashes ( $this->$field ) . "',";
				else
					$sql .= "NULL,";
			} else {
				if ($this->$field == '')
					$sql .= "'',";
				else
					$sql .= "'" . addslashes ( $this->$field ) . "',";
			}
		}
		
		// remove trailing comma
		$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
		$sql .= ")";
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
			/*
				if ($this->debug)
				{
					echo '<p><strong>Insert SQL:</strong> ' . $sql . '</p>';
					if ($this->DB->isError())
					{
						echo $this->DB->getErrorMsg();
						return false;
					}
				}*/
		return true;
	}
	
	function returnQuerySave($id) {
		if ($this->id == NULL) {
			// there hasn't been a find so we are inserting
			$sql = "INSERT INTO $this->table (`" . implode ( '`, `', $this->fields ) . "`) VALUES (";
			
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "'" . addslashes ( $this->$field ) . "',";
					else
						$sql .= "NULL,";
				} else {
					if ($this->$field == '')
						$sql .= "'',";
					else
						$sql .= "'" . addslashes ( $this->$field ) . "',";
				}
			}
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= ")";
		} else {
			// update
			$sql = "UPDATE $this->table SET ";
			foreach ( $this->fields as $field ) {
				if ($field != $this->primary_key) {
					if ($this->$field != '')
						$sql .= "`$field`='" . addslashes ( $this->$field ) . "' ,";
					else
						$sql .= "`$field`=NULL,";
				}
			}
			// remove trailing comma
			$sql = substr ( $sql, 0, strlen ( $sql ) - 1 );
			$sql .= " WHERE $this->primary_key = $this->id LIMIT 1";
		}
		return $sql;
	}
	
	function destroy($id) {
		$sql = "DELETE FROM $this->table WHERE $this->primary_key = $id";
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		return true;
	}
	
	function deleteAllBy($where) {
		$sql = "DELETE FROM $this->table " . $where;
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		return true;
	}
	
	function disable($id) {
		$sql = "UPDATE $this->table SET status='0' WHERE $this->primary_key = $id";
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		return true;
	}
	
	function disableAllBy($where) {
		$sql = "UPDATE $this->table SET status='0' " . $where;
		$result = $this->DB->query ( $sql );
		if ($result == false)
			return false;
		return true;
	}
	
	function startTransaction() {
		$this->DB->autocommit ( false );
	}
	function commit() {
		$this->DB->commit ();
	}
	function rollback() {
		$this->DB->rollback ();
	}
	function dump() {
		echo '<pre>';
		echo '<h3>Object Dump</h3>';
		print_r ( $this );
		echo '</pre>';
	}
}
?>