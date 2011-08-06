<div id="pagenation">
<?php if($pagenation['prev_page']){ ?>
<span id="prev">
<a href="<?=$pagenation['prev_page']['url']?>">&lt; <?=$_LANG['prev']?></a>
</span>
<?php } else { ?>
<span id ="prev">&lt; <?=$_LANG['prev']?></span>
<?php }?>
<?php
foreach ($pagenation['pages'] as $page) {
	if ($page['url']){
?>
<span class="page"><a href="<?=$page['url']?>"><?=$page['num']?></a></span>
<?php
	} else {
?>
<span class="page"><?=$page['num']?></span>
<?php
	}
}
?>
<?php if($pagenation['next_page']){ ?>
<span id="next">
<a href="<?=$pagenation['next_page']['url']?>"><?=$_LANG['next']?> &gt;</a>
</span>
<?php } else { ?>
<span id ="next"><?=$_LANG['next']?> &gt;</span>
<?php }?>
</div>
