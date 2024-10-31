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
$location = get_query_var( 'location' );

$locations = explode("\r\n", get_option('sdp_locations', '') );
//need to find location to detect if it has upper case if they are present
foreach ( $locations as $loc ){
	if (strtolower( strtr( trim( $loc ) , ['\'' => '', ' ' => '-']) ) == $location ){
		$location = $loc;
		break;
	}
}
$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
$settings = json_decode( stripcslashes( $meta ) );

if ( $settings->show_footer_header ){
	get_header(); 
}else{
	?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
}

if ($settings->custom_css):?>
	<style>
	<?php echo $settings->custom_css; ?>
</style>
<?php endif;?>
<?php 
//Impreza theme support
if (function_exists('us_get_page_area_id')){
	$margin_top = '80px';
}else{
	$margin_top = '0';
}


?>
<div id="sdp-banner" style="background-image: url(<?php echo $settings->bg_image; ?>); margin-top: <?php echo $margin_top; ?>; ">
	<div class="col center"><h1><?php echo esc_html( Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ));  ?></h1></div>
</div>
<div id="sdp-post">
	<main id="sdp-post-main" class="sdp-template-main">
		<!-- <div class="row m-4 heading">
			
		</div> -->
		<?php foreach ($settings->paragraphs as $pg ) : ?>
			<?php if (Seo_dynamic_pages::SECTION_TYPE_PARAGRAPH == $pg->type) : ?>
				<div class="row paragraph <?php echo $pg->class; ?>">
					<div class="col-md-<?php echo empty($pg->image) ? 12 : 6; ?> center vcenter paragraph-heading <?php echo ( true === $pg->image_position_left) ? 'order-1' : 'order-0'; ?>"><h2 class="av-special-heading-tag"><?php echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->heading, $settings, $location )); ?></h2><br/><?php echo do_shortcode( Seo_dynamic_pages_Public::get_var( $pg->html, $settings, $location ) ); ?>
					<?php if ( property_exists ( $pg , 'cta_button' )): ?>
						<div class="col center"><p><?php 
						echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->cta_button->text, $settings, $location ));  ?></p>
					</div>
					<div class="col center">
					<?php /* <button class="btn button" onclick="window.location.href='<?php echo $pg->cta_button->link_url; ?>';" ><?php 
					echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->cta_button->button_text, $settings, $location ));  ?></button> */?>
					<div class="w-btn-wrapper width_auto align_left"><a class="w-btn us-btn-style_2 icon_none" href="<?php echo $pg->cta_button->link_url; ?>" ><span class="w-btn-label"><?php 
					echo esc_html( Seo_dynamic_pages_Public::get_var( $pg->cta_button->button_text, $settings, $location ));  ?></span></a></div>
				</div>
			<?php endif; ?>
		</div>
		<?php if ( !empty($pg->image) ) : ?>
			<?php /*<div class="col-md-6 center vcenter paragraph-image <?php echo ( true === $pg->image_position_left) ? 'order-0' : 'order-1'; ?>"><img src="<?php echo Seo_dynamic_pages_Public::get_var( $pg->image, $settings, $location ); ?>" height="<?php echo Seo_dynamic_pages_Public::get_var( $pg->image_height, $settings, $location ); ?>" width="<?php echo Seo_dynamic_pages_Public::get_var( $pg->image_width, $settings, $location ); ?>" alt="<?php echo Seo_dynamic_pages_Public::get_var( $pg->image_alt, $settings, $location ); ?>" title="<?php echo Seo_dynamic_pages_Public::get_var( $pg->image_title, $settings, $location ); ?>"/></div>

			*/ ?>
			 <div class="col-md-6 center vcenter paragraph-image <?php echo ( true === $pg->image_position_left) ? 'order-0' : 'order-1'; ?>"><?php echo do_shortcode(Seo_dynamic_pages_Public::get_var( $pg->image, $settings, $location )); ?></div>
		<?php endif; ?>

	</div>
	<?php elseif (Seo_dynamic_pages::SECTION_TYPE_REGULAR == $pg->type): ?>
		<div class="row section" style="background-image: url(<?php echo $pg->image; ?>); <?php echo 1 == $pg->full_width ? 'margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);' : ''; ?>; <?php echo $pg->height ? 'height: '.$pg->height .'px' : ''; ?> ">     
	<!-- <div class="row m-3 section-label">
		<div class="col center"><h3><?php echo esc_html( Seo_dynamic_pages_Public::get_var( $settings->sections_label, $settings, $location ));  ?></h3></div>
	</div> -->
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

		<?php /*if ($settings->cta_buttons ): ?>
			<div class="row mt-3 cta">
				<div class="col center"><p><?php 
				echo esc_html( Seo_dynamic_pages_Public::get_var( $settings->cta_buttons[ 0 ]->text, $settings, $location ));  ?></p></div>
			</div>
			<div class="row">
				<div class="col center"><button class="btn button" onclick="window.location.href='<?php echo $settings->cta_buttons[ 0 ]->link_url; ?>';" ><?php 
				echo esc_html( Seo_dynamic_pages_Public::get_var( $settings->cta_buttons[ 0 ]->button_text, $settings, $location ));  ?></button></div>
			</div>
		<?php endif;*/ ?>
		<div class="row m-2 last-updated">
			<div class="col center"><p>Last Updated: <?php echo date('m/d/Y', strtotime('-3 days', current_time('timestamp'))); ?> - <?php echo $settings->service_name; ?> from <?php echo $location; ?></p></div>
		</div>
	</main><!-- .site-main -->
</div><!-- .content-area -->
<?php 
if ( $settings->show_footer_header ){
	get_footer();
}else{
	wp_footer(); ?>
</body>
</html>
<?php } ?>
