<div class="box">
<?php
if ($session['role'] == 'admin'){
?>
<a href="page/<?=$page['id']?>/edit/"><?=$_LANG['edit']?></a>
<?php
}
?>

<h2 class="title"><?=$page['title']?></h2>
<?=$page['body']?>
</div>
