<div id="login">
<h2><?=$_LANG['login']?></h2>
<form method="post" action="session/">
<input type="hidden" name="_method" value="post">
<input type="hidden" name="done" value="<?=$done?>">
<label for="username"><?=$_LANG['login_username']?></label>
<input id="username" type="text" name="username" /><br/>
<label for="password"><?=$_LANG['login_password']?></label>
<input id="password" type="password" name="password" /><br/>
<label for="persistent"><?=$_LANG['login_persistent']?></label>
<input id="persistent" type="checkbox" name="persistent" /><br/>
<label for="submit"></label><input id="submit" type="submit" name="submit" value="submit"/>
</form>
</div>
