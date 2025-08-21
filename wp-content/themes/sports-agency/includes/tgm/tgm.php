<?php
	
require get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function sports_agency_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'sports-agency' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WPElemento Importer', 'sports-agency' ),
			'slug'             => 'wpelemento-importer',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Elementor', 'sports-agency' ),
			'slug'             => 'elementor',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Woocommerce', 'sports-agency' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'ShopLentor – WooCommerce Builder ', 'sports-agency' ),
			'slug'             => 'woolentor-addons',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'YITH WooCommerce Wishlist', 'sports-agency' ),
			'slug'             => 'yith-woocommerce-wishlist',
			'required'         => false,
			'force_activation' => false,
		)
	);
	$config = array();
	sports_agency_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'sports_agency_register_recommended_plugins' );
