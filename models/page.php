<?php
class PageModel extends Model {
	public $error;

	public function __construct(){
		parent::__construct();
	}

/*
	public function addpage($param){
		$sql = "INSERT INTO ".$this->table." (title,body,adddate,moddate) VALUES(?,?,now(),now())";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['title'],$param['body']));
	}

	public function editpage($param){
		$sql = "UPDATE ".$this->table." SET title = ?,body = ?,moddate = now() WHERE id = ?";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['title'],$param['body'],$param['id']));
	}
	public function deletepage($param) {
		$sql = "DELETE FROM ".$this->table." WHERE id = ?";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['id']));
	}
	public function getpage($param){
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." where id = ?";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['id']));
		return $sth->fetch();
	}
*/

	public function getpages($param){
                $num_per_page = $param['n'];
                $page = $param['p'];
		$start = ($page-1)*$num_per_page;
		//$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s ORDER BY adddate DESC limit 10",$this->table."");
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." ORDER BY adddate DESC limit $start,$num_per_page";
		$sth = $this->dbh->query($sql);
		return $sth->fetchAll();
		/*
		$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s ORDER BY adddate DESC limit %s,%s",$this->table."",m($start),m($num_per_page));
		$result = mysql_query($sql,$this->db);
		$pages = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($pages,$row);
		}
		return $pages;
		*/
	}

	public function getrecentpages(){
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." ORDER BY adddate DESC limit 10";
		$sth = $this->dbh->query($sql);
		return $sth->fetchAll();

		/*
		$result = mysql_query($sql,$this->db);
		$pages = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($pages,$row);
		}
		return $pages;
		*/
	}


	public function validate($param) {
		if ($param['title'] == "") {
			$error['title'] = "title is null";
		}
		if ($param['body'] == "") {
			$error['body'] = "body is null";
		}
		$this->error = $error;
		if ($error) {
			return false;
		} else {
			return true;
		}
	}
}
?>
