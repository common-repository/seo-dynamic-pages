<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/public/partials
 */
?>
<xml version="1.0" encoding="UTF-8">
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php foreach ( $services as $service ): ?>
		<?php foreach ( $service['data'] as $data ): ?>
			<url>
				<loc><?php echo $data['link']; ?></loc>
				<lastmod><?php echo date('Y-m-d', strtotime('-3 days', current_time('timestamp'))); ?></lastmod>
				<changefreq>weekly</changefreq>
				<priority>0.8</priority>
			</url>
		<?php endforeach; ?>
	<?php endforeach; ?>
</urlset> 
</xml>