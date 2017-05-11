<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags always come first -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title><?= isset($page_title) ? $page_title : 'diamondhousehotel.am | ' . $t['items']['header_title'] ?></title>

		<? if (isset($_GET['rooms'])): ?>
			<meta property="og:title" content="<?= $currentRoom['title'] ?>"/>
			<meta property="og:type" content="article"/>
			<meta property="og:description" content="<?= $currentRoom['fb_desc'] ?>"/>
			<meta property="og:url" content="<?= $currentRoom['fb_url'] ?>"/>
			<meta property="og:image" content="<?= $currentRoom['fb_img'] ?>"/>
		<? else: ?>
			<meta property="og:title" content="<?= isset($page_title) ? $page_title : 'DiamondHouseHotel.am' ?>" />
			<meta property="og:type" content="website">
			<meta property="og:description" content="Diamond House Hotel Yerevan"/>
			<meta property="og:url" content="http://diamondhousehotel.am"/>
			<meta property="og:image" content="<?= !empty($FBData['img']) ? bURL . thumb($FBData['img'], 600, 400) : bURL."img/fb/fb_og_img.jpg" ?>"/>
		<? endif; ?>

		<!-- main css files -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/css/tether.min.css" /> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" /> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
		<link href="<?= htmDIR ?>css/vendor.css?v=0.1" rel="stylesheet">
		<link href="<?= htmDIR ?>css/main.css?v=0.7" rel="stylesheet">
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

	<body>
	    <script>
	     	var htmDIR = '<?= htmDIR ?>';
	     	var lang   = '<?= $lang['name'] ?>';
	     	var trarr = '<?= json_encode($t['js']) ?>';
	    </script>	
		<header>
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 col-xs-12">
							<div class="logo-cont">
								<div class="logo">
									<a href="<?= createURL() ?>"><img src="./img/logo.png" alt=""></a>
								</div>
							</div>
						</div>
						<div class="col-xl-7 col-lg-6 col-md-5 col-sm-6 col-xs-12">
							<div class="header-slogan"><img src="./img/slogan.png" alt=""></div>
							<div class="info-unit-box">
								<div class="info-unit">
									<i class="fa fa-map-marker" aria-hidden="true"></i>
									Armenia, Yerevan, Aram str. 86
								</div>	
								<div class="info-unit">
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
									info@diamondhousehotel.am
								</div>	
								<div class="info-unit">
									<i class="fa fa-phone" aria-hidden="true"></i>
									 +(374 10) 50 80 80
								</div>
							</div>	
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
							<div class="socials">
								<div class="socail-icons">
									<a href="https://www.facebook.com/diamondhousehotel/?fref=ts" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>	
									<a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>	
									<a href="https://www.linkedin.com/company/diamond-house-hotel-yerevan" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>	
								</div>
							</div>
							<div class="languages">
								<?
									$changeLang = $local;	
									unset($changeLang[$lang['name']]);
								?>	

								<a href="<?= langChanger(array('l' => $lang['name'])) ?>"><?= $local[$lang['name']]['lang'] ?> <img src="img/flags/<?= $lang['name'] ?>.png"></a>
								<div class="drop-down-lang">
									<? foreach ($changeLang as $key => $value): ?>
										<a href="<?= langChanger(array('l' => $key)) ?>"><?= $value['lang'] ?> <img src="img/flags/<?= $key ?>.png"></a>
									<? endforeach; ?>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<nav class="navbar">
							<button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i></button>
							<div class="collapse navbar-toggleable-md" id="navbarResponsive">
								<ul class="nav navbar-nav navbar-right">
									<li class="nav-item <?= $route == 'index' ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('') ?>"><?= $t['header']['home'] ?><span class="sr-only">(current)</span></a>
									</li>

									<li class="nav-item <?= $route == 'rooms' ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('rooms') ?>"><?= $t['header']['rooms'] ?> <span class="sr-only">(current)</span></a>
									</li>

									<li class="nav-item <?= $route == 'reservation' ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('reservation') ?>"><?= $t['header']['reservation'] ?></a>
									</li>
									<li class="nav-item <?= $route == 'static' && $_GET['static'] == 1 ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('static=1') ?>"><?= $t['header']['services'] ?></a>
									</li>
									<li class="nav-item <?= $route == 'static' && $_GET['static'] == 3 ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('static=3') ?>"><?= $t['header']['conferences'] ?></a>
									</li>									
									<li class="nav-item <?= $route == 'static' && $_GET['static'] == 4 ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('static=4') ?>"><?= $t['header']['bar'] ?></a>
									</li>
									<li class="nav-item <?= $route == 'contacts' ? 'active' : '' ?>">
										<a class="nav-link" href="<?= createURL('contacts') ?>"><?= $t['header']['contacts'] ?></a>
									</li>
								</ul>
							</div>
						</nav>						
					</div>
				</div>
			</div>			
		</header>
		<? if (!empty($genslider)): ?>
			<div id="main-slider" class="main-slider">
				<? foreach ($genslider as $value): ?>
					<div><div class="main-slider-unit" style="background-image: url(<?= !empty($value['cropped']) ? $value['cropped'] : (!empty($value['img']) ? $value['img'] : '') ?>);"></div></div>
				<? endforeach; ?>
			</div>
		<? endif; ?>
		
		<? if ($route != 'reservation'): ?>
			<? include TEMPLATES . "booking.php"; ?>
		<? endif; ?>