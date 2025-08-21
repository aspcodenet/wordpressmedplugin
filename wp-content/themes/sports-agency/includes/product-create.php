<?php

class Whizzie {

	public function __construct() {
		$this->init();
	}

	public function init()
	{
	
	}

	public static function sports_agency_setup_widgets(){

	set_theme_mod( 'sports_agency_header_button_text', 'Join Now' );
	set_theme_mod( 'sports_agency_header_button_url', '#' );

	$sports_agency_product_image_gallery = array();
	$sports_agency_product_ids = array();

	$sports_agency_product_category= array(
		'Football'       => array(
			'Balls',
			'Running Shoes',
			'Accessories',
			'Jerseys',
		),
		'Cricket'       => array(
			'Jerseys',
			'Balls',
			'Running Shoes',
			'Accessories',
		),
		'Base Ball'       => array(
			'Accessories',
			'Jerseys',
			'Balls',
			'Running Shoes',
		),
		'Tennis'       => array(
			'Running Shoes',
			'Accessories',
			'Jerseys',
			'Balls',
		),
		'Cycling'       => array(
			'Running Shoes',
			'Jerseys',
			'Accessories',
			'Balls',
		),
		'Rugby'       => array(
			'Jerseys',
			'Running Shoes',
			'Accessories',
			'Balls',
		)
	);
	$sports_agency_k = 1;
	foreach ( $sports_agency_product_category as $sports_agency_product_cats => $sports_agency_products_name ) { 
	// Insert porduct cats Start
	$content = 'This is sample product category';
	$sports_agency_parent_category	=	wp_insert_term(
	$sports_agency_product_cats, // the term
	'product_cat', // the taxonomy
		array(
		'description'=> $content,
		'slug' => str_replace( ' ', '-', $sports_agency_product_cats)
		)
	);

// -------------- create subcategory END -----------------

	$sports_agency_n=1;
	// create Product START
	foreach ( $sports_agency_products_name as $key => $sports_agency_product_title ) {
	$content = '
		<div class="main_content">
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		</div>';

	// Create post object
	$sports_agency_my_post = array(
		'post_title'    => wp_strip_all_tags( $sports_agency_product_title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'product',
		'post_category' => [$sports_agency_parent_category['term_id']]
	);

	// Insert the post into the database

	$sports_agency_uqpost_id = wp_insert_post($sports_agency_my_post);
	wp_set_object_terms( $sports_agency_uqpost_id, str_replace( ' ', '-', $sports_agency_product_cats), 'product_cat', true );

	$sports_agency_product_price = array('18','18','18','18');
	$sports_agency_product_regular_price = array('18','18','18','18');
	$sports_agency_product_sale_price = array('18','18','18','18');
	
	update_post_meta( $sports_agency_uqpost_id, '_regular_price', $sports_agency_product_regular_price[$sports_agency_n-1] );
	update_post_meta( $sports_agency_uqpost_id, '_price', $sports_agency_product_price[$sports_agency_n-1] );
	update_post_meta( $sports_agency_uqpost_id, '_sale_price', $sports_agency_product_sale_price[$sports_agency_n-1] );
	array_push( $sports_agency_product_ids,  $sports_agency_uqpost_id );

	// Now replace meta w/ new updated value array
	$sports_agency_image_url = get_template_directory_uri().'/assets/images/product/'.$sports_agency_product_cats.'/' . str_replace(' ', '_', strtolower($sports_agency_product_title)).'.png';
	$sports_agency_image_name  = $sports_agency_product_title.'.png';
	$sports_agency_upload_dir = wp_upload_dir();
	// Set upload folder
	$sports_agency_image_data = file_get_contents(esc_url($sports_agency_image_url));
	// Get image data
	$unique_file_name = wp_unique_filename($sports_agency_upload_dir['path'], $sports_agency_image_name);
	// Generate unique name
	$sports_agency_filename = basename($unique_file_name);
	// Create image file name
	// Check folder permission and define file location
	if (wp_mkdir_p($sports_agency_upload_dir['path'])) {
	$sports_agency_file = $sports_agency_upload_dir['path'].'/'.$sports_agency_filename;
	} else {
	$sports_agency_file = $sports_agency_upload_dir['basedir'].'/'.$sports_agency_filename;
	}
	
	file_put_contents($sports_agency_file, $sports_agency_image_data);
	// Check image file type
	$wp_filetype = wp_check_filetype($sports_agency_filename, null);
	// Set attachment data
	$attachment = array(
	'post_mime_type' => $wp_filetype['type'],
	'post_title'     => sanitize_file_name($sports_agency_filename),
	'post_type'      => 'product',
	'post_status'    => 'inherit',
	);

	// Create the attachment
	$sports_agency_attach_id = wp_insert_attachment($attachment, $sports_agency_file, $sports_agency_uqpost_id);

	// Define attachment metadata
	$attach_data = wp_generate_attachment_metadata($sports_agency_attach_id, $sports_agency_file);

	// Assign metadata to attachment
	wp_update_attachment_metadata($sports_agency_attach_id, $attach_data);
	if ( count( $sports_agency_product_image_gallery ) < 3 ) {
		array_push( $sports_agency_product_image_gallery, $sports_agency_attach_id );
	}
	// // And finally assign featured image to post
	set_post_thumbnail($sports_agency_uqpost_id, $sports_agency_attach_id);
	++$sports_agency_n;
	}
	// Create product END
	++$sports_agency_k;
	}
	// Add Gallery in first simple product and second variable product START
	$sports_agency_product_image_gallery = implode( ',', $sports_agency_product_image_gallery );
	foreach ( $sports_agency_product_ids as $sports_agency_product_id ) {
	update_post_meta( $sports_agency_product_id, 'sports_agency_product_image_gallery', $sports_agency_product_image_gallery );
	}
}

}
 