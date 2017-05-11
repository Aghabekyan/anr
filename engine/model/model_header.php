<?php

	$genslider = $db->select("SELECT `img`, `cropped` FROM `sliders` WHERE `slider` = 'gen_slider' AND `state` = 1 ORDER BY `order`");
	

	$FBData = array(
		'img' => '',
	);

	if (!empty($genslider)) {
		$FBData['img'] = $genslider[rand(0, count($genslider) - 1)]['img'];
	}


?>