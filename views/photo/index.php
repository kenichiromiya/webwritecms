<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<base href="<?=$base?>"/>
<!--link rel="stylesheet" type="text/css" href="themes/default/style.css"/-->
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?php //include("plugins/css/menu.php")?>
<?=$_PLUGIN['head']?>
</head>
<body>
<div id="wrapper">
<?php include("header.php")?>


<div id="contents">
<?php //include("editmenu.php")?>
<div id="main">
<?=$main?>
</div>
<div id="sidebar">
<div class="box">
</div>
</div>

</div>

<?php include("footer.php")?>
</div>
</body>
</html>
