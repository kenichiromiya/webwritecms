<?php
$menus = array();
array_push($menus,$menutree[0]);
foreach($menutree[0]['child'] as $menu) {
	array_push($menus,$menu);
}
?>
<div id="navigation">
<ul>
<?php foreach ($menus as $num => $menu) {?>
	<li><a href="<?=$menu['path']?>/" title="<?=$menu['name']?>" id="menu<?=$num?>"><?=$menu['name']?></a></li>
<?php } ?>
</ul>
</div>
