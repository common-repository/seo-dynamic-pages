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
<div id="sdp-sitemap">
	<?php foreach ( $services as $service ): ?>
		<h2><?php echo $service['name']; ?></h2>
		<ul>
			<?php foreach ( $service['data'] as $data ): ?>
				<li><a href="<?php echo $data['link']; ?>"><?php echo $data['h1_tag']; ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endforeach; ?>
</div>