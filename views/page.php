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


<?php include("globalnavi.php")?>
<div id="contents">
<?php //include("editmenu.php")?>
<div id="main">
<?php
if ($session['username']){
?>
<div class="add"><a href="page/edit/"><?=$_LANG['add']?></a></div>
<?php
}
?>
<?=$main?>
<?php readfile("http://miyaa.sakura.ne.jp/cmsdev/entry/?o=text")?>
</div>
<div id="sidebar">

<div class="box">
<ul>
<?php foreach($recentpages as $recentpage) { ?>
<li><a href="page/<?=$recentpage['id']?>/"><?=$recentpage['title']?></a></li>
<?php } ?>
</ul>
</div>

</div>

</div>

<?php include("footer.php")?>
</div>
</body>
</html>
