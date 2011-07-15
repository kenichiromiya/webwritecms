<?php
class Template
{

	function getcontents($template,$data = array())
	{
		global $_LANG;
		extract($data);
		$cwd = getcwd();
		chdir("views");
                ob_start();
		//include_once("functions.php");
		include($template);
                $contents = ob_get_contents();
                ob_end_clean();
		chdir($cwd);
		return $contents;
	}

	function display($template,$data = array())
	{
		global $_LANG;
		extract($data);
		$cwd = getcwd();
		chdir("views");
		//include_once("functions.php");
		include($template);
		chdir($cwd);
	}
}
?>
