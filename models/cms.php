<?php
include_once("model.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class CMSModel extends Model
{
	public $db;
	public function __construct() {
		parent::__construct();
		global $_DB;
		$this->db = $_DB;
	}

}
?>
