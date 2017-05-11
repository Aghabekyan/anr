<?php

	require (MODELS . 'model_header.php');

	$vid = !empty($_GET['v']) ? intval($_GET['v']) : redirect(createURL());


	$res = $db->selectRow("SELECT * FROM `content` WHERE `id`=?", $vid);

	if (empty($res['id'])) redirect(createURL());
	

	$time  = convertDate('Y-m-d G:i:s', 'G:i',$res['published']);
	$day   = convertDate('Y-m-d G:i:s', 'j',$res['published']);
	$year  = convertDate('Y-m-d G:i:s', 'Y',$res['published']);
	$month = $t['months'][convertDate('Y-m-d G:i:s', 'n',$res['published']) - 1];

	$img = !empty($res['img']) ? json_decode($res['img'], true) : '';


	$data = array(
		'id'      => $res['id'], 
		'title'   => $res["title_{$lang['name']}"],
		'desc'    => $res["desc_{$lang['name']}"],
		'img'     => $img,
		'gallery' => !empty($res['gallery']) ? json_decode($res['gallery'], true) : '',
		'youtube' => $res['youtube'],
		'copy'    => $res['copy'],
		'views'   => $res['views'],
		'date'    => "{$time} - {$day}/{$month}/{$year}",
		'url'     => createbURL("v={$res['id']}"),

		'fb_url'  => createbURL("v={$res['id']}"),
		'fb_img'  => bURL . "timthumb.php?src={$img['img']}&w=600&h=400",
		'fb_desc' => mb_substr(strip_tags($res["desc_{$lang['name']}"]), 0, 200, 'UTF-8'),    
	);

	
	// Այս թեմայով -------------------------------------------------------------------------------------------------- //

	$suggestions = array();

	$meta = $db->selectRow("SELECT `suggestions` FROM `content` WHERE id=?", $vid);


	$res = $db->select("SELECT `id`, `title_{$lang['name']}` title, `youtube`, `duration`, `hd`, `views`, `img`, `published`
						FROM `content`
						WHERE published < NOW() 
						AND   state = 1
						AND   MATCH (suggestions) AGAINST (? IN BOOLEAN MODE)
						AND   id != ?
						ORDER BY `published` DESC
						LIMIT 0, ?", $meta['suggestions'], $vid, 8);
	
	
	foreach($res as $value) {

		$title = strip_tags($value['title']);

		if (convertDate('Y-m-d G:i:s', 'Y-m-d',$value['published']) == date("Y-m-d")) {
			$date = $t['items']['today'] . ' ' . convertDate('Y-m-d G:i:s', 'G:i',$value['published']);
		}
		else {
			$time = convertDate('Y-m-d G:i:s', 'G:i',$value['published']);
			$day   = convertDate('Y-m-d G:i:s', 'j',$value['published']);
			$year  = convertDate('Y-m-d G:i:s', 'Y',$value['published']);
			$month = $t["months"][convertDate('Y-m-d G:i:s', 'n',$value['published']) - 1];
	
			$date = $day . ' / ' . $month . ' / ' . $year;								
		
		}

		$img = json_decode($value['img'], true);
		$img = !empty($img['cropped']) ? $img['cropped'] : (!empty($img['img']) ? thumb($img['img'], 282, 190) : '');

		$suggestions[] = array(
			'id'      => $value['id'],
			'title'   => mb_strlen($title, 'UTF-8') > 150 ? mb_substr($title, 0, 150, 'UTF-8').'...' : $title,
			'img'     => $img,
			'youtube' => $value['youtube'],
			'hd'      => $value['hd'],
			'views'   => number_format($value['views']),
			'duration' => $value['duration'],
			'date'    => $date,
			'url'     => createURL("v={$value['id']}", $value['title']),
			
		);
	}
	
	$page_title = $page_title . ' | ' . $data['title'];
		
	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/v.php');
	require(bDIR.'/engine/templates/footer.php');


?>