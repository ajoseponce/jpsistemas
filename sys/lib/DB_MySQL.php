<?php
class TRecordset
{
		var $fields_by_name;
		var $fields_by_type;
		var $fields_by_flag;
		var $cur=0;
		var $numfields;
		var $numrows;
		var $fieldname;
		var $eof;

		function Close()
		{
			if ($this->cur) @mysql_free_result($this->cur);
		}

		function MoveFirst()
		{
			$this->MoveRow(0);
		}

		function MoveRow($index)
		{
			if(!mysql_data_seek($this->cur,$index))
				$this->eof = true;
			else
			{
				$this->numrows = @mysql_num_rows($this->cur);
				$this->eof = false;
				$this->MoveNext();
			}
		}

		function MoveNext()
		{
			$data=@mysql_fetch_row($this->cur);
			if (isset($data[0]))
			{
				for ($i=0;$i<mysql_num_fields($this->cur);$i++)
				{
					$n_m=strtoupper(mysql_field_name($this->cur, $i));
					$this->fields_by_name[$n_m]=$data[$i];
					$this->fields_by_type[$n_m]=mysql_field_type($this->cur, $i);
					$this->fields_by_flag[$n_m]=explode(" ",mysql_field_flags($this->cur, $i));
				}
				$this->numrows = mysql_num_rows($this->cur);
				$this->eof = false;
			}
			else
			{
				if ($this->cur) $this->numrows=@mysql_num_rows($this->cur);
				$this->eof = true;
			}
		}

		function ReturnId()
		{
			return mysql_insert_id();
		}

		function Field($id)
		{
			return $this->fields_by_name[strtoupper($id)];
		}

		function FieldType($id)
		{
			return $this->fields_by_type[strtoupper($id)];
		}

		function FieldFlag($id)
		{
			return $this->fields_by_flag[strtoupper($id)];
		}

		function AffectedRow()
		{
			return mysql_affected_rows($this->cur);
		}

		function Display()
		{
			echo "<table border=1 cellspacing=0 cellpadding=0>\n<tr>";
			for ($i=0; $i < $this->numfields; $i++) echo "<th nowrap>" . $this->fieldname[$i] . "</th>";
			echo "</tr>\n";

			for(;!$this->eof;$this->MoveNext())
			{
				echo "<tr>";
				for ($i=0; $i< $this->numfields; $i++) echo "<td nowrap>&nbsp;" . $this->field($this->fieldname[$i]) . "</td>";
				echo "</tr>\n";
			}
			echo "</table>\n";
		}
}

class TConnection
{
		var $conn=0;
		var $rs;

		function Connect($host, $user, $password, $db="")
		{
			$this->conn = @mysql_connect($host, $user, $password);
			if ($this->conn && $db) mysql_select_db($db, $this->conn);
			return $this;
		}

		function Disconnect()
		{
			if ($this->conn) mysql_close($this->conn);
		}

		function Execute($sqlstat)
		{
			$this->rs = new TRecordset;
			if ($this->conn) $this->rs->cur = mysql_query($sqlstat, $this->conn);
			if ($this->rs->cur)
			{
				$this->rs->numfields = @mysql_num_fields($this->rs->cur);
				for ($i=0; $i < $this->rs->numfields; $this->rs->fieldname[$i]=mysql_field_name($this->rs->cur, $i),$i++);
				$this->rs->MoveNext();
			}
			return ($this->rs->cur)?$this->rs:false;
		}

		function start_transaction()
		{
			return $this->Execute("START TRANSACTION");
		}

		function commit()
		{
			return $this->Execute("COMMIT");
		}

		function rollback()
		{
			return $this->Execute("ROLLBACK");
		}

		function errmsg()
		{
			return @mysql_error();
		}

		function errnro()
		{
			return @mysql_errno();
		}

		function info()
		{
			return @mysql_info();
		}
}

?>