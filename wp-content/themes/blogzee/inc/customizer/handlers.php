<?php
use Blogzee\CustomizerDefault as BZ;

/**
 * Binds JS handlers to make theme customizer preview reload changes asynchronously
 */
add_action( 'customize_preview_init', function() {
    wp_enqueue_script(
        'blogzee-customizer-preview',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-preview.min.js',
        ['customize-preview'],
        BLOGZEE_VERSION,
        [ 'strategy'  =>  'defer', 'in_footer' =>  true ]
    );

    // localize scripts
    wp_localize_script(
        'blogzee-customizer-preview',
        'blogzeePreviewObject', 
        [
            '_wpnonce'  =>  wp_create_nonce( 'blogzee-customizer-nonce' ),
            'ajaxUrl'   =>  admin_url( 'admin-ajax.php' ),
            'totalCats' => get_categories() ? get_categories([ 'fields' => 'ids' ]) : [],
            'totalTags' => ( get_tags() && blogzee_is_widget_being_used( 'blogzee_tags_collection_widget' ) ) ? get_tags([ 'fields' => 'ids' ]) : []
        ]
    );
});

add_action( 'customize_controls_enqueue_scripts', function(){
    $buildControlsDeps = apply_filters(  'blogzee_customizer_build_controls_dependencies', 
        [
            'react',
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-i18n',
            'wp-polyfill',
            'jquery',
            'wp-components'
        ]
    );

    wp_enqueue_style(
        'blogzee-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-controls.min.css',
        ['wp-components'],
        BLOGZEE_VERSION,
        'all'
    );

    wp_enqueue_style(
        'blogzee-builder-style',
        get_template_directory_uri() .'/inc/customizer/assets/builder.min.css',
        ['wp-components'],
        BLOGZEE_VERSION,
        'all'
    );
    
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );

    wp_enqueue_script(
        'blogzee-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-extends.min.js',
        $buildControlsDeps,
        BLOGZEE_VERSION,
        [ 'strategy'  =>  'defer', 'in_footer' =>  true ]
    );

    wp_enqueue_script( 
        'customizer-customizer-extras',
        get_template_directory_uri() . '/inc/customizer/assets/extras.min.js',
        [ 'jquery', 'customize-controls' ],
        BLOGZEE_VERSION,
        [ 'strategy' => 'defer', 'in_footer' => true ]
    );

    $nexus_collective = function( $type ) {
        return blogzee_wp_query( $type );
    };
    wp_localize_script( 
        'customizer-customizer-extras', 
        'customizerExtrasObject', [
            '_wpnonce'	=> wp_create_nonce( 'blogzee-customizer-controls-nonce' ),
            'ajaxUrl' => esc_url( admin_url('admin-ajax.php') ),
            'custom'    =>  [
                'single_section_panel'   =>  $nexus_collective( 'post' ),
                'page_settings_section'   =>  $nexus_collective( 'page' ),
                'archive_general_section'   =>  home_url() . '/',
                'category_archive_section'  =>  $nexus_collective( 'category' ),
                'tag_archive_section'  =>  $nexus_collective( 'tag' ),
                'author_archive_section'  =>  $nexus_collective( 'author' )
            ],
            'custom_callback'   =>  [
                'bottom_footer_header_or_custom'    =>  [
                    'custom'    =>  [ 'bottom_footer_logo_option' ]
                ],
                /* Header Builder custom callbacks */
                'header_first_row_column'   =>  [
                    '1' =>  [ 'header_first_row_column_one' ],
                    '2' =>  [ 'header_first_row_column_one', 'header_first_row_column_two' ],
                    '3' =>  [ 'header_first_row_column_one', 'header_first_row_column_two', 'header_first_row_column_three' ],
                    '4' =>  [ 'header_first_row_column_one', 'header_first_row_column_two', 'header_first_row_column_three', 'header_first_row_column_four' ],
                ],
                'header_second_row_column'  =>  [
                    '1' =>  [ 'header_second_row_column_one' ],
                    '2' =>  [ 'header_second_row_column_one', 'header_second_row_column_two' ],
                    '3' =>  [ 'header_second_row_column_one', 'header_second_row_column_two', 'header_second_row_column_three' ],
                    '4' =>  [ 'header_second_row_column_one', 'header_second_row_column_two', 'header_second_row_column_three', 'header_second_row_column_four' ],
                ],
                'header_third_row_column'   =>  [
                    '1' =>  [ 'header_third_row_column_one' ],
                    '2' =>  [ 'header_third_row_column_one', 'header_third_row_column_two' ],
                    '3' =>  [ 'header_third_row_column_one', 'header_third_row_column_two', 'header_third_row_column_three' ],
                    '4' =>  [ 'header_third_row_column_one', 'header_third_row_column_two', 'header_third_row_column_three', 'header_third_row_column_four' ],
                ],
                /* Footer Builder custom callbacks */
                'footer_first_row_column'   =>  [
                    '1' =>  [ 'footer_first_row_column_one' ],
                    '2' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two' ],
                    '3' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three' ],
                    '4' =>  [ 'footer_first_row_column_one', 'footer_first_row_column_two', 'footer_first_row_column_three', 'footer_first_row_column_four' ],
                ],
                'footer_second_row_column'  =>  [
                    '1' =>  [ 'footer_second_row_column_one' ],
                    '2' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two' ],
                    '3' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three' ],
                    '4' =>  [ 'footer_second_row_column_one', 'footer_second_row_column_two', 'footer_second_row_column_three', 'footer_second_row_column_four' ],
                ],
                'footer_third_row_column'   =>  [
                    '1' =>  [ 'footer_third_row_column_one' ],
                    '2' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two' ],
                    '3' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three' ],
                    '4' =>  [ 'footer_third_row_column_one', 'footer_third_row_column_two', 'footer_third_row_column_three', 'footer_third_row_column_four' ],
                ],
                'header_buiilder_header_sticky' =>  [
                    'true'  =>  [ 'header_first_row_header_sticky', 'header_second_row_header_sticky', 'header_third_row_header_sticky' ]
                ]
            ]
        ]
    );
});

// extract to the customizer js
$blogzeeAddAction = function() {
    $action_prefix = "wp_ajax_" . "blogzee_";
    // retrieve posts with search key
    add_action( $action_prefix . 'get_multicheckbox_posts_simple_array', function() {
        check_ajax_referer( 'blogzee-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $post_args = [ 'numberposts' => 10, 's' => esc_html( $searchKey ) ];
        $posts_list = get_posts( apply_filters( 'blogzee_query_args_filter', $post_args ) );
        foreach( $posts_list as $postItem ) :
            $posts_array[] = [ 
                'value'	=> absint( $postItem->ID ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $postItem->post_title ) )
            ];
        endforeach;
        wp_send_json_success( $posts_array );
        wp_die();
    });

    // retrieve categories with search key
    add_action( $action_prefix . 'get_multicheckbox_categories_simple_array', function() {
        check_ajax_referer( 'blogzee-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $categories_list = get_categories( [ 'number' => 10, 'search' => esc_html( $searchKey ) ] );
        $categories_array = [];
        foreach( $categories_list as $categoryItem ) :
            $categories_array[] = [
                'value'	=> absint( $categoryItem->term_id ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $categoryItem->name ) ) . ' (' .absint( $categoryItem->count ) . ')'
            ];
        endforeach;
        wp_send_json_success( $categories_array );
        wp_die();
    });

    // retrieve tags with search key
    add_action( $action_prefix . 'get_multicheckbox_tags_simple_array', function() {
        check_ajax_referer( 'blogzee-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $tags_list = get_tags( [ 'number' => 10, 'search' => esc_html( $searchKey ) ] );
        $tags_array = [];
        foreach( $tags_list as $tagItem ) :
            $tags_array[] = [
                'value'	=> absint( $tagItem->term_id ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $tagItem->name ) )
            ];
        endforeach;
        wp_send_json_success( $tags_array );
        wp_die();
    });

    // retrieve authors with search key
    add_action( $action_prefix . 'get_multicheckbox_authors_simple_array', function() {
        check_ajax_referer( 'blogzee-customizer-controls-live-nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ) : '';
        $users_list = get_users( [ 'number' => 10, 'search' => esc_html($searchKey ) ] );
        foreach( $users_list as $userItem ) :
            $users_array[] = [
                'value'	=> absint( $userItem->ID ),
                'label'	=> esc_html( str_replace( [ '\'', '"' ], '', $userItem->display_name ) )
            ];
        endforeach;
        wp_send_json_success( $users_array );
        wp_die();
    });

    // typography fonts url
    add_action( $action_prefix . 'typography_fonts_url', function() {
        check_ajax_referer( 'blogzee-customizer-nonce', 'security' );
		// enqueue inline style
		ob_start();
			echo esc_url( blogzee_typo_fonts_url() );
        $blogzee_typography_fonts_url = ob_get_clean();
		echo apply_filters( 'blogzee_typography_fonts_url', esc_url( $blogzee_typography_fonts_url ) );
		wp_die();
	});
};
$blogzeeAddAction();

// Imports previous customizer settings on exists
add_action( "wp_ajax_blogzee_import_custmomizer_setting", function() {
    check_ajax_referer( 'blogzee-customizer-controls-nonce', 'security' );
    $n_setting = wp_get_theme()->get_stylesheet();
    $old_setting = get_option( 'theme_mods_blogzee' );
    if( ! $old_setting ) return;
    $current_setting = get_option( 'theme_mods_' . $n_setting );
    if( update_option( 'theme_mods_' .$n_setting. '-old', $current_setting ) ) {
        if( update_option( 'theme_mods_' . $n_setting, $old_setting ) ) {
            return true;
        }
    }
    return;
    wp_die();
});

if( ! function_exists( 'blogzee_wp_query' ) ) :
    /**
     * Returns permalink
     * 
     * @param post_type
     * @since 1.0.0
     * @package Blogzee Pro
     */
    function blogzee_wp_query( $type ) {
        $permalink = home_url();
        switch( $type ) :
            case ( in_array( $type, [ 'page', 'post' ] ) ):
                    $type_args = [
                        'post_type'	=>	$type,
                        'posts_per_page'	=>	1,
                        'orderby'	=>	'rand'	
                    ];
                    if( $type == 'search' ) $type_args['s'] = 'a';
                    $type_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $type_args ) );
                    if( $type_query->have_posts() ) :
                        while( $type_query->have_posts() ):
                            $type_query->the_post();
                            $permalink = get_the_permalink();
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    return $permalink;
                break;
            case ( in_array( $type, [ 'tag', 'category' ] ) ):
                    $nexus_collective = function( $args ){
                        return get_terms( $args );
                    };
                    $taxonomy = ( $type == 'category' ) ? 'category' : 'post_tag';
                    $total = count( $nexus_collective([ 'taxonomy'  =>  $taxonomy, 'number' => 0 ]) );
                    $random_number = rand( 0, ( $total - 1 ) );
                    $taxonomy_args = [
                        'orderby'   =>  'rand',
                        'number'    =>  1,
                        'taxonomy'  =>  $taxonomy,
                        'offset'	=>	$random_number
                    ];
                    $get_taxonomies = $nexus_collective( $taxonomy_args );
                    if( ! empty( $get_taxonomies ) && is_array( $get_taxonomies ) ) :
                        foreach( $get_taxonomies as $taxonomy ) :
                            $permalink = get_term_link( $taxonomy->term_id );
                        endforeach;
                    endif;
                    return $permalink;
                break;
            case 'author':
                    $nexus_collective = function( $args ) {
                        return new \WP_User_Query( $args );
                    };
                    $total = $nexus_collective( [ 'number' => 0 ] )->get_total();
                    $random_number = rand( 0, ( $total - 1 ) );
                    $author_args = [
                        'number'    =>  1,
                        'offset'    =>  $random_number
                    ];
                    $user_query = $nexus_collective( $author_args );
                    if ( ! empty( $user_query->get_results() ) ) :
                        foreach ( $user_query->get_results() as $user ) :
                            $permalink = get_author_posts_url( $user->data->ID );
                        endforeach;
                    endif;
                    wp_reset_postdata();
                    return $permalink;
                break;
        endswitch;
    }
endif;