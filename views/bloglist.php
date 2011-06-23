<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$_VAR['config']['title']?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<base href="<?=$_VAR['base']?>"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?=$_PLUGIN['head']?>
</head>
<body>
<div id="wrapper">
<?php include("header.php")?>

<div id="main">
<?php //include("editmenu.php")?>

<div id="contents">
<?=$_VAR['contents']?>
</div>

<div id="sidebar">
<div class="box">
<?=$_VAR['calendar']?>
</div>
<div class="box">
<?php include("recententries.php")?>
</div>
<div class="box">
<?php include("archives.php")?>
</div>
</div>
<?php include("pagenation.php");?>
</div>

<?php include("footer.php")?>
</div>
</body>
</html>
