<?php
use Blogzee\CustomizerDefault as BZ;
/**
 * Class that handles everything related to customizer
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */
 require get_template_directory() . '/inc/customizer/helpers.php';
 if( ! class_exists( 'Blogzee_Customizer' ) ) :
    class Blogzee_Customizer extends Blogzee_Customizer_List {
        /**
         * Instance of this class
         * 
        * @since 1.0.0
        */
        private static $_instance = null;

        /**
         * customizer variable
         * 
        * @since 1.0.0
        */
        protected $customize;

        /**
         * Has current Section id
         * 
         * @since 1.0.0
         */
        public $section;

        /**
         * Creates only one instance of class
         * 
         * @since 1.0.0
         */
        static function instance( $wp_customize ) {
            if( is_null( self::$_instance ) ) self::$_instance = new self( $wp_customize );
            return self::$_instance;
        }

        /**
         * Function that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __construct( $wp_customize ) {
            $this->customize = $wp_customize;
            $this->customize();
            $this->register();
        }

        /**
         * Function to customizer predefined panels, sections and controls
         * 
         * @since 1.0.0
         */
        public function customize() {
            $this->customize->get_section( 'title_tagline' )->title = esc_html__( 'Site Identity', 'blogzee' );
            $this->customize->get_control( 'custom_logo' )->priority = 10;
            $this->customize->get_control( 'site_icon' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->section = 'title_tagline';
            $this->customize->get_control( 'header_textcolor' )->priority = 20;
            $this->customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'blogzee' );
            $this->customize->get_control( 'blogname' )->section = 'title_tagline';
            $this->customize->get_control( 'blogname' )->priority = 30;
            $this->customize->get_control( 'blogdescription' )->section = 'title_tagline';
            $this->customize->get_control( 'blogdescription' )->priority = 30;
            $this->customize->get_control( 'display_header_text' )->section = 'title_tagline';
            $this->customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'blogzee' );
            $this->customize->get_control( 'display_header_text' )->priority = 40;
        }

        /**
         * Register panels, sections and control in the customizer
         * 
         * @since 1.0.0
         */
        protected function register() {
            // About theme section
            $this->add_section( 'about_section' );
            $this->add_control( 'site_documentation_info', 'info_box' );
            $this->add_control( 'site_support_info', 'info_box' );
            $this->add_control( 'view_premium_info', 'info_box' );
            // Site Logo & Title
            $this->section = 'title_tagline';
            $this->add_control( 'site_title_section_tab', 'section_tab' );
            $this->add_control( 'logo_and_icon_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'site_logo_width', 'number' );
            $this->add_control( 'site_title_section_toggle', 'section_heading_toggle' );
            $this->add_control( 'site_title_tag_for_frontpage', 'select' );
            $this->add_control( 'site_title_tag_for_innerpage', 'select' );
            $this->add_control( 'blogdescription_option', 'checkbox' );
            $this->add_control( 'site_title_typo', 'typography' );
            $this->add_control( 'site_description_typo', 'typography' );
            $this->add_control( 'site_title_hover_textcolor', 'predefined_color' );
            $this->add_control( 'site_description_color', 'predefined_color' );
            // Global Panel
            $this->add_panel( 'global_panel' );
            // SEO / Misc
            $this->add_section( 'seo_misc_section' );
            $this->add_control( 'site_schema_ready', 'toggle' );
            $this->add_control( 'site_date_to_show', 'radio_tab' );
            $this->add_control( 'site_date_format', 'select' );
            $this->add_control( 'disable_admin_notices_heading', 'section_heading' );
            $this->add_control( 'disable_admin_notices', 'toggle' );
            // Preloader
            $this->add_section( 'preloader_section' );
            $this->add_control( 'preloader_option', 'toggle' );
            // Website Layout
            $this->add_section( 'website_layout_section' );
            $this->add_control( 'website_layout_header', 'section_heading' );
            $this->add_control( 'website_layout', 'radio_image' );
            // Animation / Hover Effect
            $this->add_section( 'animation_section' );
            $this->add_control( 'site_hover_animation', 'section_heading' );
            $this->add_control( 'post_title_hover_effects', 'select' );
            $this->add_control( 'site_image_hover_effects', 'select' );
            $this->add_control( 'cursor_animation', 'select' );
            // Social Icons
            $this->add_section( 'social_icons_section' );
            $this->add_control( 'social_icons_section_heading', 'section_tab' );
            $this->add_control( 'social_icons', 'custom_repeater' );
            $this->add_control( 'social_icon_color', 'color' );
            // Buttons
            $this->add_section( 'buttons_section' );
            $this->add_control( 'global_button_redirect', 'redirect_control' );
            $this->add_control( 'global_button_typo', 'typography' );
            // Post Format
            $this->add_section( 'post_format_section' );
            $this->add_control( 'standard_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'audio_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'gallery_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'image_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'quote_post_format_icon_picker', 'icon_picker' );
            $this->add_control( 'video_post_format_icon_picker', 'icon_picker' );
            // Breadcrumb Options
            $this->add_section( 'breadcrumb_options_section' );
            $this->add_control( 'breadcrumb_section_tab', 'section_tab' );
            $this->add_control( 'site_breadcrumb_option', 'simple_toggle' );
            $this->add_control( 'site_breadcrumb_type', 'select' );
            $this->add_control( 'breadcrumb_typo', 'typography' );
            // Scroll to Top
            $this->add_section( 'stt_options_section' );
            $this->add_control( 'stt_text', 'text' );
            // Colors Panel
            $this->add_panel( 'colors_panel' );
            // Theme Colors / Preset
            $this->add_section( 'theme_presets_section' );
            $this->add_control( 'theme_colors_section_heading', 'section_heading' );
            $this->add_control( 'theme_color', 'preset_color' );
            $this->add_control( 'gradient_theme_color', 'preset_color' );
            $this->add_control( 'theme_presets_section_heading', 'section_heading' );
            $this->add_control( 'solid_color_preset', 'preset' );
            $this->add_control( 'gradient_color_preset', 'preset' );
            // Category Colors
            $this->add_section( 'category_colors_section' );
            $totalCats = get_categories();
            if( $totalCats ) :
                $totalCats_count = count( $totalCats );
                foreach( $totalCats as $key => $singleCat ) :
                    $this->add_control( 'category_' . absint( $singleCat->term_id ) . '_color_heading', 'section_heading_toggle' );
                    $this->add_control( 'category_' . absint( $singleCat->term_id ) . '_color', 'color' );
                    $this->add_control( 'category_background_' . absint( $singleCat->term_id ) . '_color', 'color' );
                endforeach;
            endif;
            // Tags Colors
            $this->add_section( 'tag_colors_section' );
            $totalTags = get_tags();
            if( $totalTags ) :
                $totalTags_count = count( $totalTags );
                foreach( $totalTags as $key => $singleTag ) :
                    $this->add_control( 'tag_' . absint( $singleTag->term_id ) . '_color_heading', 'section_heading_toggle' );
                    $this->add_control( 'tag_' . absint( $singleTag->term_id ) . '_color', 'color' );
                    $this->add_control( 'tag_background_' . absint( $singleTag->term_id ) . '_color', 'color' );
                endforeach;
            endif;
            // Advertisement Section
            $this->add_section( 'advertisement_section' );
            $this->add_control( 'advertisement_repeater', 'custom_repeater' );
            // Typography Section
            $this->add_section( 'typography_section' );
            $this->add_control( 'typography_preset_header', 'section_heading' );
            $this->add_control( 'typography_presets', 'typography_preset' );
            $this->add_control( 'heading_typographies', 'section_heading' );
            $this->add_control( 'heading_one_typo', 'typography' );
            $this->add_control( 'heading_two_typo', 'typography' );
            $this->add_control( 'heading_three_typo', 'typography' );
            $this->add_control( 'heading_four_typo', 'typography' );
            $this->add_control( 'heading_five_typo', 'typography' );
            $this->add_control( 'heading_six_typo', 'typography' );
            // Widget Styles Section
            $this->add_section( 'widget_styles_section' );
            $this->add_control( 'widget_styles_general_settings_header', 'section_heading_toggle' );
            $this->add_control( 'sidebar_border_radius', 'predefined_number' );
            $this->add_control( 'sidebar_image_border_radius', 'predefined_number' );
            $this->add_control( 'widget_styles_sidebar_settings_header', 'section_heading_toggle' );
            $this->add_control( 'sidebar_block_title_typography', 'typography' );
            $this->add_control( 'sidebar_post_title_typography', 'typography' );
            $this->add_control( 'sidebar_category_typography', 'typography' );
            $this->add_control( 'sidebar_date_typography', 'typography' );
            $this->add_control( 'sidebar_pagination_button_typo', 'typography' );
            $this->add_control( 'widget_styles_headings_settings_header', 'section_heading_toggle' );
            $this->add_control( 'sidebar_heading_one_typography', 'typography' );
            $this->add_control( 'sidebar_heading_two_typo', 'typography' );
            $this->add_control( 'sidebar_heading_three_typo', 'typography' );
            $this->add_control( 'sidebar_heading_four_typo', 'typography' );
            $this->add_control( 'sidebar_heading_five_typo', 'typography' );
            $this->add_control( 'sidebar_heading_six_typo', 'typography' );
            // Mobile Options Section
            $this->add_section( 'mobile_options_section' );
            $this->add_control( 'show_main_banner_excerpt_mobile_option', 'checkbox' );
            $this->add_control( 'show_carousel_banner_excerpt_mobile_option', 'checkbox' );
            $this->add_control( 'show_readtime_mobile_option', 'checkbox' );
            $this->add_control( 'show_comment_number_mobile_option', 'checkbox' );
            $this->add_control( 'show_background_animation_on_mobile', 'checkbox' );
            $this->add_control( 'show_scroll_to_top_on_mobile', 'checkbox' );
            // Top Header Section
            $this->add_section( 'date_time_section' );
            $this->add_control( 'date_time_typography', 'typography' );
            $this->add_control( 'date_color', 'color' );
            $this->add_control( 'time_color', 'color' );
            // Menu Options Section
            $this->add_section( 'header_menu_options_section' );
            $this->add_control( 'menu_options_section_tab', 'section_tab' );
            $this->add_control( 'main_menu_typo', 'typography' );
            $this->add_control( 'main_menu_sub_menu_typo', 'typography' );
            $this->add_control( 'header_main_menu_header', 'section_heading' );
            $this->add_control( 'header_menu_color', 'color' );
            $this->add_control( 'header_sub_menu_header', 'section_heading' );
            $this->add_control( 'header_sub_menu_color', 'color' );
            $this->add_control( 'header_menu_hover_effect', 'select' );
            // Live Search Section
            $this->add_section( 'header_live_search_section' );
            $this->add_control( 'search_section_tab', 'section_tab' );
            $this->add_control( 'search_icon_size', 'number' );
            $this->add_control( 'search_icon_color', 'color' );
            // Custom Button Section
            $this->add_section( 'custom_button_section' );
            $this->add_control( 'custom_button_section_tab', 'section_tab' );
            $this->add_control( 'custom_button_label', 'text' );
            $this->add_control( 'custom_button_redirect_href_link', 'url' );
            $this->add_control( 'custom_button_animation_type', 'select' );
            $this->add_control( 'custom_button_text_typography', 'typography' );
            $this->add_control( 'header_custom_button_background_color_group', 'color' );
            $this->add_control( 'header_custom_button_border_radius', 'number' );
            // Theme Mode Section
            $this->add_section( 'theme_mode_section' );
            $this->add_control( 'theme_mode_section_tab', 'section_tab' );            
            $this->add_control( 'theme_mode_dark_icon', 'icon_picker' );
            $this->add_control( 'theme_mode_light_icon', 'icon_picker' );
            $this->add_control( 'theme_mode_icon_size', 'number' );
            $this->add_control( 'theme_mode_dark_icon_color', 'color' );
            $this->add_control( 'theme_mode_light_icon_color', 'color' );
            // Canvas Menu Section
            $this->add_section( 'canvas_menu_section' );
            $this->add_control( 'canvas_menu_setting', 'section_tab' );
            $this->add_control( 'canvas_menu_position', 'radio_tab' );
            $this->add_control( 'canvas_menu_redirects', 'redirect_control' );
            $this->add_control( 'canvas_menu_icon_color', 'color' );
            // Header Builder
            $this->add_section( 'header_builder_section_settings' );
            $this->add_control( 'header_builder_section_tab', 'section_tab' );
            $this->add_control( 'header_builder_section_width', 'radio_image' );
            $this->add_control( 'header_buiilder_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_first_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_second_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_third_row_header_sticky', 'simple_toggle' );
            $this->add_control( 'header_builder_background', 'color' );
            // Ticker News Section
            $this->add_section( 'ticker_news_section' );
            $this->add_control( 'ticker_news_section_heading', 'section_tab' );
            $this->add_control( 'ticker_news_option', 'toggle' );
            $this->add_control( 'ticker_news_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'ticker_news_categories', 'multiselect' );
            $this->add_control( 'ticker_news_posts_to_include', 'multiselect' );
            $this->add_control( 'ticker_news_post_order', 'select' );
            $this->add_control( 'ticker_news_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'ticker_news_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( 'ticker_news_border_radius', 'number' );
            $this->add_control( 'ticker_news_typography_heading', 'section_heading_toggle' );
            $this->add_control( 'ticker_news_post_title_typo', 'typography' );
            $this->add_control( 'ticker_news_post_date_typo', 'typography' );
            // Main Banner Section
            $this->add_section( 'main_banner_section' );
            $this->add_control( 'main_banner_section_heading', 'section_tab' );
            $this->add_control( 'main_banner_option', 'toggle' );
            $this->add_control( 'main_banner_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'main_banner_slider_categories', 'multiselect' );
            $this->add_control( 'main_banner_slider_posts_to_include', 'multiselect' );
            $this->add_control( 'main_banner_post_order', 'select' );
            $this->add_control( 'main_banner_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'main_banner_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( 'main_banner_trailing_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'main_banner_trailing_slider_categories', 'multiselect' );
            $this->add_control( 'main_banner_trailing_slider_posts_to_include', 'multiselect' );
            $this->add_control( 'main_banner_trailing_post_order', 'select' );
            $this->add_control( 'main_banner_trailing_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'main_banner_trailing_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( 'main_banner_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'main_banner_post_elements_alignment', 'radio_tab' );
            $this->add_control( 'main_banner_border_radius', 'number' );
            $this->add_control( 'main_banner_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( 'main_banner_image_sizes', 'select' );
            $this->add_control( 'main_banner_image_border_radius', 'predefined_number' );
            $this->add_control( 'main_banner_design_typography', 'section_heading_toggle' );
            $this->add_control( 'main_banner_design_post_title_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_excerpt_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_categories_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_date_typography', 'typography' );
            $this->add_control( 'main_banner_design_post_author_typography', 'typography' );
            $this->add_control( 'main_banner_design_sidebar_typography', 'section_heading_toggle' );
            $this->add_control( 'main_banner_sidebar_block_typography', 'typography' );
            $this->add_control( 'main_banner_sidebar_post_typography', 'typography' );
            $this->add_control( 'main_banner_sidebar_categories_typography', 'typography' );
            $this->add_control( 'main_banner_sidebar_date_typography', 'typography' );
             // Category Collection Section
            $this->add_section( 'category_collection_section' );
            $this->add_control( 'category_collection_section_heading', 'section_tab' );
            $this->add_control( 'category_collection_option', 'toggle' );
            $this->add_control( 'category_collection_show_count', 'simple_toggle' );
            $this->add_control( 'category_collection_number_of_columns', 'number' );
            $this->add_control( 'category_collection_query_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( 'category_to_include', 'multiselect' );
            $this->add_control( 'category_to_exclude', 'multiselect' );
            $this->add_control( 'category_collection_orderby', 'select' );
            $this->add_control( 'category_collection_number', 'predefined_number' );
            $this->add_control( 'category_collection_image_heading_section_heading', 'section_heading_toggle' );
            $this->add_control( 'category_collection_image_size', 'select' );
            $this->add_control( 'category_collection_image_radius', 'number' );
            $this->add_control( 'category_collection_hover_effects', 'select' );
            $this->add_control( 'category_collection_typo', 'typography' );
            // Carousel Section
            $this->add_section( 'carousel_section' );
            $this->add_control( 'carousel_section_heading', 'section_tab' );
            $this->add_control( 'carousel_option', 'toggle' );
            $this->add_control( 'carousel_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'carousel_slider_categories', 'multiselect' );
            $this->add_control( 'carousel_slider_posts_to_include', 'multiselect' );
            $this->add_control( 'carousel_post_order', 'select' );
            $this->add_control( 'carousel_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'carousel_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( 'carousel_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'carousel_post_elements_alignment', 'radio_tab' );
            $this->add_control( 'carousel_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( 'carousel_image_sizes', 'select' );
            $this->add_control( 'carousel_image_border_radius', 'spacing' );
            $this->add_control( 'carousel_design_post_title_typography', 'typography' );
            $this->add_control( 'carousel_design_post_excerpt_typography', 'typography' );
            $this->add_control( 'carousel_design_post_categories_typography', 'typography' );
            $this->add_control( 'carousel_design_post_date_typography', 'typography' );
            $this->add_control( 'carousel_design_post_author_typography', 'typography' );
            // Blog / Archives Panel
            $this->add_panel( 'archive_panel' );
            // General Settings Section
            $this->add_section( 'archive_general_section' );
            $this->add_control( 'archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_layouts_settings_header', 'section_heading_toggle' );
            $this->add_control( 'archive_post_layout', 'radio_image' );
            $this->add_control( 'archive_sidebar_layout', 'radio_image' );
            $this->add_control( 'archive_elements_settings_header', 'section_heading_toggle' );
            $this->add_control( 'archive_post_elements_alignment', 'radio_tab' );
            $this->add_control( 'archive_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( 'archive_image_size', 'select' );
            $this->add_control( 'archive_section_border_radius', 'number' );
            $this->add_control( 'archive_typography_header', 'section_heading_toggle' );
            $this->add_control( 'archive_title_typo', 'typography' );
            $this->add_control( 'archive_excerpt_typo', 'typography' );
            $this->add_control( 'archive_category_typo', 'typography' );
            $this->add_control( 'archive_date_typo', 'typography' );
            $this->add_control( 'archive_author_typo', 'typography' );
            $this->add_control( 'archive_read_time_typo', 'typography' );
            $this->add_control( 'archive_comment_typo', 'typography' );
            // Category Page Section
            $this->add_section( 'category_archive_section' );
            $this->add_control( 'category_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_category_info_box_option', 'toggle' );
            $this->add_control( 'archive_category_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_category_info_box_description_typo', 'typography' );
            // Tag Page Section
            $this->add_section( 'tag_archive_section' );
            $this->add_control( 'tag_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_tag_info_box_option', 'toggle' );
            $this->add_control( 'archive_tag_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_tag_info_box_description_typo', 'typography' );
            // Author Page Section
            $this->add_section( 'author_archive_section' );
            $this->add_control( 'author_archive_section_heading', 'section_tab' );
            $this->add_control( 'archive_author_info_box_option', 'toggle' );
            $this->add_control( 'archive_author_info_box_title_typo', 'typography' );
            $this->add_control( 'archive_author_info_box_description_typo', 'typography' );
            // Pagination Settings Section
            $this->add_section( 'pagination_settings_section' );
            $this->add_control( 'archive_pagination_type', 'select' );
            // Single Post Panel
            $this->add_panel( 'single_section_panel' );
            //  General Settings Section
            $this->add_section( 'blog_single_general_settings' );
            $this->add_control( 'single_section_heading', 'section_tab' );
            $this->add_control( 'single_sidebar_layout', 'radio_image' );
            $this->add_control( 'single_image_settings_header', 'section_heading_toggle' );
            $this->add_control( 'single_image_size', 'select' );
            $this->add_control( 'single_image_border_radius', 'predefined_number' );
            $this->add_control( 'single_page_border_radius', 'number' );
            $this->add_control( 'single_typography_header', 'section_heading_toggle' );
            $this->add_control( 'single_title_typo', 'typography' );
            $this->add_control( 'single_content_typo', 'typography' );
            $this->add_control( 'single_category_typo', 'typography' );
            $this->add_control( 'single_date_typo', 'typography' );
            $this->add_control( 'single_author_typo', 'typography' );
            $this->add_control( 'single_read_time_typo', 'typography' );
            //  Elements Settings Section
            $this->add_section( 'blog_single_elements_settings_section' );
            $this->add_control( 'single_author_option', 'simple_toggle' );
            $this->add_control( 'single_author_image_option', 'simple_toggle' );
            $this->add_control( 'single_post_content_alignment', 'radio_tab' );
            //  Related Posts Section
            $this->add_section( 'blog_single_related_posts_section' );
            $this->add_control( 'single_post_related_posts_option', 'toggle' );
            $this->add_control( 'single_post_related_posts_title', 'text' );
            // Page Settings Section
            $this->add_section( 'page_settings_section' );
            $this->add_control( 'page_settings_section_tab', 'section_tab' );
            $this->add_control( 'page_settings_sidebar_layout', 'radio_image' );
            $this->add_control( 'page_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( 'page_image_size', 'select' );
            $this->add_control( 'page_image_border_radius', 'predefined_number' );
            $this->add_control( 'page_border_radius', 'number' );
            $this->add_control( 'page_typography_section_heading_toggle', 'section_heading_toggle' );
            $this->add_control( 'page_title_typo', 'typography' );
            $this->add_control( 'page_content_typo', 'typography' );
            // You May Have Missed Section  
            $this->add_section( 'you_may_have_missed_section' );
            $this->add_control( 'you_may_have_missed_section_tab', 'section_tab' );
            $this->add_control( 'you_may_have_missed_section_option', 'toggle' );
            $this->add_control( 'you_may_have_missed_no_of_columns', 'predefined_number' );
            $this->add_control( 'you_may_have_missed_title_option', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_title', 'text' );
            $this->add_control( 'you_may_have_missed_post_query_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'you_may_have_missed_categories', 'multiselect' );
            $this->add_control( 'you_may_have_missed_posts_to_include', 'multiselect' );
            $this->add_control( 'you_may_have_missed_post_order', 'select' );
            $this->add_control( 'you_may_have_missed_no_of_posts_to_show', 'predefined_number' );
            $this->add_control( 'you_may_have_missed_hide_post_with_no_featured_image', 'simple_toggle' );
            $this->add_control( 'you_may_have_missed_post_elements_settings_heading', 'section_heading_toggle' );
            $this->add_control( 'you_may_have_missed_post_elements_alignment', 'radio_tab' );
            $this->add_control( 'you_may_have_missed_image_setting_heading', 'section_heading_toggle' );
            $this->add_control( 'you_may_have_missed_image_sizes', 'select' );
            $this->add_control( 'you_may_have_missed_image_border_radius', 'spacing' );
            $this->add_control( 'you_may_have_missed_design_section_title_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_title_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_categories_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_date_typography', 'typography' );
            $this->add_control( 'you_may_have_missed_design_post_author_typography', 'typography' );
            // Footer Builder
            $this->add_section( 'footer_builder_section_settings' );
            $this->add_control( 'footer_section_tab', 'section_tab' );
            $this->add_control( 'footer_builder_section_width', 'radio_image' );
            $this->add_control( 'footer_title_typography', 'typography' );
            $this->add_control( 'footer_text_typography', 'typography' );
            /* Footer Copyright */
            $this->add_section( 'footer_copyright' );
            $this->add_control( 'bottom_footer_section_tab', 'section_tab' );
            $this->add_control( 'bottom_footer_site_info', 'textarea' );
            $this->add_control( 'bottom_footer_text_typography', 'typography' );
            $this->add_control( 'bottom_footer_link_typography', 'typography' );
            /* Footer Logo */
            $this->add_section( 'footer_logo' );
            $this->add_control( 'bottom_footer_logo_option', 'media' );
            $this->add_control( 'bottom_footer_header_or_custom', 'select' );
            $this->add_control( 'bottom_footer_logo_width', 'number' );
            // Background Section
            $this->section = 'background_image';
            $this->add_control( 'site_background_animation_settings_heading', 'section_heading' );
            $this->add_control( 'site_background_animation', 'select' );
            // Header builder row one sections
            $this->add_section( 'header_first_row' );
            $this->add_control( 'header_first_row_section_tab', 'section_tab' );
            $this->add_control( 'header_first_row_column', 'number' );
            $this->add_control( 'header_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_first_row_reflector', 'builder_reflector' );
            
            $this->add_control( 'header_first_row_padding', 'spacing' );
            $this->add_control( 'header_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_first_row_column_four', 'responsive_radio_tab' );
            // Header second row section
            $this->add_section( 'header_second_row' );
            $this->add_control( 'header_second_row_section_tab', 'section_tab' );
            $this->add_control( 'header_second_row_column', 'number' );
            $this->add_control( 'header_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_second_row_reflector', 'builder_reflector' );
            $this->add_control( 'header_second_row_padding', 'spacing' );
            $this->add_control( 'header_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_second_row_column_four', 'responsive_radio_tab' );
            // Header third row section
            $this->add_section( 'header_third_row' );
            $this->add_control( 'header_third_row_section_tab', 'section_tab' );
            $this->add_control( 'header_third_row_column', 'number' );
            $this->add_control( 'header_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'header_third_row_reflector', 'builder_reflector' );
            $this->add_control( 'header_third_row_padding', 'spacing' );
            $this->add_control( 'header_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'header_third_row_column_four', 'responsive_radio_tab' );
            // Footer builder row one sections
            $this->add_section( 'footer_first_row' );
            $this->add_control( 'footer_first_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_first_row_column', 'number' );
            $this->add_control( 'footer_first_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_first_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_first_row_padding', 'spacing' );
            $this->add_control( 'footer_first_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_first_row_column_four', 'responsive_radio_tab' );
            // Footer second row section
            $this->add_section( 'footer_second_row' );
            $this->add_control( 'footer_second_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_second_row_column', 'number' );
            $this->add_control( 'footer_second_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_second_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_second_row_padding', 'spacing' );
            $this->add_control( 'footer_second_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_second_row_column_four', 'responsive_radio_tab' );
            // Footer third row section
            $this->add_section( 'footer_third_row' );
            $this->add_control( 'footer_third_row_section_tab', 'section_tab' );
            $this->add_control( 'footer_third_row_column', 'number' );
            $this->add_control( 'footer_third_row_column_layout', 'responsive_radio_image' );
            $this->add_control( 'footer_third_row_reflector', 'builder_reflector' );
            $this->add_control( 'footer_third_row_padding', 'spacing' );
            $this->add_control( 'footer_third_row_column_one', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_two', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_three', 'responsive_radio_tab' );
            $this->add_control( 'footer_third_row_column_four', 'responsive_radio_tab' );
            // Mobile Canvas
            $this->add_section( 'mobile_canvas_section' );
            $this->add_control( 'mobile_canvas_section_tab', 'section_tab' );
            $this->add_control( 'mobile_canvas_reflector', 'builder_reflector' );
            $this->add_control( 'mobile_canvas_alignment', 'radio_tab' );
            $this->add_control( 'mobile_canvas_icon_color', 'color' );
            // Footer Menu Options
            $this->add_section( 'footer_menu_options_section' );
            $this->add_control( 'footer_menu_section_tab', 'section_tab' );
            $this->add_control( 'footer_menu_hover_effect', 'select' );
            $this->add_control( 'footer_menu_typography', 'typography' );
            $this->add_control( 'footer_menu_color', 'color' );
            // Footer Social Icons
            $this->add_section( 'footer_social_icons_section' );
            $this->add_control( 'footer_social_icons_section_heading', 'section_tab' );
            $this->add_control( 'footer_social_icons', 'custom_repeater' );
            $this->add_control( 'footer_social_icon_color', 'color' );
            /* Header Builder Section */
            $this->add_section( 'header_builder_section' );
            $this->add_control( 'header_builder', 'builder' );
            $this->add_control( 'responsive_header_builder', 'responsive_builder' );
            /* Footer Builder Section */
            $this->add_section( 'footer_builder_section' );
            $this->add_control( 'footer_builder', 'builder' );
        }

        /**
         * Add a panel in the customizer
         * 
         * @since 1.0.0
         */
        public function add_panel( $id ) {
            if( $id ) :
                $params = $this->get_panels( $id );
                $this->customize->add_panel( $id, $params );
            endif;
        }

        /**
         * Add a section in the customizer
         * 
         * @since 1.0.0
         */
        public function add_section( $id ) {
            if( $id ) :
                $this->section = $id;
                $params = $this->get_sections( $id );
                $this->customize->add_section( $id, $params );
            endif;
        }

        /**
         * Add Control
         * 
         * @since 1.0.0
         */
        public function add_control( $id, $type ) {
            if( ! in_array( $type, [ 'info_box', 'section_heading_toggle', 'section_heading', 'redirect_control', 'builder_reflector', 'section_tab' ] ) ) :
                $settings_array = [
                    'default'   =>  BZ\blogzee_get_customizer_default( $id ) 
                ];
            endif;
            $params = [ 'section'   =>  $this->section ];
            switch( $type ) :
                case 'typography' :
                        $params = array_merge( $params, $this->get_typography( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_typo_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Typography_Control( $this->customize, $id, $params ) );
                    break;
                case 'checkbox' :
                        $params = array_merge( $params, $this->get_checkbox( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_checkbox';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Checkbox_Control( $this->customize, $id, $params ) );
                    break;
                case 'toggle' :
                        $params = array_merge( $params, $this->get_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_toggle_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'simple_toggle' :
                        $params = array_merge( $params, $this->get_simple_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_toggle_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Simple_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_tab': 
                        $params = array_merge( $params, $this->get_section_tab( $id ) );
                        $params[ 'section' ] = $this->section;
                        $settings_array[ 'default' ] = 'general';
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Section_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'spacing': 
                        $params = array_merge( $params, $this->get_spacing( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_spacing_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Spacing_Control( $this->customize, $id, $params ) );
                    break;
                case 'radio_tab': 
                        $params = array_merge( $params, $this->get_radio_tab( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Radio_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'info_box':
                        $params = array_merge( $params, $this->get_info_box( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Info_Box_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_heading_toggle': 
                        $params = array_merge( $params, $this->get_section_heading_toggle( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Section_Heading_Toggle_Control( $this->customize, $id, $params ) );
                    break;
                case 'number': 
                        $params = array_merge( $params, $this->get_number( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = ( array_key_exists( 'responsive', $params ) && $params[ 'responsive' ] ) ? 'blogzee_sanitize_responsive_range' : 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Number_Range_Control( $this->customize, $id, $params ) );
                    break;
                case 'section_heading': 
                        $params = array_merge( $params, $this->get_section_heading( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Section_Heading_Control( $this->customize, $id, $params ) );
                    break;
                case 'redirect_control': 
                        $params = array_merge( $params, $this->get_redirect_control( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Redirect_Control( $this->customize, $id, $params ) );
                    break;
                case 'radio_image': 
                        $params = array_merge( $params, $this->get_radio_image( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_select_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Radio_Image_Control( $this->customize, $id, $params ) );
                    break;
                case 'icon_picker': 
                        $params = array_merge( $params, $this->get_icon_picker( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_icon_picker_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Icon_Picker_Control( $this->customize, $id, $params ) );
                    break;
                case 'text': 
                        $params = array_merge( $params, $this->get_text( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Text_Control( $this->customize, $id, $params ) );
                    break;
                case 'select':
                        $params = array_merge( $params, $this->get_select( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_select_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Select_Control( $this->customize, $id, $params ) );
                    break;
                case 'preset': 
                        $params = array_merge( $params, $this->get_preset_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_preset_colors';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Preset_Control( $this->customize, $id, $params ) );
                    break;
                case 'color': 
                        $params = array_merge( $params, $this->get_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_color_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'media': 
                        $params = array_merge( $params, $this->get_media_control( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new WP_Customize_Media_Control( $this->customize, $id, $params ) );
                    break;
                case 'predefined_color': 
                        $params = array_merge( $params, $this->get_predefined_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_hex_color';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Default_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'custom_repeater':
                        $params = array_merge( $params, $this->get_custom_repeaters( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_repeater_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Custom_Repeater( $this->customize, $id, $params ) );
                    break;
                case 'predefined_number': 
                        $params = array_merge( $params, $this->get_custom_number_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'absint';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Number_Control( $this->customize, $id, $params ) );
                    break;
                case 'url': 
                        $params = array_merge( $params, $this->get_url( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_url';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Url_Control( $this->customize, $id, $params ) );
                    break;
                case 'multiselect': 
                        $params = array_merge( $params, $this->get_multiselect_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_async_multiselect_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Post_Multiselect_Control( $this->customize, $id, $params ) );
                    break;
                case 'typography_preset':
                        $params = array_merge( $params, $this->get_typography_preset_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_typography_preset_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Typography_Preset_Control( $this->customize, $id, $params ) );
                    break;
                case 'textarea': 
                        $params = array_merge( $params, $this->get_textareas( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_textarea_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( $id, $params );
                    break;
                case 'preset_color': 
                        $params = array_merge( $params, $this->get_theme_colors( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'sanitize_text_field';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Theme_Color_Control( $this->customize, $id, $params ) );
                    break;
                case 'builder_reflector': 
                        $params = array_merge( $params, $this->get_builder_reflector_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Builder_Reflector_Control( $this->customize, $id, $params ) );
                    break;
                case 'responsive_radio_image': 
                        $params = array_merge( $params, $this->get_responsive_radio_image( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_responsive_radio_image';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Responsive_Radio_Image( $this->customize, $id, $params ) );
                    break;
                case 'responsive_radio_tab':
                        $params = array_merge( $params, $this->get_responsive_radio_tab( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_responsive_radio_tab';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Responsive_Radio_Tab_Control( $this->customize, $id, $params ) );
                    break;
                case 'builder': 
                        $params = array_merge( $params, $this->get_builder_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_builder_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Builder_Control( $this->customize, $id, $params ) );
                    break;
                case 'responsive_builder': 
                        $params = array_merge( $params, $this->get_responsive_builder_controls( $id ) );
                        $settings_array[ 'transport' ] = array_key_exists( 'transport', $params ) ? $params[ 'transport' ] : 'refresh';
                        unset( $params[ 'transport' ] );
                        $settings_array[ 'sanitize_callback' ] = 'blogzee_sanitize_builder_control';
                        $this->customize->add_setting( $id, $settings_array );
                        $this->customize->add_control( new Blogzee_WP_Responsive_Builder_Control( $this->customize, $id, $params ) );
                    break;
            endswitch;
        }   // End of get_class_or_sanitize_function() Method
    }
    add_action( 'customize_register', function( $wp_customize ){
        new Blogzee_Customizer( $wp_customize );
    }, 10 );
endif;