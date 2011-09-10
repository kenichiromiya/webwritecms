<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title><?=$config['title']?></title>
<base href="<?=$base?>"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="javascript" type="text/javascript" href="js/script.js">
<?=$head?>
</head>
<body>
<div id="wrapper">
<?php include("header.php")?>

<div id="contents">
<div id="menu">

<div class="box">
<ul>
<!--li><a href="config/admin/"><?=$_LANG['admin_config']?></a></li-->
<li><a href="page/edit/"><?=$_LANG['admin_add_page']?></a></li>
<li><a href="entry/edit/"><?=$_LANG['admin_add_entry']?></a></li>
<li><a href="page/admin/"><?=$_LANG['admin_page']?></a></li>
<li><a href="entry/admin/"><?=$_LANG['admin_entry']?></a></li>
<li><a href="category/admin/"><?=$_LANG['admin_category']?></a></li>
<li><a href="template/admin/"><?=$_LANG['admin_template']?></a></li>
<li><a href="account/admin/"><?=$_LANG['admin_account']?></a></li>
</ul>
</div>

</div>
<div id="main">
<?=$main?>
</div>
</div>

<?php include("footer.php")?>
</div>
</body>
</html>
