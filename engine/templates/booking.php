<div class="booking-wrapper <?= !in_array($route, array('index')) ? 'not-index' : '' ?>">
	<div class="container">
		<div class="booking <?= $lang['name'] == 'ru' ? 'ru' : '' ?>">
			<? if ($route == 'index'): ?>
				<div class="slogan"><img src="./img/slogan.png" alt=""></div>
			<? endif; ?>
			<div class="row">
				<form action="<?= htmDIR ?>" method="GET">
					<input type="hidden" name="reservation">
					<input type="hidden" name="l" value="<?= $lang['name'] ?>">
					<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
						<div class="your-rooms">
							<small><?= $t['booking']['book'] ?></small>
							<span><?= $t['booking']['room'] ?></span>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
						<div class="form-group booking-day">
							<label class="form-control-label" for="inputSuccess1" placeholder="First name"><?= $t['booking']['arrival'] ?></label>
							<input placeholder="<?= date("d/m/Y") ?>" value="<?= isset($_GET['dfrom']) ? $_GET['dfrom'] : '' ?>" name="dfrom" type="text" class="form-control form-control-success" id="inputSuccess1">
							<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
						<div class="form-group booking-day">
							<label class="form-control-label" for="inputSuccess1"><?= $t['booking']['departure'] ?></label>
							<input placeholder="<?= date("d/m/Y") ?>" value="<?= isset($_GET['dto']) ? $_GET['dto'] : '' ?>" name="dto" type="text" class="form-control form-control-success" id="inputSuccess1">
							<i class="fa fa-lg fa-calendar" aria-hidden="true"></i>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-4 col-sm-12">
						<input class="book-btn" type="submit" value="<?= $t['booking']['book_now'] ?>">
					</div>
					<div class="col-lg-12">
						<div class="book-slogan">
							<?= $t['booking']['slogan'] ?>
						</div>
					</div>					
				</form>

			</div>
		</div>
	</div>
</div>	