<div class="container rooms-wrapper">
	<div class="heading">
		<h2><?= $t['index']['rooms_and_rates']['title'] ?></h2>
		<img src="./img/accmod.png">
		<p><?= $t['index']['rooms_and_rates']['desc'] ?></p>
	</div>
	<? if (!empty($rooms)): ?>
		<div class="row">
			<? foreach ($rooms as $key => $value): ?>
				<div class="col-xl-<?= ($key == 3 || $key == 4) ? 6 : 4 ?> col-lg-<?= ($key == 3 || $key == 4) ? 6 : 4 ?>">
					<a href="<?= createURL("rooms&id={$value['id']}") ?>" style="background-image: url(<?= !empty($value['img']['cropped']) ? thumb($value['img']['cropped'], 540, 300) : (!empty($value['img']['img']) ? thumb($value['img']['img'], 540, 300) : '') ?>);" class="room img">
						<h2><?= $value['title'] ?></h2>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	<? endif; ?>
</div>


<div class="rooms-wrapper gallery-wrapper">
	<div class="heading">
		<h2><?= $t['index']['gallery']['title'] ?></h2>
		<img src="./img/accmod.png">
		<p><?= $t['index']['gallery']['desc'] ?></p>

		<div class="gallery-buttons button-group filter-button-group">
			<button data-filter="*"><?= $t['index']['gallery']['all'] ?></button>
			<button data-filter=".gallery-1"><?= $t['index']['gallery']['bedrooms'] ?></button>
			<button data-filter=".gallery-2, .transition"><?= $t['index']['gallery']['bar'] ?></button>
			<button data-filter=".gallery-3, .alkaline-earth"><?= $t['index']['gallery']['conferences'] ?></button>
		</div>
	</div>
	<? if (!empty($gallery)): ?>
		<div class="gallery clearfix">
			<? foreach ($gallery as $value): ?>
				<a style="background-image: url(<?= !empty($value['cropped']) ? thumb($value['cropped'], 1400, 1400) : (!empty($value['img']) ? thumb($value['img'], 1400, 1400) : '') ?>);" class="gallery-unit <?= 'gallery-' . $value['type'] ?> main-gallery" rel="group" href="<?= $value['img'] ?>"></a>
			<? endforeach; ?>
		</div>
	<? endif; ?>
</div>
<hr>
<div class="container services">
	<div class="heading">
		<h2><?= $t['index']['services']['title'] ?></h2>
		<img src="./img/accmod.png">
		<p><?= $t['index']['services']['desc'] ?></p>
	</div>		
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="service-unit" href="#">
				<img src="img/services/wifi.png" alt="">
				<h3><?= $t['index']['services']['1']['title'] ?></h3>
				<p><?= $t['index']['services']['1']['desc'] ?></p>
			</a>
		</div>	
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="service-unit" href="#">
				<img src="img/services/food.png" alt="">
				<h3><?= $t['index']['services']['2']['title'] ?></h3>
				<p><?= $t['index']['services']['2']['desc'] ?></p>
			</a>
		</div>	
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="service-unit" href="#">
				<img src="img/services/rent.png" alt="">
				<h3><?= $t['index']['services']['3']['title'] ?></h3>
				<p><?= $t['index']['services']['3']['desc'] ?></p>
			</a>
		</div>	
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a class="service-unit" href="#">
				<img src="img/services/taxi.png" alt="">
				<h3><?= $t['index']['services']['4']['title'] ?></h3>
				<p><?= $t['index']['services']['4']['desc'] ?></p>
			</a>
		</div>				
	</div>
</div>
<hr>		
<div class="container">
	<div class="heading">
		<h2><?= $t['index']['feedback']['title'] ?></h2>
		<img src="./img/accmod.png">
		<p><?= $t['index']['feedback']['desc'] ?></p>
	</div>

	<div class="row feedback-gallery">
		<? if (!empty($feedbacks)) foreach ($feedbacks as $value): ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="feedback">
					<div class="feedbeack-top clearfix">
						<img src="<?= !empty($value['img']) ? bURL . 'disk/feedbacks/' . $value['img'] . '.jpg' : 'img/no-image.png' ?>">
						<p><?= $value['feedback'] ?></p>
						<span>
							<img src="img/corner.png">
						</span>
					</div>							
					<div class="feedbeack-bottom">
						<?= $value['name'] ?> - <span>Diamond House Hotel</span>
					</div>							
				</div>
			</div>
		<? endforeach; ?>
	</div>
	<div class="write-feedback">
		<span>
			<i class="fa fa-pencil" aria-hidden="true"></i>
			<?= $t['index']['feedback']['form']['write'] ?>
		</span>
	</div>
	<div class="feedback-area">
		<form action="<?= createURL('feedbacks') ?>" method="POST" enctype="multipart/form-data">
			<p><?= $t['index']['feedback']['form']['desc'] ?></p>
			<div class="form-group feedback-day">
				<label class="form-control-label" for="inputSuccess1"><?= $t['index']['feedback']['form']['name'] ?></label>
				<input type="text" name="name" required class="form-control form-control-success" id="inputSuccess1">
			</div>
			<div class="form-group feedback-day">
				<label class="form-control-label" for="inputSuccess1"><?= $t['index']['feedback']['form']['email'] ?></label>
				<input type="text" name="email" class="form-control form-control-success" id="inputSuccess1">
			</div>
			<div class="form-group feedback-day">
				<label class="form-control-label" for="inputSuccess1"><?= $t['index']['feedback']['form']['feedback'] ?></label>
				<textarea required class="form-control form-control-success" name="feedback" id="inputSuccess1"></textarea>
			</div>
			<div class="row">
				<div class="col-lg-6 col-xs-12">
					<div class="feedback-file-upload">
						<label class="custom-file">
							<input type="file" name="guest_img" id="file" class="custom-file-input">
							<span class="custom-file-control"></span>
						</label>
					</div>	
				</div>
				<div class="col-lg-6 col-xs-12">
					<div class="recaptcha">
						<div class="g-recaptcha" data-sitekey="6Lef2Q8UAAAAAAAdFFJRJBwlVGFoj3SDQqzx58Mj"></div>		
					</div>
				</div>
			</div>
			<div class="additional">
				<input type="submit" value="<?= $t['index']['feedback']['form']['send'] ?>">
			</div>			
		</form>
	</div>
</div>
<hr>
<div class="contacts">
	<div class="heading">
		<h2><?= $t['index']['location']['title'] ?></h2>
		<img src="./img/accmod.png">
	</div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3048.1161466443928!2d44.50506471584194!3d40.18422857939271!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abcfd67375505%3A0xc43e36a918d5de4e!2sDiamond+House+Hotel!5e0!3m2!1sen!2s!4v1481915636161" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>			
	<div class="map-mask">
		<div class="contact-info">
			<h3><?= $t['index']['location']['contacts'] ?></h3>
			<p><?= $t['index']['location']['help'] ?></p>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['name'] ?></strong>
				<span>DIAMOND HOUSE</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['address'] ?></strong>
				<span>86 Aram str., 0002 Yerevan, Armenia</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['tel'] ?></strong>
				<span>(+374)10 50 80 80</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['tel'] ?></strong>
				<span>(+374) 11 44 80 80</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['fax'] ?></strong>
				<span>(+374) 10 50 09 33</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['skype'] ?></strong>
				<span>DiamondHouse86</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['email'] ?></strong>
				<span>reservation@diamondhousehotel.am</span>
			</div>
			<div class="contact-unit">
				<strong><?= $t['index']['location']['email'] ?></strong>
				<span>info@diamondhousehotel.am</span>
			</div>
		</div>
	</div>
</div>
