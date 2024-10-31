<?php
//Impreza theme support
/*if (function_exists('us_get_page_area_id')){
	$margin_top = '80px';
}else{
	$margin_top = '0';
}*/
?>

<div id="sdp-banner" style="background-image: url(<?php echo $settings->bg_image; ?>); ">
	<div class="col center"><h1><?php echo esc_html( Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ));  ?></h1></div>
</div>
<div id="sdp-post">
	<main id="sdp-post-main" class="sdp-template-main">
		<?php foreach ($settings->paragraphs as $pg ) : ?>
			<?php if (Seo_dynamic_pages::SECTION_TYPE_PARAGRAPH == $pg->type) : ?>
				<div class="row paragraph <?php echo $pg->class; ?>">
					<div class="col-md-<?php echo empty($pg->image) ? 12 : 6; ?> center vcenter paragraph-heading <?php echo ( true === $pg->image_position_left) ? 'order-1' : 'order-0'; ?>"><h2 class="av-special-heading-tag"><?php echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->heading, $settings, $location )); ?></h2><br/><?php echo do_shortcode( Seo_dynamic_pages_Public::get_var( $pg->html, $settings, $location ) ); ?>
					<?php if ( property_exists ( $pg , 'cta_button' )): ?>
						<div class="col center"><p><?php 
						echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->cta_button->text, $settings, $location ));  ?></p>
					</div>
					<div class="col center">

						<div class="w-btn-wrapper width_auto align_left"><a class="w-btn us-btn-style_2 icon_none" href="<?php echo $pg->cta_button->link_url; ?>" ><span class="w-btn-label"><?php 
						echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->cta_button->button_text, $settings, $location ));  ?></span></a></div>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( !empty($pg->image) ) : ?>

				<div class="col-md-6 center vcenter paragraph-image <?php echo ( true === $pg->image_position_left) ? 'order-0' : 'order-1'; ?>"><?php echo do_shortcode(Seo_dynamic_pages_Public::get_var( $pg->image, $settings, $location )); ?></div>
			<?php endif; ?>

		</div>
		<?php elseif (Seo_dynamic_pages::SECTION_TYPE_REGULAR == $pg->type): ?>
			<div class="row section" style="background-image: url(<?php echo $pg->image; ?>); <?php echo 1 == $pg->full_width ? 'margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);' : ''; ?>; <?php echo $pg->height ? 'height: '.$pg->height .'px' : ''; ?> ">     
				<div class="section-inner">
					<div class="row">
						<div class="col center section-heading"><h3><?php 
						echo Seo_dynamic_pages_Public::get_var( $pg->heading, $pg, $location );  ?></h3></div>
					</div>
					<div class="row text" style="<?php echo $pg->text_strench ? 'width: '.$pg->text_strench .'%' : ''; ?>">
						<div class="col center section-text"><h4><?php 
						$index = rand(0, count($pg->sections)-1 );
						echo  Seo_dynamic_pages_Public::get_var( $pg->text, $pg, $location );  ?></h4></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="row m-2 last-updated">
		<div class="col center"><p>Last Updated: <?php echo date('m/d/Y', strtotime('-3 days', current_time('timestamp'))); ?> - <?php echo $settings->service_name; ?> from <?php echo $location; ?></p></div>
	</div>
	<?php if ($settings->output_agg_rating):  ?>
		<div class="sdp-aggreagate-rating" itemscope itemtype="http://schema.org/LocalBusiness">
			<img itemprop="image" src="<?php echo $settings->agg_company_logo; ?>" alt="<?php echo $settings->agg_company_logo_alt; ?>" />
			<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"> 
				Rated <span itemprop="ratingValue">5</span>/
				<span itemprop="bestRating">5</span> 
				based on <span itemprop="reviewCount"><?php echo rand(20, 60); ?></span> customer reviews
			</div>
			<span itemprop="name"><?php echo Seo_dynamic_pages_Public::get_var( $settings->agg_company_name, $settings, $location );?></span>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress"><?php echo Seo_dynamic_pages_Public::get_var( $settings->agg_company_address, $settings, $location );?></span>
				<span itemprop="addressLocality"><?php echo Seo_dynamic_pages_Public::get_var( $settings->agg_company_city, $settings, $location );?></span>, 
				<span itemprop="addressRegion"><?php echo Seo_dynamic_pages_Public::get_var( $settings->agg_company_state, $settings, $location );?></span>
			</div> 
			Phone: <span itemprop="telephone"><?php echo Seo_dynamic_pages_Public::get_var( $settings->agg_company_phone, $settings, $location );?></span>
		</div>
	<?php endif; ?>
</main><!-- .site-main -->
</div><!-- .content-area -->

