<?php
/**
 * Handle the wigets files and hooks
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blogzee_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blogzee' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// left sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'blogzee' ),
			'id'            => 'sidebar-left',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// header toggle sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Canvas Menu Sidebar', 'blogzee' ),
			'id'            => 'canvas-menu-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);
	
	// footer sidebar - column 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 1', 'blogzee' ),
			'id'            => 'footer-sidebar-column-one',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 2', 'blogzee' ),
			'id'            => 'footer-sidebar-column-two',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 3', 'blogzee' ),
			'id'            => 'footer-sidebar-column-three',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span class="divider"></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	// footer sidebar - column 4
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar - Column 4', 'blogzee' ),
			'id'            => 'footer-sidebar-column-four',
			'description'   => esc_html__( 'Add widgets here.', 'blogzee' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title"><span></span><span>',
			'after_title'   => '</span></h2>',
		)
	);

	register_widget( 'Blgocast_WP_Heading_Widget' );
	register_widget( 'Blogzee_Author_Info_Widget' );
	register_widget( 'Blogzee_Category_Collection_Widget' );
	register_widget( 'Blogzee_Tags_Collection_Widget' );
	register_widget( 'Blogzee_Post_Grid_Widget' );
	register_widget( 'Blogzee_Post_List_Widget' );
	register_widget( 'Blogzee_Social_Platforms_Widget' );
	register_widget( 'Blogzee_Carousel_Widget' );
	register_widget( 'Blogzee_Posts_Grid_Two_Column_Widget' );
}
add_action( 'widgets_init', 'blogzee_widgets_init' );

if( ! function_exists( 'blogzee_widget_scripts' ) ) :
	/**
	 * Enqueue styles and scripts for widget
	 * 
	 * @since 1.0.0
	 * @package Blogzee Pro
	 */
	function blogzee_widget_scripts( $hook ) {
		if( $hook != 'widgets.php' ) return;
		wp_enqueue_style( 'blogzee-widget', get_template_directory_uri() .'/inc/widgets/assets/widget.css', [], BLOGZEE_VERSION );
		wp_enqueue_style( 'blogzee-select2', get_template_directory_uri() . '/assets/external/select2/select2.min.css', [], '4.1.0', 'all' );
		wp_enqueue_media();
		wp_enqueue_script( 'blogzee-widget', get_template_directory_uri() .'/inc/widgets/assets/widget.js', ['jquery'], BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
		wp_enqueue_script( 'blogzee-select2', get_template_directory_uri() .'/assets/external/select2/select2.min.js', ['jquery'], BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
		wp_localize_script( 'blogzee-widget', 'widgetData', [
			'widgetAjaxUrl'	=>	admin_url( 'admin-ajax.php' ),
			'widgetNonce'	=>	wp_create_nonce( 'blogzee_widget_nonce' )
		]
		);
	}
	add_action( 'admin_enqueue_scripts', 'blogzee_widget_scripts' );
endif;

require get_template_directory() . '/inc/widgets/heading.php';
require get_template_directory() . '/inc/widgets/author-info.php';
require get_template_directory() . '/inc/widgets/category-collection.php';
require get_template_directory() . '/inc/widgets/tags-collection.php';
require get_template_directory() . '/inc/widgets/post-grid.php';
require get_template_directory() . '/inc/widgets/post-list.php';
require get_template_directory() . '/inc/widgets/social-platforms.php';
require get_template_directory() . '/inc/widgets/widget-fields.php';
require get_template_directory() . '/inc/widgets/carousel.php';
require get_template_directory() . '/inc/widgets/posts-grid-two-column.php';