<?php
include_once("view.php");
include_once("validator.php");
include_once("models/config.php");
include_once("models/session.php");
/*
if(!$session['username']){
	//header("Location:".BASE_URI."login.php?done=".$_VAR['done']);
	header("Location:login.php?done=$done");
}
*/
class Controller
{
	public function __construct() {
                $this->sessionmodel = new SessionModel();
		$this->session = $this->sessionmodel->getsession();
		$this->param = Sanitizer::sanitize();
		$this->validator = new Validator();
		$this->view = new View();
                //$this->configmodel = new ConfigModel();
                $this->base = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/";
                $this->var['base'] = $this->base;
		$this->var['session'] = $this->session;

                if (preg_match("/^p(\d+)$/",$this->param['id'],$m)){
                        $this->param['p'] = $m[1];
                }
                //$this->var['config'] = $this->configmodel->getconfig();
                //$this->var['session'] = $this->sessionmodel->getsession();
	}

        public function auth() {
                if(!$this->session['username']){
                        $done = getdone();
                        header("Location:".$this->var['base']."session/?done=$done");
                }
        }

	public function index() {
		if ($this->param['method'] == "GET") {
		} elseif ($this->param['method'] == "POST") {
		} elseif ($this->param['method'] == "PUT") {
		} elseif ($this->param['method'] == "DELETE") {
		}
	}

/*
	public function loadmodel($modelname) {
		if (file_exists("models/$modelname.php")) {
			include_once("models/$modelname.php");
			$classname = ucwords($modelname)."Model";
			if (class_exists($classname)) {
				$objname = $modelname."model";
				$this->$objname =& new $classname();
			}
		}
	}
*/
}
?>
