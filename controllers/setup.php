<?php
include_once("controller.php");
include_once("models/setup.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class SetupController extends Controller
{
	public function __construct() {
                $this->param = $GLOBALS['param'];
                $this->validator = new Validator();
                $this->template = new View();
                $this->base = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/";
                $this->var['base'] = $this->base;

		$this->setupmodel = new SetupModel();
        }

	public function put() {
		$this->setupmodel->create();
	}

	public function delete() {
		$this->setupmodel->drop();
	}

	public function get() {
		$this->template->display("setup.php",$this->var);
	}
}
?>
