<?php 

	require MODELS . 'model_header.php';

	$cat = '';

	$res = $db->select("SELECT `id`, `title_{$lang['name']}` title, `desc_{$lang['name']}` `desc`, `img`,`published`
						FROM `content`
						WHERE `published` < NOW()
						AND `state` = 1
						ORDER BY `published` DESC LIMIT 0, 80"); 

	foreach ($res as $key => $value) {

		$desc = strip_tags($value['desc']);
		$desc = html_entity_decode($desc, ENT_QUOTES, 'UTF-8');

		$data[] = array(
			'url'   => createbURL("v={$value['id']}",$value['title']),
			'title' => $value['title'],
			'desc'  => mb_substr($desc,0,170,'UTF-8'),
			'date'  => date('D, d M Y g:i:s O', strtotime($value['published'])),
			'img'   => $value['img'],
		);
	}

	

	header ("Content-Type:text/xml");
	require(bDIR.'/engine/templates/rss.php');


?>