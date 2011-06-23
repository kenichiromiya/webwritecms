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

		$controllername = isset($this->param['c']) ? $this->param['c'] : 'page';
		if (file_exists("controllers/$controllername.php")) {
			include_once("controllers/$controllername.php");
			$classname = ucwords($controllername)."Controller";
			if (class_exists($classname)) {
				$controller =& new $classname();
			}
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
