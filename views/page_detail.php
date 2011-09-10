<?php if ($page) { ?>
<div class="box">
<h2 class="title"><?=$page['title']?></h2>
<?=$page['body']?>
<?php
if ($session['role'] == 'admin'){
?>
<div class="edit"><a href="page/<?=$page['id']?>/edit/"><?=$_LANG['edit']?></a></div>
<?php
}
?>
</div>
<?php } ?>
