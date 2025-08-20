<?php
/**
 * Frontpage section hooks and function for the theme
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;
 
 if( ! function_exists( 'blogzee_article_masonry' ) ) :
    /**
     * Masonry articles element
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_article_masonry() {
        $query_args = [
            'post_type' =>  'post',
            'post_status'   =>  'publish'
        ];
        $post_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $query_args ) );
        if( $post_query->have_posts() ) :
            while( $post_query->have_posts() ) :
                $post_query->the_post();
            endwhile;
        endif;
    }
    add_action( 'blogzee_masonry_articles_hook', 'blogzee_article_masonry' );
 endif;
