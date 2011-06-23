<div id="pagenation">
<?php if($pagenation['prev_page']){ ?>
<span id="prev">
<a href="entry/?<?=$pagenation['prev_page']['query']?>">&lt; <?=$_LANG['prev']?></a>
</span>
<?php } else { ?>
<span id ="prev">&lt; <?=$_LANG['prev']?></span>
<?php }?>
<?php
foreach ($pagenation['pages'] as $page) {
	if ($page['query']){
?>
<span class="page"><a href="entry/?<?=$page['query']?>"><?=$page['num']?></a></span>
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
<a href="entry/?<?=$pagenation['next_page']['query']?>"><?=$_LANG['next']?> &gt;</a>
</span>
<?php } else { ?>
<span id ="next"><?=$_LANG['next']?> &gt;</span>
<?php }?>
</div>
