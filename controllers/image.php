<?php
include_once("controllers/cms.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class ImageController extends CMSController
{
	public $imagemodel;

        public function __construct() {
		parent::__construct();

		$this->auth();
        }

	public function put() {
	}

	public function post() {
                $this->imagemodel->editimage($this->param);
                header("Location:".$this->var['base']."image/admin/");
        }

        public function delete() {
                $this->imagemodel->deleteimage($this->param);
                header("Location:".$this->var['base']."image/admin/");
	}

	public function get() {
                if ($this->param['action'] == "edit") {
			$this->var['_method'] = "post";
                        $this->var['main'] = $this->template->getcontents("image/edit.php",$this->var);
                } elseif ($this->param['action'] == "admin") {
                        $this->var['main'] = $this->template->getcontents("image/image.php",$this->var);

                }
                $this->template->display("admin/index.php",$this->var);
	}
}
?>
