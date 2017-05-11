<div class="container">
	<div id="make-count" data-id="<?= $data['id'] ?>"></div>
	<div class="row">
		<div class="col-lg-8">
			<div class="show_desc">
				<h1 data-href="<?= $data['url'] ?>"><?= $data['title'] ?></h1>
				<img class="show_img" src="<?= $data['img']['img'] ?>">
				<? if (!empty($data['img']['desc'])): ?>
					<strong class="vcopy col-lg-12 col-md-12 col-sm-12 col-xs-12"><?= $data['img']['desc'] ?></strong>
				<? endif; ?>
				
				<?= $data['desc'] ?>

				<? if ($data['copy']): ?>
					<div class="shopPageCopy">&copy; LoveYou.am</div>
				<? endif; ?>

				<? if (!empty($data['gallery']['url'])): ?>
					<div class="fotorama" data-width="100%" data-allowfullscreen="true" data-ratio="600/400" data-max-width="100%">
						<? foreach ($data['gallery']['url'] as $key => $value): ?>
							<div data-img="<?= $value ?>">
								<? if (!empty($data['gallery']['desc'][$key])): ?>
									<span class="SDesc"><?= $data['gallery']['desc'][$key] ?></span>
								<? endif; ?>
							</div>
						<? endforeach; ?>
					</div>
				<? endif; ?>
				
				<? if (!empty($data['youtube'])): ?>
					<iframe style="margin-bottom: 7px" width="100%" height="360" src="https://www.youtube.com/embed/<?= $data['youtube'] ?>" frameborder="0" allowfullscreen></iframe>				
				<? endif; ?>
				<div class="showTopSharersUnit">
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553fa2ad366c17a4" async="async"></script>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<div class="addthis_sharing_toolbox"></div>
				</div>
				<div class="articleComments">
					<div class="fb-comments" data-href="<?= $data['fb_url'] ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
				</div>					
			</div>
		</div>

		<div class="col-lg-4">
			<div class="ads">
				<div class="row">
					<? foreach ($zodiac as $value): ?>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="zodiacUnit">
								<a href="<?= createURL("categories={$value['id']}&parentid=26") ?>"><img src="img/zodiac/<?= $value["title_en"] ?>.png" alt="<?= $value["title_{$lang['name']}"] ?>"></a>
								<small><?= $value["title_{$lang['name']}"] ?></small>	
							</div>
						</div>
					<? endforeach; ?>
				</div>
			</div>
			<div style="height:360px" class="ads">advertisement</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="block1">
		<div class="block_heading">
			<div class="heading_title">
				<b>Suggestions</b>
			</div>
		</div>	
		<div style="padding: 0 15px;" class="row">
			<? foreach ($suggestions as $key => $value): ?>
				<div class="col-lg-3">
					<div class="video_wrapper vw_1">
						<div class="video_img vh2">
							<div style="background-image: url(<?= $value['img'] ?>);" class="img vh2"></div>
							<a href="<?= $value['url'] ?>" class="video_hover"><span></span></a>
							<div class="video_toolbar">
								<? if ($value['id'] == 1): ?>
									<div class="toolbar_item toolbar_hd">HD</div>
								<? endif; ?>

								<? if (!empty($value['duration'])): ?>
									<div class="toolbar_item"><?= $value['duration'] ?></div>
								<? endif; ?>
							</div>
						</div>
						<div class="video_desc">
							<a href="<?= $value['url'] ?>"><?= $value['title'] ?></a>
							<div class="vdesc_tools">
								<div class="vdesc_time"><i class="glyphicon glyphicon-time"></i><?= $value['date'] ?></div>
								<div class="vdesc_hits"><i class="glyphicon glyphicon-eye-open"></i><?= $value['views'] ?> - times</div>
							</div>
						</div>								
					</div>
				</div>						
			<? endforeach; ?>						
		</div>					
	</div>
</div>	