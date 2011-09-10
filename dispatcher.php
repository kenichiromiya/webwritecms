<?php

class Dispatcher {
	public function __construct() {
		$this->param = Sanitizer::sanitize();
	}

	public function dispatch() {
		//$arg = $this->get['path'][0];

		//$controllername = isset($this->param['c']) ? $this->param['c'] : 'page';
		if (!file_exists("controllers/".$this->param['controller'].".php")) {
			$this->param['controller'] = "page";
		}
		include_once("controllers/".$this->param['controller'].".php");
		$classname = ucwords($this->param['controller'])."Controller";
		if (class_exists($classname)) {
			$controller =& new $classname();
			//$controller->param = $this->param;
		}
		$actionname = isset($this->param['action']) ? $this->param['action'] : "index";
		$controller->$actionname();
	}
}
?>
