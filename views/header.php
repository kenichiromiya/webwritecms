<div id="header">
<div id="logo">
<h1>
<a href="./"><img src="images/logo.png"/></a>
</h1>
</div>

<div id="session">
<?php if($session['username']) { ?>
<form action="session/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?php echo $_LANG['logout']?>">
</form>
<?php
} else {
?>
<a href="session/"><?php echo $_LANG['login']?></a>
<?php } ?>
</div>

<!--
<div id="gnavi">
<?php if ($session['username']){?>
<span><?=$session['username']?></span>
<span><a href="logout.php?done=<?=$done?>"><?=$_LANG['logout']?></a></span>
<?php } else {?>
<span><a href="login.php?done=<?=$done?>"><?=$_LANG['login']?></a></span>
<span><a href="account.php"><?=$_LANG['account']?></a></span>
<?php }?>
</div>
-->
</div>
