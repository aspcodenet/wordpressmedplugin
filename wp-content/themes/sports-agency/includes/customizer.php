<?php

if ( class_exists("Kirki")){

	Kirki::add_config('theme_config_id', array(
		'capability'   =>  'edit_theme_options',
		'option_type'  =>  'theme_mod',
	));


	Kirki::add_field( 'theme_config_id', [
		'label'       => esc_html__( 'Logo Size','sports-agency' ),
		'section'     => 'title_tagline',
		'priority'    => 9,
		'type'        => 'range',
		'settings'    => 'logo_size',
		'choices' => [
			'step'             => 5,
			'min'              => 0,
			'max'              => 100,
			'aria-valuemin'    => 0,
			'aria-valuemax'    => 100,
			'aria-valuenow'    => 50,
			'aria-orientation' => 'horizontal',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_enable_logo_text',
		'section'     => 'title_tagline',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

  	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'sports_agency_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'sports-agency' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'sports-agency' ),
			'off' => esc_html__( 'Disable', 'sports-agency' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'sports_agency_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'sports-agency' ),
		'section'     => 'title_tagline',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'sports-agency' ),
			'off' => esc_html__( 'Disable', 'sports-agency' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_site_tittle_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Title Font Size', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_site_tittle_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo a'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_site_tagline_font_heading',
		'section'     => 'title_tagline',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Site Tagline Font Size', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_site_tagline_font_size',
		'type'        => 'number',
		'section'     => 'title_tagline',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.logo span'),
				'property' => 'font-size',
				'suffix' => 'px'
			),
		),
	) );


	// Theme color

	Kirki::add_section( 'sports_agency_theme_color_setting', array(
		'title'    => __( 'Color Option', 'sports-agency' ),
		'priority' => 10,
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_first_theme_color',
		'label'       => __( 'Theme First color', 'sports-agency'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'sports-agency' ),
		'section'     => 'sports_agency_theme_color_setting',
		'type'        => 'color',
		'default'     => '#479F49',
	) );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_second_theme_color',
		'label'       => __( 'Theme Second color', 'sports-agency'),
		'description'    => esc_html__( 'To customize the colors of the homepage, use the Elementor editor', 'sports-agency' ),
		'section'     => 'sports_agency_theme_color_setting',
		'type'        => 'color',
		'default'     => '#000000',
	) );

	// TYPOGRAPHY SETTINGS

	Kirki::add_panel( 'sports_agency_typography_panel', array(
		'priority' => 10,
		'title'    => __( 'Typography', 'sports-agency' ),
	) );

	//Heading 1 Section

	Kirki::add_section( 'sports_agency_h1_typography_setting', array(
		'title'    => __( 'Heading 1', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h1_typography_heading',
		'section'     => 'sports_agency_h1_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 1 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h1_typography_font',
		'section'   =>  'sports_agency_h1_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Sigmar', sans-serif",
			'variant'       =>  '300',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '0.50px',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  array('.header-image-box h1'),
				'suffix' => '!important'
			],
		],
	) );

	//Heading 2 Section

	Kirki::add_section( 'sports_agency_h2_typography_setting', array(
		'title'    => __( 'Heading 2', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h2_typography_heading',
		'section'     => 'sports_agency_h2_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 2 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h2_typography_font',
		'section'   =>  'sports_agency_h2_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Sigmar', sans-serif",
			'font-size'       => '',
			'variant'       =>  '300',
			'line-height'   =>  '',
			'letter-spacing'    =>  '0.50px',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h2'
			],
		],
	) );

	//Heading 3 Section

	Kirki::add_section( 'sports_agency_h3_typography_setting', array(
		'title'    => __( 'Heading 3', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h3_typography_heading',
		'section'     => 'sports_agency_h3_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 3 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h3_typography_font',
		'section'   =>  'sports_agency_h3_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Outfit', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h3',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 4 Section

	Kirki::add_section( 'sports_agency_h4_typography_setting', array(
		'title'    => __( 'Heading 4', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h4_typography_heading',
		'section'     => 'sports_agency_h4_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 4 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h4_typography_font',
		'section'   =>  'sports_agency_h4_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Outfit', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h4',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 5 Section

	Kirki::add_section( 'sports_agency_h5_typography_setting', array(
		'title'    => __( 'Heading 5', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h5_typography_heading',
		'section'     => 'sports_agency_h5_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 5 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h5_typography_font',
		'section'   =>  'sports_agency_h5_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Outfit', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h5',
				'suffix' => '!important'
			],
		],
	) );

	//Heading 6 Section

	Kirki::add_section( 'sports_agency_h6_typography_setting', array(
		'title'    => __( 'Heading 6', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_h6_typography_heading',
		'section'     => 'sports_agency_h6_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading 6 Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_h6_typography_font',
		'section'   =>  'sports_agency_h6_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Outfit', sans-serif",
			'variant'       =>  '700',
			'font-size'       => '',
			'line-height'   =>  '',
			'letter-spacing'    =>  '',
			'text-transform'    =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   =>  'h6',
				'suffix' => '!important'
			],
		],
	) );

	//body Typography

	Kirki::add_section( 'sports_agency_body_typography_setting', array(
		'title'    => __( 'Content Typography', 'sports-agency' ),
		'panel'    => 'sports_agency_typography_panel',
		'priority' => 0,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_body_typography_heading',
		'section'     => 'sports_agency_body_typography_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Content  Typography', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'  =>  'typography',
		'settings'  => 'sports_agency_body_typography_font',
		'section'   =>  'sports_agency_body_typography_setting',
		'default'   =>  [
			'font-family'   =>  "'Outfit', sans-serif",
			'variant'       =>  '',
		],
		'transport'     =>  'auto',
		'output'        =>  [
			[
				'element'   => 'body',
				'suffix' => '!important'
			],
		],
	) );

	//Theme Options Panel

	Kirki::add_panel( 'sports_agency_theme_options_panel', array(
		'priority' => 10,
		'title'    => __( 'Theme Options', 'sports-agency' ),
	) );

	// HEADER SECTION

	Kirki::add_section( 'sports_agency_section_header',array(
		'title' => esc_html__( 'Header Settings', 'sports-agency' ),
		'description'    => esc_html__( 'Here you can add header information.', 'sports-agency' ),
		'panel' => 'sports_agency_theme_options_panel',
		'tabs'  => [
			'header' => [
				'label' => esc_html__( 'Header', 'sports-agency' ),
			],
			'menu'  => [
				'label' => esc_html__( 'Menu', 'sports-agency' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'sports_agency_menu_size_heading',
		'section'     => 'sports_agency_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Font Size(px)', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_menu_size',
		'tab'      => 'menu',
		'label'       => __( 'Enter a value in pixels. Example:20px', 'sports-agency' ),
		'type'        => 'text',
		'section'     => 'sports_agency_section_header',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => 'font-size',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'menu',
		'settings'    => 'sports_agency_menu_text_transform_heading',
		'section'     => 'sports_agency_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Menu Text Transform', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'menu',
		'settings'    => 'sports_agency_menu_text_transform',
		'section'     => 'sports_agency_section_header',
		'default'     => 'capitalize',
		'choices'     => [
			'none' => esc_html__( 'Normal', 'sports-agency' ),
			'uppercase' => esc_html__( 'Uppercase', 'sports-agency' ),
			'lowercase' => esc_html__( 'Lowercase', 'sports-agency' ),
			'capitalize' => esc_html__( 'Capitalize', 'sports-agency' ),
		],
		'output' => array(
			array(
				'element'  => array( '#main-menu a', '#main-menu ul li a', '#main-menu li a'),
				'property' => ' text-transform',
			),
		),
	));


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'sports_agency_phone_number_heading',
		'section'     => 'sports_agency_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Join Button', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Text', 'sports-agency' ),
		'settings' => 'sports_agency_header_button_text',
		'section'  => 'sports_agency_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'url',
		'tab'      => 'header',
		'label'    =>  esc_html__( 'Link', 'sports-agency' ),
		'settings' => 'sports_agency_header_button_url',
		'section'  => 'sports_agency_section_header',
		'default'  => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header',
		'settings'    => 'sports_agency_cart_enable_setting_heading',
		'section'     => 'sports_agency_section_header',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Cart Button', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header',
		'settings'    => 'sports_agency_cart_enable_setting',
		'label'       => esc_html__( 'Enable or Disable Cart', 'sports-agency' ),
		'section'     => 'sports_agency_section_header',
		'default'     => true,
		'priority'    => 10,
	] );

	// WOOCOMMERCE SETTINGS

	Kirki::add_section( 'sports_agency_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'sports-agency' ),
		'description'    => esc_html__( 'Woocommerce Settings of themes', 'sports-agency' ),
		'panel'    => 'woocommerce',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_shop_page_sidebar',
		'label'       => esc_html__( 'Enable/Disable Shop Page Sidebar', 'sports-agency' ),
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => 'false',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Shop Page Layouts', 'sports-agency' ),
		'settings'    => 'sports_agency_shop_page_layout',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'sports-agency' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'sports-agency' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_shop_page_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'label'       => esc_html__( 'Products Per Row', 'sports-agency' ),
		'settings'    => 'sports_agency_products_per_row',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => '4',
		'priority'    => 10,
		'choices'     => [
			'2' => '2',
			'3' => '3',
			'4' => '4',
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'label'       => esc_html__( 'Products Per Page', 'sports-agency' ),
		'settings'    => 'sports_agency_products_per_page',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => '8',
		'priority'    => 10,
		'choices'  => [
					'min'  => 0,
					'max'  => 50,
					'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_single_product_sidebar',
		'label'       => esc_html__( 'Enable / Disable Single Product Sidebar', 'sports-agency' ),
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => 'true',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'label'       => esc_html__( 'Single Product Layout', 'sports-agency' ),
		'settings'    => 'sports_agency_single_product_sidebar_layout',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'sports-agency' ),
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'sports-agency' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_single_product_sidebar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_products_button_border_radius_heading',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Products Button Border Radius', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'sports_agency_products_button_border_radius',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
		'choices'  => [
					'min'  => 1,
					'max'  => 50,
					'step' => 1,
				],
		'output' => array(
			array(
				'element'  => array('.woocommerce ul.products li.product .button',' a.checkout-button.button.alt.wc-forward','.woocommerce #respond input#submit', '.woocommerce a.button', '.woocommerce button.button','.woocommerce input.button','.woocommerce #respond input#submit.alt','.woocommerce button.button.alt','.woocommerce input.button.alt'),
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_sale_badge_position_heading',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Badge Position', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'sports_agency_sale_badge_position',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'     => 'right',
		'choices'     => [
			'right' => esc_html__( 'Right', 'sports-agency' ),
			'left' => esc_html__( 'Left', 'sports-agency' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_products_sale_font_size_heading',
		'section'     => 'sports_agency_woocommerce_settings',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Sale Font Size', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'text',
		'settings'    => 'sports_agency_products_sale_font_size',
		'section'     => 'sports_agency_woocommerce_settings',
		'priority'    => 10,
		'output' => array(
			array(
				'element'  => array('.woocommerce span.onsale','.woocommerce ul.products li.product .onsale'),
				'property' => 'font-size',
				'units' => 'px',
			),
		),
	] );
	
	//ADDITIONAL SETTINGS

	Kirki::add_section( 'sports_agency_additional_setting', array(
		'title'          => esc_html__( 'Additional Settings', 'sports-agency' ),
		'description'    => esc_html__( 'Additional Settings of themes', 'sports-agency' ),
		'panel'    => 'sports_agency_theme_options_panel',
		'priority'       => 10,
		'tabs'  => [
			'general' => [
				'label' => esc_html__( 'General', 'sports-agency' ),
			],
			'header-image'  => [
				'label' => esc_html__( 'Header Image', 'sports-agency' ),
			],
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_preloader_hide',
		'label'       => esc_html__( 'Here you can enable or disable your preloader.', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => false,
		'priority'    => 10,
		'tab'      => 'general',
	] );
 
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => true ,
		'priority'    => 10,
		'tab'      => 'general',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_scroll_alignment_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Position', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'radio-buttonset',
		'tab'      => 'general',
		'settings'    => 'sports_agency_scroll_alignment',
		'section'     => 'sports_agency_additional_setting',
		'default'     => 'right',
		'choices'     => [
			'left' => esc_html__( 'left', 'sports-agency' ),
			'center' => esc_html__( 'center', 'sports-agency' ),
			'right' => esc_html__( 'right', 'sports-agency' ),
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_scroller_border_radius_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Scroll To Top Border Radius', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'slider',
		'tab'      => 'general',
		'settings'    => 'sports_agency_scroller_border_radius',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '50',
		'choices'     => [
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		],
		'output' => array(
			array(
				'element'  => '.scroll-up a',
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_cursor_outline_heading',
		'section'     => 'sports_agency_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dot Cursor', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'sports_agency_cursor_outline',
		'label'       => esc_html__( 'Enable or Disable Dot Cursor', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_progress_bar_heading',
		'section'     => 'sports_agency_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'general',
		'settings'    => 'sports_agency_progress_bar',
		'label'       => esc_html__( 'Enable or Disable Progress Bar', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_progress_bar_position_heading',
		'section'     => 'sports_agency_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Position', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'sports_agency_progress_bar_position',
		'section'     => 'sports_agency_additional_setting',
		'default'     => 'top',
		'choices'     => [
			'top' => esc_html__( 'Top', 'sports-agency' ),
			'bottom' => esc_html__( 'Bottom', 'sports-agency' ),
		],
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_progress_bar_color_heading',
		'section'     => 'sports_agency_additional_setting',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Progress Bar Color', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_progress_bar_color',
		'tab'      => 'general',
		'label'       => __( 'Color', 'sports-agency' ),
		'type'        => 'color',
		'section'     => 'sports_agency_additional_setting',
		'transport' => 'auto',
		'default'     => '#479F49',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '#elemento-progress-bar',
				'property' => 'background-color',
			),
		),
		'active_callback'  => [
			[
				'setting'  => 'sports_agency_progress_bar',
				'operator' => '===',
				'value'    => true,
			],
		]
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'general',
		'settings'    => 'sports_agency_single_page_layout_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Page Layout', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'general',
		'settings'    => 'sports_agency_single_page_layout',
		'section'     => 'sports_agency_additional_setting',
		'default'     => 'One Column',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'sports-agency' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'sports-agency' ),
			'One Column' => esc_html__( 'One Column', 'sports-agency' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_background_attachment_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Attachment', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_background_attachment',
		'section'     => 'sports_agency_additional_setting',
		'default'     => 'scroll',
		'choices'     => [
			'scroll' => esc_html__( 'Scroll', 'sports-agency' ),
			'fixed' => esc_html__( 'Fixed', 'sports-agency' ),
		],
		'output' => array(
			array(
				'element'  => '.header-image-box',
				'property' => 'background-attachment',
			),
		),
	 ) );

	 Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_image_height_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image height', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_header_image_height',
		'label'       => __( 'Image Height', 'sports-agency' ),
		'description'    => esc_html__( 'Enter a value in pixels. Example:500px', 'sports-agency' ),
		'type'        => 'text',
		'tab'      => 'header-image',
		'default'    => [
			'desktop' => '400px',
			'tablet'  => '350px',
			'mobile'  => '200px',
		],
		'responsive' => true,
		'section'     => 'sports_agency_additional_setting',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.header-image-box'),
				'property' => 'height',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_overlay_heading',
		'section'     => 'sports_agency_additional_setting',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Header Image Overlay', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_header_overlay_setting',
		'tab'      => 'header-image',
		'label'       => __( 'Overlay Color', 'sports-agency' ),
		'type'        => 'color',
		'section'     => 'sports_agency_additional_setting',
		'transport' => 'auto',
		'default'     => '#02020282',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.header-image-box:before',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_page_title',
		'label'       => esc_html__( 'Enable / Disable Header Image Page Title.', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'header-image',
		'settings'    => 'sports_agency_header_breadcrumb',
		'label'       => esc_html__( 'Enable / Disable Header Image Breadcrumb.', 'sports-agency' ),
		'section'     => 'sports_agency_additional_setting',
		'default'     => '1',
		'priority'    => 10,
	] );

	// POST SECTION

	Kirki::add_section( 'sports_agency_blog_post', array(
		'title'          => esc_html__( 'Post Settings', 'sports-agency' ),
		'description'    => esc_html__( 'Here you can add post information.', 'sports-agency' ),
		'panel'    => 'sports_agency_theme_options_panel',
		'tabs'  => [
			'blog-post' => [
				'label' => esc_html__( 'Blog Post', 'sports-agency' ),
			],
			'single-post'  => [
				'label' => esc_html__( 'Single Post', 'sports-agency' ),
			],
		],
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_enable_post_animation_heading',
		'section'     => 'sports_agency_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Animation', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_enable_post_animation',
		'label'       => esc_html__( 'Enable or Disable Blog Post Animation', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_post_layout_heading',
		'section'     => 'sports_agency_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Layout', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_post_layout',
		'section'     => 'sports_agency_blog_post',
		'default'     => 'Right Sidebar',
		'choices'     => [
			'Left Sidebar' => esc_html__( 'Left Sidebar', 'sports-agency' ),
			'Right Sidebar' => esc_html__( 'Right Sidebar', 'sports-agency' ),
			'One Column' => esc_html__( 'One Column', 'sports-agency' ),
			'Three Columns' => esc_html__( 'Three Columns', 'sports-agency' ),
			'Four Columns' => esc_html__( 'Four Columns', 'sports-agency' ),
		],
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_date_hide',
		'label'       => esc_html__( 'Enable / Disable Post Date', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_author_hide',
		'label'       => esc_html__( 'Enable / Disable Post Author', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Post Comment', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_blog_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Post Image', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_length_setting_heading',
		'section'     => 'sports_agency_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Blog Post Content Limit', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'tab'      => 'blog-post',
		'settings'    => 'sports_agency_length_setting',
		'section'     => 'sports_agency_blog_post',
		'default'     => '15',
		'priority'    => 10,
		'choices'  => [
					'min'  => -10,
					'max'  => 40,
		 			'step' => 1,
				],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_single_post_date_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Date', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_single_post_author_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Author', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_single_post_comment_hide',
		'label'       => esc_html__( 'Enable / Disable Single Post Comment', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Tag', 'sports-agency' ),
		'settings'    => 'sports_agency_single_post_tag',
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'label'       => esc_html__( 'Enable / Disable Single Post Category', 'sports-agency' ),
		'settings'    => 'sports_agency_single_post_category',
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_single_post_featured_image',
		'label'       => esc_html__( 'Enable / Disable Single Post Image', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_single_post_radius',
		'section'     => 'sports_agency_blog_post',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Single Post Image Border Radius(px)', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_single_post_border_radius',
		'label'       => __( 'Enter a value in pixels. Example:15px', 'sports-agency' ),
		'type'        => 'text',
		'tab'      => 'single-post',
		'section'     => 'sports_agency_blog_post',
		'transport' => 'auto',
		'output' => array(
			array(
				'element'  => array('.post-img img'),
				'property' => 'border-radius',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_show_related_post_heading',
		'section'     => 'sports_agency_blog_post',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Related post', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'tab'      => 'single-post',
		'settings'    => 'sports_agency_show_related_post',
		'label'       => esc_html__( 'Enable or Disable Related post', 'sports-agency' ),
		'section'     => 'sports_agency_blog_post',
		'default'     => true,
		'priority'    => 10,
	] );

	// No Results Page Settings

	Kirki::add_section( 'sports_agency_no_result_section', array(
		'title'          => esc_html__( '404 & No Results Page Settings', 'sports-agency' ),
		'panel'    => 'sports_agency_theme_options_panel',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_page_not_found_title_heading',
		'section'     => 'sports_agency_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Title', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'sports_agency_page_not_found_title',
		'section'  => 'sports_agency_no_result_section',
		'default'  => esc_html__('404 Error!', 'sports-agency'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_page_not_found_text_heading',
		'section'     => 'sports_agency_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Page Text', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'sports_agency_page_not_found_text',
		'section'  => 'sports_agency_no_result_section',
		'default'  => esc_html__('The page you are looking for may have been moved, deleted, or possibly never existed.', 'sports-agency'),
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'     => 'custom',
		'settings' => 'sports_agency_page_not_found_line_break',
		'section'  => 'sports_agency_no_result_section',
		'default'  => '<hr>',
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_no_results_title_heading',
		'section'     => 'sports_agency_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Title', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'sports_agency_no_results_title',
		'section'  => 'sports_agency_no_result_section',
		'default'  => esc_html__('Nothing Found', 'sports-agency'),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_no_results_content_heading',
		'section'     => 'sports_agency_no_result_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Results Content', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'sports_agency_no_results_content',
		'section'  => 'sports_agency_no_result_section',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sports-agency'),
	] );
	
	// FOOTER SECTION

	Kirki::add_section( 'sports_agency_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'sports-agency' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'sports-agency' ),
        'panel'    => 'sports_agency_theme_options_panel',
		'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_show_footer_widget_heading',
		'section'     => 'sports_agency_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_show_footer_widget',
		'label'       => esc_html__( 'Footer Widget', 'sports-agency' ),
		'section'     => 'sports_agency_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_show_footer_copyright',
		'label'       => esc_html__( 'Footer Copyright', 'sports-agency' ),
		'section'     => 'sports_agency_footer_section',
		'default'     => '1',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_text_heading',
		'section'     => 'sports_agency_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'sports_agency_footer_text',
		'section'  => 'sports_agency_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_enable_heading',
		'section'     => 'sports_agency_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'sports_agency_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'sports-agency' ),
		'section'     => 'sports_agency_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'sports-agency' ),
			'off' => esc_html__( 'Disable', 'sports-agency' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_background_widget_heading',
		'section'     => 'sports_agency_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Background', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id',
	[
		'settings'    => 'sports_agency_footer_background_widget',
		'type'        => 'background',
		'section'     => 'sports_agency_footer_section',
		'default'     => [
			'background-color'      => 'rgba(23,20,20,1)',
			'background-image'      => '',
			'background-repeat'     => 'no-repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.footer-widget',
			],
		],
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_widget_alignment_heading',
		'section'     => 'sports_agency_footer_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Widget Alignment', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'select',
		'settings'    => 'sports_agency_footer_widget_alignment',
		'section'     => 'sports_agency_footer_section',
		'default'     =>[
			'desktop' => 'left',
			'tablet'  => 'left',
			'mobile'  => 'center',
		],
		'responsive' => true,
		'label'       => __( 'Widget Alignment', 'sports-agency' ),
		'transport' => 'auto',
		'choices'     => [
			'center' => esc_html__( 'center', 'sports-agency' ),
			'right' => esc_html__( 'right', 'sports-agency' ),
			'left' => esc_html__( 'left', 'sports-agency' ),
		],
		'output' => array(
			array(
				'element'  => '.footer-area',
				'property' => 'text-align',
				'media_query' => [
					'desktop' => '@media (min-width: 1024px)',
					'tablet'  => '@media (min-width: 768px) and (max-width: 1023px)',
					'mobile'  => '@media (max-width: 767px)',
				],
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_copright_color_heading',
		'section'     => 'sports_agency_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Background Color', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_footer_copright_color',
		'type'        => 'color',
		'label'       => __( 'Background Color', 'sports-agency' ),
		'section'     => 'sports_agency_footer_section',
		'transport' => 'auto',
		'default'     => '#479F49',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => '.footer-copyright',
				'property' => 'background',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_copright_text_color_heading',
		'section'     => 'sports_agency_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Copyright Text Color', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_footer_copright_text_color',
		'type'        => 'color',
		'label'       => __( 'Text Color', 'sports-agency' ),
		'section'     => 'sports_agency_footer_section',
		'transport' => 'auto',
		'default'     => '#ffffff',
		'choices'     => [
			'alpha' => true,
		],
		'output' => array(
			array(
				'element'  => array( '.footer-copyright a', '.footer-copyright p'),
				'property' => 'color',
			),
		),
	) );

	// Footer Social Icons Section

	Kirki::add_section( 'sports_agency_footer_social_media_section', array(
		'title'          => esc_html__( 'Footer Social Icons', 'sports-agency' ),
		'panel'    => 'sports_agency_theme_options_panel',
		'priority'       => 160,
	) );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_footer_social_icon_hide_heading',
		'section'     => 'sports_agency_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable or Disable your Footer Social Icon', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'sports_agency_footer_social_icon_hide',
		'label'       => esc_html__( 'Enable or Disable Social Icon.', 'sports-agency' ),
		'section'     => 'sports_agency_footer_social_media_section',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'sports_agency_enable_footer_socail_link_align_heading',
		'section'     => 'sports_agency_footer_social_media_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Text Align', 'sports-agency' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', array(
		'settings'    => 'sports_agency_enable_footer_socail_link_align',
		'type'        => 'select',
		'priority'    => 10,
		'label'       => __( 'Text Align', 'sports-agency' ),
		'section'     => 'sports_agency_footer_social_media_section',
		'default'     => 'left',
		'choices'     => [
			'center' => esc_html__( 'center', 'sports-agency' ),
			'right' => esc_html__( 'right', 'sports-agency' ),
			'left' => esc_html__( 'left', 'sports-agency' ),
		],
		'output' => array(
			array(
				'element'  => array( '.footer-links'),
				'property' => 'text-align',
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'priority'    => 10,
		'settings'    => 'sports_agency_enable_footer_socail_link',
		'section'     => 'sports_agency_footer_social_media_section',
		'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Social Media Link', 'sports-agency' ) . '</h3>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'priority'    => 10,
		'section'     => 'sports_agency_footer_social_media_section',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icons', 'sports-agency' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'sports-agency' ),
		'settings'     => 'sports_agency_social_links_settings_footer',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'sports-agency' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'sports-agency' ). ' <a href="https://fontawesome.com/v6/search?ic=brands" target="_blank"><strong>' . esc_html__( 'View All', 'sports-agency' ) . ' </strong></a>',
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'sports-agency' ),
				'description' => esc_html__( 'Add the social icon url here.', 'sports-agency' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 20
		],
	] );

	load_template( trailingslashit( get_template_directory() ) . '/includes/logo/logo-resizer.php' );
}
