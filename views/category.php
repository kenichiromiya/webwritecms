<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>cms</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div id="wrapper">
<?php include("templates/header.php")?>

<div id="main">
<?php include("templates/editmenu.php")?>
<div id="menu">
<?=$_VAR['calendar']?>
</div>
<div id="menu">
</div>

<div id="contents">
<form action="editcategory.php" method="POST">
<?=$_VAR['category']?>
<?=$_LANG['category_id']?><input type="text" name="category_id" value="">
<?=$_LANG['category_name']?><input type="text" name="name" value="">
<input type="submit" name="category_add" value="<?=$_LANG['category_add']?>">
<input type="submit" name="category_delete" value="<?=$_LANG['category_delete']?>">
</form>
</div>

<?php include("templates/footer.php")?>
</div>
</body>
</html>
