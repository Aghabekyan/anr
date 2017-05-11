<div class="container rooms-wrapper">
	<? if (empty($id)): ?>
		<div class="heading">
			<h2><?= $t['index']['rooms_and_rates']['title'] ?></h2>
			<img src="./img/accmod.png">
			<p><?= $t['index']['rooms_and_rates']['desc'] ?></p>
		</div>
		<? if (!empty($rooms) ): ?>
			<div class="row">
				<? foreach ($rooms as $value): ?>
					<div class="col-xl-6 col-lg-6 col-md-12">
						<div class="rooms-preview">
							<h2><a href="<?= createURL("rooms&id={$value['id']}") ?>"><?= $value['title'] ?></a></h2>
							<a href="<?= createURL("rooms&id={$value['id']}") ?>">
								<img src="<?= thumb($value['img']['img'], 540, 290) ?>">
							</a>
							<p><?= $value['desc'] ?></p>
							<div class="view-details clearfix">
								<a class="book-this-room" href="<?= createURL('reservation') ?>"><?= $t['items']['book_room'] ?></a>
								<a href="<?= createURL("rooms&id={$value['id']}") ?>"><?= $t['items']['view_details'] ?></a>
							</div>						
						</div>
					</div>
				<? endforeach; ?>
			</div>
		<? endif; ?>
	<? else: ?>
		<div class="heading">
			<h2><?= $currentRoom['title'] ?></h2>
			<img src="./img/accmod.png">
			<p style="max-width: 100%"><?= $currentRoom['desc'] ?></p>
		</div>
		<div class="container">
			<div class="row room_view">
				<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
					<? if (!empty($currentRoom['gallery']['url'])): ?>
						<div class="fotorama">
							<? foreach ($currentRoom['gallery']['url'] as $value): ?>
								<img src="<?= $value ?>">
							<? endforeach; ?>
						</div>					
					<? endif; ?>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
					<h4><?= $t['items']['room_desc'] ?></h4>
					<div class="room-fulldesc">
						<?= $currentRoom['fulldesc'] ?>	
					</div>
				</div>
			</div>
			<? if (!empty($currentRoom['youtube'])): ?>
				<div class="youtube-wrapper">
					<iframe src="https://www.youtube.com/embed/<?= $currentRoom['youtube'] ?>" frameborder="0" allowfullscreen></iframe>
				</div>
			<? endif; ?>
			<div class="view-details clearfix">
				<a class="book-this-room" href="<?= createURL("reservation") ?>"><?= $t['items']['book_room'] ?></a>
			</div>
			<div class="suggested-room-heading"><h2><?= $t['items']['compare'] ?></h2></div>
			<div class="row">
				<? foreach ($rooms as $value): ?>
					<? if ($value['id'] != $id): ?>
						<div class="col-xl-3 col-lg-3 col-md-6 col-xs-12">
							<div class="suggested-room">
								<div style="background-image: url(<?= thumb($value['img']['img'], 248, 222) ?>);" class="suggested-room-img img"></div>						
								<h4><?= $value['title'] ?></h4>
								<div class="view-details clearfix">
									<a href="<?= createURL("rooms&id={$value['id']}") ?>"><?= $t['items']['view_details'] ?></a>
								</div>						
							</div>
						</div>
					<? endif; ?>
				<? endforeach; ?>
			</div>
		</div>
	<? endif; ?>
</div>

