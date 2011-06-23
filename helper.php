<?php

function getpagenation($option) {
	$cur_page = $option['cur_page'];
	$per_page = $option['per_page'];
	$total_rows = $option['total_rows'];
	$min_page = 1;
	$max_page = ceil($total_rows/$per_page);
	$pagenation = array();
	$pages = array($cur_page);
	$offset = 1;
	while ($count < 5 and (($cur_page - $offset > 0) or ($cur_page + $offset <= $max_page))) {
		if ($cur_page - $offset > 0 ){
			array_unshift($pages,$cur_page - $offset);
			$count++;
		}
		if ($cur_page + $offset <= $max_page ){
			array_push($pages,$cur_page + $offset);
			$count++;
		}
		$offset++;
	}

	$url = $_ENV["REQUEST_URI"];
	$parsed_url =  parse_url($url);
	parse_str($parsed_url['query'],$parsed_query);

	//$start_page = array_shift($pages);
	//$end_page = array_pop($pages);
	$start_page = $pages[0];
	$end_page = $pages[count($pages)-1];

	for ($i = $start_page;$i <= $end_page;$i++) {
		$pagenation['pages'][$i]['num'] = $i;
		if ($i != $cur_page) {
			$parsed_query['p'] = $i;
			$pagenation['pages'][$i]['query'] = http_build_query($parsed_query);
		}
	}

	$pagenation['min_page']['num'] = 1;
	$parsed_query['p'] = 1;
	$pagenation['min_page'] = http_build_query($parsed_query);
	if($cur_page > $min_page){
		$parsed_query['p'] = $cur_page-1;
		$pagenation['prev_page']['query'] = http_build_query($parsed_query);
	}
	if($cur_page < $max_page){
		$parsed_query['p'] = $cur_page+1;
		$pagenation['next_page']['query'] = http_build_query($parsed_query);
	}
	$pagenation['max_page']['num'] = $max_page;
	$parsed_query['p'] = $max_page;
	$pagenation['max_page']['query'] = http_build_query($parsed_query);
	return $pagenation;
}
	
function http_add_query($url,$query) {
	$parsed_url =  parse_url($url);
	parse_str($parsed_url['query'],$parsed_query);
	$parsed_query = array_merge($parsed_query,$query);
	//unset($parsed_query['p']);
	$parsed_url['query'] = http_build_query($parsed_query);
	$url = $parsed_url['path']."?".$parsed_url['query'];

}

//WHERE photo.photo_id = tag.photo_id and tag.tagname = '$query'"

function m($string) {
	return mysql_real_escape_string($string);
}

/*
function file_get_{
	ob_start();
	eval('?>' . file_get_contents('plugins/menu.php') . '<?');
	$string = ob_get_contents();
	ob_end_clean();
	return $string;
}
*/
function getpath() {
	
	$parseurl = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$path = explode('/', $parseurl['path']); 

	return $path;
}

function gettag($photo_id) {
//$query = sprintf("INSERT INTO tag (photo_id,tagname)
	global $_DB;
	$sql = sprintf("SELECT tagname FROM tag WHERE photo_id = '%s'",m($photo_id));
	$result = mysql_query($sql,$_DB);
	$tags = array();
	while ($row=mysql_fetch_assoc($result)){
		$row['query'] = urlencode($row['tagname']);
		array_push($tags,$row);
	}
	return $tags;
}

function gettags() {
	global $_DB;
	$sql ="SELECT tagname,count(tagname) AS tagcount FROM tag GROUP BY tagname ORDER BY tagcount DESC";
	$result = mysql_query($sql,$_DB);
	$tags = array();
	while ($row=mysql_fetch_assoc($result)){
		$row['query'] = urlencode($row['tagname']);
		array_push($tags,$row);
	}
	return $tags;
}


function getdone() {
	return urlencode("http://".$_ENV["HTTP_HOST"].$_ENV["REQUEST_URI"]);
}

/*
function getloginname() {
	global $_DB;
	$session_id = $_COOKIE['session_id'];
	if ($session_id){
		//$query = "SELECT username FROM session WHERE session_id = '$session_id'";
		$query = sprintf("SELECT username FROM session WHERE session_id = '%s'",m($session_id));
		$result = mysql_query($query,$_DB);
		$row=mysql_fetch_assoc($result);
		return $row['username'];
	}
}
*/
function getprofilebykey($username) {
	global $_DB;
	//$query = "SELECT * FROM profile WHERE username = '$username'";
	$query = sprintf("SELECT * FROM profile WHERE username = '%s'",m($username));
	$result = mysql_query($query,$_DB);
	return mysql_fetch_assoc($result);
}

function getresampledimagesize($filename,$max_width,$max_height) {
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_height/$ratio;
	} else {
		$new_width = $max_width*$ratio;
		$new_height = $max_height;
	}
	return array($new_width,$new_height);
} 

function imageresize($newfilename,$filename,$max_width,$max_height) {
	// 新規サイズを取得します
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_height/$ratio;
	} else {
		$new_width = $max_width*$ratio;
		$new_height = $max_height;
	}

	//$new_width = $max_width;
	//$new_height = $max_height/$ratio;

	// 再サンプル
	$image_p = imagecreatetruecolor($new_width, $new_height);
	switch ($imagetype)
	{
		case 1:
			$image = imagecreatefromgif($filename);
			break;
		case 2:
			$image = imagecreatefromjpeg($filename);
			break;
		case 3:
			$image = imagecreatefrompng($filename);
			break;
	}
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));   
//imageconvolution($image_p, $matrix, 8, 0);   
  

	// 出力
	imagejpeg($image_p, $newfilename, 95);
}

# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license


//http://www.php-z.net/c10/n84.html

?>
