<?php

	function news_process ($args) { // checked
		global $lang, $t, $invertsubs;

		$width  	  = !empty($args['width'])  ? $args['width'] : 100;
		$height 	  = !empty($args['height']) ? $args['height'] : 60;
		$str_len 	  = !empty($args['str_len']) ? $args['str_len'] : 45;
		$thumb_width  = !empty($args['thumb_width']) ? $args['thumb_width'] : 50;
		$thumb_height = !empty($args['thumb_height']) ? $args['thumb_height'] : 50;

		$data = array();
		
		foreach($args['data'] as $key => $value) {

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
			$img = !empty($img['cropped']) ? $img['cropped'] : (!empty($img['img']) ? thumb($img['img'], $width, $height) : '');
			
			$data['data'][$key] = array(
				'id'      => $value['id'],
				'title'   => mb_strlen($title, 'UTF-8') > $str_len ? mb_substr($title, 0, $str_len, 'UTF-8').'...' : $title,
				'desc'    => mb_strlen($desc, 'UTF-8') > 500 ? mb_substr($desc, 0, 500, 'UTF-8').'...' : $desc,
				'img'     => $img,
				'youtube' => $value['youtube'],
				'gallery' => $value['gallery'],
				'hd'      => $value['hd'],
				'views'   => number_format($value['views']),
				'duration' => $value['duration'],
				'date'    => $date,
				'url'     => createURL("v={$value['id']}", $value['title']),
				
			);

			

			if (!empty($args['desc'])) {

				$data[$key]['desc'] = mb_substr(strip_tags($value['desc']), 0, 300, 'UTF-8');
			}


			// break foreach ------------------------------------------------------------------- //

			if (!empty($args['break']) && $key < $args['break']) break;

		}

		$data['count']       = number_format($args['count']);
		$data['slider_view'] = $args['slider_view'];
		$data['index_page']  = $args['index_page'];
		$data['cat_name']    = $args['cat_name'];
		$data['parentid']    = $args['parentid'];

		return $data;
	}

	function gen_slider_process($slider_data) { // checked
		global $lang, $invertsubs, $t;

		$data = array();

		foreach($slider_data as $key => $value) {

			$desc = strip_tags($value['desc']);
			
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
			$img = !empty($img['cropped']) ? $img['cropped'] : (!empty($img['img']) ? $img['img'] : '');

			$data['big'][$key] = array(
				'id'       => $value['id'],
				'title'    => strip_tags($value['title']),
				'desc'     => mb_strlen($desc, 'UTF-8') > 500 ? mb_substr($desc, 0, 500, 'UTF-8').'...' : $desc,
				'img'      => $img,
				'youtube'  => strip_tags($value['youtube']),
				'url'      => createURL("v={$value['id']}", $value['title']),
				'duration' => $value['duration'],
				'date'     => $date,
			);
		}
		
		return $data;
	}
	
	

	function most_viewed_process($args) {
		global $lang, $t, $invertsubs;

		$width  =  !empty($args['width'])  ? $args['width'] : 80;
		$height =  !empty($args['height']) ? $args['height'] : 54;
		$str_len = !empty($args['len']) ? $args['len'] : 45;

		$data = array();

		foreach($args['items'] as $value) {

			$title = strip_tags($value['title']);

			$time  = convertDate('Y-m-d G:i:s', 'G:i',$value['published']);
			$day   = convertDate('Y-m-d G:i:s', 'j',$value['published']);
			$year  = convertDate('Y-m-d G:i:s', 'Y',$value['published']);
			$month = $t['months'][convertDate('Y-m-d G:i:s', 'n',$value['published']) - 1];
			$date = $day . '.' . $month . '.' . $year . ' | ' . $time;	
			

			$data[] = array(
				'id'	=> $value['id'],
				'title'	=> mb_strlen($title, 'UTF-8') > $str_len ? mb_substr($title, 0, $str_len, 'UTF-8').'...' : $title,
				'date'  => $date,
				'img'	=> $value['img'],
				'url'   => createURL("v={$value['id']}", $value['title']),
				'logo'  => '',
			);
		}
		return $data;
	}



?>