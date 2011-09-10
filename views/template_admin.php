<div id="template">
[<a href="template/edit/">Add</a>]
<table>
<tr id="colmuns">
<td>filename</td>
<td>edit</td>
<td>delete</td>
</tr>
<?php foreach ($templates as $template) { ?>
<tr>
<td><?=$template['filename']?></td>
<td>[<a href="template/<?=$template['filename']?>/edit/">Edit</a>]</td>
<td>
<form action="template/<?=$template['filename']?>/" method="post">
<input type="hidden" name="_method" value="delete">
<input type="submit" value="<?=$_LANG['delete']?>">
</form>

</td>
</tr>
<?php } ?>
</table>
</div>
