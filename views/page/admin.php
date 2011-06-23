[<a href="page/edit/">Add</a>]
<table id="page">
<tr id="colmuns">
<td>title</td>
<td>edit</td>
<td>delete</td>
</tr>
<?php foreach ($pages as $page) { ?>
<tr>
<td><?=$page['title']?></td>
<td>[<a href="page/<?=$page['id']?>/edit/">Edit</a>]</td>
<td>
<form action="page/<?=$page['id']?>/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=$_LANG['delete']?>">
</form>
</td>
</tr>
<?php } ?>
</table>
