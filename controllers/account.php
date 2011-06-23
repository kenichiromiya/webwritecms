<?php
include_once("controllers/cms.php");
include_once("models/account.php");

class AccountController extends CMSController
{

        public $accountmodel = '';
	public $template = '';
        public $var = '';

        public function __construct() {
		parent::__construct();
		$this->param['username'] = isset($this->param['username']) ? $this->param['username'] : $this->param['id'];

                $this->accountmodel = new AccountModel();

		$this->auth();
        }


        public function put() {
                $this->accountmodel->addaccount($this->param);
                header("Location:".$this->var['base']."account/admin/");
        }

        public function post() {
                $this->accountmodel->editaccount($this->param);
                header("Location:".$this->var['base']."account/admin/");
        }

        public function delete() {
                $this->accountmodel->deleteaccount($this->param);
                header("Location:".$this->var['base']."account/admin/");
        }

	public function get(){
		if ($this->param['a'] == "edit") {
                        if ($this->param['id']) {
				$account = $this->accountmodel->getaccount($this->param);
                                $this->var['_method'] = "post";
                        } elseif($this->param['a'] == "edit") {
                                $account = array('username'=>'','role'=>'');
                                $this->var['_method'] = "put";
                        }
			$this->var['account'] = $account;
			$this->var['main'] = $this->template->getcontents("account/edit.php",$this->var);
		} elseif ($this->param['a'] == "admin") {
			$this->var['accounts'] = $this->accountmodel->getaccounts();
			$this->var['main'] = $this->template->getcontents("account/account.php",$this->var);
		}
		$this->template->display("admin/index.php",$this->var);
	}
}
?>
