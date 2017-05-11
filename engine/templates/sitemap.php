<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<?='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'?>

	<url>
		<? foreach($data as $value): ?>
				<loc><![CDATA[<?=$value['url']?>]]></loc>
				<lastmod><?=$value['publish_date']?></lastmod>
				<changefreq>daily</changefreq>
				<priority>0.5</priority>
		<?endforeach;?>
	</url>

<?='</urlset>'?>