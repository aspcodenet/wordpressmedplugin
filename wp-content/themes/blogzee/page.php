<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

get_header();

	do_action( 'blogzee_main_content_opening' );
	$page_settings_sidebar_layout = BZ\blogzee_get_customizer_option( 'page_settings_sidebar_layout' );
	$page_sidebar_layout_meta = metadata_exists( 'post', get_the_ID(), 'page_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) : 'customizer-setting';
	$array = [
		'post_id'	=>	get_the_ID(),
		'customizer_layout'	=>	$page_settings_sidebar_layout
	];
	$array['position'] = ['left-sidebar'];
	if( in_array( $page_sidebar_layout_meta, [ 'left-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( 'page_sidebar_layout', $array );
	?>
		<main id="primary" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

	<?php
	$array['position'] = ['right-sidebar'];
	if( in_array( $page_sidebar_layout_meta, [ 'right-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( 'page_sidebar_layout', $array );
	do_action( 'blogzee_main_content_closing' );

get_footer();