<?php
class Validator {
	function validate($param,$rule) {
		foreach ($param as $key => $value) {
			if ($rule[$key]) {
			}
		}
		//return true;
		return false;
	}
}
?>
