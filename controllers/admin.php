<?php
include_once("controllers/cms.php");

class AdminController extends CMSController
{
        public function __construct() {
		parent::__construct();

		/*
                $session = $this->sessionmodel->getsession();
                if(!$session['username']){
                        $done = getdone();
                        $base = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']);
                        header("Location:".$base."/session/?done=$done");
                }
		*/
		$this->auth();
        }

	public function put() {
	}
	public function post() {
	}

	public function get() {
		$this->var['main'] = $this->template->getcontents("admin/admin.php",$this->var);
		$this->template->display("admin/index.php",$this->var);
		//$_VAR = $this->var;
	}
}
?>
