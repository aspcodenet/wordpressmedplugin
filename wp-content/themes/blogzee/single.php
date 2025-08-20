<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

get_header();

	do_action( 'blogzee_main_content_opening' );
	$single_sidebar_layout = BZ\blogzee_get_customizer_option( 'single_sidebar_layout' );
	$single_sidebar_layout_meta = metadata_exists( 'post', get_the_ID(), 'post_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'post_sidebar_layout', true ) : 'customizer-setting';
	$array = [
		'post_id'	=>	get_the_ID(),
		'customizer_layout'	=>	$single_sidebar_layout
	];
	$array['position'] = ['left-sidebar'];
	if( in_array( $single_sidebar_layout_meta, [ 'left-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( 'post_sidebar_layout', $array );
	?>
		<main id="primary" class="site-main">
			<?php
				echo '<div class="blogzee-inner-content-wrap">'; //inner-content-wrap
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'single' );
					endwhile; // End of the loop.
				echo '</div><!-- .blogzee-inner-content-wrap -->'; //inner-content-wrap
			?>
		</main><!-- #main -->
	<?php
	$array['position'] = ['right-sidebar'];
	if( in_array( $single_sidebar_layout_meta, [ 'right-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( 'post_sidebar_layout', $array );
	do_action( 'blogzee_main_content_closing' );

get_footer();