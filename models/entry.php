<?php

class EntryModel extends Model {

	public function __construct() {
		parent::__construct();
	}

	public function getentryarchives() {
		$sql = "SELECT count(*) AS count,DATE_FORMAT(adddate,'%%Y%%m') AS adddate FROM ".$this->table." GROUP BY DATE_FORMAT(adddate, '%%Y%%m') ORDER BY adddate DESC";
		$sth = $this->dbh->query($sql);
		return $sth->fetchAll();
/*
		$result = mysql_query($sql,$this->db);
		$archives = array();
		while ($archive=mysql_fetch_assoc($result)){
			array_push($archives,$archive);
		}
		return $archives;
*/
	}

/*
	public function addentry($param) {
		$sql = "INSERT INTO ".TABLE_PREFIX."entry (title,category_id,body,adddate,moddate) VALUES(?,?,?,now(),now())";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['title'],$param['category_id'],$param['body']));

//		mysql_query($query,$this->db);
	}

	public function editentry($param){
		$sql = "UPDATE ".TABLE_PREFIX."entry SET title = ?,category_id = ?,body = ?,moddate = now() WHERE id = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['title'],$param['category_id'],$param['body'],$param['id']));
		//mysql_query($query,$this->db);
	}

	public function deleteentry($param){
		$sql = "DELETE FROM ".TABLE_PREFIX."entry WHERE id = ?";
		$sth = $this->dbh->prepare($sql);
		$sth->execute(array($param['id']));

	//	mysql_query($query,$this->db);
	}

	public function getentry($param) {
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".TABLE_PREFIX."entry WHERE id = ?";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();

		//$result = mysql_query($query,$this->db);
		//$entry=mysql_fetch_assoc($result);
		//return $entry;
	}
*/

	public function getpreventry($param) {
		$sql = "SELECT * FROM ".$this->table." where id < ? ORDER BY id DESC limit 1";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
		//$result = mysql_query($sql,$this->db);
		//$entry=mysql_fetch_assoc($result);
		//return $entry;
	}
	public function getnextentry($param) {
		$sql = "SELECT * FROM ".$this->table." where id > ? ORDER BY id limit 1";
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array($param['id']));
                return $sth->fetch();
		//$result = mysql_query($sql,$this->db);
		//$entry=mysql_fetch_assoc($result);
		//return $entry;
	}

	public function getrecententries($param){
		$category_id = $param['c'];
		$bind_param = array();
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." ";
		if ($category_id) {
			$sql .= "WHERE category_id = ? ";
			array_push($bind_param,$category_id);
		}
		$sql .= "ORDER BY adddate DESC limit 0,10";

                $sth = $this->dbh->prepare($sql);
		$sth->execute($bind_param);
                return $sth->fetchAll();

/*
		$result = mysql_query($sql,$this->db);
		$entries = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($entries,$row);
		}
		return $entries;
*/
	}

	public function getentries($param) {
		$date = $param['d'];
		$category_id = $param['c'];
		//$num_per_page = isset($param['n']) ? $param['n'] : '1';
		$num_per_page = isset($param['n']) ? $param['n'] : '1';
		$page = isset($param['p']) ? $param['p'] : '1';
		$start = ($page-1)*$num_per_page;
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table." ";
		$bind_param = array();
		if ($date){
			if (strlen($date) == 6){
				list($year,$mon) = sscanf($date,"%04d%02d");
				$adddate = sprintf("%04d-%02d%%",$year,$mon);
			}
			if (strlen($date) == 8){
				list($year,$mon,$mday) = sscanf($date,"%04d%02d%02d");
				$adddate = sprintf("%04d-%02d-%02d%%",$year,$mon,$mday);
			}
			$sql .= "WHERE adddate like ? ";
			array_push($bind_param,$adddate);
		}
		if ($category_id) {
			$sql .= "WHERE category_id = ? ";
			array_push($bind_param,$category_id);
		}
		$sql .= "ORDER BY adddate DESC limit $start,$num_per_page ";
                $sth = $this->dbh->prepare($sql);
                $sth->execute($bind_param);
                return $sth->fetchAll();

/*
		$result = mysql_query($query,$this->db);
		$entries = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($entries,$row);
		}
		return $entries;
*/

	}

	
	public function getcount() {
		$sql = "SELECT FOUND_ROWS()";
                $sth = $this->dbh->prepare($sql);
                $sth->execute();
                $row = $sth->fetch();
		return $row[0];
	}


	public function getcalendar($year = '',$mon = '') {
		if ($year == '' and $mon == '') {
			$today = getdate();
			$year = $today['year'];
			$mon = $today['mon'];
		}
		$days = $this->getdays($year,$mon);
		$pn = $this->getpn($year,$mon);

		$d = sprintf("%04d%02d",$year,$mon);
		$calendar = $this->generate_calendar($year, $mon, $days, 3, "entry/?d=$d",0,$pn);
		return $calendar;
	}

	public function getdays($year,$mon){
		$adddate = sprintf("%04d-%02d%%",$year,$mon);
		// その月のデータを取得する
		$sql = "SELECT * FROM ".$this->table." WHERE adddate LIKE ?";
		//echo $sql;
                $sth = $this->dbh->prepare($sql);
                $sth->execute(array("$adddate"));
                $adddates = $sth->fetchAll();

		/*
		$result = mysql_query($sql,$this->db);
		$adddates = array();
		while ($row=mysql_fetch_assoc($result)){
			array_push($adddates,$row);
		}
		*/
		$days = array();
		foreach ($adddates as $adddate) {
			// http://keithdevens.com/software/php_calendar#source
			list($addyear,$addmon,$addmday,$dmy,$dmy,$dmy) = sscanf($adddate['adddate'],"%04d-%02d-%02d %02d:%02d:%02d");
			$d = sprintf("%04d%02d%02d",$addyear,$addmon,$addmday);
			$days[$addmday] = array("entry/?d=$d",'linked-day');
		}
		return $days;
	}

	public function getpn($year,$mon){
		$timestamp =  mktime(0, 0, 0, $mon, 1, $year);
		$nowmonth = date('Ym', $timestamp);
		$nextMonth  = strtotime("+1 month",$timestamp);
		$nextmonth = date('Ym', $nextMonth);
		$prevMonth  = strtotime("-1 month",$timestamp);
		$prevmonth = date('Ym', $prevMonth);

		// prev next :-)
		$pn = array('&laquo;'=>"entry/?d=$prevmonth", '&raquo;'=>"entry/?d=$nextmonth");
		return $pn;
	}

	public function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){
		$first_of_month = gmmktime(0,0,0,$month,1,$year);
#remember that mktime will automatically correct if invalid dates are entered
# for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
# this provides a built in "rounding" feature to generate_calendar()

		$day_names = array(); #generate all the day names according to the current locale
			for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
				$day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

					list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
		$weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
			$title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

#Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
			@list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
			if($p) $p = '<span class="calendar-prev">'.($pl ? '<a href="'.htmlspecialchars($pl).'">'.$p.'</a>' : $p).'</span>&nbsp;';
		if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? '<a href="'.htmlspecialchars($nl).'">'.$n.'</a>' : $n).'</span>';
		$calendar = '<table class="calendar">'."\n".
			'<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

		if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
#if day_name_length is >3, the full name of the day will be printed
			foreach($day_names as $d)
				$calendar .= '<th abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
			$calendar .= "</tr>\n<tr>";
		}

		if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
			for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
				if($weekday == 7){
					$weekday   = 0; #start a new week
						$calendar .= "</tr>\n<tr>";
				}
				if(isset($days[$day]) and is_array($days[$day])){
					@list($link, $classes, $content) = $days[$day];
					if(is_null($content))  $content  = $day;
					$calendar .= '<td'.($classes ? ' class="'.htmlspecialchars($classes).'">' : '>').
						($link ? '<a href="'.htmlspecialchars($link).'">'.$content.'</a>' : $content).'</td>';
				}
				else $calendar .= "<td>$day</td>";
			}
		if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

			return $calendar."</tr>\n</table>\n";
	}
}
?>
