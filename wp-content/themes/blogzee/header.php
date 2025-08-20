<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
require get_template_directory() . '/builder/responsive-header.php';
use Blogzee_Builder as BB;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> <?php blogzee_schema_body_attributes(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blogzee' ); ?></a>
	<?php
		/**
		 * hook - blogzee_page_prepend_hook
		 * 
		 * hooked - blogzee_loader_html - 1
		 * hooked - blogzee_custom_header_html - 20
		 * 
		 * @package Blogzee Pro
		 * @since 1.0.0 
		 */
		if( has_action( 'blogzee_page_prepend_hook' ) ) do_action( "blogzee_page_prepend_hook" );

		$headerClass = 'site-header layout--one ' . BZ\blogzee_get_customizer_option( 'header_builder_section_width' );
		?>
			<header id="masthead" class="<?php echo esc_attr( $headerClass ); ?>">
				<div class="blogzee-container">
					<div class="row">
						<?php
							new BB\Header_Builder_Render();
							new BB\Responsive_Header_Builder_Render();
						?>
					</div>
				</div>
			</header><!-- #masthead -->
		<?php

		/**
		 * Hook - blogzee_header_after_hook
		 * 
		 * Hooked  - blogzee_progress_bar - 10
		 * Hooked  - blogzee_ticker_html - 20
		 * Hooked  - blogzee_main_banner_html - 30
		 * Hooked  - blogzee_category_collection_html - 40
		 * Hooked  - blogzee_carousel_html - 50
		 * 
		 * @since 1.0.0
		 */
		if( has_action( 'blogzee_header_after_hook' ) ) do_action( 'blogzee_header_after_hook' );