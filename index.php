<?php
		
	require_once('config.php');
	$validLanguages = array('am', 'en', 'ru');
	$defaultLanguage = 'en';
	$lang['name'] = (isset($_GET['l']) and in_array($_GET['l'], $validLanguages)) ? $_GET['l'] : $defaultLanguage;
	
	ob_start();
		require(bDIR.'/engine/translations/'.$lang['name'].'.php');
	ob_end_clean();
	
	$validRoutes = array('v', 'categories', 'search', 'rss', 'sitemap', 'about', 'contacts', 'ajax_snippets', 'static', 'reservation', 'rooms', 'feedbacks', 'notification');

	$local = array(
		'am' => array('fb' => 'hy_AM', 'lang' => 'AM'),
		'ru' => array('fb' => 'ru_RU', 'lang' => 'RU'),
		'en' => array('fb' => 'en_US', 'lang' => 'EN'),
	);


	// Routing ---------------------------------------------------------------------------------------------------------------------------------------------------------------- //

	$route = 'index';

	foreach ($validRoutes as $value) {
		if (isset($_GET[$value])) {
			$route = $value;
		}
	}

	$page_title = 'DiamondHouseHotel.am';

	require bDIR."/engine/routes/{$route}.php";
	
?>