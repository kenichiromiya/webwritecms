<?php
include_once("controllers/cms.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class ConfigController extends CMSController
{
	public $configmodel;

        public function __construct() {
		parent::__construct();

		$this->auth();
        }

	public function put() {
	}

	public function post() {
                $this->configmodel->editconfig($this->param);
                header("Location:".$this->var['base']."config/admin/");
        }

        public function delete() {
                $this->configmodel->deleteconfig($this->param);
                header("Location:".$this->var['base']."config/admin/");
	}

	public function get() {
                if ($this->param['action'] == "edit") {
			$this->var['_method'] = "post";
                        $this->var['main'] = $this->template->getcontents("config/edit.php",$this->var);
                } elseif ($this->param['action'] == "admin") {
                        $this->var['main'] = $this->template->getcontents("config/config.php",$this->var);

                }
                $this->template->display("admin/index.php",$this->var);
	}
}
?>
