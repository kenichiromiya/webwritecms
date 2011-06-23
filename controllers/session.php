<?php
include_once("controllers/cms.php");
include_once("models/account.php");
include_once("models/session.php");

class SessionController extends CMSController
{
        public $accountmodel = '';
	public $template = '';
        public $var = '';

        public function __construct() {
		parent::__construct();
                $this->accountmodel = new AccountModel();
		/*
		$session = $this->sessionmodel->getsession();
		if(!$session['username']){
			$done = getdone();
			$base = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']);
			header("Location:".$base."/session/?done=$done");
		}
		*/
        }

	public function post() {
		if($this->var['session']['username']){
			header("Location:index.php?c=admin");
		}

		if ($this->accountmodel->authaccount($this->param)){
			$this->sessionmodel->deletesession();

			$this->sessionmodel->addsession($this->param);
			if ($this->param['done']) {
				header("Location:".urldecode($this->param['done']));
			} else {
				header("Location:".$this->var['base']);
			}
		} else {
			echo 'NG';
		}
	}

	public function delete() {
		$this->sessionmodel->deletesession();
		include("views/session/logout.php");
	}

	public function get(){
		$this->var['done'] = $this->get['done'];
		$this->var['contents'] = $this->template->getcontents("views/session/login.php",$this->var);

		$this->template->display("views/session/index.php",$this->var);
	}
}
?>
