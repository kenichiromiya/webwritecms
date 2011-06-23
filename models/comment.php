<?php
include_once("models/cms.php");

class CommentModel extends CMSModel {

	function __construct() {
		parent::__construct();
	}

	function addcomment($param) {
		$query = sprintf("INSERT INTO %s (entry_id,name,url,title,body,adddate) VALUES('%s','%s','%s','%s','%s',now())",TABLE_PREFIX."comment",m($param['id']),m($param['name']),m($param['url']),m($param['title']),m($param['body']));
		mysql_query($query,$this->db);

	}

	function getcomments($param) {
		$sql = sprintf("SELECT SQL_CALC_FOUND_ROWS * FROM %s WHERE entry_id = '%s' ORDER BY adddate",TABLE_PREFIX."comment",m($param['id']));
		$result = mysql_query($sql,$this->db);
		$comments = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($comments,$row);
		}
		return $comments;
	}

	function getcommentnum() {
		$sql = "SELECT FOUND_ROWS()";
		$result = mysql_query($sql,$this->db);
		$commentnum = mysql_result($result,0);
		return $commentnum;
	}
}
?>
