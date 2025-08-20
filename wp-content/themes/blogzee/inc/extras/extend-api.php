<?php
/**
 * Endpoints for custom control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'Blogzee_Extend_Api' ) ) :
    /**
     * Register api
     * 
     * @since 1.0.0
     */
    class Blogzee_Extend_Api {
        /**
         * Route of the api
         * 
         * @since 1.0.0
         */
        protected $route = 'blogzee/v1/extend';

        /**
         * Method that gets called when class is instantiated
         * 
         * @since 1.0.0
         */
        public function __construct() {
            $this->init();
        }

        /**
         * Register the api when class is called
         * 
         * @since 1.0.0
         */
        public function init() {
            add_action( 'rest_api_init', function(){
                register_rest_route(
                    $this->route,
                    '/(?P<action>\w+)/',    // named capturing group, regular expression
                    [
                        'methods' => 'GET',
                        'callback' =>  [ $this, 'callback' ],
                        'permission_callback' => '__return_true'
                    ]
                );
            } );
        }

        /**
         * api callback
         * 
         * @since 1.0.0
         */
        public function callback( $request ) {
            return $this->{ $request['action'] }( $request );
        }

        /**
         * Get all posts
         * 
         * @since 1.0.0
         */
        public function get_posts( $request ) {
            if( ! current_user_can( 'edit_posts' ) ) return;

            $options = [];
            $query_args = [
                'post_status'   =>  'publish',
                'posts_per_page'    =>  100,
                'ignore_sticky_posts'   =>  true,
            ];
            if ( isset( $request['query_slug'] ) ) $query_args['post_type'] = $request['query_slug'];
            if ( isset( $request['s'] ) ) $query_args['s'] = $request['s'];
            if ( isset( $request['exclude'] ) ) :
                $ids = explode( ',', $request['exclude'] );
                $query_args['post__not_in'] = $ids;
            endif;

            $query = new \WP_Query( $query_args );
            if( $query->have_posts() ) :
                while( $query->have_posts() ) :
                    $query->the_post();
                    $options[] = [
                        'value' => get_the_ID(),
                        'label' => html_entity_decode( get_the_title() ),
                    ];
                endwhile;
                wp_reset_postdata();
            endif;
            return $options;
        }

        /**
         * Get all taxonomy, category or tag
         * 
         * @since 1.0.0
         */
        public function get_taxonomy( $request ) {
            if( ! current_user_can( 'edit_posts' ) ) return;

            $options = [];
            $query_args = [
                'orderby' => 'name', 
                'order' => 'DESC',
                'hide_empty' => true,
                'number' => 6,
                'fields'    =>  'ids'
            ];
            if ( isset( $request['query_slug'] ) ) $query_args['taxonomy'] = $request['query_slug'];
            if ( isset( $request['s'] ) ) $query_args['name__like'] = $request['s'];
            if ( isset( $request['exclude'] ) ) $query_args['exclude'] = $request['exclude'];
        
            $terms = get_terms( $query_args );
            if( ! empty( $terms ) && is_array( $terms ) ) :
                foreach( $terms as $id ) :

                    if( $request['query_slug'] == 'post_tag' ) :
                        $label_args = get_tag( $id );
                        $label = $label_args->name;
                    else :
                        $label = get_cat_name( $id );
                    endif;

                    $options[] = [
                        'value' => absint( $id ),
                        'label' =>  sanitize_text_field( $label )
                    ];
                    
                endforeach;
                wp_reset_postdata();
            endif;
            return $options;
        }


        /**
         * get all users
         * 
         * @since 1.0.0
         */
        public function get_users( $request ) {
            if ( ! current_user_can( 'edit_posts' ) ) return;
    
            $query_args = [
                'number' => 6,
                'fields'    =>  [ 'ID', 'display_name' ]
            ];

            if ( isset( $request['exclude'] ) ) :
                $ids = explode( ',', $request['exclude'] );
                $query_args['exclude'] = $ids;
            endif;
    
            if ( isset( $request['s'] ) ) $query_args['search'] = '*'. $request['s'] .'*';
    
            $options = [];
            $user_query = new \WP_User_Query( $query_args );
    
            if ( ! empty( $user_query->get_results() ) ) :
                foreach ( $user_query->get_results() as $user ) :
                    $options[] = [
                        'value' => absint( $user->ID ),
                        'label' => sanitize_text_field( $user->display_name )
                    ];
                endforeach;
            endif;

            wp_reset_postdata();
            return $options;
        }
    }
    new Blogzee_Extend_Api();
endif;