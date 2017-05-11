<div class="heading">
	<h2><?= $data['title'] ?></h2>
	<img src="./img/accmod.png">
</div>
<div class="container">
	<div class="row room_view">
		<div class="offset-lg-1 col-lg-10">
			<div class="room-fulldesc">
				<?= $data['desc'] ?>
			</div>
		</div>
		<div class="offset-lg-1 col-lg-10">
			<? if (!empty($data['gallery']['url'])): ?>
				<div class="fotorama" data-width='100%'>
					<? foreach ($data['gallery']['url'] as $value): ?>
						<img src="<?= $value ?>">
					<? endforeach; ?>
				</div>					
			<? endif; ?>
		</div>
	</div>
	<? if (!empty($data['youtube'])): ?>
		<div class="youtube-wrapper">
			<iframe src="https://www.youtube.com/embed/<?= $data['youtube'] ?>" frameborder="0" allowfullscreen></iframe>
		</div>
	<? endif; ?>
</div>