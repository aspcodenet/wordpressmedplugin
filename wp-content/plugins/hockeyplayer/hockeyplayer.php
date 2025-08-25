<?php
/**
 * Plugin Name: HockeyPlayer CPT
 * Description: Hockeyspelare bla bla
 * Version: 1.0
 * Author: Stefan
 */


// Do not load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

class HockeyPlayer_CPT {
    private static $instance = null;
    private function __construct(){
        add_action( 'init', array($this, 'register_hockeyplayer_cpt') );
        add_shortcode('AllaSpelare', array($this, 'alla_spelare_shortcode'));
    }

    function alla_spelare_shortcode(){
        // Loopa alla spelare från databasen
        $args = array(
                'post_type'      => 'hockeyplayer',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC'
            );

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $output = '<div>';
            while ($query->have_posts()) {
                $query->the_post();
                $output .= '<div>' . get_the_title() ;
                if (has_post_thumbnail()) {
                    $output .= get_the_post_thumbnail(get_the_ID(), 'medium');
                }                
                    $output .= get_the_content();
                $output .= 'Född: ' . get_post_meta(get_the_ID(), 'birth_year', true);
                $output. '</div><hr/>';
            }
            $output .= '</div>';
            wp_reset_postdata(); // se till att inte sabba riktiga loopen
            return $output;
        } else {
            return '<p>Inga hockeyspelare hittades.</p>';
        }
    }

    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    function register_hockeyplayer_cpt() {
        $labels = array(
            'name'          => 'Hockey Players',
            'singular_name' => 'Hockey Player',
            'menu_name'     => 'Hockey Players',
            'all_items'     => 'All Hockey Players',
            'add_new_item'  => 'Add New cool Hockey Player',
            'add_new'       => 'Add New',
            'edit_item'     => 'Edit Hockey Player',
            'search_items'  => 'Search Hockey Players',
        );


        $args = array(
            'labels'        => $labels,  // Vi kan styra texterna i admin läget
            'public'        => true,
            'has_archive'   => true,
            'menu_icon'     => 'dashicons-visibility', // Eller en annan lämplig ikon
            'supports'      => array( 'title', 'editor', 'thumbnail' ), // Stöd för titel och miniatyrbild
            'rewrite'       => array( 'slug' => 'hockeyplayers' ),
        );

        register_post_type( 'hockeyplayer', $args );
    }


};

HockeyPlayer_CPT::get_instance();




// function register_hockeyplayer_cpt() {
//     $labels = array(
//         'name'          => 'Hockey Players',
//         'singular_name' => 'Hockey Player',
//         'menu_name'     => 'Hockey Players',
//         'all_items'     => 'All Hockey Players',
//         'add_new_item'  => 'Add New cool Hockey Player',
//         'add_new'       => 'Add New',
//         'edit_item'     => 'Edit Hockey Player',
//         'search_items'  => 'Search Hockey Players',
//     );


//     $args = array(
//         'labels'        => $labels,  // Vi kan styra texterna i admin läget
//         'public'        => true,
//         'has_archive'   => true,
//         'menu_icon'     => 'dashicons-visibility', // Eller en annan lämplig ikon
//         'supports'      => array( 'title', 'editor', 'thumbnail' ), // Stöd för titel och miniatyrbild
//         'rewrite'       => array( 'slug' => 'hockeyplayers' ),
//     );

//     register_post_type( 'hockeyplayer', $args );
// }
// add_action( 'init', 'register_hockeyplayer_cpt' );

?>