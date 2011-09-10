<?php

class Sanitizer {

	static $param;
	function sanitize() {
                if (isset($this->param)){
                        return $this->param;
                }
		$post = array();
		$get = array();
		foreach ($_POST as $key => $value) {
			if (is_array($value)) {
				// TODO array sanitize
				$post[$key] = $value;
			} else {
				$post[$key] = strip_tags($value);
			}
		}
		foreach ($_GET as $key => $value) {
			if (is_array($value)) {
				$get[$key] = $value;
			} else {
				$get[$key] = strip_tags($value);
			}
		}
		$this->param = array_merge($post,$get);
		if ($this->param['_method']) {
			$method = strtoupper($this->param['_method']);
		} else {
			$method = $_SERVER["REQUEST_METHOD"];
		}
		$this->param['method'] = $method;
		return $this->param;
	}
}
?>
