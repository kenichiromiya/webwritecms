<?php
class Model
{

	public function __construct() {
                global $_DB;
                $this->db = $_DB;
		//global $dbh;
		//$this->dbh = $GLOBALS['dbh'];
		$this->dbh = DB::connect();
		$classname = get_class($this);
		preg_match("/(.*)Model/",$classname,$m);
		$this->table = TABLE_PREFIX.strtolower($m[1]);
		$this->allow = array("now()");
	}

        function add($param) {
		$columns = $this->getcolumns();
		$fields = array();
		foreach ($columns as $column){
			array_push($fields,$column['Field']);
		}
		$colnames = array();
		$places = array();
		$values = array();
		foreach ($param as $key => $value) {
			if (in_array($key,$fields)) {
				if(in_array($value,$this->allow)) {
					array_push($colnames,$key);
					array_push($places,$value);
				} else {
					array_push($colnames,$key);
					array_push($places,"?");
					array_push($values,$value);
				}
			}
		}
		$colname = implode(",", $colnames);
		$place = implode(",", $places);
                $sql = "INSERT INTO ".$this->table." ($colname) VALUES($place)";
                $sth = $this->dbh->prepare($sql);
                $sth->execute($values);
        }

        function edit($param){
		$columns = $this->getcolumns();
		$keyfields = array();
		$fields = array();
		foreach ($columns as $column){
			if ($column['Key'] == 'PRI') {
				array_push($keyfields,$column['Field']);
			} else {
				array_push($fields,$column['Field']);
			}
		}
		$sets = array();
		$wheres = array();
		$values = array();
		foreach ($param as $key => $value) {
			if (in_array($key,$fields)) {
				if(in_array($value,$this->allow)) {
					array_push($sets,"$key = $value");
				} else {
					array_push($sets,"$key = ?");
					array_push($values,$value);
				}
			}
		}
		foreach ($param as $key => $value) {
			if (in_array($key,$keyfields)) {
				array_push($wheres,"$key = ?");
				array_push($values,$value);
			}
		}
		
		$set = implode(",", $sets);
		$where = implode(" AND ", $wheres);
                $sql = "UPDATE ".$this->table." SET $set WHERE $where";
                $sth = $this->dbh->prepare($sql);
                $sth->execute($values);
        }

        function delete($param){
		$columns = $this->getcolumns();
		foreach ($columns as $column){
			if ($column['Key'] == 'PRI') {
				$primary = $column['Field'];
			}
		}
                $sql = "DELETE FROM ".$this->table." WHERE $primary = ?";
		//echo "$sql ".$param[$primary];
		//exit;
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param[$primary]));
        }

        function get($param) {
		$columns = $this->getcolumns();
		foreach ($columns as $column){
			if ($column['Key'] == 'PRI') {
				$primary = $column['Field'];
			}
		}
                $sql = "SELECT * FROM ".$this->table." WHERE $primary = ?";
		//echo "$sql ".$param[$primary];
		//exit;
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param[$primary]));
                return $sth->fetch();
        }

	function getall() {
                $sql = "SELECT * FROM ".$this->table;
                $sth = $this->dbh->query($sql);
                return $sth->fetchAll();
	}

	function getcolumns() {
		$sql = "SHOW COLUMNS FROM ".$this->table;
                $sth = $this->dbh->query($sql);
                return $sth->fetchall();
	}

	function validate() {
	}
}
?>
