<?php
include_once("models/session.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class SetupController extends Controller
{
	public function __construct() {
		parent::__construct();
		$base = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/";
		$this->var['base'] = $base;
        }

	public function post() {

		$define = '<?php'."\n";
		$define .= 'define("MYSQL_CONNECT_HOST","'.$this->post['host'].'");'."\n";
		$define .= 'define("MYSQL_CONNECT_USER","'.$this->post['user'].'");'."\n";
		$define .= 'define("MYSQL_CONNECT_PASS","'.$this->post['pass'].'");'."\n";
		$define .= 'define("MYSQL_DB_NAME","'.$this->post['db'].'");'."\n";
		$define .= 'define("TABLE_PREFIX","'.$this->post['prefix'].'");'."\n";
		$define .= '?>';

		file_put_contents("define.php",$define);
		$sql = file_get_contents("dump.sql");
		$sql = preg_replace("/`cmsdev_(.+)`/","`".$this->post['prefix']."$1`",$sql);
		$sqls = preg_split("/;/",$sql);
		print_r($sqls);
		$_DB = mysql_connect($this->post['host'],$this->post['user'],$this->post['pass']) or die("cannnot connect");
		mysql_select_db($this->post['db'],$_DB);
		$query = "SET NAMES utf8";
		mysql_query($query,$_DB);
		foreach ($sqls as $sql) {
			mysql_query($sql,$_DB);
		}
	}

	public function get() {
		global $_LANG;

		$this->template->display("setup/index.php",$this->var);
	}
}
?>
