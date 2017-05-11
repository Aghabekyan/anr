<?php 

	$id = !empty($_GET['id']) ? (int)$_GET['id'] : '';
	


	if (empty($id)) {
	
		require(bDIR.'/engine/model/model_main.php');	
	}

	else {
		
		$rooms = $db->select("SELECT `id`, 
									 `roomtitle_{$lang['name']}` `title`, 
									 `roomdesc_{$lang['name']}` `desc`, 
									 `fulldesc_{$lang['name']}` `fulldesc`, 
									 `youtube_{$lang['name']}` `youtube`, 
									 `img`, 
									 `gallery` FROM `rooms`");



		foreach ($rooms as $key => $value) {
			$rooms[$key]['img'] = json_decode($value['img'], true);	
			$rooms[$key]['gallery'] = json_decode($value['gallery'], true);	
			
			if ($value['id'] == $id) {
				$currentRoom = $value;
			}
		}
		$currentRoom['img']     = json_decode($currentRoom['img'], true);	
		$currentRoom['gallery'] = json_decode($currentRoom['gallery'], true);	
		

		$currentRoom['fb_url']  = createbURL("rooms={$currentRoom['id']}");
		$currentRoom['fb_img']  = !empty($currentRoom['img']['img']) ? bURL . "timthumb.php?src={$currentRoom['img']['img']}&w=600&h=400" : '';
		$currentRoom['fb_desc'] = !empty($currentRoom['desc']) ? mb_substr(strip_tags($currentRoom['desc']), 0, 200, 'UTF-8') : '';

	}


	

		
	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/rooms.php');
	require(bDIR.'/engine/templates/footer.php');

?>