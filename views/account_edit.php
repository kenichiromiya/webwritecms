<form action="account/<?php if ($account['username']) {echo $account['username']."/";} ?>" method="post" >
<input type="hidden" name="_method" value="<?=$_method?>">
<table>
<tr>
<td><?=$_LANG['account_username']?></td>
<td>
<?php if ($_method== "put") { ?>
<input type="text" name="username" size="20" value=""/>
<?php } else { ?>
<?=$account['username']?>
<?php }?>
</td>
</tr>
<tr>
<td><?=$_LANG['account_password']?></td>
<td><input type="password" name="password"/></td>
</tr>
<tr>
<td><?=$_LANG['account_email']?></td>
<td><input type="text" name="email" value="<?=$account['email']?>"/></td>
</tr>
<tr>
<td><?=$_LANG['account_role']?></td>
<td>
<select name="role">
<option value="admin"<?php if($account['role'] == 'admin') { echo 'selected=""'; }?>>admin</option>
<option value="user"<?php if($account['role'] == 'user') { echo 'selected=""'; }?>>user</option>
</select>
</td>
</tr>
<tr>
<tr>
<td></td>
<td><input type="submit" value="Submit"/></td>
<table>
</form>
