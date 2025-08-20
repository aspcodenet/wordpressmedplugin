<?php
/**
 * INcludes theme defaults and starter functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
namespace Blogzee\CustomizerDefault;

if( ! function_exists( 'blogzee_get_customizer_option' ) ) :
    /**
     * Gets customizer "theme mod" value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_get_customizer_option( $control_id ) {
        return get_theme_mod( $control_id, blogzee_get_customizer_default( $control_id ) );
    }
endif;

if( !function_exists( 'blogzee_get_multiselect_tab_option' ) ) :
    /**
     * Gets customizer "multiselect combine tab" value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_get_multiselect_tab_option( $key ) {
        $value = blogzee_get_customizer_option( $key );
        if( !$value["desktop"] && !$value["tablet"] && !$value["mobile"] ) return apply_filters( "blogzee_get_multiselect_tab_option", false );
        return apply_filters( "blogzee_get_multiselect_tab_option", true );
    }
endif;

if( ! function_exists( 'blogzee_customizer_default_array' ) ) :
    /**
     * Returns controls default values
     * 
     * @since 1.0.0
     */
    function blogzee_customizer_default_array() {

        $responsive = function( $desktop = 0, $tablet = 0, $smartphone = 0 ) {
            $default = [
                'desktop'   =>  $desktop,
                'tablet'    =>  $tablet,
                'smartphone'    =>  $smartphone
            ];
            return $default;
        };

        $typography = function( $append = [] ){
            $default = [
                'font_family'   => [ 'value' => 'Jost', 'label' => 'Jost' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size'   => [
                    'desktop'   =>  13,
                    'tablet'   =>  13,
                    'smartphone'   =>  13
                ],
                'line_height'   => [
                    'desktop'   =>  21,
                    'tablet'   =>  21,
                    'smartphone'   =>  21
                ],
                'letter_spacing'   => [
                    'desktop'   =>  0,
                    'tablet'   =>  0,
                    'smartphone'   =>  0
                ],
                'text_transform'    => 'unset',
                'text_decoration'    => 'none',
                'preset'    =>  '-1'
            ];
            if( ! empty( $append ) && is_array( $append ) ) return array_merge( $default, $append );
	        return $default;
        };

        $color = function( $append = [] ) {
            $default = [ 
                'type'  =>  'solid',
                'solid' =>  '#fff'
            ];
            if( ! empty( $append ) && is_array( $append ) ):
                $append_keys = array_keys( $append );
                $default['type'] = $append_keys[0];
                return array_merge( $default, $append );
            endif;
	        return $default;
        };

        $icon_picker = function( $append = [] ){
            $default = [
                'type'  => 'icon',
                'value' => 'fa-solid fa-arrow-right'
            ];
            if( ! empty( $append ) && is_array( $append ) ) return array_merge( $default, $append );
	        return $default;
        };

        $array_defaults = apply_filters( 'blogzee_get_customizer_defaults', [
            'theme_color'   => '#F34601',
            'gradient_theme_color'   => 'linear-gradient(135deg,#942cddcc 0,#38a3e2cc 100%)',
            'header_textcolor'  =>  'f34601',
            'site_background_animation' =>  'none',
            'show_scroll_to_top_on_mobile'    => false,
            'show_main_banner_excerpt_mobile_option'  =>  false,
            'show_carousel_banner_excerpt_mobile_option'  =>  false,
            'show_readtime_mobile_option'  =>  true,
            'show_comment_number_mobile_option'  =>  false,
            'show_background_animation_on_mobile'  =>  false,
            'website_layout'    => 'full-width--layout',
            'social_icons' => json_encode([
                [
                    'icon_class'    =>  'fab fa-facebook-f',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-instagram',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-youtube',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
            ]),
            'footer_social_icons' => json_encode([
                [
                    'icon_class'    =>  'fab fa-facebook-f',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-instagram',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
                [
                    'icon_class'    =>  'fab fa-youtube',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ],
            ]),
            'global_button_typo'    => $typography([
                'font_family' =>  [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
            ]),
            'audio_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' =>  'fa-solid fa-music' ]),
            'gallery_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-layer-group' ]),
            'image_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-image' ]),
            'quote_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-quote-left' ]),
            'standard_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-regular fa-file-lines' ]),
            'video_post_format_icon_picker' => $icon_picker([ 'type' => 'none', 'value' => 'fa-solid fa-video' ]),
            'stt_text'  =>  esc_html__( '', 'blogzee' ),
            'preloader_option'  => false,
            'post_title_hover_effects'  => 'eight',
            'site_image_hover_effects'  => 'five',
            'cursor_animation'  => 'none',
            'site_breadcrumb_option'    => false,
            'site_breadcrumb_type'  => 'default',
            'breadcrumb_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
            ]),
            'site_schema_ready' => true,
            'site_date_format'  => 'default',
            'site_date_to_show' => 'published',
            'disable_admin_notices'   => false,
            'site_title_hover_textcolor'=> '#f34601',
            'site_description_color'    => '#131315',
            'site_title_tag_for_frontpage'  =>  'h1',
            'site_title_tag_for_innerpage'  =>  'h2',
            'ticker_news_option'    => true,
            'ticker_news_categories' => [],
            'ticker_news_posts_to_include' => [],
            'ticker_news_post_order'    =>  'date-desc',
            'ticker_news_no_of_posts_to_show'   =>  3,
            'ticker_news_hide_post_with_no_featured_image'  =>  false,
            'ticker_news_border_radius' =>  $responsive( 8, 8, 8 ),
            'ticker_news_post_title_typo'    =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 14, 13 ),
                'line_height' =>  $responsive( 17, 17, 17 )
            ]),
            'ticker_news_post_date_typo' =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 17, 17, 17 )
            ]),
            'main_banner_option'    => true,
            'main_banner_slider_categories' => [],
            'main_banner_slider_posts_to_include' => [],
            'main_banner_trailing_slider_categories' => [],
            'main_banner_trailing_slider_posts_to_include' => [],
            'default_typo_one'   =>  $typography(),
            'default_typo_two'   =>  $typography([ 
                'font_family'   => [ 'value' => 'Manrope', 'label' => 'Manrope' ],
            ]),
            'site_title_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 30, 35, 35 ),
                'line_height' =>  $responsive( 45, 42, 40 )
            ]),
            'site_description_typo'   =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 22, 22, 22 )
            ]),
            'custom_button_label'  =>  esc_html__( 'Subscribe', 'blogzee' ),
            'custom_button_redirect_href_link' =>  home_url(),
            'custom_button_text_typography' =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'header_custom_button_background_color_group'   =>  [
                'initial'   => $color([ 'solid' => '#000' ]),
                'hover'   => $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'search_icon_size' =>  $responsive( 17, 16, 16 ),
            'theme_mode_dark_icon' => $icon_picker([ 'value' => 'fas fa-moon' ]),
            'theme_mode_light_icon' => $icon_picker([ 'value' => 'fas fa-sun' ]),
            'theme_mode_icon_size'    =>  $responsive( 18, 18, 18 ),
            'header_buiilder_header_sticky'    =>  false,
            'header_first_row_header_sticky'    =>  false,
            'header_second_row_header_sticky'    =>  true,
            'header_third_row_header_sticky'    =>  false,
            'header_menu_hover_effect' =>  'none',
            'footer_menu_hover_effect' =>  'none',
            'main_menu_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 13, 13 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'main_menu_sub_menu_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_pagination_type'   => 'number',
            'archive_post_layout'   => 'grid-two',
            'archive_sidebar_layout'    =>  'right-sidebar',
            'archive_post_elements_alignment'=> 'left',
            'archive_image_size'  =>  'large',
            'archive_section_border_radius'   =>  16,
            'archive_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 19, 20, 22 ),
                'line_height' =>  $responsive( 28, 30, 35 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'Unset',
            ]), 
            'archive_excerpt_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_category_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Regular 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 14, 12 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_date_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_author_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'archive_read_time_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_comment_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_category_info_box_option'  => true,
            'archive_category_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 26, 26, 26 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_category_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_tag_info_box_option'  => true,
            'archive_tag_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 26, 26, 26 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'archive_tag_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'archive_author_info_box_option'  => true,
            'archive_author_info_box_title_typo'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 26, 26, 26 ),
                'line_height' =>  $responsive( 32, 32, 32 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform' => 'Capitalize'
            ]),
            'archive_author_info_box_description_typo'    => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'single_sidebar_layout'=> 'right-sidebar',
            'single_author_option'  => true,
            'single_author_image_option'  => true,
            'single_post_content_alignment' =>  'left',
            'single_image_size'  =>  'large',
            'single_image_border_radius'   =>  16,
            'single_post_related_posts_option'  => true,
            'single_post_related_posts_title'   => esc_html__( 'Related Articles', 'blogzee' ),
            'single_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 34, 27, 24 ),
                'line_height' =>  $responsive( 44, 38, 38 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'single_content_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 26, 26, 26 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'single_category_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'single_date_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'single_author_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'single_read_time_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'single_page_border_radius' =>  16,
            'page_settings_sidebar_layout'  =>  'right-sidebar',
            'page_image_size'  =>  'large',
            'page_image_border_radius'   =>  16,
            'page_title_typo'  => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 32, 32, 32 ),
                'line_height' =>  $responsive( 31, 31, 31 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'page_content_typo'  => $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 26, 26, 26 ),
                'letter_spacing' =>  $responsive( 0.4, 0.4, 0.4 )
            ]),
            'page_border_radius'  =>  16,
            'site_logo_width'  =>  $responsive( 160, 160, 160 ),
            'header_custom_button_border_radius'  =>  $responsive( 16, 16, 16 ),
            'custom_button_animation_type'  =>  'none',
            'canvas_menu_position'  =>  'left',
            'main_banner_no_of_posts_to_show'   =>  5,
            'main_banner_trailing_no_of_posts_to_show'   =>  3,
            'main_banner_hide_post_with_no_featured_image'  =>  false,
            'main_banner_trailing_hide_post_with_no_featured_image'  =>  false,
            'main_banner_post_order'    =>  'date-desc',
            'main_banner_trailing_post_order'    =>  'date-desc',
            'main_banner_date_icon' => $icon_picker([ 'value' => 'fas fa-calendar-days' ]),
            'main_banner_post_elements_alignment'  =>  'left',
            'main_banner_image_sizes'  =>  'large',
            'main_banner_image_border_radius'   =>  16,
            'main_banner_border_radius'   =>  $responsive( 14, 14, 14 ),
            'main_banner_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 22, 20 ),
                'line_height' =>  $responsive( 34, 32, 30 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'main_banner_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'main_banner_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'main_banner_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'main_banner_sidebar_post_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'unset',
            ]),
            'main_banner_sidebar_block_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 24, 24 ),
                'line_height' =>  $responsive( 36, 36, 36 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'unset',
            ]),
            'main_banner_sidebar_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'unset',
            ]),
            'main_banner_sidebar_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 15, 15, 15 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 ),
                'text_transform'    => 'unset',
            ]),
            'main_banner_design_post_excerpt_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '300', 'label' => 'Light 300', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 25, 25, 25 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'carousel_option'    => false,
            'carousel_slider_categories' => [],
            'carousel_slider_posts_to_include' => [],
            'carousel_no_of_posts_to_show'   =>  5,
            'carousel_hide_post_with_no_featured_image'  =>  false,
            'carousel_post_order'    =>  'date-desc',
            'carousel_post_elements_alignment'  =>  'center',
            'carousel_image_sizes'  =>  'large',
            'carousel_image_border_radius'  =>  [ 
                'desktop' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ],
                'tablet' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ],
                'smartphone' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ]
            ],
            'carousel_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            'carousel_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'carousel_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'carousel_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform' => 'Capitalize'
            ]),
            'carousel_design_post_excerpt_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            // category collection
            'category_collection_option'    =>  false,
            'category_collection_show_count'    =>  false,
            'category_collection_number_of_columns'    =>  $responsive( 3, 2, 1 ),
            'category_to_include' => [],
            'category_to_exclude' => [],
            'category_collection_number' => 3,
            'category_collection_orderby' => 'asc-name',
            'category_collection_image_radius'  =>  $responsive( 16, 16, 16 ),
            'category_collection_image_size'  =>  'large',
            'category_collection_hover_effects'  =>  'none',
            'category_collection_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 19, 19, 19 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            // you may have missed
            'you_may_have_missed_section_option' => true,
            'you_may_have_missed_title_option' => true,
            'you_may_have_missed_title' => esc_html__( 'You May Have Missed', 'blogzee' ),
            'you_may_have_missed_no_of_columns'    =>  3,
            'you_may_have_missed_categories' => [],
            'you_may_have_missed_posts_to_include' => [],
            'you_may_have_missed_no_of_posts_to_show'   =>  3,
            'you_may_have_missed_hide_post_with_no_featured_image'  =>  false,
            'you_may_have_missed_post_order'    =>  'rand-desc',
            'you_may_have_missed_post_elements_alignment'  =>  'left',
            'you_may_have_missed_image_sizes'  =>  'large',
            'you_may_have_missed_image_border_radius'   =>  [
                'desktop' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ],
                'tablet' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ],
                'smartphone' => [ 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'link' => true ]
            ],
            'you_may_have_missed_design_section_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 19, 19, 19 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
                // 'text_transform'    => 'Uppercase'
            ]),
            'you_may_have_missed_design_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 19, 17 ),
                'line_height' =>  $responsive( 29, 29, 29 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'you_may_have_missed_design_post_categories_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 24, 24, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'you_may_have_missed_design_post_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'you_may_have_missed_design_post_author_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 12, 12, 12 ),
                'line_height' =>  $responsive( 18, 18, 18 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize',
            ]),
            // theme footer
            'bottom_footer_site_info'   => esc_html__( 'Blogzee - Blog WordPress Theme %year%.', 'blogzee' ),
            'bottom_footer_header_or_custom'    =>  'header',
            'bottom_footer_logo_option'   =>  0,
            'bottom_footer_logo_width'  =>  $responsive( 200, 200, 200 ),
            'heading_one_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 34, 34, 34 ),
                'line_height' =>  $responsive( 44, 44, 44 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_two_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 28, 28, 28 ),
                'line_height' =>  $responsive( 35, 35, 35 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_three_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 24, 24 ),
                'line_height' =>  $responsive( 31, 31, 31 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_four_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_five_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'heading_six_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0, 0, 0 )
            ]),
            'sidebar_border_radius'   => 16,
            'sidebar_image_border_radius'   => 12,
            'sidebar_block_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'unset'
            ]),
            'sidebar_post_title_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 23, 23, 23 )
            ]),
            'sidebar_category_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_date_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 20, 20, 20 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_one_typography'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 28, 28, 28 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_two_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 24, 24, 24 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_three_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 22, 22, 22 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_four_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 20, 20, 20 ),
                'line_height' =>  $responsive( 28, 28, 28 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_heading_five_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.2, 0.3 )
            ]),
            'sidebar_heading_six_typo'  =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 16, 16, 16 ),
                'line_height' =>  $responsive( 22, 22, 22 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'sidebar_pagination_button_typo'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Regular 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 13, 13, 13 ),
                'line_height' =>  $responsive( 13, 13, 13 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Capitalize'
            ]),
            'advertisement_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogzee' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogzee' ),
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_alignment'    =>  'center',
                    'item_image_option' =>  'original'
                ]
            ]),
            'blogdescription_option'    =>  false,
            'footer_title_typography'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'SemiBold 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 18, 18, 18 ),
                'line_height' =>  $responsive( 34, 34, 34 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 ),
                'text_transform'    => 'Unset'
            ]),
            'footer_text_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Medium 600', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'bottom_footer_text_typography'    => $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'bottom_footer_link_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 24, 24, 24 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'solid_color_preset' =>  [
                'color_palettes' => [
                    [ '#40E0D0', '#F4C430', '#FF00FF', '#007BA7', '#DC143C', '#7FFF00' ],
                    [ '#007FFF', '#FFBF00', '#50C878', '#8A2BE2', '#FF7F50' ],
                    [ '#008080', '#FFD700', '#E6E6FA', '#800000', '#808000', '#CCCCFF' ]
                ],
                'active_palette'    =>  '0'
            ],
            'gradient_color_preset' =>  [
                'color_palettes' => [
                    [ 'linear-gradient(135deg, #000000, #FFFF00)', 'linear-gradient(135deg, #191970, #FFD700)', 'linear-gradient(135deg, #4B0082, #FFA500)', 'linear-gradient(135deg, #FF8C00, #483D8B)', 'linear-gradient(135deg, #006400, #8B4513)', 'linear-gradient(135deg, #DC143C, #FFD700)' ],
                    [ 'linear-gradient(135deg, #00FFFF, #FF6347)', 'linear-gradient(135deg, #228B22, #8B4513)', 'linear-gradient(135deg, #F4A460, #DAA520)', 'linear-gradient(135deg, #FFD700, #FF6347)', 'linear-gradient(135deg, #9400D3, #87CEEB)', 'linear-gradient(135deg, #00FF00, #00FFFF)' ],
                    [ 'linear-gradient(135deg, #FFD700, #FFA500)', 'linear-gradient(135deg, #FF7F50, #FFD700)', 'linear-gradient(135deg, #483D8B, #00FFFF)', 'linear-gradient(135deg, #DC143C, #8B008B)', 'linear-gradient(135deg, #228B22, #2E8B57)', 'linear-gradient(135deg, #FF6347, #FFA500)' ],
                ],
                'active_palette'    =>  '0'
            ],
            'social_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'footer_social_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'header_menu_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'header_sub_menu_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'search_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#171717' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'theme_mode_dark_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#fff' ]),
                'hover' =>  $color([ 'solid' => '#fff' ])
            ],
            'theme_mode_light_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '#2f2e2e' ])
            ],
            'canvas_menu_icon_color' => [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'typography_presets'    =>  [
                'typographies'    =>  [
                    $typography([
                        'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                        'font_size'   => [
                            'desktop' => 16,
                            'tablet' => 16,
                            'smartphone' => 16
                        ],
                        'line_height'   => array(
                            'desktop' => 20,
                            'tablet' => 20,
                            'smartphone' => 20
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0.3,
                            'tablet' => 0.3,
                            'smartphone' => 0.3
                        )
                    ]),
                    $typography([
                        'font_family'   => [ 'value' => 'Outfit', 'label' => 'Outfit' ],
                        'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                        'font_size'   => [
                            'desktop' => 13,
                            'tablet' => 13,
                            'smartphone' => 13
                        ],
                        'line_height'   => array(
                            'desktop' => 23,
                            'tablet' => 23,
                            'smartphone' => 23
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0.3,
                            'tablet' => 0.3,
                            'smartphone' => 0.3
                        ),
                        'text_transform'    => 'uppercase'
                    ]),
                    $typography([
                        'font_family'   => [ 'value' => 'Poppins', 'label' => 'Poppins' ],
                        'font_weight'   => [ 'value' => '400', 'label' => 'Regular 400', 'variant' => 'normal' ],
                        'font_size'   => [
                            'desktop' => 14,
                            'tablet' => 14,
                            'smartphone' => 14
                        ],
                        'line_height'   => array(
                            'desktop' => 25,
                            'tablet' => 25,
                            'smartphone' => 25
                        ),
                        'letter_spacing'   => array(
                            'desktop' => 0,
                            'tablet' => 0,
                            'smartphone' => 0
                        )
                    ])
                ],
                'labels'    =>  [ esc_html__( 'Typography 1', 'blogzee' ), esc_html__( 'Typography 2', 'blogzee' ), esc_html__( 'Typography 3', 'blogzee' ) ]
            ],
            'header_builder'    =>  [
                '00'    =>  [],
                '01'    =>  [],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [ 'site-logo', 'menu' ],
                '11'    =>  [ 'search', 'theme-mode', 'button' ],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  []
            ],
            /* Date / Time */
            'date_time_typography'   =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 14, 14, 14 ),
                'line_height' =>  $responsive( 36, 36, 36 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'date_color'   =>  $color([ 'solid' => '#000' ]),
            'time_color'   =>  $color([ 'solid' => '#000' ]),
            /* Header builder */
            'header_builder_section_width'   =>  'boxed--layout',
            'header_builder_background'   =>  $color(),
            /* First row */
            'header_first_row_column'  =>  2,
            'header_first_row_column_layout'  =>  $responsive( 'two', 'two', 'four' ),
            'header_first_row_padding'   =>  [
                'desktop' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ]
            ],
            'header_first_row_column_one'   =>  $responsive( 'left', 'left', 'center' ),
            'header_first_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'header_first_row_column_three'   =>  $responsive( 'right', 'right', 'right' ),
            'header_first_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Second row */
            'header_second_row_column'  =>  2,
            'header_second_row_column_layout'  =>  $responsive( 'two', 'two', 'four' ),
            'header_second_row_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ]
            ],
            'header_second_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'header_second_row_column_two'   =>  $responsive( 'right', 'right', 'right' ),
            'header_second_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'header_second_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Third row */
            'header_third_row_column'  =>  2,
            'header_third_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'header_third_row_padding'   =>  [
                'desktop' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 10, 'right' => 0, 'bottom' => 10, 'left' => 0, 'link' => true ]
            ],
            'header_third_row_column_one'   =>  $responsive( 'left', 'left', 'left' ),
            'header_third_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'header_third_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'header_third_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer Builder */
            'footer_builder'    =>  [
                '00'    =>  [ 'logo' ],
                '01'    =>  [],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [ 'social-icons' ],
                '11'    =>  [],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [ 'copyright','scroll-to-top' ],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  [],
            ],
            /* Footer builder */
            'footer_builder_section_width'   =>  'boxed--layout',
            /* Footer First row */
            'footer_first_row_column'  =>  1,
            'footer_first_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_first_row_padding'   =>  [
                'desktop' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 60, 'right' => 0, 'bottom' => 0, 'left' => 0, 'link' => true ]
            ],
            'footer_first_row_column_one'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_first_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_first_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_first_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer  econd row */
            'footer_second_row_column'  =>  1,
            'footer_second_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_second_row_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 0, 'bottom' => 20, 'left' => 0, 'link' => true ]
            ],
            'footer_second_row_column_one'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_second_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_second_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_second_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Footer Third row */
            'footer_third_row_column'  =>  1,
            'footer_third_row_column_layout'  =>  $responsive( 'one', 'two', 'three' ),
            'footer_third_row_padding'   =>  [
                'desktop' => [ 'top' => 20, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ],
                'tablet' => [ 'top' => 20, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ],
                'smartphone' => [ 'top' => 20, 'right' => 0, 'bottom' => 60, 'left' => 0, 'link' => true ]
            ],
            'footer_third_row_column_one'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_third_row_column_two'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_third_row_column_three'   =>  $responsive( 'center', 'center', 'center' ),
            'footer_third_row_column_four'   =>  $responsive( 'right', 'right', 'right' ),
            /* Responsive header builder */
            'responsive_header_builder' =>  [
                '00'    =>  [ 'site-logo' ],
                '01'    =>  [ 'toggle-button' ],
                '02'    =>  [],
                '03'    =>  [],
                '10'    =>  [],
                '11'    =>  [],
                '12'    =>  [],
                '13'    =>  [],
                '20'    =>  [],
                '21'    =>  [],
                '22'    =>  [],
                '23'    =>  [],
                'responsive-canvas' =>  [ 'menu' ]
            ],
            'mobile_canvas_alignment'   =>  'left',
            'mobile_canvas_icon_color'  =>  [
                'initial'   =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ]),
                'hover'   =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
            'footer_menu_typography'    =>  $typography([
                'font_family'   => [ 'value' => 'Montserrat', 'label' => 'Montserrat' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Medium 500', 'variant' => 'normal' ],
                'font_size' =>  $responsive( 15, 15, 15 ),
                'line_height' =>  $responsive( 23, 23, 23 ),
                'letter_spacing' =>  $responsive( 0.3, 0.3, 0.3 )
            ]),
            'footer_menu_color' =>  [ 
                'initial'   =>  $color([ 'solid' => '#000' ]),
                'hover' =>  $color([ 'solid' => '--blogzee-global-preset-theme-color' ])
            ],
        ]);
        return $array_defaults;
    }
endif;

if( !function_exists( 'blogzee_get_customizer_default' ) ) :
    /**
     * Gets customizer "theme_mods" value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_get_customizer_default( $key ) { 
        $array_defaults = blogzee_customizer_default_array();
        $totalCats = get_categories();
        if( $totalCats ) :
            foreach( $totalCats as $singleCat ) :
                $array_defaults['category_' .absint($singleCat->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '--blogzee-global-preset-theme-color'
                    ],
                    'hover'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                ];
                $array_defaults['category_background_' .absint($singleCat->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' => '#fdcdba'
                    ],
                    'hover' =>  [
                        'type'  =>  'solid',
                        'solid' => '--blogzee-global-preset-theme-color'
                    ]
                ];
            endforeach;
        endif;
        $totalTags = get_tags();
        if( $totalTags ) :
            foreach( $totalTags as $singleTag ) :
                $array_defaults['tag_' .absint($singleTag->term_id). '_color'] = [
                    'initial'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ],
                    'hover'   =>  [
                        'type'  =>  'solid',
                        'solid' =>  '#fff'
                    ]
                ];
                $array_defaults['tag_background_' .absint($singleTag->term_id). '_color'] = [
                    'initial'    => [
                        'type'  =>  'solid',
                        'solid' => '--blogzee-global-preset-theme-color' 
                    ],
                    'hover'    => [
                        'type'  =>  'solid',
                        'solid' => '--blogzee-global-preset-theme-color'
                    ]
                ];
            endforeach;
        endif;
        return $array_defaults[$key];
    }
endif;