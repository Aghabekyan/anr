<?php
	
	// Gallery ---------------------------------------------------------------------------------------------------------------- //

	$gallery = $db->select("SELECT `img`, `cropped`, `type` FROM `sliders` WHERE `slider` = 'gallery'");		


	// Rooms ---------------------------------------------------------------------------------------------------------------- //

	$rooms = $db->select("SELECT `id`, `roomtitle_{$lang['name']}` `title`, `roomdesc_{$lang['name']}` `desc`, `img` FROM `rooms` ORDER BY `id` DESC");

	foreach ($rooms as $key => $value) {
		$rooms[$key]['img'] = json_decode($value['img'], true);
	}


	// Feedbacks ---------------------------------------------------------------------------------------------------------------- //

	$feedbacks = $db->select("SELECT * FROM `feedbacks` WHERE `state` = 1");

?>