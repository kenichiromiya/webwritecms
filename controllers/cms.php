<?php
include_once("models/config.php");
include_once("models/session.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class CMSController extends Controller
{

	public function __construct() {
		parent::__construct();
		$this->configmodel = new ConfigModel();
		$this->sessionmodel = new SessionModel();
		$this->base = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/";
		$this->var['base'] = $this->base;

		$this->var['config'] = $this->configmodel->getconfig();
		$this->var['session'] = $this->sessionmodel->getsession();

	}
	public function auth() {
		$session = $this->sessionmodel->getsession();
		if(!$session['username']){
			$done = getdone();
			header("Location:".$this->var['base']."session/?done=$done");
		}
	}

	public function put() {
	}

	public function post() {
	}

	public function get() {
	}
}
?>
