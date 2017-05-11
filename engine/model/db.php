<?php


	function getNews($args) { // checked
		global $db, $lang;

		if(!empty($args['cat']) && !empty($args['limit'])) {

			$res['query'] = $db->select("SELECT t1.`id`, `title_{$lang['name']}` title, `desc_{$lang['name']}` `desc`, `youtube`, `gallery`, `duration`, `hd`, `views`, `img`, `published`, `relation` 
								FROM `content` t1 
								JOIN `categories_rel` t2
								ON t1.`id` = t2.`id`
								WHERE t1.`state` = 1
								AND t1.`published` < NOW()
								AND t2.`subcat` = {$args['cat']}
								ORDER BY t1.`id` DESC 
								LIMIT 0, 10");
			
			$res['count'] = $db->selectRow("SELECT COUNT(*) count FROM (SELECT t1.* FROM content t1 JOIN `categories_rel` t2 ON t1.`id` = t2.`id` WHERE t2.`subcat` = {$args['cat']}) AS `subquery`");
			echo $db->error();
			return $res;
		}
		return array();
	}

	function general_slider($args) {
		global $db, $lang;

		if(!empty($args['limit'])) {

		$res = $db->select("SELECT `id`, `title_{$lang['name']}` title, `published`, `img`, `hd`, `duration`, `views`, `youtube`, `desc_{$lang['name']}` `desc`
							FROM `content`
							WHERE `published` < NOW()
							AND   `state` = 1
							AND   `general` = 1
							ORDER BY `published` DESC LIMIT 0, ?", $args['limit']);
			return $res;
		}
		return array();
	}



?>