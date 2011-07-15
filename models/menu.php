<?php
include_once("models/cms.php");

class MenuModel extends CMSModel
{

        public function __construct() {
                parent::__construct();
        }

	public function addmenu($param) {
		$query = sprintf("INSERT INTO %s (name,path,parent_id) VALUES('%s','%s','%s')",TABLE_PREFIX."menu",m($param['name']),m($param['path']),m($param['parent_id']));
		mysql_query($query,$this->db);
	}

	public function editmenu($param) {
		$query = sprintf("UPDATE %s SET name = '%s',path = '%s' WHERE id = '%s'",TABLE_PREFIX."menu",m($param['name']),m($param['path']),m($param['id']));
		mysql_query($query,$this->db);
	}

	public function deletemenu($param) {
		$query = sprintf("DELETE FROM %s WHERE id = '%s'",TABLE_PREFIX."menu",m($param['id']));
		mysql_query($query,$this->db);
	}

	public function initmenu() {
		$sql = sprintf("SELECT count(*) FROM %s",TABLE_PREFIX."menu");
		$result = mysql_query($sql,$this->db);
		$count = mysql_result($result,0);
		if(!$count){
			$query = sprintf("INSERT INTO %s (name,path,parent_id) VALUES('top','.',0)",TABLE_PREFIX."menu");
			mysql_query($query,$this->db);
		}
	}

	public function getmenu($param) {
		$sql = sprintf("SELECT * FROM %s WHERE id = '%s'",TABLE_PREFIX."menu",m($param['id']));
		$result = mysql_query($sql,$this->db);
		$menu=mysql_fetch_assoc($result);
		return $menu;
	}

	public function createmenuimage($menutree) {
		/*
		   $menuname = $menus[0]['name'];
		   foreach($menus[0]['child'] as $menu) { 
		   $menuname = $menuname.$menu['name'];
		   } 
		 */
		// 画像を生成します
		$im = imagecreatetruecolor(800, 60);

		// いくつかの色を生成します
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);
		imagefilledrectangle($im, 0, 0, 799, 29, $white);
		imagefilledrectangle($im, 0, 30, 799, 59, $grey);

		// 描画する文字列
		//$text = 'CMS';
		// フォント自身のパスでパスを置き換えます
		$font = 'font/ipaexg.ttf';

		// テキストに影を付けます
		//imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

		// テキストを追加します
		// array imagettftext ( $image , フォントサイズ , $angle , $x , $y , $color , $fontfile , $text )
		// x,yは最初の文字のベースポイント (ほぼ文字の左下角)

		$menus = array();
		array_push($menus,$menutree[0]);
		foreach($menutree[0]['child'] as $menu) { 
			array_push($menus,$menu);
		} 
		$menunum = count($menus);

		$width = 800/$menunum;
		$fontsize = 12;
		$x=0;
		$y=20;
		foreach ($menus as $menu) {
			$len = mb_strlen($menu['name'],"UTF-8");
			$offset = ($width-$fontsize*$len)/2-6;
			//echo $len."##".$offset."##".$width;
			imagettftext($im, $fontsize, 0, $x + $offset, $y, $black, $font, $menu['name']);
			imagettftext($im, $fontsize, 0, $x + $offset, $y+30, $white, $font, $menu['name']);
			$x = $x+$width;
		}

		// imagepng() を使用して imagejpeg() よりもクリアなテキストにします
		imagepng($im,"plugins/images/menu.png");
		imagedestroy($im);

		$css = "
			ul#navigation {
width:800px;
margin:0;
overflow:hidden;　/*float解除*/
		 zoom:100%;　/*float解除*/
			}
		ul#navigation li {
float:left; /*次の要素を右側へ回り込ませる*/
      list-style:none; /*リストの●を消す*/
		}
		ul#navigation li a {
display:block; /*インラインからブロック要素へ変更*/
height:30px; /*高さ*/
width:".$width."px; /*横幅*/
      text-align:center; /*テキストの位置*/
      font-weight:bold; /*テキストの太さ*/
      letter-spacing:1px; /*文字間隔*/
      text-indent:-9898px; /*テキストを横に飛ばして見えなくする*/
      background-image:url(../images/menu.png); /*メニュー画像*/
      background-repeat:no-repeat; /*画像の繰り返しをオフに*/
		} 
		";

		$x = 0;
		foreach ($menus as $num => $menu) {
			$css .= 'ul#navigation a#menu'.$num.' {background-position:'.$x.'px 0px;}';
			$css .= 'ul#navigation li a#menu'.$num.':hover {background-position:'.$x.'px -30px;}';
			$x = $x-$width;
		}
		file_put_contents("plugins/css/menu.css",$css);
	}
	public function getmenutree() {
		$sql = sprintf("SELECT * FROM %s",TABLE_PREFIX."menu");
		$result = mysql_query($sql,$this->db);
		$menus = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($menus,$row);
		}
		$menus=  $this->list_to_tree($menus,'id','parent_id');
		return $menus;
	}

	//http://www.php-z.net/c10/n84.html
	public function list_to_tree($category = array(),
			$idField = 'id',$parentField='parent_id'){
		if(!is_array($category)) exit("配列ではありません");

		$index = array();
		$tree = array();

		foreach($category as $value){
			$id     = $value[$idField];
			$parent = $value[$parentField];

			if(isset($index[$id])){
				$value['child'] = $index[$id]['child'];
				$index[$id] = $value;

			} else {
				$index[$id] = $value;
			}

			if($parent == 0){
				$tree[] =& $index[$id];

			} else {
				$index[$parent]['child'][] =& $index[$id];
			}


		}
		return $tree;
	}

}
?>
