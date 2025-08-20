<?php
use Blogzee\CustomizerDefault as BZ;
/**
 * Includes panel, section and controls ids and parameters
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */

 if( ! class_exists( 'Blogzee_Customizer_List' ) ) :
    class Blogzee_Customizer_List {
        /**
         * Returns panels array
         * 
         * @since 1.0.0
         */
        public function get_panels( $id = '' ) {
            $panels_array = [
                'global_panel'    =>  [
                    'title' =>  __( 'Global', 'blogzee' ),
                    'priority'  => 6
                ],
                'colors_panel'    =>  [
                    'title' =>  __( 'Colors', 'blogzee' ),
                    'priority'  => 20
                ],
                'archive_panel'    =>  [
                    'title' =>  __( 'Blog / Archives', 'blogzee' ),
                    'priority'  =>  80
                ],
                'single_section_panel'    =>  [
                    'title' =>  __( 'Single Post', 'blogzee' ),
                    'priority'  =>  80
                ]
            ];
            return ( $id ? $panels_array[ $id ] : $panels_array );
        }

        /**
         * Returns sections array
         * 
         * @since 1.0.0
         */
        public function get_sections( $id = '' ) {
            $sections_array =  [
                'about_section' => [
                    'title' => esc_html__( 'About Theme', 'blogzee' ),
                    'priority'  => 1
                ],
                'header_builder_section' => [
                    'title' => esc_html__( 'Header Builder', 'blogzee' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'footer_builder_section' => [
                    'title' => esc_html__( 'Footer Builder', 'blogzee' ),
                    'active_callback'   =>  function(){ return false; }
                ],
                'header_builder_section_settings' => [
                    'title' => esc_html__( 'Header Builder', 'blogzee' ),
                    'priority'  => 70
                ],
                'footer_builder_section_settings' => [
                    'title' => esc_html__( 'Footer Builder', 'blogzee' ),
                    'priority'  => 80
                ],
                'seo_misc_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'SEO / Misc', 'blogzee' ),
                ],
                'preloader_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Preloader', 'blogzee' ),
                ],
                'website_layout_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Website Layout', 'blogzee' ),
                ],
                'animation_section' => [
                    'title' => esc_html__( 'Animation / Hover Effects', 'blogzee' ),
                    'panel' => 'global_panel'
                ],
                'social_icons_section' => [
                    'title' => esc_html__( 'Social Icons', 'blogzee' ),
                ],
                'footer_social_icons_section' => [
                    'title' => esc_html__( 'Social Icons', 'blogzee' ),
                ],
                'buttons_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Buttons', 'blogzee' ),
                ],
                'post_format_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Post Format', 'blogzee' ),
                ],
                'breadcrumb_options_section' => [
                    'panel' => 'global_panel',
                    'title' => esc_html__( 'Breadcrumb Options', 'blogzee' ),
                ],
                'stt_options_section' => [
                    'title' => esc_html__( 'Scroll To Top', 'blogzee' ),
                ],
                'advertisement_section' => [
                    'title' =>  esc_html__( 'Advertisement', 'blogzee' ),
                    'priority'  =>  29
                ],
                'typography_section' => [
                    'title' => esc_html__( 'Typography', 'blogzee' ),
                    'priority'  => 30
                ],
                'widget_styles_section' => [
                    'title' => esc_html__( 'Sidebar / Widget Styles', 'blogzee' ),
                    'priority'  => 30
                ],
                'mobile_options_section' => [
                    'title' => esc_html__( 'Mobile Options', 'blogzee' ),
                    'priority'  => 30
                ],
                'theme_presets_section' => [
                    'panel' =>  'colors_panel',
                    'title' =>  esc_html__( 'Theme Colors / Presets', 'blogzee' ),
                ],
                'category_colors_section' => [
                    'panel' => 'colors_panel',
                    'title' => esc_html__( 'Category Colors', 'blogzee' ),
                ],
                'tag_colors_section' => [
                    'title' => esc_html__( 'Tag Colors', 'blogzee' ),
                    'panel' => 'colors_panel',
                ],
                'date_time_section' => [
                    'title' =>  esc_html__( 'Date / Time', 'blogzee' )
                ],
                'header_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'blogzee' )
                ],
                'footer_menu_options_section' => [
                    'title' =>  esc_html__( 'Menu Options', 'blogzee' )
                ],
                'header_live_search_section' => [
                    'title' =>  esc_html__( 'Search', 'blogzee' )
                ],
                'custom_button_section' => [
                    'title' =>  esc_html__( 'Custom Button', 'blogzee' )
                ],
                'theme_mode_section' => [
                    'title' =>  esc_html__( 'Theme Mode', 'blogzee' )
                ],
                'canvas_menu_section' => [
                    'title' =>  esc_html__( 'Off canvas', 'blogzee' )
                ],
                'ticker_news_section' => [
                    'title' =>  esc_html__( 'Ticker News', 'blogzee' ),
                    'priority'  =>  70
                ],
                'main_banner_section' => [
                    'title' =>  esc_html__( 'Main Banner', 'blogzee' ),
                    'priority'  =>  70
                ],
                'carousel_section' => [
                    'title' =>  esc_html__( 'Carousel', 'blogzee' ),
                    'priority'  =>  70
                ],
                'category_collection_section' => [
                    'title' =>  esc_html__( 'Category collection', 'blogzee' ),
                    'priority'  =>  70
                ],
                'archive_general_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'General Settings', 'blogzee' ),
                ],
                'category_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Category Page', 'blogzee' ),
                ],
                'tag_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Tag Page', 'blogzee' ),
                ],
                'author_archive_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Author Page', 'blogzee' ),
                ],
                'pagination_settings_section' => [
                    'panel'  =>  'archive_panel',
                    'title' =>  esc_html__( 'Pagination Settings', 'blogzee' ),
                ],
                'blog_single_general_settings' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'General Settings', 'blogzee' ),
                ],
                'blog_single_elements_settings_section' => [
                    'title' =>  esc_html__( 'Elements Settings', 'blogzee' ),
                    'panel' =>  'single_section_panel'
                ],
                'blog_single_related_posts_section' => [
                    'panel' =>  'single_section_panel',
                    'title' =>  esc_html__( 'Related Posts', 'blogzee' )
                ],
                'page_settings_section' => [
                    'title' =>  esc_html__( 'Page Settings', 'blogzee' ),
                    'priority'  =>  80
                ],
                'you_may_have_missed_section' => [
                    'title' => esc_html__( 'You May Have Missed', 'blogzee' )
                ],
                'testing_inner_section' => [
                    'title' => esc_html__( 'Inner Section', 'blogzee' ),
                    'priority'  =>  29
                ],
                /* Header builder row settings section */
                'header_first_row' => [
                    'title' => esc_html__( 'Header First Row', 'blogzee' )
                ],
                'header_second_row' => [
                    'title' => esc_html__( 'Header Second Row', 'blogzee' )
                ],
                'header_third_row' => [
                    'title' => esc_html__( 'Header Third Row', 'blogzee' )
                ],
                /* Footer builder row settings section */
                'footer_first_row' => [
                    'title' => esc_html__( 'Footer First Row', 'blogzee' )
                ],
                'footer_second_row' => [
                    'title' => esc_html__( 'Footer Second Row', 'blogzee' )
                ],
                'footer_third_row' => [
                    'title' => esc_html__( 'Footer Third Row', 'blogzee' )
                ],
                'footer_logo' => [
                    'title' => esc_html__( 'Footer Logo Settings', 'blogzee' )
                ],
                'footer_copyright' => [
                    'title' => esc_html__( 'Footer Copyright', 'blogzee' )
                ],
                'mobile_canvas_section' => [
                    'title' => esc_html__( 'Mobile Canvas', 'blogzee' )
                ]
            ];
            return ( $id ? $sections_array[ $id ] : $sections_array );
        }

        /**
         * Returns typography array
         * 
         * @since 1.0.0
         */
        public function get_typography( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ],
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'site_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Typography', 'blogzee' ),
                ]),
                'site_description_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Typography', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'date_time_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogzee' ),
                ]),
                'main_menu_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Main Menu Typography', 'blogzee' ),
                ]),
                'main_menu_sub_menu_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Sub Menu Typography', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'custom_button_text_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typography', 'blogzee' )
                ]),
                'main_banner_design_post_title_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogzee' ),
                ]),
                'main_banner_design_post_excerpt_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogzee' ),
                ]),
                'main_banner_design_post_categories_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'main_banner_design_post_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
                'main_banner_design_post_author_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'main_banner_sidebar_block_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title Typo', 'blogzee' ),
                ]),
                'main_banner_sidebar_post_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogzee' ),
                ]),
                'main_banner_sidebar_categories_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'main_banner_sidebar_date_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'carousel_design_post_title_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogzee' ),
                ]),
                'carousel_design_post_excerpt_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogzee' ),
                ]),
                'carousel_design_post_categories_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'carousel_design_post_date_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
                'carousel_design_post_author_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogzee' ),
                ]),
                'category_collection_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogzee' ),
                ]),
                'global_button_typo'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'breadcrumb_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogzee' ),
                ]),
                'archive_title_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'blogzee' ),
                ]),
                'archive_excerpt_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Excerpt Typo', 'blogzee' ),
                ]),
                'archive_category_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'archive_date_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
                'archive_author_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogzee' ),
                ]),
                'archive_read_time_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Typo', 'blogzee' ),
                ]),
                'archive_comment_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Comment Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'archive_category_info_box_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Title', 'blogzee' ),
                ]),
                'archive_category_info_box_description_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Description Typo', 'blogzee' ),
                ]),
                'archive_tag_info_box_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Title', 'blogzee' ),
                ]),
                'archive_tag_info_box_description_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Tag Description Typo', 'blogzee' ),
                ]),
                'archive_author_info_box_title_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Name', 'blogzee' ),
                ]),
                'archive_author_info_box_description_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Description Typo', 'blogzee' ),
                ]),
                'single_title_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogzee' ),
                ]),
                'single_content_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Content Typo', 'blogzee' ),
                ]),
                'single_category_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'single_date_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
                'single_author_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogzee' ),
                ]),
                'single_read_time_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Read Time Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'page_title_typo'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Page Title Typo', 'blogzee' ),
                ]),
                'page_content_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Page Content Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_design_section_title_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section Title Typo', 'blogzee' ),
                ]),
                'you_may_have_missed_design_post_title_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Title Typo', 'blogzee' ),
                ]),
                'you_may_have_missed_design_post_categories_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category Typo', 'blogzee' ),
                ]),
                'you_may_have_missed_design_post_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
                'you_may_have_missed_design_post_author_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Author Typo', 'blogzee' ),
                ]),
                'footer_title_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title Typo', 'blogzee' ),
                ]),
                'footer_text_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'bottom_footer_text_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Text Typo', 'blogzee' ),
                ]),
                'bottom_footer_link_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Link Typo', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'heading_one_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 1', 'blogzee' ),
                ]),
                'heading_two_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 2', 'blogzee' ),
                ]),
                'heading_three_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 3', 'blogzee' ),
                ]),
                'heading_four_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 4', 'blogzee' ),
                ]),
                'heading_five_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 5', 'blogzee' ),
                ]),
                'heading_six_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 6', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'sidebar_block_title_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Block Title', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_post_title_typography' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_category_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Category', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_date_typography'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_pagination_button_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pagination typo', 'blogzee' ),
                    'tab'   =>  'general',
                    'bottom_separator'  =>  true
                ]),
                'sidebar_heading_one_typography'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 1', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_heading_two_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 2', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_heading_three_typo'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 3', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_heading_four_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 4', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_heading_five_typo' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 5', 'blogzee' ),
                    'tab'   =>  'general'
                ]),
                'sidebar_heading_six_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Heading 6', 'blogzee' ),
                    'tab'   =>  'general',
                    'bottom_separator'  =>  true
                ]),
                'footer_menu_typography'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Typography', 'blogzee' ),
                ]),
                'ticker_news_post_title_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Post Title Typo', 'blogzee' ),
                ]),
                'ticker_news_post_date_typo'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Date Typo', 'blogzee' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns checkbox array
         * 
         * @since 1.0.0
         */
        public function get_checkbox( $id = '' ) {
            $default = [
                'type'  =>  'checkbox',
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'blogdescription_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Display site description', 'blogzee' ),
                    'priority'  =>  40
                ]),
                'show_main_banner_excerpt_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show main banner excerpt on mobile', 'blogzee' ) 
                ]),
                'show_carousel_banner_excerpt_mobile_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show carousel banner excerpt on mobile', 'blogzee' )
                ]),
                'show_readtime_mobile_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show readtime on mobile', 'blogzee' ) 
                ]),
                'show_comment_number_mobile_option' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show comment number on mobile', 'blogzee' )
                ]),
                'show_background_animation_on_mobile'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show background animation on mobile', 'blogzee' ) 
                ]),
                'show_scroll_to_top_on_mobile'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show scroll to top on mobile', 'blogzee' ),
                    'bottom_separator'  =>  true
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns toggle array
         * 
         * @since 1.0.0
         */
        public function get_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'ticker_news_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show Ticker News', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'main_banner_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show main banner', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'carousel_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show carousel', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'category_collection_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable category collection', 'blogzee' ),
                ]),
                'site_schema_ready' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Make website schema ready', 'blogzee' ),
                    'transport' =>  'postMessage'
                ]),
                'disable_admin_notices'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Disabled the theme admin notices', 'blogzee' ),
                    'description'	      => esc_html__( 'This will hide all the notices or any message shown by the theme like review notices, change log notices', 'blogzee' ),
                    'transport' =>  'postMessage'
                ]),
                'preloader_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable site preloader', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'archive_category_info_box_option'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show category info box', 'blogzee' ),
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ]),
                'archive_tag_info_box_option'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show tag info box', 'blogzee' ),
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ]),
                'archive_author_info_box_option'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author info box', 'blogzee' ),
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ]),
                'single_post_related_posts_option'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Show related articles', 'blogzee' ),
                ]),       
                'you_may_have_missed_section_option'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Enable you may have missed section', 'blogzee' ),
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns simple toggle array
         * 
         * @since 1.0.0
         */
        public function get_simple_toggle( $id = '' ) {
            $default = [];
            $control_array = [
                'header_buiilder_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Section Sticky', 'blogzee' )
                ]),
                'header_first_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 1st row', 'blogzee' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_second_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 2nd row', 'blogzee' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage'
                ]),
                'header_third_row_header_sticky' => $this->get_params( $default, [
                    'label' => esc_html__( 'Enable Header Sticky in 3rd row', 'blogzee' ),
                    'active_callback'   =>  function( $control ){
                        return $control->manager->get_control( 'header_buiilder_header_sticky' )->value();
                    },
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'ticker_news_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'main_banner_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'main_banner_trailing_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'carousel_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'category_collection_show_count' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show category count', 'blogzee' ),
                ]),
                'site_breadcrumb_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show breadcrumb trails', 'blogzee' ),
                ]),
                'single_author_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author', 'blogzee' ),
                ]),
                'single_author_image_option' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Show author image', 'blogzee' ),
                ]),
                'you_may_have_missed_title_option' => $this->get_params( $default, [
                    'label' => esc_html__( 'Show section title', 'blogzee' ),
                    'transport' =>  'postMessage'
                ]),
                'you_may_have_missed_hide_post_with_no_featured_image' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hide posts with no featured image', 'blogzee' ),
                    'bottom_separator'  =>  true
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_simple_toggle() Method

        /**
         * Get all section tab control
         * 
         * @since 1.0.0
         */
        public function get_section_tab( $id = '' ) {
            $default = [
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogzee' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogzee' )
                    ]
                ],
                'priority'  =>  1
            ];
            $control_array = [
                'header_builder_section_tab'    =>  $this->get_params( $default, []),
                'site_title_section_tab'    =>  $this->get_params( $default, []),
                'menu_options_section_tab' =>  $this->get_params( $default, []),
                'search_section_tab'    =>  $this->get_params( $default, []),
                'custom_button_section_tab'  =>  $this->get_params( $default, []),
                'theme_mode_section_tab' =>  $this->get_params( $default, []),
                'canvas_menu_setting'   =>  $this->get_params( $default, []),
                'category_collection_section_heading'   =>  $this->get_params( $default, []),
                'breadcrumb_section_tab'    =>  $this->get_params( $default, []),
                'archive_section_heading'   =>  $this->get_params( $default, []),
                'category_archive_section_heading'  =>  $this->get_params( $default, []),
                'tag_archive_section_heading'   =>  $this->get_params( $default, []),
                'author_archive_section_heading'    =>  $this->get_params( $default, []),
                'single_section_heading'    => $this->get_params( $default, []),
                'page_settings_section_tab' =>  $this->get_params( $default, []),
                'you_may_have_missed_section_tab'   =>  $this->get_params( $default, []),
                'footer_section_tab'    =>  $this->get_params( $default, []),
                'bottom_footer_section_tab' =>  $this->get_params( $default, []),
                'social_icons_section_heading' => $this->get_params( $default, []),
                'footer_social_icons_section_heading' => $this->get_params( $default, []),
                'ticker_news_section_heading'  =>  $this->get_params( $default, []),
                'main_banner_section_heading'  =>  $this->get_params( $default, []),
                'carousel_section_heading' =>  $this->get_params( $default, []),
                /* Header builder row controls */
                'header_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                'header_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                'header_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                /* Footer builder row controls */
                'footer_first_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                'footer_second_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                'footer_third_row_section_tab'   =>  $this->get_params( $default, [
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogzee' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogzee' )
                        ],
                        [
                            'name'  =>  'column',
                            'title' =>  esc_html__( 'Column', 'blogzee' )
                        ]
                    ],
                ]),
                'mobile_canvas_section_tab'   =>  $this->get_params( $default, [] ),
                'footer_menu_section_tab'   =>  $this->get_params( $default, [] )
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_tab() Method

        /**
         * Get all spacing controls
         * 
         * @since 1.0.0
         */
        public function get_spacing( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Padding ( px )', 'blogzee' ),
                'tab'   =>  'design',
                'input_attrs' => $this->get_input_attrs([
                    'max'   => 50
                ]),
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'carousel_image_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius ( Px )', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'general',
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_image_border_radius'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'tab'   =>  'general',
                    'bottom_separator'  =>  true
                ]),
                /* Header row paddings */
                'header_first_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'header_second_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'header_third_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                /* Footer row paddings */
                'footer_first_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'footer_second_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
                'footer_third_row_padding'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Padding', 'blogzee' ),
                    'tab'   =>  'design',
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 200
                    ])
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_spacing() Method

        /**
         * Get all radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_radio_tab( $id = '' ) {
            $default = [
                'label' => esc_html__( 'Elements Alignment', 'blogzee' ),
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'blogzee' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'blogzee' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'blogzee' )
                    ]
                ],
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'main_banner_post_elements_alignment'  =>  $this->get_params( $default, [
                    'bottom_separator'  =>  true
                ]),
                'carousel_post_elements_alignment' =>  $this->get_params( $default, [
                    'bottom_separator'  =>  true
                ]),
                'site_date_to_show'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Date to display', 'blogzee' ),
                    'description' => esc_html__( 'Whether to show date published or modified date.', 'blogzee' ),
                    'choices' => [
                        [
                            'value' => 'published',
                            'label' => esc_html__('Published date', 'blogzee' )
                        ],
                        [
                            'value' => 'modified',
                            'label' => esc_html__('Modified date', 'blogzee' )
                        ]
                    ],
                    'double_line'   =>  true,
                    'transport' =>  'refresh'
                ]),
                'archive_post_elements_alignment'  =>  $this->get_params( $default, [
                    'bottom_separator'  =>  true
                ]),
                'single_post_content_alignment'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post content alignment', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_post_elements_alignment'  =>  $this->get_params( $default, [
                    'bottom_separator'  =>  true
                ]),
                'canvas_menu_position'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Canvas Position', 'blogzee' ),
                    'choices'   =>  [
                        [
                            'value' => 'left',
                            'icon'  =>  'editor-alignleft'
                        ],
                        [
                            'value' => 'right',
                            'icon'  =>  'editor-alignright'
                        ]
                    ],
                ]),
                'mobile_canvas_alignment'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Alignment', 'blogzee' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_tab() Method

        /**
         * Get all info box control
         * 
         * @since 1.0.0
         */
        public function get_info_box( $id = '' ) {
            $control_array = [
                'site_documentation_info' =>  [
                    'label' => esc_html__( 'Theme Documentation', 'blogzee' ),
                    'description' => esc_html__( 'We have well prepared documentation which includes overall instructions and recommendations that are required in this theme.', 'blogzee' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'View Documentation', 'blogzee' ),
                            'url'   => esc_url( '//doc.blazethemes.com/blogzee' )
                        ]
                    ]
                ],
                'site_support_info'   =>  [
                    'label' => esc_html__( 'Theme Support', 'blogzee' ),
                    'description' => esc_html__( 'We provide 24/7 support regarding any theme issue. Our support team will help you to solve any kind of issue. Feel free to contact us.', 'blogzee' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'Support Form', 'blogzee' ),
                            'url'   => esc_url( '//blazethemes.com/support' )
                        ]
                    ]
                ],
                'view_premium_info' =>  [
                    'label' => esc_html__( 'View Premium Info', 'blogzee' ),
                    'description' => esc_html__( 'Checkout the features of premium version.', 'blogzee' ),
                    'choices' => [
                        [
                            'label' => esc_html__( 'View Premium', 'blogzee' ),
                            'url' => '//blazethemes.com/theme/blogzee-pro/'
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_info_box() Method

        /**
         * Get all section heading toggle controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading_toggle( $id = '' ) {
            $default = [
                'bottom_separator'  =>  true
            ];
            $control_array = [
                'ticker_news_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogzee' )
                ]),
                'ticker_news_typography_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'tab'   =>  'design'
                ]),
                'main_banner_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogzee' ),
                ]),
                'main_banner_trailing_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Trailing Post Query', 'blogzee' ),
                ]),
                'main_banner_post_elements_settings_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogzee' ),
                ]),
                'main_banner_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogzee' ),
                    'initial'   =>  false,
                ]),
                'main_banner_design_typography'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'tab'   =>  'design'
                ]),
                'main_banner_design_sidebar_typography'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Sidebar Typography', 'blogzee' ),
                    'tab'   =>  'design'
                ]),
                'carousel_post_query_settings_heading'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogzee' ),
                ]),
                'carousel_post_elements_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogzee' ),
                ]),
                'carousel_image_setting_heading'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogzee' ),
                ]),
                'category_collection_query_section_heading_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Query Settings', 'blogzee' ),
                ]),
                'category_collection_image_heading_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogzee' ),
                ]),
                'archive_layouts_settings_header' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Layouts Settings', 'blogzee' ),
                ]),
                'archive_elements_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Elements Settings', 'blogzee' ),
                ]),
                'archive_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogzee' ),
                ]),
                'archive_typography_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'tab'   => 'design'
                ]),
                'single_image_settings_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Image Settings', 'blogzee' ),
                ]),
                'single_typography_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'tab'   => 'design',
                ]),
                'page_image_setting_heading'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogzee' ),
                    'initial'   =>  false,
                ]),
                'page_table_of_content_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Table of content', 'blogzee' ),
                ]),
                'page_typography_section_heading_toggle'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography', 'blogzee' ),
                    'tab'   =>  'design'
                ]),
                'you_may_have_missed_post_query_settings_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Query', 'blogzee' ),
                ]),
                'you_may_have_missed_post_elements_settings_heading'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Post Elements Settings', 'blogzee' ),
                ]),
                'you_may_have_missed_image_setting_heading'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Settings', 'blogzee' ),
                ]),
                'widget_styles_general_settings_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'General Settings', 'blogzee' )
                ]),
                'widget_styles_sidebar_settings_header'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Sidebar Typography', 'blogzee' )
                ]),
                'widget_styles_headings_settings_header'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Heading Typography', 'blogzee' )
                ]),
                'logo_and_icon_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Logo & Site Icon', 'blogzee' ),
                    'priority'  =>  5
                ]),
                'site_title_section_toggle'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Site Title & Tagline', 'blogzee' ),
                    'priority'  =>  20
                ]),
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                foreach( $totalCats as $singleCat ) :
                    $cat_id = 'category_' . absint( $singleCat->term_id ) . '_color_heading';
                    $control_array[ $cat_id ] = [
                        'label' => esc_html( $singleCat->name ),
                        'bottom_separator'  =>  true
                    ];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                foreach( $totalTags as $singleTag ) :
                    $tag_id = 'tag_' . absint( $singleTag->term_id ) . '_color_heading';
                    $control_array += [ $tag_id =>  [
                        'label' => esc_html( $singleTag->name ),
                        'bottom_separator'  =>  true
                    ]];
                    $tag_priority += 10;
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading_toggle() Method


        /**
         * Get all number controls
         * 
         * @since 1.0.0
         */
        public function get_number( $id = '' ) {
            $default = [
                'unit'  =>  'px',
                'input_attrs'   =>  $this->get_input_attrs(),
                'responsive'    =>  true,
                'transport' =>  'postMessage'
            ];
            $control_array = [
                'site_logo_width'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400,
                        'min'   =>  100
                    ]),
                    'bottom_separator'  =>  true
                ]),
                'search_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size (px)', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'header_custom_button_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([]),
                    'tab'   =>  'design'
                ]),
                'theme_mode_icon_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Icon Size', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([])
                ]),
                'main_banner_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'tab'   =>  'design',
                    'bottom_separator'  =>  true,
                ]),
                'category_collection_number_of_columns' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'No. of columns', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  4,
                        'min'   =>  1
                    ]),
                    'bottom_separator'  =>  true
                ]),
                'archive_section_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'tab'   =>  'design',
                    'responsive'    =>  false,
                    'bottom_separator'  =>  true
                ]),
                'single_page_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs(),
                    'tab'   =>  'design',
                    'responsive'    =>  false,
                    'bottom_separator'  =>  true
                ]),
                'page_border_radius'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs(),
                    'responsive'    =>  false,
                    'tab'   =>  'design',
                    'bottom_separator'  =>  true
                ]),
                'bottom_footer_logo_width'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo Width (px)', 'blogzee' ),
                    'input_attrs'   =>  $this->get_input_attrs([
                        'max'   =>  400
                    ])
                ]),
                'category_collection_image_radius'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Border radius', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([]),
                    'responsive'    =>  true
                ]),
                /* Header Builder row controls */
                'header_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'header_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 3,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                /* Footer Builder row controls */
                'footer_first_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_second_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'footer_third_row_column'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Column count', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'         => 4,
                        'min'         => 1
                    ]),
                    'responsive'    =>  false
                ]),
                'ticker_news_border_radius'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Border Radius (px)', 'blogzee' ),
                    'tab'   =>  'design',
                    'bottom_separator'  =>  true
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_number() Method

        /**
         * Get all section heading controls
         * 
         * @since 1.0.0
         */
        public function get_section_heading( $id = '' ) {
            $default = [
                'bottom_separator'  =>  true
            ];
            $control_array = [
                'header_sub_menu_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Sub Menu', 'blogzee' ),
                    'tab'   => 'design'
                ]),
                'header_main_menu_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Main Menu', 'blogzee' ),
                    'tab'   => 'design'
                ]),
                'typography_preset_header'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Typography Preset', 'blogzee' )
                ]),
                'heading_typographies'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Headings', 'blogzee' )
                ]),
                'disable_admin_notices_heading' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Admin Settings', 'blogzee' )
                ]),
                'website_layout_header' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Website Layout', 'blogzee' )
                ]),
                'site_hover_animation'  =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Hover Animation', 'blogzee' )
                ]),
                'site_background_animation_settings_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Animation Settings', 'blogzee' ),
                ]),
                'theme_colors_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Theme Colors', 'blogzee' )
                ]),
                'theme_presets_section_heading'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Presets', 'blogzee' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_section_heading() Method

        /**
         * Get all redirect controls
         * 
         * @since 1.0.0
         */
        public function get_redirect_control( $id = '' ) {

            $control_array = [
                'canvas_menu_redirects' =>  [
                    'label' => esc_html__( 'Widgets', 'blogzee' ),
                    'tab'   => 'general',
                    'choices'     => [
                        'canvas-menu-sidebar' => [
                            'type'  => 'section',
                            'id'    => 'sidebar-widgets-canvas-menu-sidebar',
                            'label' => esc_html__( 'Manage canvas menu widget', 'blogzee' )
                        ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'global_button_redirect'    =>  [
                    'tab'   => 'general',
                    'choices'     => [
                        'canvas-menu-sidebar' => [
                            'type'  => 'control',
                            'id'    => 'archive_section_heading',
                            'label' => esc_html__( 'Head to Archive', 'blogzee' )
                        ]
                    ]
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_redirect_control() Method

        /**
         * Get all radio image controls
         * 
         * @since 1.0.0
         */
        public function get_radio_image( $id = '' ) {
            $theme_directory = get_template_directory_uri();
            $control_array = [
                'website_layout'  =>  [
                    'choices'  => [
                        'boxed--layout' => [
                            'label' => esc_html__( 'Boxed', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout' => [
                            'label' => esc_html__( 'Full Width', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ],
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ],
                'archive_post_layout' =>  [
                   'label' =>  esc_html__( 'Archive Layout', 'blogzee' ),
                   'choices'  => [
                       'grid-two' => [
                           'label' => esc_html__( 'Grid 2', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-grid-two.png'
                       ],
                       'list-two' => [
                           'label' => esc_html__( 'List 2', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/archive-list-two.png'
                       ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'archive_sidebar_layout'  =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogzee' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'bottom_separator'  =>  true
               ],
                'single_sidebar_layout'   =>  [
                    'label' =>  esc_html__( 'Sidebar Layout', 'blogzee' ),
                    'choices'  => [
                        'right-sidebar' => [
                            'label' => esc_html__( 'Right Sidebar', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                        ],
                        'left-sidebar' => [
                            'label' => esc_html__( 'Left Sidebar', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                        ],
                        'no-sidebar' => [
                            'label' => esc_html__( 'No Sidebar', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                        ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'page_settings_sidebar_layout'    =>  [
                   'label' =>  esc_html__( 'Sidebar Layout', 'blogzee' ),
                   'choices'  => [
                       'right-sidebar' => [
                           'label' => esc_html__( 'Right Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/right-sidebar.png'
                       ],
                       'left-sidebar' => [
                           'label' => esc_html__( 'Left Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/left-sidebar.png'
                       ],
                       'no-sidebar' => [
                           'label' => esc_html__( 'No Sidebar', 'blogzee' ),
                           'url'   => $theme_directory . '/assets/images/customizer/no-sidebar.png'
                       ]
                    ],
                    'bottom_separator'  =>  true
                ],
                'header_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'blogzee' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ],
                    'transport' =>  'postMessage'
                ],
                'footer_builder_section_width'  =>  [
                    'label' => esc_html__( 'Section Width', 'blogzee' ),
                    'choices' => [
                        'boxed--layout' =>  [
                            'label' => esc_html__('Boxed', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/boxed-width.png'
                        ],
                        'full-width--layout'    =>  [
                            'label' => esc_html__('Full Width', 'blogzee' ),
                            'url'   => $theme_directory . '/assets/images/customizer/full-width.png'
                        ]
                    ],
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_radio_image() Method

        /**
         * Get all icon picker controls
         * 
         * @since 1.0.0
         */
        public function get_icon_picker( $id = '' ) {
            $default = [
                'include_media' =>  true
            ];

            $control_array = [
                'theme_mode_dark_icon'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Dark Icon', 'blogzee' ),
                    'include_media' =>  false,
                    'transport' =>  'postMessage'
                ]),
                'theme_mode_light_icon'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Choose Light Icon', 'blogzee' ),
                    'include_media' =>  false,
                    'transport' =>  'postMessage'
                ]),
                'standard_post_format_icon_picker'    =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Standard post format', 'blogzee' ),
                ]),
                'audio_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Audio post format', 'blogzee' ),
                ]),
                'gallery_post_format_icon_picker' =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Gallery post format', 'blogzee' ),
                ]),
                'image_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Image post format', 'blogzee' ),
                ]),
                'quote_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Quote post format', 'blogzee' ),
                ]),
                'video_post_format_icon_picker'   =>  $this->get_params( $default, [
                   'label' =>  esc_html__( 'Video post format', 'blogzee' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_icon_picker() Method

        /**
         * Get all text controls
         * 
         * @since 1.0.0
         */
        public function get_text( $id = '' ) {
            $default = [
                'label' =>  esc_html__( 'Button Label', 'blogzee' ),
                'type'  =>  'text',
                'tab'   => 'general',
                'transport' =>  'postMessage',
                'bottom_separator'  =>  true
            ];

            $control_array = [
                'custom_button_label' =>  $this->get_params( $default, [
                    'bottom_separator'  =>  false
                ]),
                'stt_text'  =>  $this->get_params( $default, []),
                'you_may_have_missed_title'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Section title', 'blogzee' )
                ]),
                'single_post_related_posts_title'   =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Related articles title', 'blogzee' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_text() Method

        /**
         * Get all select controls
         * 
         * @since 1.0.0
         */
        public function get_select( $id = '' ) {
            $default = [
                'type'  =>  'select',
            ];

            $control_array = [
                'site_title_tag_for_frontpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Frontpage)', 'blogzee' ),
                    'choices'   =>  apply_filters( 'blogzee_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'site_title_tag_for_innerpage'    =>  $this->get_params( $default, [
                    'label'   =>  esc_html__( 'Site Title Tag (For Innerpage)', 'blogzee' ),
                    'choices'   =>  apply_filters( 'blogzee_get_title_tags_array_filter', [] ),
                    'priority'  =>  30
                ]),
                'header_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover Effect', 'blogzee' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'blogzee' ),
                        'two'  =>  esc_html__( 'Effect 1', 'blogzee' ),
                    ],
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'footer_menu_hover_effect'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover Effect', 'blogzee' ),
                    'choices'   =>  [
                        'none'  =>  esc_html__( 'None', 'blogzee' ),
                        'one'  =>  esc_html__( 'Effect 1', 'blogzee' ),
                        'two'  =>  esc_html__( 'Effect 2', 'blogzee' ),
                        'three'  =>  esc_html__( 'Effect 3', 'blogzee' ),
                        'four'  =>  esc_html__( 'Effect 4', 'blogzee' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'ticker_news_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogzee' ),
                    'choices'   =>  blogzee_post_order_args()
                ]),
                'main_banner_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogzee' ),
                    'choices'   =>  blogzee_post_order_args()
                ]),
                'main_banner_trailing_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogzee' ),
                    'choices'   =>  blogzee_post_order_args()
                ]),
                'main_banner_image_sizes' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'carousel_post_order' =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogzee' ),
                    'choices'   =>  blogzee_post_order_args(),
                ]),
                'carousel_image_sizes'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'category_collection_orderby' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Order by', 'blogzee' ),
                    'choices'   =>  [
                        'asc-name'  =>  esc_html__( 'Ascending Name', 'blogzee' ),
                        'asc-count'  =>  esc_html__( 'Ascending Count', 'blogzee' ),
                        'desc-name'  =>  esc_html__( 'Descending Name', 'blogzee' ),
                        'desc-count'  =>  esc_html__( 'Descending Count', 'blogzee' )
                    ],
                ]),
                'category_collection_image_size'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'category_collection_hover_effects'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Hover effects', 'blogzee' ),
                    'choices'   =>  [
                        'none'   =>  esc_html__( 'None', 'blogzee' ),
                        'one'   =>  esc_html__( 'Effect 1', 'blogzee' )
                    ],
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'archive_image_size'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                    'bottom_separator'  =>  true
                ]),
                'archive_pagination_type' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Pagination Type', 'blogzee' ),
                    'choices'   =>  apply_filters( 'blogzee_get_pagination_type_array_filter', [
                        'default'   => esc_html__( 'Default', 'blogzee' ),
                        'number'    => esc_html__( 'Number', 'blogzee' )
                    ]),
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ]),
                'single_image_size'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'page_image_size' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'you_may_have_missed_post_order'  =>  $this->get_params( $default, [
                    'label' =>  esc_html( 'Post Order', 'blogzee' ),
                    'choices'   =>  blogzee_post_order_args(),
                ]),
                'you_may_have_missed_image_sizes' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Sizes', 'blogzee' ),
                    'choices'   =>  blogzee_get_image_sizes_option_array_for_customizer(),
                ]),
                'bottom_footer_header_or_custom'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Logo From', 'blogzee' ),
                    'choices'   =>  [
                        'header'  =>  esc_html__( 'Default Site Logo', 'blogzee' ),
                        'custom'  =>  esc_html__( 'Custom', 'blogzee' )
                    ],
                ]),
                'site_date_format'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Date format', 'blogzee' ),
                    'description' => esc_html__( 'Date format applied to single and archive pages.', 'blogzee' ),
                    'choices'   => [
                        'theme_format'  => esc_html__( 'Default by theme', 'blogzee' ),
                        'default'   => esc_html__( 'Wordpress default date', 'blogzee' )
                    ],
                    'bottom_separator'  =>  true
                ]),
                'post_title_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Post title hover effects', 'blogzee' ),
                    'description' => esc_html__( 'Applied to post titles listed in archive pages.', 'blogzee' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogzee' ),
                        'seven'  => esc_html__( 'Effect One', 'blogzee' ),
                        'eight'  => esc_html__( 'Effect Two', 'blogzee' )
                    ],
                    'transport' =>  'postMessage'
                ]),
                'site_image_hover_effects'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Image hover effects', 'blogzee' ),
                    'description' => esc_html__( 'Applied to post thumbanails listed in archive pages.', 'blogzee' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogzee' ),
                        'three'  => esc_html__( 'Effect One', 'blogzee' ),
                        'five'  => esc_html__( 'Effect Two', 'blogzee' ) 
                    ],
                    'transport' =>  'postMessage'
                ]),
                'cursor_animation'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Cursor animation', 'blogzee' ),
                    'description' => esc_html__( 'Applied to mouse pointer.', 'blogzee' ),
                    'choices'   => [
                        'none' => esc_html__( 'None', 'blogzee' ),
                        'two'  => esc_html__( 'Animation 1', 'blogzee' )
                    ],
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'site_breadcrumb_type'    =>  $this->get_params( $default, [
                    'label'     => esc_html__( 'Breadcrumb type', 'blogzee' ),
                    'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'blogzee' ),
                    'choices'   => [
                        'default' => esc_html__( 'Default', 'blogzee' ),
                        'bcn'  => esc_html__( 'NavXT', 'blogzee' ),
                        'yoast'  => esc_html__( 'Yoast SEO', 'blogzee' ),
                        'rankmath'  => esc_html__( 'Rank Math', 'blogzee' )
                    ]
                ]),
                'custom_button_animation_type'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Animation Type', 'blogzee' ),
                    'choices'   => [
                        'none'  => esc_html__( 'None', 'blogzee' ),
                        'one'   => esc_html__( 'Effect 1', 'blogzee' ),
                    ],
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'site_background_animation'    =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Background animation', 'blogzee' ),
                    'choices'	=>	[
                        'none'	=>	esc_html__( 'None', 'blogzee' ),
                        'two'	=>	esc_html__( 'Animation 1', 'blogzee' )
                    ],
                    'transport' =>  'postMessage'
                ]) 
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_select() Method

        /**
         * Get all preset controls
         * 
         * @since 1.0.0
         */
        public function get_preset_colors( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'solid_color_preset'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Solid Presets', 'blogzee' ),
                    'description'   =>  esc_html__( 'Set color presets', 'blogzee' ),
                    'bottom_separator'  =>  true
                ]),
                'gradient_color_preset'   =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Gradient Presets', 'blogzee' ),
                    'description'   =>  esc_html__( 'Set gradient presets', 'blogzee' ),
                    'blend' =>  'gradient'
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_preset_colors() Method

        /**
         * Get all color controls
         * 
         * @since 1.0.0
         */
        public function get_colors( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'involve'   =>  [ 'solid' ],
                'hover' =>  false,
                'transport' =>  'postMessage'
            ];
            
            $control_array = [
                // solid initial hover
                'social_icon_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Social Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'footer_social_icon_color'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Social Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'header_menu_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                    'bottom_separator' =>  true
                ]),
                'header_sub_menu_color' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Text Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true,
                ]),
                'search_icon_color'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_dark_icon_color'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Dark Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'theme_mode_light_icon_color' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Light Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                'canvas_menu_icon_color'   => $this->get_params( $default, [
                    'label'     => esc_html__( 'Canvas Menu Icon Color', 'blogzee' ),
                    'involve'   =>  [ 'solid' ],
                    'hover' =>  true
                ]),
                // initial hover solid gradient
                'header_custom_button_background_color_group'   => $this->get_params( $default, [
                    'label' => esc_html__( 'Background Color', 'blogzee' ),
                    'involve'   =>  [ 'solid', 'gradient' ], 
                    'hover' =>  true
                ]),
                // solid gradient image
                'header_builder_background' => $this->get_params( $default, [
                   'label' => esc_html__( 'Background', 'blogzee' ),
                   'involve' => [ 'solid', 'gradient', 'image' ],
                   'bottom_separator'   =>  true
                ]),
                /* Date / Time */
                'date_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Date Color', 'blogzee' ),
                   'involve' => [ 'solid' ]
                ]),
                'time_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Time Color', 'blogzee' ),
                   'involve' => [ 'solid' ],
                   'bottom_separator'   =>  true
                ]),
                'mobile_canvas_icon_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Icon Color', 'blogzee' ),
                   'involve' => [ 'solid' ],
                   'hover'  =>  true,
                   'tab'   =>  'design'
                ]),
                'footer_menu_color' => $this->get_params( $default, [
                   'label' => esc_html__( 'Color', 'blogzee' ),
                   'involve' => [ 'solid' ],
                   'tab'   =>  'design',
                   'hover'  =>  true
                ])
            ];
            $totalCats = get_categories();
            if( $totalCats ) :
                $totalCats_count = count( $totalCats );
                foreach( $totalCats as $key => $singleCat ) :
                    $cat_color_id = 'category_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ 'category_top_spacing_' . $key ] = [];
                    $control_array[ $cat_color_id ] = [
                        'label' => esc_html__( 'Text Color', 'blogzee' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                        'transport' =>  'postMessage'
                    ];

                    $background_id = 'category_background_' . absint( $singleCat->term_id ) . '_color';
                    $control_array[ $background_id ] = [
                        'label' => esc_html__( 'Background', 'blogzee' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                        'bottom_separator'  =>  true,
                        'transport' =>  'postMessage'
                    ];
                    if( $totalCats_count != ( $key + 1 ) ) $control_array[ 'category_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;

            $totalTags = get_tags();
            $tag_priority = 10;
            if( $totalTags ) :
                $totalTags_count = count( $totalTags );
                foreach( $totalTags as $key => $singleTag ) :
                    $tag_color_id = 'tag_' . absint( $singleTag->term_id ) . '_color';
                    $control_array[ 'tag_top_spacing_' . $key ] = [];
                    $control_array += [ $tag_color_id =>  [
                        'label' => esc_html__( 'Text Color', 'blogzee' ),
                        'involve'   =>  [ 'solid' ],
                        'hover' =>  true,
                        'transport' =>  'postMessage'
                    ]];

                    $background_id = 'tag_background_' . absint( $singleTag->term_id ) . '_color';
                    $control_array += [ $background_id   =>  [
                        'label' => esc_html__( 'Background', 'blogzee' ),
                        'involve'   =>  [ 'solid', 'gradient' ],
                        'hover' =>  true,
                        'bottom_separator'  =>  true,
                        'transport' =>  'postMessage'
                    ]];
                    $tag_priority += 10;
                    if( $totalTags_count != ( $key + 1 ) ) $control_array[ 'tag_bottom_spacing_' . $key ] = [];
                endforeach;
            endif;
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_colors() Method

        /**
         * Get all Media controls
         * 
         * @since 1.0.0
         */
        public function get_media_control( $id = '' ) {
            $default = [
                'mime_type' => 'image',
            ];

            $control_array = [
                'bottom_footer_logo_option'   =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Footer Logo', 'blogzee' ),
                    'description' => esc_html__( 'Upload image for bottom footer', 'blogzee' ),
                    'active_callback'   =>  function( $control ) {
                        return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
                    },
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_media_control() Method

        /**
         * Get all wordpress default color controls
         * 
         * @since 1.0.0
         */
        public function get_predefined_colors( $id = '' ) {
            $default = [
                'tab'   =>  'design',
                'priority'  =>  20,
                'transport' =>  'postMessage'
            ];

            $control_array = [
                'site_title_hover_textcolor'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Title Hover Color', 'blogzee' )
                ]),
                'site_description_color'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Site Description Color', 'blogzee' )
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_predefined_colors() Method

        /**
         * Get all custom repeater controls
         * 
         * @since 1.0.0
         */
        public function get_custom_repeaters( $id = '' ) {
            $default = [];
            $control_array = [
                'social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'blogzee' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogzee' ),
                    'row_label'     => 'inherit-icon_class',
                    'fields'        => [
                        'icon_class'   => [
                            'type'          => 'fontawesome-icon-picker',
                            'label'         => esc_html__( 'Social Icon', 'blogzee' ),
                            'description'   => esc_html__( 'Select from dropdown.', 'blogzee' ),
                            'default'       => esc_attr( 'fab fa-instagram' ),
                            'families'  =>  'social'
                        ],
                        'icon_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'blogzee' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ],
                    'bottom_separator'  =>  true
                ]),
                'footer_social_icons' =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Social Icons', 'blogzee' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogzee' ),
                    'row_label'     => 'inherit-icon_class',
                    'fields'        => [
                        'icon_class'   => [
                            'type'          => 'fontawesome-icon-picker',
                            'label'         => esc_html__( 'Social Icon', 'blogzee' ),
                            'description'   => esc_html__( 'Select from dropdown.', 'blogzee' ),
                            'default'       => esc_attr( 'fab fa-instagram' ),
                            'families'  =>  'social'
                        ],
                        'icon_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL for icon', 'blogzee' ),
                            'default'   => ''
                        ],
                        'item_option'             => 'show'
                    ]
                ]),
                'advertisement_repeater'  =>  $this->get_params( $default, [
                    'label'         => esc_html__( 'Advertisements', 'blogzee' ),
                    'description'   => esc_html__( 'Hold and drag vertically to re-order the icons', 'blogzee' ),
                    'row_label'     => esc_html__( 'Advertisement', 'blogzee' ),
                    'fields'        => [
                        'item_image'   => [
                            'type'          => 'image',
                            'label'         => esc_html__( 'Image', 'blogzee' ),
                            'default'       => 0
                        ],
                        'item_url'  => [
                            'type'      => 'url',
                            'label'     => esc_html__( 'URL', 'blogzee' ),
                            'default'   => ''
                        ],
                        'item_target'   =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Open in', 'blogzee' ),
                            'default'   =>  '_self',
                            'options'   =>  [
                                '_blank'    =>  esc_html__( 'New tab', 'blogzee' ),
                                '_self'    =>  esc_html__( 'Same tab', 'blogzee' )
                            ]
                        ],
                        'item_rel_attribute'    =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Rel', 'blogzee' ),
                            'default'   =>  'opener',
                            'options'   =>  [
                                'nofollow'  =>  esc_html__( 'No follow', 'blogzee' ),
                                'noopener'  =>  esc_html__( 'No opener', 'blogzee' ),
                                'noreferrer'  =>  esc_html__( 'No referrer', 'blogzee' )
                            ]
                        ],
                        'item_heading'  =>  [
                            'type'  =>  'heading',
                            'label' =>  esc_html__( 'Display Area', 'blogzee' )
                        ],
                        'item_checkbox_before_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Before post content', 'blogzee' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_after_post_content' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'After post content', 'blogzee' ),  
                            'default'   =>  false
                        ],
                        'item_checkbox_random_post_archives' =>  [
                            'type'  =>  'checkbox',
                            'label' =>  esc_html__( 'Random post archives', 'blogzee' ),  
                            'default'   =>  false
                        ],
                        'item_alignment'    =>   [
                            'type'  =>  'alignment',
                            'label' =>  esc_html__( 'Ad Alignment', 'blogzee' ),
                            'default'   =>  'left',
                            'options'   =>  [
                                'left'  =>  esc_html__( 'fa-solid fa-align-left', 'blogzee' ),
                                'center'  =>  esc_html__( 'fa-solid fa-align-center', 'blogzee' ),
                                'right'  =>  esc_html__( 'fa-solid fa-align-right', 'blogzee' )
                            ]
                        ],
                        'item_image_option' =>  [
                            'type'  =>  'select',
                            'label' =>  esc_html__( 'Image Option', 'blogzee' ),
                            'default'   =>  'original',
                            'options'   =>  [
                                'full_width'  =>  esc_html__( 'Full Width', 'blogzee' ),
                                'original'  =>  esc_html__( 'Original', 'blogzee' )
                            ]
                        ],
                        'item_option'             => 'show'
                    ],
                    'bottom_separator'  =>  true
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_custom_repeaters() Method

        /**
         * Get all controls rendered using predefined number control
         * 
         * @since 1.0.0
         */
        public function get_custom_number_controls( $id = '' ) {
            $default = [
                'type'  =>  'number',
                'input_attrs'   =>  $this->get_input_attrs([
                    'min'   =>  1
                ]),
            ];

            $control_array = [
                'ticker_news_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogzee' ),
                ]),
                'main_banner_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogzee' ),
                ]),
                'main_banner_trailing_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogzee' ),
                ]),
                'main_banner_image_border_radius'   => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'carousel_no_of_posts_to_show'   => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogzee' ),
                ]),
                'category_collection_number'  => $this->get_params( $default, [
                    'label' => esc_html__( 'Number of category', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  10,
                        'min'   =>  1
                    ]),
                    'bottom_separator'  =>  true
                ]),
                'single_image_border_radius'  => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   => 100
                    ]),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'page_image_border_radius' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs(),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_no_of_columns' => $this->get_params( $default, [
                    'label' =>  esc_html__( 'No of Columns', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'min'   =>  2,
                        'max'   =>  4
                    ]),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_no_of_posts_to_show' => $this->get_params( $default, [
                    'label' =>  esc_html( 'No of posts to show', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  4,
                        'min'   =>  1
                    ])
                ]),
                'sidebar_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  50
                    ]),
                    'transport' =>  'postMessage'
                ]),
                'sidebar_image_border_radius' =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Image Border Radius (px)', 'blogzee' ),
                    'input_attrs' => $this->get_input_attrs([
                        'max'   =>  50
                    ]),
                    'transport' =>  'postMessage',
                    'bottom_separator'  =>  true
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_custom_number_controls() Method

        /**
         * Get a list of all url controls
         * 
         * @since 1.0.0
         */
        public function get_url( $id = '' ) {
            $default = [
                'type'  =>  'url',
            ];

            $control_array = [
                'custom_button_redirect_href_link'    =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Redirect URL', 'blogzee' ),
                    'description'   =>  esc_html__( 'Add url for the button to redirect', 'blogzee' ),
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_url() Method

        /**
         * Get all multiselect controls
         * 
         * @since 1.0.0
         */
        public function get_multiselect_controls( $id = '' ) {
            $default = [
                'endpoint'   =>  'extend/get_taxonomy',
                'purpose'   =>  'post',
            ];

            $control_array = [
                // category
                'ticker_news_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                'main_banner_slider_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                'main_banner_trailing_slider_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                'carousel_slider_categories'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                'category_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to include', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                'category_to_exclude' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Category to exclude', 'blogzee' ),
                    'purpose'   =>  'category',
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_categories' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts Categories', 'blogzee' ),
                    'purpose'   =>  'category'
                ]),
                // posts
                'ticker_news_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogzee' ),
                    'endpoint'   =>  'extend/get_posts',
                    'bottom_separator'  =>  true
                ]),
                'main_banner_slider_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogzee' ),
                    'endpoint'   =>  'extend/get_posts',
                    'bottom_separator'  =>  true
                ]),
                'main_banner_trailing_slider_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogzee' ),
                    'endpoint'   =>  'extend/get_posts',
                    'bottom_separator'  =>  true
                ]),
                'carousel_slider_posts_to_include'  => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogzee' ),
                    'endpoint'   =>  'extend/get_posts',
                    'bottom_separator'  =>  true
                ]),
                'you_may_have_missed_posts_to_include' => $this->get_params( $default, [
                    'label'     => esc_html__( 'Posts To Include', 'blogzee' ),
                    'endpoint'   =>  'extend/get_posts',
                    'bottom_separator'  =>  true
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_multiselect_controls() Method

        /**
         * Get all reflector controls
         * 
         * @since 1.0.0
         */
        public function get_builder_reflector_controls( $id ) {
            $default = [
                'label' =>  esc_html__( 'Row Widgets', 'blogzee' )
            ];
            $control_array = [
                /* Header builder reflectors */
                'header_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	1,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder',
                    'bottom_separator'  =>  true
                ]),
                'header_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	2,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder',
                    'bottom_separator'  =>  true
                ]),
                'header_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'header',
                    'builder'	=>	'header_builder',
                    'row'	=>	3,
                    'responsive'    =>  'responsive-header',
                    'responsive_builder_id' =>  'responsive_header_builder',
                    'bottom_separator'  =>  true
                ]),
                /* Footer builder reflectors */
                'footer_first_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	1,
                    'bottom_separator'  =>  true
                ]),
                'footer_second_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	2,
                    'bottom_separator'  =>  true
                ]),
                'footer_third_row_reflector' => $this->get_params( $default, [
                    'placement'	=>	'footer',
                    'builder'	=>	'footer_builder',
                    'row'	=>	3,
                    'bottom_separator'  =>  true
                ]),
                /* Responsive Header Builder reflector */
                'mobile_canvas_reflector' => $this->get_params( $default, [
                    'placement'	=>	'responsive-header',
                    'builder'	=>	'responsive_header_builder',
                    'row'	=>	4
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_builder_reflector_controls() Method

        /**
         * Get all responsive radio image  controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_image( $id ) {
            $default = [];
            $theme_directory = get_template_directory_uri();
            $column_layouts = [
                'one' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_one.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 1 ]
                ],
                'two' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_two.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'three' => [
                    'label' => esc_html__( 'Layout Two', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_three.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'five' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_five.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'seven' => [
                    'label' => esc_html__( 'Layout Two', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_seven.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'thirteen' => [
                    'label' => esc_html__( 'Layout Three', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_thirteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 2 ]
                ],
                'sixteen' => [
                    'label' => esc_html__( 'Layout Three', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_sixteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ]
            ];

            $footer_column_layouts = [
                'one' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_one.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 1 ]
                ],
                'two' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_two.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'three' => [
                    'label' => esc_html__( 'Layout Two', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_three.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 2 ]
                ],
                'five' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_five.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 3 ]
                ],
                'nine' => [
                    'label' => esc_html__( 'Layout One', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_nine.png',
                    'devices'	=>	[ 'smartphone', 'tablet', 'desktop' ],
                    'columns'	=>	[ 4 ]
                ],
                'thirteen' => [
                    'label' => esc_html__( 'Layout Three', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_thirteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 2 ]
                ],
                'sixteen' => [
                    'label' => esc_html__( 'Layout Two', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_sixteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 3 ]
                ],
                'eighteen' => [
                    'label' => esc_html__( 'Layout Two', 'blogzee' ),
                    'url'   => $theme_directory . '/assets/images/customizer/builder_eighteen.png',
                    'devices'	=>	[ 'smartphone', 'tablet' ],
                    'columns'	=>	[ 4 ]
                ]
            ];
            $control_array = [
                /* Header layout row controls */
                'header_first_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'choices'  => $column_layouts
                ],
                'header_second_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'row'   =>  2,
                    'choices'  => $column_layouts
                ],
                'header_third_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'row'   =>  3,
                    'choices'  => $column_layouts
                ],
                /* Footer layout row controls */
                'footer_first_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'builder'   =>  'footer',
                    'choices'  => $footer_column_layouts
                ],
                'footer_second_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'row'   =>  2,
                    'builder'   =>  'footer',
                    'choices'  => $footer_column_layouts
                ],
                'footer_third_row_column_layout'    =>  [
                    'label' =>  esc_html__( 'Column layout', 'blogzee' ),
                    'row'   =>  3,
                    'builder'   =>  'footer',
                    'choices'  => $footer_column_layouts
                ],
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }   // End of get_responsive_radio_image() Method

        /**
         * Gets all textarea controls
         * 
         * @since 1.0.0
         */
        public function get_textareas( $id = '' ){
            $default = [
                'type'  =>  'textarea'
            ];
            $control_array = [
                'bottom_footer_site_info' =>  $this->get_params( $default, [
                    'label' => esc_html__( 'Copyright Text', 'blogzee' ),
                    'description' => esc_html__( 'Add %year% to retrieve current year.', 'blogzee' )
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Gets all responsive radio tab controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_radio_tab( $id = '' ){
            $default = [
                'choices' => [
                    [
                        'value' => 'left',
                        'icon'  =>  'editor-alignleft',
                        'label' =>  esc_html__( 'Left', 'blogzee' )
                    ],
                    [
                        'value' => 'center',
                        'icon'  =>  'editor-aligncenter',
                        'label' =>  esc_html__( 'Center', 'blogzee' )
                    ],
                    [
                        'value' => 'right',
                        'icon'  =>  'editor-alignright',
                        'label' =>  esc_html__( 'Right', 'blogzee' )
                    ]
                ],
                'transport' =>  'postMessage'
            ];
            $control_array = [
                /* Header builder first row */
                'header_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_first_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_first_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Header builder second row */
                'header_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_second_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_second_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Header builder third row */
                'header_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'header_third_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'header_third_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder first row */
                'footer_first_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_first_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_first_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder second row */
                'footer_second_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_second_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_second_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
                /* Footer builder third row */
                'footer_third_row_column_one'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 1 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 1, 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_two'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 2 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 2, 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_three'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 3 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 3, 4 ] ) );
                    },
                ]),
                'footer_third_row_column_four'  =>  $this->get_params( $default, [
                    'label' =>  esc_html__( 'Column 4 Alignment', 'blogzee' ),
                    'tab'   =>  'column',
                    'active_callback'   =>  function( $control ) {
                        return ( in_array( $control->manager->get_setting( 'footer_third_row_column' )->value(), [ 4 ] ) );
                    },
                ]),
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all typography preset controls
         * 
         * @since 1.0.0
         */
        public function get_typography_preset_controls( $id = '' ) {

            $control_array = [
                'typography_presets' =>   [
                    'label' =>  esc_html__( 'Typography Preset', 'blogzee' ),
                    'description'   =>  esc_html__( 'This is the control to use in future projects.', 'blogzee' ),
                    'bottom_separator'  =>  true,
                    'transport' =>  'postMessage'
                ]
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all preset color controls
         * 
         * @since 1.0.0
         */
        public function get_theme_colors( $id = '' ) {
            $default = [
                'transport' =>  'postMessage'
            ];

            $control_array = [
                // preset colors
                'theme_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Theme Color', 'blogzee' ),
                    'variable'   => '--blogzee-global-preset-theme-color'
                ]),
                'gradient_theme_color' => $this->get_params( $default, [
                    'label' => esc_html__( 'Gradient Theme Color', 'blogzee' ),
                    'variable'   => '--blogzee-global-preset-gradient-theme-color',
                    'involve'   =>  'gradient',
                    'bottom_separator'  =>  true
                ])
            ];
            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all builder controls
         * 
         * @since 1.0.0
         */
        public function get_builder_controls( $id = '' ) {

            $default = [
            ];

            $control_array = [
                'header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'responsive_builder'	=>	'responsive_header_builder',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'blogzee' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'blogzee' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogzee' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'blogzee' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Primary Menu', 'blogzee' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'blogzee' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'blogzee' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'blogzee' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ]
                    ]
                ]),
                'footer_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'footer_builder_section_settings',
                    'placement'	=>	'footer',
                    'widgets'	=>	[
                        'logo'	=>	[
                            'label' 	=>	esc_html__( 'Logo', 'blogzee' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'footer_logo'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogzee' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'footer_social_icons_section'
                        ],
                        'copyright'	=>	[
                            'label' 	=>	esc_html__( 'Copyright', 'blogzee' ),
                            'icon' 	=>	'privacy',
                            'section'	=>	'footer_copyright'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Secondary Menu', 'blogzee' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'footer_menu_options_section'
                        ],
                        'sidebar-one'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 1', 'blogzee' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-one'
                        ],
                        'sidebar-two'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 2', 'blogzee' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-two'
                        ],
                        'sidebar-three'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 3', 'blogzee' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-three'
                        ],
                        'sidebar-four'	=>	[
                            'label' 	=>	esc_html__( 'Sidebar 4', 'blogzee' ),
                            'icon' 	=>	'columns',
                            'section'	=>	'sidebar-widgets-footer-sidebar-column-four'
                        ],
                        'you-may-have-missed'	=>	[
                            'label' 	=>	esc_html__( 'You may have missed', 'blogzee' ),
                            'icon' 	=>	'star-filled',
                            'section'	=>	'you_may_have_missed_section'
                        ],
                        'scroll-to-top'	=>	[
                            'label' 	=>	esc_html__( 'Scroll to Top', 'blogzee' ),
                            'icon' 	=>	'arrow-up-alt2',
                            'section'	=>	'stt_options_section'
                        ],
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Returns all responsive builder controls
         * 
         * @since 1.0.0
         */
        public function get_responsive_builder_controls( $id = '' ) {

            $default = [
            ];

            $control_array = [
                'responsive_header_builder' => $this->get_params( $default, [
                    'builder_settings_section'	=>	'header_builder_section_settings',
                    'placement'	=>	'header',
                    'responsive_canvas_id'	=>	'responsive-canvas',
                    'responsive_section'	=>	'mobile_canvas_section',
                    'widgets'	=>	[
                        'site-logo'	=>	[
                            'label' 	=>	esc_html__( 'Site Logo and Title', 'blogzee' ),
                            'icon' 	=>	'admin-site',
                            'section'	=>	'title_tagline'
                        ],
                        'date-time'	=>	[
                            'label' 	=>	esc_html__( 'Date Time', 'blogzee' ),
                            'icon' 	=>	'clock',
                            'section'	=>	'date_time_section'
                        ],
                        'social-icons'	=>	[
                            'label' 	=>	esc_html__( 'Social Icons', 'blogzee' ),
                            'icon' 	=>	'networking',
                            'section'	=>	'social_icons_section'
                        ],
                        'search'	=>	[
                            'label' 	=>	esc_html__( 'Search', 'blogzee' ),
                            'icon' 	=>	'search',
                            'section'	=>	'header_live_search_section'
                        ],
                        'menu'	=>	[
                            'label' 	=>	esc_html__( 'Primary Menu', 'blogzee' ),
                            'icon' 	=>	'menu',
                            'section'	=>	'header_menu_options_section'
                        ],
                        'button'	=>	[
                            'label' 	=>	esc_html__( 'Button', 'blogzee' ),
                            'icon' 	=>	'button',
                            'section'	=>	'custom_button_section'
                        ],
                        'theme-mode'	=>	[
                            'label' 	=>	esc_html__( 'Theme Mode', 'blogzee' ),
                            'icon' 	=>	'lightbulb',
                            'section'	=>	'theme_mode_section'
                        ],
                        'off-canvas'	=>	[
                            'label' 	=>	esc_html__( 'Off Canvas', 'blogzee' ),
                            'icon' 	=>	'text-page',
                            'section'	=>	'canvas_menu_section'
                        ],
                        'toggle-button'	=>	[
                            'label' 	=>	esc_html__( 'Toggle Button', 'blogzee' ),
                            'icon' 	=>	'ellipsis',
                            'section'	=>	'mobile_canvas_section'
                        ]
                    ]
                ])
            ];

            return ( $id ? $control_array[ $id ] : $control_array );
        }

        /**
         * Get controls parameters necessary in add_control function
         * 
         * @since 1.0.0
         */
        public function get_params( $default = [], $append = [] ) {
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }

        /**
         * Get input_attrs array
         * 
         * @since 1.0.0
         */
        public function get_input_attrs( $append = [] ) {
            $default = [
                'max'   =>  100,
                'min'   =>  0,
                'step'   =>  1,
                'reset'   =>  true
            ];
            if( ! empty( $append ) && is_array( $append ) ) return $append += $default;
            return $default;
        }
    }
 endif;