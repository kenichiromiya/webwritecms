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
<span>最新版ダウンロード</span>
hogehoge.tar.gz
</div>

<div class="box">
<ul>
<?php foreach($recentpages as $recentpage) { ?>
<li><a href="page/<?=$recentpage['id']?>/"><?=$recentpage['title']?></a></li>
<?php } ?>
</ul>
</div>

<div class="box">
<a href="admin/"><?php echo $_LANG['admin']?></a>
<?php
if ($session['role'] == 'admin'){
?>
<form action="session/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?php echo $_LANG['logout']?>">
</form>
<?php } ?>
</div>
</div>

</div>

<?php include("footer.php")?>
</div>
</body>
</html>
