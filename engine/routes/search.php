<?
	
	$search = $db->escape($_GET['search']);

	if($search == '') header('Location: ' . htmDIR);

	$cat_name = '<em>" ' . $search . ' "</em> ' . $t['items']['no_res'];	


	if( strlen($search) < 3 ){
		$cat_name = '<em>" ' . $search . ' "</em>' . ' ' . $t['items']['less_3'];
	}
	
		
	$data = array();
	$pagination = '';
	
	if(strlen($search) > 3) {

		$search_words =  explode(" ", $search);

		$phrase='';
		foreach($search_words as $key=>$word){
			$phrase .= $word . '* ';
		}


		$res = pageination(array(
			'showOnPage' => 50,
			'pagination_url' => "search=" . $search,
			'page' => isset($_GET['paged']) ? intval($_GET['paged']) : 1,
			'query' => array(
					'count' => array(
							'query' => "SELECT count(*) count
										FROM `content`
										WHERE MATCH (`title_{$lang['name']}`, `desc_{$lang['name']}`, `metakey`) AGAINST (? IN BOOLEAN MODE)
										AND `published` < NOW()
										AND `state` = 1",
										
							'bind' => array($phrase)
						),
					'res' => array(
							'query' => "SELECT `id`, `title_{$lang['name']}` title, `youtube`, `gallery`, `duration`, `hd`, `views`, `img`, `published`, `relation`,
											   MATCH (`title_{$lang['name']}`, `desc_{$lang['name']}`, `metakey`) AGAINST (? IN BOOLEAN MODE) AS rel
										FROM `content`
										WHERE MATCH (`title_{$lang['name']}`, `desc_{$lang['name']}`, `metakey`) AGAINST (? IN BOOLEAN MODE)
										AND `published` < NOW()
										AND `state` = 1
										ORDER BY `rel` DESC, `published` DESC",
							'bind' => array($phrase, $phrase)
					)
				)
		));





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

		$page_title = $page_title . ' | ' . $search;

		$cat_name = $t['items']['search_res'].' "<em>' . $search . ' </em>" ' . $t['items']['search_query'];

	}

			

	require(bDIR.'/engine/model/model_header.php');
	require(bDIR.'/engine/model/model_main.php');
	

	require(bDIR.'/engine/templates/header.php');
	require(bDIR.'/engine/templates/search.php');
	require(bDIR.'/engine/templates/footer.php');

?>