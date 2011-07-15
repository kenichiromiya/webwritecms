<?php

class Dispatcher {
	public function __construct() {
		global $post;
		global $get;
		global $param;
		$this->post = $post;
		$this->get = $get;
		$this->param = $param;
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
		}
		switch ($this->param['method']) {
			case "POST":
				$controller->post();
				break;
			case "PUT":
				$controller->put();
				break;
			case "DELETE":
				$controller->delete();
				break;
			case "GET";
				$controller->get();
				break;
		}
	}
}
?>
