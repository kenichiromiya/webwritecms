<div class="box">
<ul>
<?php foreach($recententries as $recententry) { ?>
<li><a href="entry/<?=$recententry['id']?>/"><?=$recententry['title']?></a></li>
<?php } ?>
</ul>
</div>
