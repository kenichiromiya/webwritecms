<?php
include_once("models/cms.php");

class PageModel extends CMSModel {

	public function __construct(){
		parent::__construct();
	}

	public function addpage($param){
		$query = sprintf("INSERT INTO %s (title,body,adddate,moddate) VALUES('%s','%s',now(),now())",TABLE_PREFIX."page",m($param['title']),m($param['body']));
		mysql_query($query,$this->db);
	}

	public function editpage($param){
		$query = sprintf("UPDATE %s SET title = '%s',body = '%s',moddate = now() WHERE id = '%s'",TABLE_PREFIX."page",m($param['title']),m($param['body']),m($param['id']));
		mysql_query($query,$this->db);
	}
	public function getpage($param){
		$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s where id = '%s'",TABLE_PREFIX."page",m($param['id']));
		$result = mysql_query($sql,$this->db);
		$page=mysql_fetch_assoc($result);

		return $page;
	}

	public function getpages($param){
                $num_per_page = $param['n'];
                $page = $param['p'];
		$start = ($page-1)*$num_per_page;
		//$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s ORDER BY adddate DESC limit 10",TABLE_PREFIX."page");
		$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s ORDER BY adddate DESC limit %s,%s",TABLE_PREFIX."page",m($start),m($num_per_page));
		$result = mysql_query($sql,$this->db);
		$pages = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($pages,$row);
		}
		return $pages;
	}

	public function getrecentpages(){
		$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s ORDER BY adddate DESC limit 10",TABLE_PREFIX."page");
		$result = mysql_query($sql,$this->db);
		$pages = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($pages,$row);
		}
		return $pages;
	}

	public function deletepage($post) {
		$query = sprintf("DELETE FROM %s WHERE id = '%s'",TABLE_PREFIX."page",m($post['id']));
		mysql_query($query,$this->db);
	}
}
?>
