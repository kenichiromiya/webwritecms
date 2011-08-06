<div class="box">
<?php
echo "<table>";
for ($j=0;$j<4;$j++){
	echo "<tr>";
	for ($i=0;$i<4;$i++){
		if(isset($photos[$j*4+$i])){
			$photo = $photos[$j*4+$i];
			echo "<td><a href=\"photo/".$photo['id']."/\"><img src=\"photos/thumbs/".$photo['name']."\"/></a></td>";
		} else {
			echo "<td></td>";
		}
	}
	echo "</tr>";
}
echo "</table>";
?>
</div>
