<?php

	$page = (int)$_GET['static'];

	$res = $db->selectRow("SELECT `id`, `title_{$lang['name']}` title, `desc_{$lang['name']}` `desc`,
								  `img`,  `youtube_{$lang['name']}` `youtube`, `gallery` FROM `static` WHERE `id`=?", $page);

	echo $db->error();

	$data = array(
		'id'      => $res['id'], 
		'title'   => $res['title'],
		'desc'    => $res['desc'],
		'img'     => $res['img'],
		'youtube' => empty($res['youtube']) ? array() : json_decode($res['youtube'], true),
		'gallery' => json_decode($res['gallery'], true),
		'url'     => createbURL("p={$res['id']}"),

		'fb_url'  => createbURL("p={$res['id']}"),
		'fb_img'  => bURL . "timthumb.php?src={$res['img']}&w=600&h=400",
		'fb_desc' => mb_substr(strip_tags($res['desc']), 0, 200, 'UTF-8'),    
	);

	
	// $page_title = $page_title . ' | ' . $static[$page];
		
	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/static.php');
	require(bDIR.'/engine/templates/footer.php');


?>