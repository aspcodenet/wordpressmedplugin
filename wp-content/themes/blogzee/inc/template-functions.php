<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogzee_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	$archive_post_layout = BZ\blogzee_get_customizer_option( 'archive_post_layout' );
	if( is_archive() || is_home() ) {
		$archive_sidebar_layout_meta = 'customizer-setting';
		$archive_layout_meta = 'customizer-layout';
		$current_id = get_queried_object_id();
		if( is_category() ) {
			$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_category_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_category_sidebar_custom_meta_field', true ) : 'customizer-setting';
			$archive_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_category_archive_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_category_archive_custom_meta_field', true ) : 'customizer-layout';
		} else if( is_tag() ) {
			$archive_sidebar_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_post_tag_sidebar_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_post_tag_sidebar_custom_meta_field', true ) : 'customizer-setting';
			$archive_layout_meta = metadata_exists( 'term', $current_id, '_blogzee_post_tag_archive_custom_meta_field' ) ? get_term_meta( $current_id, '_blogzee_post_tag_archive_custom_meta_field', true ) : 'customizer-layout';
		}
		$archive_sidebar_layout = BZ\blogzee_get_customizer_option( 'archive_sidebar_layout' );
		$classes[] = 'archive--' . esc_attr( ( $archive_layout_meta == 'customizer-layout' ) ? $archive_post_layout : $archive_layout_meta )  . '-layout';
		$classes[] = 'archive--' . esc_attr( ( $archive_sidebar_layout_meta == 'customizer-setting' ) ? $archive_sidebar_layout : $archive_sidebar_layout_meta );
	}

	if( is_single() ) {
		$single_sidebar_layout = BZ\blogzee_get_customizer_option( 'single_sidebar_layout' );
		$single_sidebar_post_meta = metadata_exists( 'post', get_the_ID(), 'post_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'post_sidebar_layout', true ) : 'customizer-setting';
		$classes[] = 'single-post--layout-five';
		$classes[] = 'single--' . esc_attr( ( $single_sidebar_post_meta == 'customizer-setting' ) ? $single_sidebar_layout : $single_sidebar_post_meta );
	}

	if( is_search() ) {
		$classes[] = 'search-page--right-sidebar';
		$classes[] = 'archive--' . esc_attr( $archive_post_layout ) . '-layout';
	}

	if( is_404() ) $classes[] = 'error-page--right-sidebar';

	if( is_page() ) {
		$page_settings_sidebar_layout = BZ\blogzee_get_customizer_option( 'page_settings_sidebar_layout' );
		$page_sidebar_post_meta = metadata_exists( 'post', get_the_ID(), 'page_sidebar_layout' ) ? get_post_meta( get_the_ID(), 'page_sidebar_layout', true ) : 'customizer-setting';
		$classes[] = 'page--' . esc_attr( ( $page_sidebar_post_meta == 'customizer-setting' ) ? $page_settings_sidebar_layout : $page_sidebar_post_meta);
	}

	$classes[] = 'blogzee-light-mode';

	$website_layout = BZ\blogzee_get_customizer_option ('website_layout');
	if( $website_layout ) $classes[] = $website_layout;

	$classes[] = 'block-title--five';
	
	$title_hover = BZ\blogzee_get_customizer_option( 'post_title_hover_effects' );
	$classes[] = 'title-hover--' . esc_attr( $title_hover );

	$image_hover = BZ\blogzee_get_customizer_option( 'site_image_hover_effects' );
	$classes[] = 'image-hover--' . esc_attr( $image_hover );

	$canvas_menu_position = BZ\blogzee_get_customizer_option( 'canvas_menu_position' );
	$classes[] = 'blogzee-canvas-position--' . esc_attr( $canvas_menu_position );

	$classes[] = 'blogzee-stickey-sidebar--disabled';
	$classes[] = ' blogzee-variables';
	$classes[] = ' is-desktop';
	
	$site_background_animation = BZ\blogzee_get_customizer_option( 'site_background_animation' );
	$classes[] = 'background-animation--' . $site_background_animation;
	if( $site_background_animation !== 'none' ) $classes[] = 'background-animation--enabled';

	$classes[] = 'archive-image-placeholder--enabled';
	return $classes;
}
add_filter( 'body_class', 'blogzee_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogzee_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blogzee_pingback_header' );

if( ! function_exists( 'blogzee_get_categories_html' ) ) :
	/**
	 * Return categories in <ul> <li> form
	 * 
	 * @since 1.0.0
	 */
	function blogzee_get_categories_html() {
		$blogzee_categoies = get_categories( [ 'object_ids' => get_the_ID() ] );
		$post_cagtegories_html = '<ul class="post-categories">';
		foreach( $blogzee_categoies as $category_key => $category_value ) :
			$post_cagtegories_html .= '<li class="cat-item item-'. ( $category_key + 1 ) .'">'. esc_html( $category_value->name ) .'</li>';
		endforeach;
		$post_cagtegories_html .= '</ul>';
		return $post_cagtegories_html;
	}
endif;

if( ! function_exists( 'blogzee_post_order_args' ) ) :
	/**
	 * Return post order args
	 * 
	 * @since 1.0.0
	 */
	function blogzee_post_order_args() {
		return [
			'date-desc' =>  esc_html__( 'Newest - Oldest', 'blogzee' ),
			'date-asc' =>  esc_html__( 'Oldest - Newest', 'blogzee' ),
			'rand-desc' =>  esc_html__( 'Random', 'blogzee' )
		];
	}
endif;

if( ! function_exists( 'blogzee_get_image_sizes_option_array' ) ) :
	/**
	 * Get list of image sizes
	 * 
	 * @since 1.0.0
	 * @package Blogzee Pro
	 */
	function blogzee_get_image_sizes_option_array() {
		$image_sizes = get_intermediate_image_sizes();
		foreach( $image_sizes as $image_size ) :
			$sizes[$image_size] = $image_size;
		endforeach;
		return $sizes;
	}
endif;

add_filter( 'get_the_archive_title_prefix', 'blogzee_prefix_string' );
function blogzee_prefix_string($prefix) {
	return apply_filters( 'blogzee_archive_page_title_prefix', false );
}

if( ! function_exists( 'blogzee_widget_control_get_tags_options' ) ) :
	/**
	 * @since 1.0.0
	 * @package Blogzee Pro
	 */
	function blogzee_widget_control_get_tags_options() {
        check_ajax_referer( 'blogzee_widget_nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ): '';
        $to_exclude = isset( $_POST['exclude'] ) ? sanitize_text_field( wp_unslash( $_POST['exclude'] ) ): '';
        $type = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ): '';
		if( $type == 'category' ) :
			$posts_list = get_categories( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'tag' ) :
			$posts_list = get_tags( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'user' ):
			$posts_list = new \WP_User_Query([ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ]);
			if( ! empty( $posts_list->get_results() ) ):
				foreach( $posts_list->get_results() as $user ) :
					$user_array[] = [
						'id'	=>	$user->ID,
						'text'	=>	$user->display_name
					];
				endforeach;
				wp_send_json_success( $user_array );
			else:
				wp_send_json_success( '' );
			endif;
		else:
			$post_args = [
				'post_type' =>  'post',
				'post_status'=>  'publish',
				'posts_per_page'    =>  6,
				'post__not_in' => explode( ',', $to_exclude ),
				's' => esc_html( $searchKey )
			];
			$posts_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $post_args ) );
			if( $posts_query->have_posts() ) :
				while( $posts_query->have_posts() ) :
					$posts_query->the_post();
					$post_array[] =	[
						'id'	=>	get_the_ID(),
						'text'	=>	get_the_title()
					];
				endwhile;
				wp_send_json_success( $post_array );
			endif;
		endif;
		if( ! empty( $posts_list ) ) :
			foreach( $posts_list as $postItem ) :
				$posts_array[] = [	
					'id'	=> esc_html( $postItem->term_taxonomy_id ),
					'text'	=> esc_html( $postItem->name .'('. $postItem->count .')' )
				];
			endforeach;
			wp_send_json_success( $posts_array );
		endif;
        wp_die();
    }
	add_action( 'wp_ajax_blogzee_widget_control_get_tags_options', 'blogzee_widget_control_get_tags_options' );
	
endif;

require get_template_directory() . '/inc/extras/helpers.php';
require get_template_directory() . '/inc/extras/extras.php';
require get_template_directory() . '/inc/extras/extend-api.php';
require get_template_directory() . '/inc/widgets/widgets.php'; // widget handlers
require get_template_directory() . '/inc/hooks/hooks.php'; // hooks handlers
require get_template_directory() . '/inc/metabox/metabox.php'; // metabox

/**
 * GEt appropriate color value
 * 
 * @since 1.0.0
 */
if(! function_exists('blogzee_get_color_format')):
    function blogzee_get_color_format($color) {
		if( ! is_string( $color ) ) return;
      if( str_contains( $color, '--blogzee-global-preset' ) ) {
        return( 'var( ' .esc_html( $color ). ' )' );
      } else {
        return $color;
      }
    }
endif;

/**
 * Minify dynamic css
 * 
 * @since 1.0.0
 */
if( ! function_exists( 'blogzee_minifyCSS' ) ) :
	function blogzee_minifyCSS( $css ) {
		// Remove comments
		$css = preg_replace( '!/\*.*?\*/!s', '', $css );
		// Remove space after colons
		$css = preg_replace( '/\s*:\s*/', ':', $css );
		// Remove whitespace
		$css = preg_replace( '/\s+/', ' ', $css );
		// Remove space before/after brackets and semicolons
		$css = preg_replace( '/\s*{\s*/', '{', $css );
		$css = preg_replace( '/\s*}\s*/', '}', $css );
		$css = preg_replace( '/\s*;\s*/', ';', $css );
		// Remove final semicolon in a block
		$css = preg_replace( '/;}/', '}', $css );
		// Trim the final output
		return trim( $css );
	}
endif;

/**
 * Check if a specific widget is being used
 * 
 * @since 1.0.0
 */
if( ! function_exists( 'blogzee_is_widget_being_used' ) ) :
	function blogzee_is_widget_being_used( $widget_id ) {
		$sidebar_widgets = wp_get_sidebars_widgets();
		if( ! empty( $sidebar_widgets ) && is_array( $sidebar_widgets ) ) :
			foreach( $sidebar_widgets as $sidebar => $widgets_array ) :
				if( ! empty( $widgets_array ) ) :
					foreach( $widgets_array as $widget ) :
						if (strpos( $widget, $widget_id ) === 0) return true;
					endforeach;
				endif;
			endforeach;
		endif;
		return false;
	}
endif;

if( ! function_exists( 'blogzee_current_styles' ) ) :
	/**
	 * Generates the current changes in styling of the theme.
	 * 
	 * @package Blogzee Pro
	 * @since 1.0.0
	 */
	function blogzee_current_styles() {
		/**
		 * Abbreviation
		 * 
		 * hr = header responsive
		 * stt = scroll to top
		 */
		$main_banner_option = BZ\blogzee_get_customizer_option( 'main_banner_option' );
		$category_collection_option = BZ\blogzee_get_customizer_option( 'category_collection_option' );
		$carousel_option = BZ\blogzee_get_customizer_option( 'carousel_option' );
		$preloader_option = BZ\blogzee_get_customizer_option( 'preloader_option' );
		$site_breadcrumb_option = BZ\blogzee_get_customizer_option( 'site_breadcrumb_option' );
		$ticker_news_option = BZ\blogzee_get_customizer_option( 'ticker_news_option' );
		$custom_logo_option = get_theme_mod( 'custom_logo' );
		// Header Builder
		$date_time_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'date-time' );
		$custom_button_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'button' );
		$theme_mode_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'theme-mode' );
		$search_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'search' );
		$off_canvas_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'off-canvas' );
		$site_logo_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'site-logo' );
		$menu_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'menu' );
		$social_icons_option = \Blogzee_Builder\Builder_Base::widget_exists( 'header_builder', 'social-icons' );
		// Footer Builder
		$you_may_have_missed_option = \Blogzee_Builder\Builder_Base::widget_exists( 'footer_builder', 'you-may-have-missed' );
		$footer_secondary_menu_option = \Blogzee_Builder\Builder_Base::widget_exists( 'footer_builder', 'menu' );
		$copyright_option = \Blogzee_Builder\Builder_Base::widget_exists( 'footer_builder', 'copyright' );
		$footer_social_icons_option = \Blogzee_Builder\Builder_Base::widget_exists( 'footer_builder', 'social-icons' );
		// Responsive Header Builder
		$hr_date_time_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'date-time' );
		$hr_custom_button_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'button' );
		$hr_theme_mode_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'theme-mode' );
		$hr_search_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'search' );
		$hr_off_canvas_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'off-canvas' );
		$hr_site_logo_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'site-logo' );
		$hr_menu_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'menu' );
		$hr_social_icons_option = \Blogzee_Builder\Builder_Base::widget_exists( 'responsive_header_builder', 'social-icons' );

		ob_start();
			blogzee_preset_color_control( 'solid_color_preset', '--blogzee-global-preset-color-' );
			blogzee_preset_color_control( 'gradient_color_preset', '--blogzee-global-preset-gradient-' );
			blogzee_typography_preset();

			/** Value Change With Responsive **/
			blogzee_value_change_responsive('body .footer-logo img', 'bottom_footer_logo_width','width');
			blogzee_spacing_control( 'body .site-header .row-one', 'header_first_row_padding', 'padding' );
			blogzee_spacing_control( 'body .site-header .row-two', 'header_second_row_padding', 'padding' );
			blogzee_spacing_control( 'body .site-header .row-three', 'header_third_row_padding', 'padding' );
			blogzee_spacing_control( 'body .site-footer .row-one', 'footer_first_row_padding', 'padding' );
			blogzee_spacing_control( 'body .site-footer .row-two', 'footer_second_row_padding', 'padding' );
			blogzee_spacing_control( 'body .site-footer .row-three', 'footer_third_row_padding', 'padding' );
			
			/** Value Change **/
			if( is_page() || is_404() ) blogzee_value_change('.page #blogzee-main-wrap #primary article, .page .blogzee-table-of-content.display--inline .toc-wrapper, .error404 .error-404','page_border_radius','border-radius');
			blogzee_value_change('.widget .post-thumb-image, .widget .post-thumb, .widget_blogzee_carousel_widget .post-thumb-wrap, .widget.widget_media_image, .widget_blogzee_category_collection_widget .categories-wrap .category-item .category-name','sidebar_image_border_radius','border-radius');
			blogzee_value_change('body .widget, body #widget_block, body .widget.widget_media_image figure.wp-block-image img','sidebar_border_radius','border-radius');

			/** Color Group (no Gradient) (Variable) **/
			$bcColorAssign = function($var,$id) {
				blogzee_assign_var($var,$id);
			};
			$bcColorAssign( '--blogzee-global-preset-theme-color', 'theme_color' );
			$bcColorAssign( '--blogzee-global-preset-gradient-theme-color', 'gradient_theme_color' );
			/** Text Color (Variable) **/
			blogzee_variable_color('--blogzee-mobile-canvas-icon-color', 'mobile_canvas_icon_color');

			// Category Bk Color
			blogzee_category_bk_colors_styles();
			if( blogzee_is_widget_being_used( 'blogzee_tags_collection_widget' ) ) blogzee_tags_bk_colors_styles();

			/* Typography (Variable) */
			$bTypoCode = function( $selector, $control, $is_variable = false ) {
				blogzee_typography_control( $selector, $control, $is_variable );
			};
			$bTypoCode("--blogzee-widget-block-font","sidebar_block_title_typography", true );
			$bTypoCode("--blogzee-widget-title-font","sidebar_post_title_typography", true );
			$bTypoCode("--blogzee-widget-date-font","sidebar_date_typography", true );
			$bTypoCode("--blogzee-widget-category-font","sidebar_category_typography", true );
			/* typo vale change */
			/* typo vale body */
			$bTypoCode('body .blogzee-widget-loader .load-more','sidebar_pagination_button_typo');
			$bTypoCode('body footer .widget_block .wp-block-group__inner-container .wp-block-heading, body footer section.widget .widget-title, body footer .wp-block-heading', 'footer_title_typography');
			$bTypoCode('body footer ul.wp-block-latest-posts a, body footer ol.wp-block-latest-comments li footer, body footer ul.wp-block-archives a, body footer ul.wp-block-categories a, body footer ul.wp-block-page-list a, body footer .widget_blogzee_post_grid_widget .post-grid-wrap .post-title, body footer .menu .menu-item a, body footer .widget_blogzee_category_collection_widget .categories-wrap .category-item .category-name, body footer .widget_blogzee_post_list_widget .post-list-wrap .post-title a', 'footer_text_typography');
			$bTypoCode('body aside h1.wp-block-heading','sidebar_heading_one_typography');
			$bTypoCode('body aside h2.wp-block-heading','sidebar_heading_two_typo');
			$bTypoCode('body aside h3.wp-block-heading','sidebar_heading_three_typo');
			$bTypoCode('body aside h4.wp-block-heading','sidebar_heading_four_typo');
			$bTypoCode('body aside h5.wp-block-heading','sidebar_heading_five_typo');
			$bTypoCode('body aside h6.wp-block-heading','sidebar_heading_six_typo');

			/* background color */
			blogzee_background_control('body.blogzee-light-mode .site-header','header_builder_background');

			if( is_single() || is_page() ) :
				$bTypoCode('body article .post-inner h1','heading_one_typo');
				$bTypoCode('body article .post-inner h2','heading_two_typo');
				$bTypoCode('body article .post-inner h3','heading_three_typo');
				$bTypoCode('body article .post-inner h4','heading_four_typo');
				$bTypoCode('body article .post-inner h5','heading_five_typo');
				$bTypoCode('body article .post-inner h6','heading_six_typo');
			endif;

			// Main banner
			if( $main_banner_option && ( is_front_page() || is_home() ) ) :
				blogzee_value_change('body .blogzee-main-banner-section .swiper .swiper-wrapper .post-thumb, .blogzee-main-banner-section.layout--four .main-banner-slider .post-elements','main_banner_image_border_radius','border-radius');
				$bTypoCode("--blogzee-banner-title-font", "main_banner_design_post_title_typography", true );
				$bTypoCode("--blogzee-banner-excerpt-font", "main_banner_design_post_excerpt_typography", true );
				$bTypoCode("--blogzee-banner-sidebar-title-font", "main_banner_sidebar_post_typography", true );
				$bTypoCode("--blogzee-banner-sidebar-block-font", "main_banner_sidebar_block_typography", true );
				$bTypoCode('.blogzee-main-banner-section .main-banner-slider .post-categories .cat-item a','main_banner_design_post_categories_typography');
				$bTypoCode('.blogzee-main-banner-section .main-banner-wrap .post-elements .post-date','main_banner_design_post_date_typography');
				$bTypoCode('.blogzee-main-banner-section .main-banner-wrap .byline','main_banner_design_post_author_typography');
				$bTypoCode('body .scrollable-posts-wrapper .post-categories li a','main_banner_sidebar_categories_typography');
				$bTypoCode('body .scrollable-posts-wrapper .post-date','main_banner_sidebar_date_typography');
				blogzee_value_change_responsive('.blogzee-main-banner-section.layout--four .scrollable-post, .blogzee-main-banner-section .main-banner-sidebar .scrollable-post .post-thumb','main_banner_border_radius','border-radius');
			endif;

			// Category Collection
			if( $category_collection_option && ( is_front_page() || is_home() ) ) :
				$bTypoCode("--blogzee-category-collection-font","category_collection_typo", true );
				blogzee_value_change_responsive('.blogzee-category-collection-section .category-wrap .category-thumb a','category_collection_image_radius','border-radius');
			endif;

			// Carousel
			if( $carousel_option && ( is_front_page() || is_home() ) ) :
				$bTypoCode('body .blogzee-carousel-section .carousel-wrap .post-elements .post-title', 'carousel_design_post_title_typography');
				$bTypoCode('.blogzee-carousel-section .post-categories .cat-item a','carousel_design_post_categories_typography');
				$bTypoCode('.blogzee-carousel-section .carousel-wrap .post-elements .post-excerpt','carousel_design_post_excerpt_typography');
				$bTypoCode('.blogzee-carousel-section .carousel-wrap .post-elements .byline','carousel_design_post_author_typography');
				$bTypoCode('.blogzee-carousel-section .carousel-wrap .post-elements .post-date','carousel_design_post_date_typography');
				blogzee_spacing_control( '.blogzee-carousel-section article.post-item .post-thumb, .blogzee-carousel-section.carousel-layout--one article.post-item .post-elements', 'carousel_image_border_radius', 'border-radius' );
			endif;

			// Single
			if( is_single() ) :
				$bTypoCode('body.single-post.blogzee-variables .site-main article .entry-content','single_content_typo');
				$bTypoCode('body.single-post.blogzee-variables .site-main article .entry-title, body.single-post.blogzee-variables .single-header-content-wrap .entry-title, body.single-post #primary .post-navigation .nav-links .nav-title, body .single-related-posts-section-wrap.layout--list .single-related-posts-wrap article .post-element .post-title','single_title_typo');
				$bTypoCode('body.single-post.blogzee-variables .site-main article .post-meta-wrap .byline, body.single-post.blogzee-variables .single-header-content-wrap .post-meta-wrap .byline, body .single-related-posts-section-wrap .single-related-posts-wrap .byline','single_author_typo');
				$bTypoCode('body.single-post.blogzee-variables .blogzee-main-wrap .blogzee-inner-content-wrap .post-date, body.single-post.blogzee-variables .single-header-content-wrap.post-meta .post-date','single_date_typo');
				$bTypoCode('body.single-post.blogzee-variables .blogzee-main-wrap .post-meta .post-read-time, body.single-post.blogzee-variables .blogzee-main-wrap .post-meta .post-comments-num','single_read_time_typo');
				$bTypoCode('body.single-post.blogzee-variables #primary article .post-categories .cat-item a, body.single-post.blogzee-variables .single-header-content-wrap .post-categories .cat-item a','single_category_typo');
				blogzee_value_change('body.single-post #blogzee-main-wrap .blogzee-container .row #primary .blogzee-inner-content-wrap article > div, body.single-post #blogzee-main-wrap .blogzee-container .row #primary nav.navigation, body.single-post #blogzee-main-wrap .blogzee-container .row #primary .single-related-posts-section-wrap.layout--list, body.single-post #primary article .post-card .bmm-author-thumb-wrap, .single-related-posts-section-wrap article .post-thumbnail, body.single-post .comment-respond .comment-form-comment textarea, body.single-post form.comment-form p input, body.single-post #primary .post-navigation .nav-links figure.nav-thumb, .single .blogzee-table-of-content.display--inline .toc-wrapper, body.single .wp-block-embed-youtube iframe, .single .blogzee-advertisement img','single_page_border_radius','border-radius');
				blogzee_value_change('.single .blogzee-inner-content-wrap .post-thumbnail','single_image_border_radius','border-radius');
			endif;

			// Page
			if( is_page() ) :
				$bTypoCode('body.page.blogzee-variables #blogzee-main-wrap #primary article .entry-title','page_title_typo');
				$bTypoCode('body.page.blogzee-variables article .entry-content','page_content_typo');
				blogzee_value_change('body.page-template-default.blogzee-variables #primary article .post-thumbnail, body.page-template-default.blogzee-variables #primary article .post-thumbnail img','page_image_border_radius','border-radius');
			endif;

			// Category Archive
			if( is_category() ) :
				$bTypoCode('body.blogzee-variables.archive.category .page-header .page-title, .archive.date .page-header .page-title','archive_category_info_box_title_typo');
				$bTypoCode('body.blogzee-variables.archive.category .page-header .archive-description','archive_category_info_box_description_typo');
			endif;

			// Tags Archive
			if( is_tag() ) :
				$bTypoCode('body.blogzee-variables.archive.tag .page-header .archive-description','archive_tag_info_box_description_typo');
				$bTypoCode('body.blogzee-variables.archive.tag .page-header .page-title','archive_tag_info_box_title_typo');
			endif;

			// Authors Archive
			if( is_author() ) :
				$bTypoCode('body.blogzee-variables.archive.author .page-header .page-title','archive_author_info_box_title_typo');
				$bTypoCode('body.blogzee-variables.archive.author .page-header .archive-description','archive_author_info_box_description_typo');
			endif;

			// You may have missed
			if( $you_may_have_missed_option ) :
				blogzee_spacing_control( '.blogzee-you-may-have-missed-section .post-thumbnail-wrapper', 'you_may_have_missed_image_border_radius', 'border-radius' );
				$bTypoCode("--blogzee-youmaymissed-title-font", "you_may_have_missed_design_post_title_typography", true );
				$bTypoCode("--blogzee-youmaymissed-block-title-font", "you_may_have_missed_design_section_title_typography", true );
				$bTypoCode("--blogzee-youmaymissed-category-font", "you_may_have_missed_design_post_categories_typography", true );
				$bTypoCode("--blogzee-youmaymissed-date-font", "you_may_have_missed_design_post_date_typography", true );
				$bTypoCode("--blogzee-youmaymissed-author-font", "you_may_have_missed_design_post_author_typography", true );
			endif;

			// Date Time
			if( $date_time_option || $hr_date_time_option ) :
				blogzee_variable_color_single('--blogzee-date-color','date_color');
				blogzee_variable_color_single('--blogzee-time-color','time_color');
				$bTypoCode("--blogzee-date-time", 'date_time_typography', true );
			endif;

			// Archive continue reading button
			if( is_archive() || is_home() ) :
				$bTypoCode("--blogzee-readmore-font", "global_button_typo", true );
			endif;

			// Breadcrumb
			if( $site_breadcrumb_option && ( ! is_home() && ! is_front_page() ) ) :
				$bTypoCode('body .blogzee-breadcrumb-wrap ul li span[itemprop="name"]','breadcrumb_typo');
			endif;

			// Ticker
			if( $ticker_news_option && ( is_front_page() || is_home() ) ) {
				$bTypoCode('body .blogzee-ticker-news .ticker-news-wrap .ticker-item .title-wrap .post-title','ticker_news_post_title_typo');
				$bTypoCode('body .blogzee-ticker-news .ticker-news-wrap .ticker-item .title-wrap .post-date','ticker_news_post_date_typo');
				blogzee_value_change_responsive('.blogzee-ticker-news .row, .blogzee-ticker-news .ticker-news-wrap .ticker-item .post-thumb','ticker_news_border_radius','border-radius');
			}

			// Archive  || Home || Search
			if( is_archive() || is_home() || is_search() ) :
				blogzee_value_change('body #blogzee-main-wrap > .blogzee-container > .row #primary .blogzee-inner-content-wrap article .blogzee-article-inner, body #blogzee-main-wrap > .blogzee-container > .row #primary .blogzee-inner-content-wrap article .blogzee-article-inner .post-thumbnail-wrapper, body.search.search-results #blogzee-main-wrap .blogzee-container .page-header, .archive--grid-two-layout #primary article:not(.post-format) .inner-content, #primary .blogzee-inner-content-wrap .blogzee-advertisement-block img','archive_section_border_radius','border-radius');
				$bTypoCode("--blogzee-post-title-font","archive_title_typo", true );
				$bTypoCode("--blogzee-post-content-font","archive_excerpt_typo", true );
				$bTypoCode("--blogzee-date-font","archive_date_typo", true );
				$bTypoCode("--blogzee-readtime-font","archive_read_time_typo", true );
				$bTypoCode("--blogzee-comment-font","archive_comment_typo", true );
				$bTypoCode("--blogzee-category-font","archive_category_typo", true );
				$bTypoCode("--blogzee-author-font", "archive_author_typo", true );
			endif;

			// Custom Button
			if( $custom_button_option || $hr_custom_button_option ) :
				$bTypoCode("--blogzee-custom-button", 'custom_button_text_typography', true );
				blogzee_variable_bk_color('--blogzee-custom-button-bk-color','header_custom_button_background_color_group');
				blogzee_value_change_responsive('body .site-header .header-custom-button','header_custom_button_border_radius','border-radius');
			endif;

			// Theme mode
			if( $theme_mode_option || $hr_theme_mode_option ) :
				blogzee_value_change_responsive('body .site-header .mode-toggle i','theme_mode_icon_size','font-size');
				blogzee_value_change_responsive('body .site-header .mode-toggle img', 'theme_mode_icon_size','width');
				blogzee_variable_color('--blogzee-theme-darkmode-color', 'theme_mode_dark_icon_color');
				blogzee_variable_color('--blogzee-theme-mode-color', 'theme_mode_light_icon_color');
			endif;

			// Theme mode
			if( $search_option || $hr_search_option_option ) :
				blogzee_value_change_responsive('body .site-header .search-trigger i', 'search_icon_size', 'font-size');
				blogzee_variable_color('--blogzee-search-icon-color', 'search_icon_color');
			endif;

			// Off Canvas
			if( $off_canvas_option || $hr_off_canvas_option ) :
				blogzee_variable_color('--blogzee-canvas-icon-color', 'canvas_menu_icon_color');
			endif;

			// Site logo Width
			if( $site_logo_option || $hr_site_logo_option ) :
				if( $custom_logo_option ) blogzee_value_change_responsive('body .site-branding img', 'site_logo_width','width');
				$bTypoCode( "--blogzee-site-title", 'site_title_typo' , true );
				$bTypoCode( "--blogzee-site-description", 'site_description_typo' , true );
			endif;

			// Header Menu
			if( $menu_option || $hr_menu_option ) :
				$bTypoCode("--blogzee-menu", 'main_menu_typo', true );
				$bTypoCode("--blogzee-submenu", 'main_menu_sub_menu_typo', true );
				blogzee_variable_color('--blogzee-menu-color', 'header_menu_color');
				blogzee_variable_color('--blogzee-menu-color-submenu', 'header_sub_menu_color');
			endif;

			// Header Social icons
			if( $social_icons_option || $hr_social_icons_option ) blogzee_variable_color('--blogzee-header-social-color', 'social_icon_color');

			// Footer Social icons
			if( $footer_social_icons_option ) blogzee_variable_color('--blogzee-footer-social-color', 'footer_social_icon_color');

			// Copyright
			if( $copyright_option ) :
				$bTypoCode('body footer .site-info', 'bottom_footer_text_typography');
				$bTypoCode('body footer .site-info a', 'bottom_footer_link_typography');
			endif;

			// Footer Secondary Menu
			if( $footer_secondary_menu_option ) :
				$bTypoCode("--blogzee-footer-menu", 'footer_menu_typography', true );
				blogzee_variable_color('--blogzee-footer-menu-color', 'footer_menu_color');
			endif;
			
		$current_styles = ob_get_clean();
		return apply_filters( 'blogzee_current_styles', wp_strip_all_tags( blogzee_minifyCSS( $current_styles ) ) );
	}
endif;

if( ! function_exists( 'blogzee_custom_excerpt_more' ) ) :
	/**
	 * Filters the excerpt content
	 * 
	 * @since 1.0.0
	 */
	function blogzee_custom_excerpt_more($more) {
		if( is_admin() ) return $more;
		return '';
	}
	add_filter('excerpt_more', 'blogzee_custom_excerpt_more');
endif;

if( ! function_exists( 'blogzee_check_youtube_api_key' ) ) :
	/**
	 * function to check whether the api key is valid or not
	 * 
	 * @since 1.0.0
	 * @package Blogzee Pro
	 */
	function blogzee_check_youtube_api_key( $api_key ) {
		$api_url = "https://www.googleapis.com/youtube/v3/videos?key=" . $api_key . "&part=snippet,contentDetails";
        $remote_get_video_info = wp_remote_get( $api_url );
		return $remote_get_video_info;
	}
endif;

if( ! function_exists( 'blogzee_random_post_archive_advertisement_part' ) ) :
    /**
     * Blogzee main banner element
     * 
     * @since 1.0.0
     */
    function blogzee_random_post_archive_advertisement_part( $ads_rendered ) {
		if( is_null( $ads_rendered ) ) return;
        $advertisement_repeater = BZ\blogzee_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $random_post_archive_advertisement ) ) return;
        $image_option = array_column( $random_post_archive_advertisement, 'item_image_option' );
        $alignment = array_column( $random_post_archive_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <div class="blogzee-advertisement-block post <?php echo esc_html( $elementClass ); ?>">
                <a href="<?php echo esc_url( $random_post_archive_advertisement[$ads_rendered]->item_url ); ?>" target="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_target ); ?>" rel="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_rel_attribute ); ?>">
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $random_post_archive_advertisement[$ads_rendered]->item_image, 'full' ) ); ?>" loading="lazy">
                </a>
            </div>
        <?php
    }
 endif;

 if( ! function_exists( 'blogzee_random_post_archive_advertisement_number' ) ) :
    /**
     * Blogzee archive ads number
     * 
     * @since 1.0.0
     */
    function blogzee_random_post_archive_advertisement_number() {
        $advertisement_repeater = BZ\blogzee_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        });
        return sizeof( $random_post_archive_advertisement );
    }
 endif;

 if( ! function_exists( 'blogzee_get_sidebar' ) ) :
	/**
	 * Adds sidebar
	 * 
	* @since 1.0.0
	 * @param layout
	 * @return sidebar
	 */
	function blogzee_get_sidebar( $meta_key, $args ) {
		if( array_key_exists( 'meta_type', $args ) && $args['meta_type'] == 'term' ) :
			$single_sidebar_layout_meta = metadata_exists( 'term', $args['post_id'], $meta_key ) ? get_term_meta( $args['post_id'], $meta_key, true ) : 'customizer-setting';
		else:
			$single_sidebar_layout_meta = metadata_exists( 'post', $args['post_id'], $meta_key ) ? get_post_meta( $args['post_id'], $meta_key, true ) : 'customizer-setting';
		endif;
		if( $single_sidebar_layout_meta == 'customizer-setting' ) {
			if( in_array( $args['customizer_layout'], $args['position'] ) && in_array( 'right-sidebar', $args['position'] ) ) get_sidebar();
			if( in_array( $args['customizer_layout'], $args['position'] ) && in_array( 'left-sidebar', $args['position'] ) ) get_sidebar('left');
		} 
		if( in_array( $single_sidebar_layout_meta, [ 'left-sidebar' ] ) && in_array( 'left-sidebar', $args['position'] ) ) get_sidebar('left');
		if( in_array( $single_sidebar_layout_meta, [ 'right-sidebar' ] ) && in_array( 'right-sidebar', $args['position'] ) ) get_sidebar();
	}
 endif;

 if( ! function_exists( 'blogzee_algorithm_to_push_ads_in_archive' ) ) :
	/**
	 * Algorithm to push ads into archive
	 * 
	 * @since 1.0.0
	 */
	function blogzee_algorithm_to_push_ads_in_archive( $args = [] ) {
		global $wp_query;
		$archive_ads_number = blogzee_random_post_archive_advertisement_number();
		if( $archive_ads_number <= 0 ) return;
		if( empty( $args ) ) :
			$max_number_of_pages = absint( $wp_query->max_num_pages );
			$paged = absint( ( get_query_var( 'paged' ) == 0 ) ? 0 : ( get_query_var( 'paged' ) - 1 ) );
		else:
			if( ( $args['paged'] - 1 ) == $archive_ads_number ) return;
			$max_number_of_pages = absint( $args['max_number_of_pages'] );
			$paged = absint( $args['paged'] - 1 );
		endif;
		$count = 1;
		$ads_id = 0;
		$loop_var = 0;
		for( $i = $archive_ads_number ; $i > 0; $i-- ) :
			if( $count <= $max_number_of_pages ):
				$ads_to_render_in_a_single_page = ceil( $i / $max_number_of_pages );
				$ads_to_render = [];
				if( $ads_to_render_in_a_single_page > 1 ) :
					$to_loop = $ads_id + $ads_to_render_in_a_single_page;
					for( $j = $ads_id; $j < $to_loop; $j++ ) :
						if( ! in_array( $ads_id, $ads_to_render ) ) $ads_to_render[] = $ads_id;
						$ads_id++;
					endfor;
					$ads_to_render_in_current_page[$loop_var] = $ads_to_render;
				else:
					$ads_to_render_in_current_page[$loop_var] = $ads_id;
					$ads_id++;
				endif;
				$count++;
				$loop_var++;
			endif;
		endfor;
		$current_page_count = empty( $args ) ? absint( $wp_query->post_count ) : absint( $args['post_count'] );
		$ads_of_current_page = array_key_exists( $paged, $ads_to_render_in_current_page ) ? $ads_to_render_in_current_page[$paged] : null;
		$ads_count = is_array( $ads_of_current_page ) ? sizeof( $ads_of_current_page ) : 1;
		$random_numbers = [];
		for( $i = 0; $i < $ads_count; $i++ ) :
			if( ! in_array( $i, $random_numbers ) ) :
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			else:
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			endif;
		endfor;
		return [
			'random_numbers'	=>	$random_numbers,
			'ads_to_render'	=>	$ads_of_current_page
		];
	}
 endif;

 if( ! function_exists( 'blogzee_get_all_menus' ) ) :
	/**
	 * Get all menus
	 * 
	 * @since 1.0.0
	 */
	function blogzee_get_all_menus() {
		$menus_array = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$value = [
			'none'	=>	esc_html__( 'None', 'blogzee' ),
		];
		if( ! empty( $menus_array ) && is_array( $menus_array ) ) :
			foreach( $menus_array as $menu ) :
				$value[ $menu->slug ] = $menu->name;
			endforeach;
			return $value;
		endif;
	}
 endif;

 if( ! function_exists( 'news_event_add_menu_description' ) ) :
	// merge menu description element to the menu 
	function news_event_add_menu_description( $item_output, $item, $depth, $args ) {
		if($args->theme_location != 'menu-1') return $item_output;
		
		if ( !empty( $item->description ) ) {
			$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description"><span class="description-wrap">' . $item->description . '</span></span>' . $args->link_after . '</a>', $item_output );
		}
		return $item_output;
	}
	add_filter( 'walker_nav_menu_start_el', 'news_event_add_menu_description', 10, 4 );
endif;