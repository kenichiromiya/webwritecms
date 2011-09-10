<?php

class AccountController extends Controller
{

        public $accountmodel = '';
        public $var = '';

        public function __construct() {
		parent::__construct();
		$this->param['username'] = isset($this->param['username']) ? $this->param['username'] : $this->param['id'];

                $this->accountmodel = new AccountModel();

		$this->auth();
        }

	public function index() {
		if ($this->param['method'] == "GET") {
			$this->var['accounts'] = $this->accountmodel->getaccounts();
			$this->var['main'] = $this->view->getcontents("account_admin.php",$this->var);
			$this->view->display("account.php",$this->var);
		} elseif ($this->param['method'] == "POST") {
			$this->accountmodel->editaccount($this->param);
			header("Location:".$this->var['base']."account/");
		} elseif ($this->param['method'] == "PUT") {
			$this->accountmodel->addaccount($this->param);
			header("Location:".$this->var['base']."account/");
		} elseif ($this->param['method'] == "DELETE") {
			$this->accountmodel->deleteaccount($this->param);
			header("Location:".$this->var['base']."account/");
		}
	}

	public function edit() {
		if ($this->param['id']) {
			$account = $this->accountmodel->getaccount($this->param);
			$this->var['_method'] = "post";
		} elseif($this->param['action'] == "edit") {
			$account = array('username'=>'','role'=>'');
			$this->var['_method'] = "put";
		}
		$this->var['account'] = $account;
		$this->var['main'] = $this->view->getcontents("account_edit.php",$this->var);
		$this->view->display("account.php",$this->var);
	}
}
?>
