	<div class="container">
	<div style="min-height: 800px" class="container">

		<? if ($parentid == 26): ?>
				
			<div class="ads">
				<div class="row">
					<? foreach ($zodiac as $value): ?>
						<div class="col-lg-1 col-md-2 col-sm-2 col-xs-4">
							<div class="zodiacUnit">
								<a href="<?= createURL("categories={$value['id']}&parentid=26") ?>"><img src="img/zodiac/<?= $value["title_en"] ?>.png" alt="<?= $value["title_{$lang['name']}"] ?>"></a>
								<small><?= $value["title_{$lang['name']}"] ?></small>	
							</div>
						</div>
					<? endforeach; ?>
				</div>
			</div>

		<? endif; ?>

		<div class="heading"><?= $cat_name ?></div>

		<div class="block1">
			<div class="block_heading">
				<div class="heading_title">
					<i class="glyphicon glyphicon-film"></i><b><?= $t['items']['all_posts'] ?> :</b> <?= $res['count'] ?>
				</div>
				<div style="height: auto; margin-top: 0" class="heading_type">
					<div class="btn-group">
						<div class="btn-group">
							<a href="bootstrap-elements.html" data-target="#" class="btn btn-raised dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<?= $t['items']['orderby'] ?>
								<span class="caret"></span>
								<div class="ripple-container"></div>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?= createURL("categories={$category}&parentid={$parentid}&orderby=popular") ?>"><?= $t['items']['popular'] ?></a></li>
								<li><a href="<?= createURL("categories={$category}&parentid={$parentid}&orderby=latest") ?>"><?= $t['items']['latest'] ?></a></li>
							</ul>
						</div>
					</div>			
				</div>
			</div>	
			<div style="padding: 0 15px;" class="row">
				<? foreach ($data as $key => $value): ?>
					<div class="col-lg-3">
						<div class="video_wrapper vw_1">
							<div class="video_img vh2">
								<div style="background-image: url(<?= $value['img'] ?>);" class="img vh2"></div>
								<a href="<?= $value['url'] ?>" class="video_hover">
									<? if (!empty($value['youtube']) && empty($value['gallery'])): ?>
										<span style="background-image: url(img/play.png)"></span>
									<? elseif (!empty($value['gallery']) && empty($value['youtube'])): ?>
										<span style="background-image: url(img/photo.png); height: 32px;"></span>
									<? endif; ?>
								</a>
								<div class="video_toolbar">
									<? if ($value['hd'] == 1): ?>
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
									<div class="vdesc_hits"><i class="glyphicon glyphicon-eye-open"></i><?= $value['views'] ?> - <?= $t['items']['times'] ?></div>
								</div>
							</div>								
						</div>
					</div>
				<? endforeach; ?>					
			</div>
			<div style="padding-left: 15px" class="row">
				<div class="col-lg-12">
					<?= $res['pagination'] ?>
				</div>
			</div>					
		</div>
	</div>	
</div>