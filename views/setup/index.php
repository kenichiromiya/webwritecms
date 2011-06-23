
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<base href="<?=$base?>"/>
<!--link rel="stylesheet" type="text/css" href="themes/default/style.css"/-->
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div id="wrapper">


<div id="contents">
<div id="main">
<div id="setup">
<h2><?=$_LANG['setup']?></h2>
<form method="post" action="setup/">
<label for="host"><?=$_LANG['setup_host']?></label><input id="host" type="text" name="host" size="20"/><br/>
<label for="user"><?=$_LANG['setup_user']?></label><input id="user" type="text" name="user" size="20"/><br/>
<label for="pass"><?=$_LANG['setup_pass']?></label><input id="pass" type="password" name="pass" size="20"/><br/>
<label for="db"><?=$_LANG['setup_db']?></label><input id="db" type="text" name="db" size="20"/><br/>
<label for="prefix"><?=$_LANG['setup_prefix']?></label><input id="prefix" type="text" name="prefix" size="20"/><br/>
<label for="create"></label><input id="create" type="submit" value="<?=$_LANG['setup_create']?>"/><br/>
</form>
</div>
</div>
</div>

</div>
</body>
</html>


