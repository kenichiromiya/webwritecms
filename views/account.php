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
<div id="main">
<?=$main?>
</div>
</div>

<?php include("footer.php")?>
</div>
</body>
</html>
