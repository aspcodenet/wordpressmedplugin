<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
$custom_class = 'has-featured-image';
if( ! has_post_thumbnail() ) $custom_class = 'no-featured-image';
$archive_readtime_on_mobile = BZ\blogzee_get_customizer_option( 'show_readtime_mobile_option' );
$archive_comment_number_on_mobile = BZ\blogzee_get_customizer_option( 'show_comment_number_mobile_option' );

$readtime_hide_on_mobile = ( ! $archive_readtime_on_mobile ) ? ' hide-on-mobile' : '';
$comment_number_hide_on_mobile = ( ! $archive_comment_number_on_mobile ) ? ' hide-on-mobile' : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?>>
    <div class="blogzee-article-inner blogzee-article-inner">
        <figure class="post-thumbnail-wrapper">
            <div class="post-thumnail-inner-wrapper">
                <?php
                    $archive_image_size = BZ\blogzee_get_customizer_option( 'archive_image_size' );
                    blogzee_post_thumbnail( $archive_image_size );
                ?>        
            </div>
            <?php blogzee_get_post_categories(get_the_ID()); ?>
        </figure>
        <div class="inner-content">
            <div class="content-wrap">
                <?php
                    blogzee_posted_on();
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    echo '<div class="post-excerpt">';
                        the_excerpt();
                    echo '</div>';
                ?>
            </div>
            <div class="post-meta">
                <?php blogzee_posted_by(); ?>
                <span class="post-meta">
                    <?php
                        $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
                        $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
                        $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogzee_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
                        $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-book-open-reader', 'type' => 'icon' ]);
                        if( $icon_html ) $read_time = $read_time . $icon_html;
                        echo '<span class="post-read-time'. esc_attr( $archive_readtime_on_mobile ) .'">' .$read_time. '</span>';

                        $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                        $icon_html = blogzee_get_icon_control_html([ 'value' => 'far fa-comments', 'type' => 'icon' ]);
                        if( $icon_html ) $comments_num = $comments_num . $icon_html;
                        echo '<a class="post-comments-num'. esc_attr( $comment_number_hide_on_mobile ) .'" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';

                        /**
                         * hook - blogzee_section_block_view_all_hook
                         * archive post button
                         */
                        if( has_action( 'blogzee_section_block_view_all_hook' ) ) do_action( 'blogzee_section_block_view_all_hook', [ 'show_button' => true ] );
                    ?>
                </span>
            </div>
        </div>
        <?php
            /**
             * hook - blogzee_archive_button_html_hook
             * 
             * @since 1.0.0
             */
            do_action( 'blogzee_archive_post_append_hook' );
        ?>
    </div>
</article>