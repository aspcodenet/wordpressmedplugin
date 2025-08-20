<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

get_header();

	do_action( 'blogzee_main_content_opening' );
	$archive_sidebar_layout = BZ\blogzee_get_customizer_option( 'archive_sidebar_layout' );
	$elementClass = ' archive-align--' . BZ\blogzee_get_customizer_option('archive_post_elements_alignment');

	$current_id = get_queried_object_id();
	if( is_category() ) {
		$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_category_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_category_sidebar_custom_meta_field', true ) : 'customizer-setting';
		$array = [
			'post_id'	=>	$current_id,
			'customizer_layout'	=>	$archive_sidebar_layout
		];
		$array['position'] = ['left-sidebar'];
		$array['meta_type'] = 'term';
		if( in_array( $archive_sidebar_layout_meta, [ 'left-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( '_blogzee_category_sidebar_custom_meta_field', $array );
	} elseif( is_tag() ) {
		$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_post_tag_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_post_tag_sidebar_custom_meta_field', true ) : 'customizer-setting';
		$array = [
			'post_id'	=>	$current_id,
			'customizer_layout'	=>	$archive_sidebar_layout
		];
		$array['position'] = ['left-sidebar'];
		$array['meta_type'] = 'term';
		if( in_array( $archive_sidebar_layout_meta, [ 'left-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( '_blogzee_post_tag_sidebar_custom_meta_field', $array );
	} else {
		if( in_array( $archive_sidebar_layout, ['left-sidebar'] )  ) get_sidebar('left');
	}

	?>
		<main id="primary" class="site-main">
			<?php
				/**
				 * Hook - blogzee_page_header_hook
				 * 
				 * Hooked - blogzee_archive_header_html - 10
				 */
				// do_action( 'blogzee_page_header_hook' );
				if ( have_posts() ) :
					$ads_info = blogzee_algorithm_to_push_ads_in_archive();
					$count = 0;
					echo '<div class="blogzee-inner-content-wrap has-button'. esc_attr( $elementClass ) .'">'; //inner-content-wrap
						while ( have_posts() ) : the_post();
							if( ! is_null( $ads_info ) ) :
								if( in_array( $wp_query->current_post, $ads_info['random_numbers'] ) ) :
									blogzee_random_post_archive_advertisement_part( is_array( $ads_info['ads_to_render'] ) ? $ads_info['ads_to_render'][$count] : $ads_info['ads_to_render'] );
									$count++;
								endif;
							endif;
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/archive/layout' );
							// $post_counter++;
						endwhile;
					echo '</div>'; //  end: blogzee-inner-content-wrap
					
					/**
					 * hook - blogzee_pagination_link_hook
					 * 
					 * hooked - blogzee_pagination_fnc - 10
					 * 
					 * @package Blogzee Pro
					 * @since 1.0.0
					 */
					do_action( 'blogzee_pagination_link_hook' );
				else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
			?>
		</main><!-- #main -->

	<?php
	if( is_category() ) {
		$array['position'] = ['right-sidebar'];
		if( in_array( $archive_sidebar_layout_meta, [ 'right-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( '_blogzee_category_sidebar_custom_meta_field', $array );
	} elseif( is_tag() ) {
		$array['position'] = ['right-sidebar'];
		if( in_array( $archive_sidebar_layout_meta, [ 'right-sidebar', 'customizer-setting' ] ) ) blogzee_get_sidebar( '_blogzee_post_tag_sidebar_custom_meta_field', $array );
	} else {
		if( in_array( $archive_sidebar_layout, ['right-sidebar'] )  ) get_sidebar();
	}
	do_action( 'blogzee_main_content_closing' );

get_footer();