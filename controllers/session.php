<?php
include_once("controller.php");
include_once("models/account.php");
include_once("models/session.php");

class SessionController extends Controller
{
        public $accountmodel = '';
	public $template = '';
        public $var = '';

        public function __construct() {
		parent::__construct();
                $this->accountmodel = new AccountModel();
		$this->sessionmodel = new SessionModel();
        }

	public function index() {
		if ($this->param['method'] == "GET") {
			$this->var['done'] = $this->get['done'];
			$this->var['contents'] = $this->view->getcontents("views/session_login.php",$this->var);

			$this->view->display("views/session.php",$this->var);
		} elseif ($this->param['method'] == "POST") {
			/*
			if($this->var['session']['username']){
				header("Location:".$this->var['base']);
			}
			*/

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
		} elseif ($this->param['method'] == "PUT") {
		} elseif ($this->param['method'] == "DELETE") {
			$this->sessionmodel->deletesession();
			include("views/session_logout.php");
		}
	}
}
?>
