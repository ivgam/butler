<?php
header("Content-type: text/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?= BASE_URL ?>/sitemap</loc>
		<lastmod><?= date('Y-m-d') ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.1</priority>
	</url>
	<url>
		<loc><?= BASE_URL ?>/attribution</loc>
		<lastmod><?= date('Y-m-d') ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.1</priority>
	</url>
    <url>
		<loc><?= BASE_URL ?></loc>
		<lastmod><?= date('Y-m-d') ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>1.0</priority>
	</url>
	<url>
		<loc><?= BASE_URL ?>/about</loc>
		<lastmod><?= date('Y-m-d', time() - 7 * 24 * 60 * 60) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.6</priority>
	</url>
	<url>
		<loc><?= BASE_URL ?>/contact</loc>
		<lastmod><?= date('Y-m-d', time() - 7 * 24 * 60 * 60) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.4</priority>
	</url>
	<url>
		<loc><?= BASE_URL ?>/privacy</loc>
		<lastmod><?= date('Y-m-d', time() - 7 * 24 * 60 * 60) ?></lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.3</priority>
	</url>
	<?php
	$oResult = Landing_Helper::getActiveLandings();
	foreach ($oResult as $row) {
		?>
		<url>
			<loc><?= BASE_URL . '/subscriptions/' . urlencode($row['campaign_name']) . '/' . urlencode($row['landing_name']) ?></loc>
			<lastmod><?= date('Y-m-d') ?></lastmod>
			<changefreq>daily</changefreq>
			<priority>0.5</priority>
		</url>
	<?php } ?>
</urlset>