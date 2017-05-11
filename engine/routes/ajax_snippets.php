<?php

	require MODELS . "model_header.php";	


	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : exit();

	$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : '';

	$lang_name = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $lang['name'];


		

	if ($action == 'hitcounter') {

		if(!isset($_COOKIE[$id])) {
			$db->update("UPDATE `content` SET views=views + 1 WHERE id=?", $id);
		}
		// hits=hits + FLOOR(1 + RAND() * 7)
	}
	

	if ($action == 'view' && !empty($id)) {
		
		$getParent = $db->selectRow("SELECT `parentid` FROM `categories` WHERE `id` = ?", (int)$_GET['v']);		

		$res = $db->select("SELECT t1.`id`, `title_{$lang_name}` title, `desc_{$lang_name}` `desc`, `youtube`, `duration`, `hd`, `views`, `img`, `published`, `relation` 
							FROM `content` t1 
							JOIN `categories_rel` t2
							ON t1.`id` = t2.`id`
							WHERE t1.`state` = 1
							AND t2.`subcat` = {$id}
							ORDER BY t1.`id` DESC 
							LIMIT 0, 10");
		


		foreach($res as $key => $value) {

			$title = strip_tags($value['title']);
			$desc  = strip_tags($value['desc']);

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
				'title'   => mb_strlen($title, 'UTF-8') > 200 ? mb_substr($title, 0, 200, 'UTF-8').'...' : $title,
				'desc'    => mb_strlen($desc, 'UTF-8') > 500 ? mb_substr($desc, 0, 500, 'UTF-8').'...' : $desc,
				'img'     => $img,
				'youtube' => $value['youtube'],
				'hd'      => $value['hd'],
				'views'   => number_format($value['views']),
				'duration' => $value['duration'],
				'date'    => $date,
				'url'     => createURL("v={$value['id']}", $value['title']),
				
			);

			
		}	

	}

	if ($action == 'crop') {

        $targ_w = $_POST['w'];
        $targ_h = $_POST['h'];

    	$jpeg_quality = 150;

    	// $image =  ? $_POST['image'] : '';

    	if (!empty($_POST['image'])) {
		    $image = parse_url( $_POST['image'], PHP_URL_PATH );
		    $image = explode( '/', $image );
		    $image = array_filter( $image );
		    $image = array_values( $image );    		
	
			if (count($image) == 3) {

				$date = $image[1];
				$name = explode('&', $image[2]);
			}
			else {

				$date = $image[2];
				$name = explode('&', $image[3]);
			}

    	}

        $img_r = imagecreatefromjpeg(bDIR . "/disk/{$date}/{$name[0]}");
        $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

        imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

        header('Content-type: image/jpeg');

    	if (!file_exists( bDIR . "/disk/{$date}/cropped" )){
			mkdir( bDIR . "/disk/{$date}/cropped", 0777 );
		}

        imagejpeg($dst_r, bDIR . "/disk/{$date}/cropped/{$name[0]}", $jpeg_quality);
          
        exit(bURL . "disk/{$date}/cropped/{$name[0]}");
	}

?>




<? if ($action == 'view' && !empty($id) && $_REQUEST['type'] == 'horizontal'): ?>
	<? foreach ($data as $key => $value): ?>
		<div class="col-lg-12">
			<div class="video_wrapper video_wrapper_tp2">
				<div class="video_img vh2">
					<div style="background-image: url(<?= $value['img'] ?>);" class="img vh2"></div>
					<a href="<?= $value['url'] ?>" class="video_hover"><span></span></a>
					<div class="video_toolbar">
						<? if ($value['hd'] == 1): ?>
							<div class="toolbar_item toolbar_hd">HD</div>
						<? endif; ?>
						<div class="toolbar_item"><?= $value['duration'] ?></div>
					</div>
				</div>
				<div class="video_desc">
					<a href="<?= $value['url'] ?>"><?= $value['title'] ?></a>
					<p><?= $value['desc'] ?></p>
					<div class="vdesc_tools">
						<div class="vdesc_time"><i class="glyphicon glyphicon-time"></i><?= $value['date'] ?></div>
						<div class="vdesc_hits"><i class="glyphicon glyphicon-eye-open"></i><?= $value['views'] ?> - <?= $t['items']['times'] ?></div>
					</div>
				</div>								
			</div>
		</div>
	<? endforeach; ?>
<? endif; ?>

<? if ($action == 'view' && !empty($id) && $_REQUEST['type'] == 'column'): ?>
	<? foreach ($data as $key => $value): ?>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
			<div class="video_wrapper vw_1">
				<div class="video_img vh2">
					<div style="background-image: url(<?= $value['img'] ?>);" class="img vh2"></div>
					<a href="<?= $value['url'] ?>" class="video_hover"><span></span></a>
					<div class="video_toolbar">
						<? if ($value['hd'] == 1): ?>
							<div class="toolbar_item toolbar_hd">HD</div>
						<? endif; ?>
						<div class="toolbar_item"><?= $value['duration'] ?></div>
					</div>
				</div>
				<div class="video_desc">
					<a href="<?= $value['url'] ?>"><?= $value['title'] ?></a>
					<div class="vdesc_tools">
						<div class="vdesc_time"><i class="glyphicon glyphicon-time"></i><?= $value['date'] ?></div>
						<div class="vdesc_hits"><i class="glyphicon glyphicon-eye-open"></i><?= $value['views'] ?> - <?= $t['items']['times'] ?></div>
					</div>
				</div>								
			</div>
		</div>
	<? endforeach; ?>
<? endif; ?>