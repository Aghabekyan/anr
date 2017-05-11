<?='<?xml version="1.0" encoding="UTF-8"?>'?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" version="2.0">
	<channel>
		<title><?= $t['rss']['title'] ?></title>
		<link><?= bURL ?></link>
		<description><?= $t['rss']['desc'] ?></description>
		<image>
			<url></url>
			<title><?= $t['rss']['title'] ?></title>
			<link><?= bURL ?></link>	
		</image>
		<? if (!empty($data)) foreach($data as $value):?>
			<item>
				<title><![CDATA[<?=$value['title']?>]]></title>
				<link><![CDATA[<?=$value['url']?>]]></link>
				<description><![CDATA[<?=$value['desc']?>]]></description>
				<category>Movie</category>
				<? if ($value['img']): ?>
					<enclosure url="<?= $value['img'] ?>" type="image/jpeg"/>
				<? endif; ?>
				<pubDate><?= $value['date'] ?></pubDate>
			</item>
		<? endforeach; ?>
	</channel>
</rss>
