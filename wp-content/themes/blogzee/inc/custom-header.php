<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Blogzee Pro
 */

use Blogzee\CustomizerDefault as BZ;
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blogzee_header_style()
 */
function blogzee_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'blogzee_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => 'ffffff',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'blogzee_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'blogzee_custom_header_setup' );

if ( ! function_exists( 'blogzee_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see blogzee_custom_header_setup().
	 */
	function blogzee_header_style() {
		$header_text_color = BZ\blogzee_get_customizer_option( 'header_textcolor' );
		$header_hover_textcolor = BZ\blogzee_get_customizer_option( 'site_title_hover_textcolor' );
		$site_description_color = BZ\blogzee_get_customizer_option( 'site_description_color' );

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.blogzee-light-mode .site-header .site-title,
			.blogzee-light-mode .site-header .site-title a,
			.blogzee-light-mode .site-footer .site-title,
			.blogzee-light-mode .site-footer .site-title a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			.blogzee-light-mode .site-header .site-description {
				color: <?php echo esc_attr( $site_description_color ); ?>;
			}
			.blogzee-light-mode .site-header .site-title:hover,
			.blogzee-light-mode .site-footer .site-title:hover a,
			.blogzee-light-mode .site-header .site-title:hover a,
			.blogzee-light-mode .site-footer .site-title:hover {
				color: <?php echo esc_attr( $header_hover_textcolor ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;