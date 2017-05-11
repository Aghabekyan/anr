<?php
	
	function langChanger($args) {
		global $route;
		$url = htmDIR. (isset($args['a']) ? admDIR.'?' : '?');
		$_get = $_GET;
		$_get['l'] = $args['l'];

		foreach ($_get as $key => $value) {
			if (empty($value)) {
				$url .= "{$key}&";
			} else {
				$url .= "{$key}={$value}&";
			}
		}
			
		return substr($url, 0, -1);
	}
	
    function isBetween($from, $till, $input) {
        $f = DateTime::createFromFormat('!H:i', $from);
        $t = DateTime::createFromFormat('!H:i', $till);
        $i = DateTime::createFromFormat('!H:i', $input);
        if ($f > $t) $t->modify('+1 day');
        return ($f <= $i && $i <= $t) || ($f <= $i->modify('+1 day') && $i <= $t);
    }
	
	function redirect($url) {
		header("Location: " . $url);
		exit();
	}

	function createURL($str = false, $title = false, $admin = false) {
		global $lang;

		if (!$str && !$admin) {
			return htmDIR."?l={$lang['name']}";
		}
		else if (!$str && $admin) {
			return htmDIR.admDIR."?l={$lang['name']}";
		}

		$admin = $admin ? admDIR : '';

		return htmDIR.$admin.'?'.$str.'&l='.$lang['name'];
	}

	function createbURL($query_str) {
		global $lang;

		if($query_str) {
			$url = bURL.'?'.$query_str.'&l='.$lang['name'];
		}
		return $url;	
	}



	function arm2translit($string) {
 		$string = preg_replace(array('/[^\p{Armenian}a-zA-Z\d\-\s]/u', '!\s+!'), array('',' '), mb_strtolower($string, 'UTF-8'));
		
        $rules = array(
            'նն' => 'ն',
        );
        $string = strtr($string, $rules);
		
        $converter = array(
            'ա' => 'a',   'բ' => 'b',   'գ' => 'g',
            'դ' => 'd',   'ե' => 'e',   'զ' => 'z',
            'է' => 'e',   'ը' => 'y',   'թ' => 't',
            'ժ' => 'g',   'ի' => 'i',   'լ' => 'l',
            'խ' => 'x',   'ծ' => 'c',   'կ' => 'k',
            'հ' => 'h',   'ձ' => 'dz',   'ղ' => 'x',
            'ճ' => 'ch',   'մ' => 'm',   'յ' => 'y',
            'ն' => 'n',   'շ' => 'sh',   'ո' => 'o',
            'չ' => 'ch',   'պ' => 'p',   'ջ' => 'j',
            'ռ' => 'r',   'ս' => 's',   'վ' => 'v',
            'տ' => 't',   'ր' => 'r',   'ց' => 'c',
            'ու' => 'u',   'փ' => 'p',   'ք' => 'q',
            'և' => 'ev',   'օ' => 'o',   'ֆ' => 'f',
			' ո' => 'vo',  ' ' => '+',	'՞' => '',
        );
		
        $string = strtr($string, $converter);
        return $string;
    }

	function rus2translit($string) {
 		return str_replace(' ', '+', $string);
    }


	function ifIE() {
		$agent = getenv("HTTP_USER_AGENT");
		if (preg_match("/MSIE/i", $agent)) return true;
		else return false;
	}
	
	
	/* date function */
	function dateCheck($str){
		$echo = date( "d.m.y",strtotime($str));
		return $echo;
	}

	function toTime($date) {
		$timestamp=strtotime($date);
		$time=date('H:i',$timestamp);
		return $time;
	}
	function dateFormat($date){
		global $t;
		$post_published = $date;
		$time = toTime($post_published);
		$day = date( "d",strtotime($post_published));
		$month = showMonthFull($post_published);
		$year = date( "Y",strtotime($post_published));
		if ( dateCheck($post_published) == date("d.m.y") ){
			$post_published = $t['header']['today']." -  ".$time;
		} else {
			$post_published = $day.".".$month.".".$year." - ".$time;
		}
		return $post_published;
	}

	function showMonthFull($dt){
		global $t;
		$month = intval(date( "m",strtotime($dt)));
		$ar = $t['months'];
		return $ar[$month-1];
	}

	function dateDMY($date) {

		$day = date( "d", strtotime($date));
		$month = showMonthFull($date);
		$year = date( "Y", strtotime($date));
		return $day . " / <i>" . $month . "</i> / " . $year;

	}
	
	/*convert date from db format to...*/
	function convertDate($format, $to, $a) {
		$date = DateTime::createFromFormat($format, $a);
		return $date->format($to);
	}
	
	/* image function */
	function youtubeID($video){
		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $str);
		return isset($str[1]) ? $str[1] : $video;
	}
	
	function yt_img($video, $width = false, $height = false){
		$width = (isset($width) AND $width != "") ? "&w=".$width : "";
		$height = (isset($height) AND $height != "") ? "&h=".$height : "";

		//preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video, $str);
		if( !empty($video)){
			$img = htmDIR."timthumb.php?src=http://img.youtube.com/vi/{$video}/0.jpg{$width}{$height}";
		} else {
			$img = "";
		}
		return $img;
	}
	
	function ret_img($img, $width = false, $height = false) {
		$width =  $width  ? "&w=".$width : "";
		$height = $height ? "&h=".$height : "";
				
		$img_url = ($img != '') ? htmDIR."timthumb.php?src=".$img.$width.$height : '';
		return $img_url;
	}

	function thumb($url, $width = false, $height = false) {
		if (empty($url)) {
			return '';
		}
		$width = $width ? "&w={$width}" : "";
		$height = $height ? "&h={$height}" : "";
		return htmDIR."timthumb.php?src=" . $url . $width . $height;
	}


// pageination

	function pageination($config = array()) {
		global $db, $lang, $t;
		
		$default = array(
				'showOnPage' => 5,
				'pagerVisible' => 5,
				'page' => 1
			);

		$config = array_merge($default, $config);

		extract($config);
		$page = ($page > 0) ? $page : 1;

		$from = ($page-1) * $showOnPage;
		$res = $db->select($query['count']['query'], $query['count']['bind']);
		$return_count = $res[0]['count'];
		$count = ceil($res[0]['count'] / ($showOnPage * $pagerVisible));
		$last_page = ceil($res[0]['count'] / $showOnPage);
		$res = $db->select($query['res']['query']." LIMIT ?,?", $query['res']['bind'], $from, $showOnPage);

		//$count - how many pages in all
		//$pc - how many pages per view
		
		$echo = '';
		if($last_page > 1){
			if($page % $pagerVisible != 0) $curpage=intval($page / $pagerVisible) + 1; //which view from start
			else $curpage = $page / $pagerVisible;
			if($curpage == 1 && $count > 1){
				$next = $curpage * $pagerVisible + 1;
			}
			else if($curpage == $count && $count > 1){
				$prev = ($curpage - 1) * $pagerVisible;
			}
			else if($count > 1){
				$prev = ($curpage - 1) * $pagerVisible;
				$next = $curpage * $pagerVisible + 1;
			}
			$first = ($curpage - 1) * $pagerVisible + 1;
			$last = $curpage * $pagerVisible;
			if($last > $last_page){
				$last = $last_page;
			}
		
			$echo.= "<div class='paginationCont'>";
				$echo.="<div class='pagination'>";
					if(isset($prev)) $echo.="<a href='?{$pagination_url}&paged={$prev}&l={$lang['name']}' class='next'><<</a>";
					for($j = $first; $j <= $last; $j++){
						if($j == $page)	$echo.="<a class='pageLinks activePage'>".$j."</a>";
						else	$echo.="<a href='?{$pagination_url}&paged={$j}&l={$lang['name']}' class='pageLinks'>{$j}</a>";
					}
					if(isset($next)) $echo.="<a href='?{$pagination_url}&paged={$next}&l={$lang['name']}' class='next'>>></a>";
				$echo.="</div>";
			$echo.= "</div>";
		}
	
		return array(
				'result' => $res,
				'pagination' => $echo,
				'count' => $return_count,
			);
	}

/////////////////////////////////////////////////////////////////////////////////////////////


	function searchHL($title, $sw){
		$sw = explode(' ',$sw);
		foreach($sw as $i)
			$title = highlight($i, $title);
		return $title;
	}

	function highlight($needle, $haystack){ 
		$ind = stripos($haystack, $needle); 
		$len = strlen($needle); 
		if($ind !== false){ 
			return substr($haystack, 0, $ind) . "<span style=''>" . substr($haystack, $ind, $len) . "</span>" . 
				highlight($needle, substr($haystack, $ind + $len)); 
		} else return $haystack; 
	}
	
	function pp($a) {
		echo "<pre>";
			print_r($a);
		echo "</pre>";
	}


	

	function getFlickrThumb($url, $size) {
		 
		$size_arr = array(

			'square_75'  => array('s', 75),
			'square_150' => array('q', 150),
			'thumb_100'  => array('t', 100),
			'thumb_240'  => array('m', 240),
			'thumb_320'  => array('n', 320),
			'thumb_640'  => array('z', 640),
			'thumb_800'  => array('c', 800),
			'thumb_1024' => array('b', 1024),

		);

		$new_size = $size_arr[$size][0];	
		$new_url = str_replace('_b.', '_'.$new_size.'.', $url);

		if($new_url == $url && $size != 'thumb_1024') {
			if($size == 'square_75' || $size == 'square_150') {

				return ret_img($url, $size_arr[$size][1], $size_arr[$size][1]);
			} 
			else return ret_img($url, $size_arr[$size][1]);
		}
		else return $new_url;
	}

	
?>