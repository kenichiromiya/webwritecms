[<a href="account/edit/">Add</a>]
<table id="account">
<tr id="colmuns">
<td>username</td>
<td>role</td>
<td>edit</td>
<td>delete</td>
</tr>
<?php foreach ($accounts as $account) { ?>
<tr>
<td><?=$account['username']?></td>
<td><?=$account['role']?></td>
<td>[<a href="account/<?=$account['username']?>/edit/">Edit</a>]</td>
<td>
<form action="account/<?=$account['username']?>/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=$_LANG['delete']?>">
</form>

</td>
</tr>
<?php } ?>
</table>
