<?php
class View
{

	function getcontents($view,$data = array())
	{
		global $_LANG;
		extract($data);
		$cwd = getcwd();
		chdir("views");
                ob_start();
		//include_once("functions.php");
		include($view);
                $contents = ob_get_contents();
                ob_end_clean();
		chdir($cwd);
		/*
		print_r($session);
		if ($session['role'] == 'admin'){
			$contents = $contents."<a href=\"template/$view/edit/\">Edit</a>";
		} 
		*/
		return $contents;
	}

	function display($view,$data = array())
	{
		global $_LANG;
		extract($data);
		$cwd = getcwd();
		chdir("views");
		//include_once("functions.php");
		include($view);
		chdir($cwd);
	}
}
?>
