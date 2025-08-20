<?php
/**
 * Blogzee Customizer
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

add_action( 'customize_register', function( $wp_customize ){
    // Preloader
    $wp_customize->add_setting( 'preloader_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'preloader_pre_sales', [
        'label'         =>  esc_html__( 'Need More Preloader Features ?', 'blogzee' ),
        'section'       =>  'preloader_section',
        'features'      =>  [
            esc_html__( '5 preloader styles', 'blogzee' ),
            esc_html__( 'Display preloader animation', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Website Layout
    $wp_customize->add_setting( 'website_layout_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'website_layout_pre_sales', [
        'label'         =>  esc_html__( 'Need More Website Layout Features ?', 'blogzee' ),
        'section'       =>  'website_layout_section',
        'features'      =>  [
            esc_html__( 'Container background color', 'blogzee' ),
            esc_html__( 'Box shadow', 'blogzee' ),
            esc_html__( 'Horizontal & vertical gap', 'blogzee' ),
            esc_html__( '5 Block title layouts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Animation / Hover effects
    $wp_customize->add_setting( 'global_animation_effects_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'global_animation_effects_pre_sales', [
        'label'         =>  esc_html__( 'Need More Animation Features ?', 'blogzee' ),
        'section'       =>  'animation_section',
        'features'      =>  [
            esc_html__( 'Show / hide AOS animation', 'blogzee' ),
            esc_html__( '20 AOS animation effects', 'blogzee' ),
            esc_html__( 'Display AOS animation', 'blogzee' ),
            esc_html__( '8 post title hover effects', 'blogzee' ),
            esc_html__( '5 image hover effects', 'blogzee' ),
            esc_html__( '2 cursor animation', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Global Button
    $wp_customize->add_setting( 'global_button_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'global_button_pre_sales', [
        'label'         =>  esc_html__( 'Need More Global Button Features ?', 'blogzee' ),
        'section'       =>  'buttons_section',
        'features'      =>  [
            esc_html__( 'Button label & Icon', 'blogzee' ),
            esc_html__( 'Icon Size', 'blogzee' ),
            esc_html__( 'Color & background', 'blogzee' ),
            esc_html__( 'Border & border radius', 'blogzee' ),
            esc_html__( 'Initial & hover box shadow', 'blogzee' ),
            esc_html__( 'Padding', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Breadcrumb
    $wp_customize->add_setting( 'breadcrumb_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'breadcrumb_pre_sales', [
        'label'         =>  esc_html__( 'Need More Breadcrumb Features ?', 'blogzee' ),
        'section'       =>  'breadcrumb_options_section',
        'features'      =>  [
            esc_html__( 'Separator Icon', 'blogzee' ),
            esc_html__( 'Text & link color', 'blogzee' ),
            esc_html__( 'Background color', 'blogzee' ),
            esc_html__( 'Box shadow', 'blogzee' ),
            esc_html__( 'Padding', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Advertisement
    $wp_customize->add_setting( 'advertisement_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'advertisement_pre_sales', [
        'label'         =>  esc_html__( 'Need More Advertisement Features ?', 'blogzee' ),
        'section'       =>  'advertisement_section',
        'features'      =>  [
            esc_html__( 'Add as many advertisement as you want.', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Typography
    $wp_customize->add_setting( 'typography_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'typography_pre_sales', [
        'label'         =>  esc_html__( 'Need More Advertisement Features ?', 'blogzee' ),
        'section'       =>  'typography_section',
        'features'      =>  [
            esc_html__( 'More than 1500+ google fonts', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Sidebar / Widget Styles
    $wp_customize->add_setting( 'sidebar_widget_styles_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'sidebar_widget_styles_pre_sales', [
        'label'         =>  esc_html__( 'Need More Sidebar Features ?', 'blogzee' ),
        'section'       =>  'widget_styles_section',
        'features'      =>  [
            esc_html__( 'Enable sidebar sticky', 'blogzee' ),
            esc_html__( 'Padding', 'blogzee' ),
            esc_html__( 'Inner background color', 'blogzee' ),
            esc_html__( 'Box shadow & border bottom', 'blogzee' ),
            esc_html__( 'Pagination color & background color', 'blogzee' ),
            esc_html__( 'Pagination border radius', 'blogzee' ),
            esc_html__( 'Pagination box shadow', 'blogzee' ),
            esc_html__( 'Pagination padding', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Mobile Options
    $wp_customize->add_setting( 'mobile_options_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'mobile_options_pre_sales', [
        'label'         =>  esc_html__( 'Need More Mobile Options Features ?', 'blogzee' ),
        'section'       =>  'mobile_options_section',
        'features'      =>  [
            esc_html__( 'Show / hide video playlist section', 'blogzee' ),
            esc_html__( 'Show / hide left & right sidebar', 'blogzee' ),
            esc_html__( 'Show / hide breadcrumb', 'blogzee' ),
            esc_html__( 'Show / hide social share', 'blogzee' ),
            esc_html__( 'And many more', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Header Builder
    $wp_customize->add_setting( 'header_builder_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'header_builder_pre_sales', [
        'label'         =>  esc_html__( 'Need More Header Builder Features ?', 'blogzee' ),
        'section'       =>  'header_builder_section_settings',
        'features'      =>  [
            esc_html__( 'Header sticky on scroll up', 'blogzee' ),
            esc_html__( 'Header sticky on scroll down', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border & box shadow', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Header Builder 1st Row
    $wp_customize->add_setting( 'header_builder_first_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'header_builder_first_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Header Builder 1st Row Features ?', 'blogzee' ),
        'section'       =>  'header_first_row',
        'features'      =>  [
            esc_html__( 'Column count up to 4', 'blogzee' ),
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border & box shadow', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Header Builder 2nd Row
    $wp_customize->add_setting( 'header_builder_second_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'header_builder_second_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Header Builder 2nd Row Features ?', 'blogzee' ),
        'section'       =>  'header_second_row',
        'features'      =>  [
            esc_html__( 'Column count up to 4', 'blogzee' ),
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border & box shadow', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Header Builder 3rd Row
    $wp_customize->add_setting( 'header_builder_third_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'header_builder_third_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Header Builder 3rd Row Features ?', 'blogzee' ),
        'section'       =>  'header_third_row',
        'features'      =>  [
            esc_html__( 'Column count up to 4', 'blogzee' ),
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border & box shadow', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Date Time
    $wp_customize->add_setting( 'date_time_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'date_time_pre_sales', [
        'label'         =>  esc_html__( 'Need More Date Time Features ?', 'blogzee' ),
        'section'       =>  'date_time_section',
        'features'      =>  [
            esc_html__( 'Background color', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
            esc_html__( 'Padding', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Social Icons
    $wp_customize->add_setting( 'social_icons_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'social_icons_pre_sales', [
        'label'         =>  esc_html__( 'Need More Social Icons Features ?', 'blogzee' ),
        'section'       =>  'social_icons_section',
        'features'      =>  [
            esc_html__( 'Add as many social icons as you want', 'blogzee' ),
            esc_html__( 'Open in New / Same Tab', 'blogzee' ),
            esc_html__( 'Inherit official color', 'blogzee' ),
            esc_html__( 'Show hover animation', 'blogzee' ),
            esc_html__( 'Font size', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Off Canvas
    $wp_customize->add_setting( 'off_canvas_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'off_canvas_pre_sales', [
        'label'         =>  esc_html__( 'Need More Off Canvas Features ?', 'blogzee' ),
        'section'       =>  'canvas_menu_section',
        'features'      =>  [
            esc_html__( 'Canvas width', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Off Canvas
    $wp_customize->add_setting( 'off_canvas_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'off_canvas_pre_sales', [
        'label'         =>  esc_html__( 'Need More Off Canvas Features ?', 'blogzee' ),
        'section'       =>  'canvas_menu_section',
        'features'      =>  [
            esc_html__( 'Canvas width', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Menu Options
    $wp_customize->add_setting( 'menu_options_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'menu_options_pre_sales', [
        'label'         =>  esc_html__( 'Need More Menu Options Features ?', 'blogzee' ),
        'section'       =>  'header_menu_options_section',
        'features'      =>  [
            esc_html__( '4 hover effects', 'blogzee' ),
            esc_html__( 'Enable menu cutoff', 'blogzee' ),
            esc_html__( 'Menu cutoff upto', 'blogzee' ),
            esc_html__( 'Menu cutoff more text', 'blogzee' ),
            esc_html__( 'Menu active color', 'blogzee' ),
            esc_html__( 'Sub menu background color', 'blogzee' ),
            esc_html__( 'Sub menu box shadow', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Search
    $wp_customize->add_setting( 'search_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'search_pre_sales', [
        'label'         =>  esc_html__( 'Need More Search Features ?', 'blogzee' ),
        'section'       =>  'header_live_search_section',
        'features'      =>  [
            esc_html__( 'Enable live search', 'blogzee' ),
            esc_html__( 'Number of posts to show', 'blogzee' ),
            esc_html__( 'View all button text', 'blogzee' ),
            esc_html__( 'No results found text', 'blogzee' ),
            esc_html__( 'Show post image', 'blogzee' ),
            esc_html__( 'show post date', 'blogzee' ),
            esc_html__( 'View all button text color', 'blogzee' ),
            esc_html__( 'View all button background color', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // custom button
    $wp_customize->add_setting( 'custom_button_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'custom_button_pre_sales', [
        'label'         =>  esc_html__( 'Need More Custom Button Features ?', 'blogzee' ),
        'section'       =>  'custom_button_section',
        'features'      =>  [
            esc_html__( 'Button icon', 'blogzee' ),
            esc_html__( 'Open in new / same tab', 'blogzee' ),
            esc_html__( 'Icon size, distance & context', 'blogzee' ),
            esc_html__( '5 animation type', 'blogzee' ),
            esc_html__( 'Text & link color', 'blogzee' ),
            esc_html__( 'Border & box shadow', 'blogzee' ),
            esc_html__( 'Padding', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Ticker News
    $wp_customize->add_setting( 'ticker_news_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'ticker_news_pre_sales', [
        'label'         =>  esc_html__( 'Need More Ticker News Features ?', 'blogzee' ),
        'section'       =>  'ticker_news_section',
        'features'      =>  [
            esc_html__( 'Display in', 'blogzee' ),
            esc_html__( 'Ticker Title', 'blogzee' ),
            esc_html__( 'Posts to exclude', 'blogzee' ),
            esc_html__( 'Posts tags & authors', 'blogzee' ),
            esc_html__( 'Offset', 'blogzee' ),
            esc_html__( 'Show image & date', 'blogzee' ),
            esc_html__( 'Date icon & icon size', 'blogzee' ),
            esc_html__( 'Marquee settings', 'blogzee' ),
            esc_html__( 'Heading & controller background', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Main banner
    $wp_customize->add_setting( 'main_banner_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'main_banner_pre_sales', [
        'label'         =>  esc_html__( 'Need More Main Banner Features ?', 'blogzee' ),
        'section'       =>  'main_banner_section',
        'features'      =>  [
            esc_html__( '4 Layouts', 'blogzee' ),
            esc_html__( 'Display in', 'blogzee' ),
            esc_html__( 'Show social share', 'blogzee' ),
            esc_html__( 'Posts to exclude', 'blogzee' ),
            esc_html__( 'Posts tags & authors', 'blogzee' ),
            esc_html__( 'Offset', 'blogzee' ),
            esc_html__( 'Meta show / hide', 'blogzee' ),
            esc_html__( 'Slider settings', 'blogzee' ),
            esc_html__( 'Image ratio & image border', 'blogzee' ),
            esc_html__( 'Content background', 'blogzee' ),
            esc_html__( 'Sidebar padding', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
            esc_html__( 'And many more', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Category Collection
    $wp_customize->add_setting( 'category_collection_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'category_collection_pre_sales', [
        'label'         =>  esc_html__( 'Need More Category Collection Features ?', 'blogzee' ),
        'section'       =>  'category_collection_section',
        'features'      =>  [
            esc_html__( '2 Layouts', 'blogzee' ),
            esc_html__( 'Display in', 'blogzee' ),
            esc_html__( 'Offset', 'blogzee' ),
            esc_html__( 'Hide empty category', 'blogzee' ),
            esc_html__( 'Slider settings', 'blogzee' ),
            esc_html__( 'Image ratio', 'blogzee' ),
            esc_html__( '3 Hover effects', 'blogzee' ),
            esc_html__( 'Content background', 'blogzee' ),
            esc_html__( 'Text color', 'blogzee' ),
            esc_html__( 'Box shadow', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // carousel
    $wp_customize->add_setting( 'carousel_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'carousel_pre_sales', [
        'label'         =>  esc_html__( 'Need More Carousel Features ?', 'blogzee' ),
        'section'       =>  'carousel_section',
        'features'      =>  [
            esc_html__( '2 Layouts', 'blogzee' ),
            esc_html__( 'Display in', 'blogzee' ),
            esc_html__( 'Number of columns', 'blogzee' ),
            esc_html__( 'Posts to exclude', 'blogzee' ),
            esc_html__( 'Posts tags & authors', 'blogzee' ),
            esc_html__( 'Offset', 'blogzee' ),
            esc_html__( 'Meta show / hide', 'blogzee' ),
            esc_html__( 'Slider settings', 'blogzee' ),
            esc_html__( 'Image ratio & border', 'blogzee' ),
            esc_html__( 'Content background', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // Blog / Archive => general settings
    $wp_customize->add_setting( 'archive_general_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'archive_general_pre_sales', [
        'label'         =>  esc_html__( 'Need More Archive Features ?', 'blogzee' ),
        'section'       =>  'archive_general_section',
        'features'      =>  [
            esc_html__( '8 Layouts', 'blogzee' ),
            esc_html__( '4 sidebar layouts', 'blogzee' ),
            esc_html__( 'Number of columns', 'blogzee' ),
            esc_html__( 'Show social share', 'blogzee' ),
            esc_html__( 'Meta show / hide', 'blogzee' ),
            esc_html__( 'Slider settings', 'blogzee' ),
            esc_html__( 'Image ratio, border & box shadow', 'blogzee' ),
            esc_html__( 'Inner background color', 'blogzee' ),
            esc_html__( 'Box shadow & border', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Category Page
    $wp_customize->add_setting( 'category_page_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'category_page_pre_sales', [
        'label'         =>  esc_html__( 'Need More Category Page Features ?', 'blogzee' ),
        'section'       =>  'category_archive_section',
        'features'      =>  [
            esc_html__( 'Show category icon', 'blogzee' ),
            esc_html__( 'Category icon', 'blogzee' ),
            esc_html__( 'Show category title', 'blogzee' ),
            esc_html__( 'Category title html tag', 'blogzee' ),
            esc_html__( 'show category description', 'blogzee' ),
            esc_html__( 'Background & box shadow', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Tag Page
    $wp_customize->add_setting( 'tags_page_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'tags_page_pre_sales', [
        'label'         =>  esc_html__( 'Need More Tags Page Features ?', 'blogzee' ),
        'section'       =>  'tag_archive_section',
        'features'      =>  [
            esc_html__( 'Show tag icon', 'blogzee' ),
            esc_html__( 'Tag icon', 'blogzee' ),
            esc_html__( 'Show tag title', 'blogzee' ),
            esc_html__( 'Tag title html tag', 'blogzee' ),
            esc_html__( 'Show tag description', 'blogzee' ),
            esc_html__( 'Background & box shadow', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Author Page
    $wp_customize->add_setting( 'author_page_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'author_page_pre_sales', [
        'label'         =>  esc_html__( 'Need More Author Page Features ?', 'blogzee' ),
        'section'       =>  'author_archive_section',
        'features'      =>  [
            esc_html__( 'Show author image', 'blogzee' ),
            esc_html__( 'Show author title', 'blogzee' ),
            esc_html__( 'Show author description', 'blogzee' ),
            esc_html__( 'Author title html author', 'blogzee' ),
            esc_html__( 'Background & box shadow', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Archive pagination
    $wp_customize->add_setting( 'archive_pagination_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'archive_pagination_pre_sales', [
        'label'         =>  esc_html__( 'Need More Pagination Features ?', 'blogzee' ),
        'section'       =>  'pagination_settings_section',
        'features'      =>  [
            esc_html__( 'Ajax load more', 'blogzee' ),
            esc_html__( 'Button label', 'blogzee' ),
            esc_html__( 'No more results text', 'blogzee' ),
            esc_html__( 'Button text color', 'blogzee' ),
            esc_html__( 'Button background color', 'blogzee' ),
            esc_html__( 'Border radius', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Single General settings
    $wp_customize->add_setting( 'single_general_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'single_general_pre_sales', [
        'label'         =>  esc_html__( 'Need More Single Features ?', 'blogzee' ),
        'section'       =>  'blog_single_general_settings',
        'features'      =>  [
            esc_html__( '6 layouts', 'blogzee' ),
            esc_html__( '4 sidebar layouts', 'blogzee' ),
            esc_html__( 'Content width', 'blogzee' ),
            esc_html__( 'Author box settings', 'blogzee' ),
            esc_html__( 'Post navigation settings', 'blogzee' ),
            esc_html__( 'Image ratio, border & box shadow', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border radius & box shadow', 'blogzee' ),
            esc_html__( 'Table of content', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Single elements settings
    $wp_customize->add_setting( 'single_elements_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'single_elements_pre_sales', [
        'label'         =>  esc_html__( 'Need More Single Elements Features ?', 'blogzee' ),
        'section'       =>  'blog_single_elements_settings_section',
        'features'      =>  [
            esc_html__( 'Show post title', 'blogzee' ),
            esc_html__( 'Title tag', 'blogzee' ),
            esc_html__( 'Show post thumbnail', 'blogzee' ),
            esc_html__( 'Show post category, date & comments', 'blogzee' ),
            esc_html__( 'Meta icon pickers', 'blogzee' ),
            esc_html__( 'Show lightbox', 'blogzee' ),
            esc_html__( 'Table of content', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // Single related posts
    $wp_customize->add_setting( 'related_posts_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'related_posts_pre_sales', [
        'label'         =>  esc_html__( 'Need More Related Posts Features ?', 'blogzee' ),
        'section'       =>  'blog_single_related_posts_section',
        'features'      =>  [
            esc_html__( '2 layouts', 'blogzee' ),
            esc_html__( 'Number of column', 'blogzee' ),
            esc_html__( 'Filter by', 'blogzee' ),
            esc_html__( 'Show author, date & comments', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // page
    $wp_customize->add_setting( 'page_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'page_pre_sales', [
        'label'         =>  esc_html__( 'Need More Page Features ?', 'blogzee' ),
        'section'       =>  'page_settings_section',
        'features'      =>  [
            esc_html__( '4 sidebar layout', 'blogzee' ),
            esc_html__( 'Show page title, content & thumbnail', 'blogzee' ),
            esc_html__( 'Title tag', 'blogzee' ),
            esc_html__( 'Image ratio, border & box shadow', 'blogzee' ),
            esc_html__( 'Background & box shadow', 'blogzee' ),
            esc_html__( 'Search page settings', 'blogzee' ),
            esc_html__( 'Table of content', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // footer builder
    $wp_customize->add_setting( 'footer_builder_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'footer_builder_pre_sales', [
        'label'         =>  esc_html__( 'Need More Footer Builder Features ?', 'blogzee' ),
        'section'       =>  'footer_builder_section_settings',
        'features'      =>  [
            esc_html__( 'Background, Border & Margins', 'blogzee' ),
            esc_html__( 'Block title & text color', 'blogzee' ),
            esc_html__( 'More than 1500+ google fonts', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // footer builder 1st row
    $wp_customize->add_setting( 'footer_builder_first_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'footer_builder_first_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Footer Builder 1st Row Features ?', 'blogzee' ),
        'section'       =>  'footer_first_row',
        'features'      =>  [
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Row Direction', 'blogzee' ),
            esc_html__( 'Vertical Alignment', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // footer builder 2nd row
    $wp_customize->add_setting( 'footer_builder_second_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'footer_builder_second_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Footer Builder 2nd Row Features ?', 'blogzee' ),
        'section'       =>  'footer_second_row',
        'features'      =>  [
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Row Direction', 'blogzee' ),
            esc_html__( 'Vertical Alignment', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // footer builder 3rd row
    $wp_customize->add_setting( 'footer_builder_third_row_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'footer_builder_third_row_pre_sales', [
        'label'         =>  esc_html__( 'Need More Footer Builder 3rd Row Features ?', 'blogzee' ),
        'section'       =>  'footer_third_row',
        'features'      =>  [
            esc_html__( '18 total column layout', 'blogzee' ),
            esc_html__( 'Row Direction', 'blogzee' ),
            esc_html__( 'Vertical Alignment', 'blogzee' ),
            esc_html__( 'Background', 'blogzee' ),
            esc_html__( 'Border', 'blogzee' ),
            esc_html__( 'Margin', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

    // copyright
    $wp_customize->add_setting( 'copyright_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'copyright_pre_sales', [
        'label'         =>  esc_html__( 'Need More Copyright Features ?', 'blogzee' ),
        'section'       =>  'footer_copyright',
        'features'      =>  [
            esc_html__( 'WYSIWYG editor', 'blogzee' ),
            esc_html__( 'Text & link color', 'blogzee' )
        ],
        'priority'  =>  200
    ]));

     // footer Social Icons
    $wp_customize->add_setting( 'footer_social_icons_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'footer_social_icons_pre_sales', [
        'label'         =>  esc_html__( 'Need More Social Icons Features ?', 'blogzee' ),
        'section'       =>  'footer_social_icons_section',
        'features'      =>  [
            esc_html__( 'Add as many social icons as you want', 'blogzee' ),
            esc_html__( 'Open in New / Same Tab', 'blogzee' ),
            esc_html__( 'Inherit official color', 'blogzee' ),
            esc_html__( 'Show hover animation', 'blogzee' ),
            esc_html__( 'Font size', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

     // scroll to top
    $wp_customize->add_setting( 'stt_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'stt_pre_sales', [
        'label'         =>  esc_html__( 'Need More Scroll To Top Features ?', 'blogzee' ),
        'section'       =>  'stt_options_section',
        'features'      =>  [
            esc_html__( 'Button Icon & alignment', 'blogzee' ),
            esc_html__( 'Display type', 'blogzee' ),
            esc_html__( 'Icon Text color', 'blogzee' ),
            esc_html__( 'Background color', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));

    // You may have missed
    $wp_customize->add_setting( 'you_may_have_missed_pre_sales', [
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new Blogzee_WP_Upsell_Control( $wp_customize, 'you_may_have_missed_pre_sales', [
        'label'         =>  esc_html__( 'Need More You May Have Missed Features ?', 'blogzee' ),
        'section'       =>  'you_may_have_missed_section',
        'features'      =>  [
            esc_html__( '2 layouts', 'blogzee' ),
            esc_html__( 'Posts to exclude', 'blogzee' ),
            esc_html__( 'Posts tags & author', 'blogzee' ),
            esc_html__( 'Offset', 'blogzee' ),
            esc_html__( 'Meta show / hide', 'blogzee' ),
            esc_html__( 'Image ratio, border & box shadow', 'blogzee' ),
            esc_html__( 'Block & post title color', 'blogzee' ),
        ],
        'priority'  =>  200
    ]));
});