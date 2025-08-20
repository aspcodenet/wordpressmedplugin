<?php
/**
 * Includes functions for selective refresh
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;
if( ! function_exists( 'blogzee_customize_selective_refresh' ) ) :
    /**
     * Adds partial refresh for the customizer preview
     */
    function blogzee_customize_selective_refresh( $wp_customize ) {
        if ( ! isset( $wp_customize->selective_refresh ) ) return;

        // theme mode light icon
        $wp_customize->selective_refresh->add_partial( 'theme_mode_dark_icon', [
            'selector'        => 'body .mode-toggle-wrap .mode-toggle',
            'render_callback' => 'blogzee_theme_mode_callback'
        ]);

        // theme mode light icon
        $wp_customize->selective_refresh->add_partial( 'theme_mode_light_icon', [
            'selector'        => 'body .mode-toggle-wrap .mode-toggle',
            'render_callback' => 'blogzee_theme_mode_callback'
        ]);

        // Header Builder Edit button
        $wp_customize->selective_refresh->add_partial( 'header_builder_section_tab', [
            'selector'        => 'header.site-header'
        ]);

        // Footer Builder Edit button
        $wp_customize->selective_refresh->add_partial( 'footer_section_tab', [
            'selector'        => 'footer.site-footer'
        ]);

        // Category Page icon
        $wp_customize->selective_refresh->add_partial( 'archive_category_info_box_option', [
            'selector'  =>  'body.archive.category  #blogzee-main-wrap .archive-header',
            'render_callback'   =>  'blogzee_category_page_icon'
        ]);

        // Tags Page icon
        $wp_customize->selective_refresh->add_partial( 'archive_tag_info_box_option', [
            'selector'  =>  'body.archive.tag #blogzee-main-wrap .archive-header',
            'render_callback'   =>  'blogzee_tags_page_icon'
        ]);

        // Authors Page icon
        $wp_customize->selective_refresh->add_partial( 'archive_author_info_box_option', [
            'selector'  =>  'body.archive.author #blogzee-main-wrap .archive-header',
            'render_callback'   =>  'blogzee_authors_page_icon'
        ]);

        // Authors Page icon
        $wp_customize->selective_refresh->add_partial( 'archive_pagination_type', [
            'selector'  =>  'body.archive #blogzee-main-wrap .pagination, body.search #blogzee-main-wrap .pagination, body.home #blogzee-main-wrap .pagination, body.blog #blogzee-main-wrap #primary .pagination',
            'render_callback'   =>  'blogzee_archive_pagination'
        ]);

        $post_format_partial_args = [ 'audio', 'gallery', 'image', 'standard', 'video', 'quote' ];
        if( ! empty( $post_format_partial_args ) && is_array( $post_format_partial_args ) ) :
            foreach( $post_format_partial_args as $format ):
                $wp_customize->selective_refresh->add_partial( $format . '_post_format_icon_picker', [
                    'selector'        => 'article.format-'. $format .' .post-format-ss-wrap .post-format-icon',
                    'render_callback' => 'blogzee_'. $format .'_post_format_icon',
                ]);
            endforeach;
        endif;
    }
    add_action( 'customize_register', 'blogzee_customize_selective_refresh' );
endif;

// theme mode callback
function blogzee_theme_mode_callback() {
    $theme_mode_light_icon = BZ\blogzee_get_customizer_option( 'theme_mode_light_icon' );
    $theme_mode_dark_icon = BZ\blogzee_get_customizer_option( 'theme_mode_dark_icon' );
    blogzee_theme_mode_switch( $theme_mode_light_icon, 'light' );
    blogzee_theme_mode_switch( $theme_mode_dark_icon, 'dark' );
}

// audio post format icon
function blogzee_audio_post_format_icon() {
    $audio_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'audio_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $audio_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// gallery post format icon
function blogzee_gallery_post_format_icon() {
    $gallery_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'gallery_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $gallery_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// image post format icon
function blogzee_image_post_format_icon() {
    $image_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'image_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $image_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// standard post format icon
function blogzee_standard_post_format_icon() {
    $standard_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'standard_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $standard_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// video post format icon
function blogzee_video_post_format_icon() {
    $video_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'video_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $video_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// quote post format icon
function blogzee_quote_post_format_icon() {
    $quote_post_format_icon_picker = BZ\blogzee_get_customizer_option( 'quote_post_format_icon_picker' );
	$icon_html = blogzee_get_icon_control_html( $quote_post_format_icon_picker );
	if( $icon_html ) return $icon_html;
	return;
}

// category page icon
function blogzee_category_page_icon() {
    if( is_category() && ! BZ\blogzee_get_customizer_option( 'archive_category_info_box_option' ) ) return;
    $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-layer-group', 'type' => 'icon' ]);
    echo '<div class="archive-title">';
        if( $icon_html ) echo $icon_html;
        the_archive_title( '<h2 class="page-title">', '</h2>' );
    echo '</div>';
    the_archive_description( '<div class="archive-description">', '</div>' );
	return;
}

// tags page icon
function blogzee_tags_page_icon() {
    if( is_tag() && ! BZ\blogzee_get_customizer_option( 'archive_tag_info_box_option' ) ) return;
    $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-tag', 'type' => 'icon' ]);
    echo '<div class="archive-title">';
        if( $icon_html ) echo $icon_html;
        the_archive_title( '<h2 class="page-title">', '</h2>' );
    echo '</div>';
    the_archive_description( '<div class="archive-description">', '</div>' );
	return;
}

// Authors page icon
function blogzee_authors_page_icon() {
    if( is_author() && ! BZ\blogzee_get_customizer_option( 'archive_author_info_box_option' ) ) return;
    echo '<div class="archive-title">';
        $author_image = get_avatar( get_queried_object_id(), 90 );
        echo $author_image;
        the_archive_title( '<h2 class="page-title">', '</h2>' );
    echo '</div>';
    the_archive_description( '<div class="archive-description">', '</div>' );
	return;
}

// archive pagination
function blogzee_archive_pagination() {
    /**
     * hook - blogzee_pagination_link_hook
     * 
     * hooked - blogzee_pagination_fnc - 10
     * @since 1.0.0
     */
    if( has_action( 'blogzee_pagination_link_hook' ) ) do_action( 'blogzee_pagination_link_hook' );
}

// Search form
function blogzee_search_form() {
    ?>
        <div class="blogzee_search_page">
            <?php get_search_form(); ?>
        </div>
    <?php 
}