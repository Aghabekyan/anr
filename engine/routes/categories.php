<?
	require(bDIR.'/engine/model/model_header.php');
	require(bDIR.'/engine/model/model_main.php');
	

	$category = !empty($_GET['categories']) ? (int)($_GET['categories']) : redirect(createURL());
	$parentid = !empty($_GET['parentid']) ? abs($_GET['parentid']) : '';


	// Order by operations ------------->

	$orderby = isset($_GET['orderby']) && in_array($_GET['orderby'], array('popular', 'latest')) ? $_GET['orderby'] : '';


	switch ($orderby) {
		case 'popular':
			$orderby = "ORDER BY t1.`views`";
			break;
		case 'latest':
			$orderby = "ORDER BY t1.`id`";
			break;
		case 'recommended':
			$orderby = "ORDER BY t1.`recommended`";
			break;
		default: $orderby = "ORDER BY t1.`id`";
	}			


	$res = pageination(array(
		'showOnPage' => 50,
		'pagination_url' => "categories={$category}&parentid={$parentid}",
		'page' => isset($_GET['paged']) ? intval($_GET['paged']) : 1,
		'query' => array(
				'count' => array(
						'query' => "SELECT COUNT(*) count 
									FROM (SELECT t1.`id` 
										  FROM content t1 
										  JOIN `categories_rel` t2 
										  ON t1.`id` = t2.`id` 
										  AND t1.`published` < NOW()
										  AND t1.`state` = 1
										  WHERE t2.`subcat` = {$category}) AS subquery", 
						'bind' => array()
					),
				'res' => array(
						'query' => "SELECT t1.`id`, `title_{$lang['name']}` title, `youtube`, `gallery`, `duration`, `hd`, `views`, `img`, `published`, `relation`, t2.`subcat` 
									FROM content t1 
									JOIN `categories_rel` t2 
									ON t1.`id` = t2.`id`
									AND t1.`published` < NOW()
									AND t1.`state` = 1 
									WHERE t2.`subcat` = ? 
									{$orderby} DESC",
						'bind' => array($category),
					)
			)
	));		

	$data = array();
	


	if (!empty($res['result'])) {

		foreach ($res['result'] as $value) {

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

			$data[] = array(
				'id'      => $value['id'],
				'title'   => mb_strlen($title, 'UTF-8') > 150 ? mb_substr($title, 0, 150, 'UTF-8').'...' : $title,
				'img'     => $img,
				'youtube' => $value['youtube'],
				'gallery' => $value['gallery'],
				'hd'      => $value['hd'],
				'views'   => number_format($value['views']),
				'duration' => $value['duration'],
				'date'    => $date,
				'url'     => createURL("v={$value['id']}", $value['title']),
				
			);

		}

	}

	
	$cat_name = $categories[$parentid]['subcats'][$category]['title'];	
	$page_title = $page_title . ' | ' . $categories[$parentid]['subcats'][$category]['title'];

	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/categories.php');
	require(bDIR.'/engine/templates/footer.php');

?>