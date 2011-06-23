[<a href="entry/edit/">Add</a>]
<table id="entry">
<tr id="colmuns">
<td>title</td>
<td>edit</td>
<td>delete</td>
</tr>
<?php foreach ($entries as $entry) { ?>
<tr>
<td><?=$entry['title']?></td>
<td>[<a href="entry/<?=$entry['id']?>/edit/">Edit</a>]</td>
<td>
<form action="entry/<?=$entry['id']?>/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=$_LANG['delete']?>">
</form>
</td>
</tr>
<?php } ?>
</table>
