<?php
/**
 * Template part for displaying posts with gallery format
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
$custom_class = 'has-featured-image';
if( array_key_exists( 'css_classes', $args ) ) $custom_class .= $args['css_classes'];
if( ! has_post_thumbnail() ) $custom_class = 'no-featured-image';
$archive_post_layout = BZ\blogzee_get_customizer_option( 'archive_post_layout' );
$current_id = get_queried_object_id();
$archive_layout_meta = 'customizer-layout';
if( is_category() ) :
    $archive_meta_key = '_blogzee_category_archive_custom_meta_field';
    $archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
elseif ( is_tag() ) :
    $archive_meta_key = '_blogzee_post_tag_archive_custom_meta_field';
    $archive_layout_meta = metadata_exists( 'term', $current_id, $archive_meta_key ) ? get_term_meta( $current_id, $archive_meta_key, true ) : 'customizer-layout';
endif;

$is_customizer_layout = ( $archive_layout_meta == 'customizer-layout' );

$is_grid_two = ( ( $archive_post_layout === 'grid-two' ) && $is_customizer_layout ) || ( ! $is_customizer_layout && ( $archive_layout_meta === 'grid-two' ) );
$is_list_two = ( ( $archive_post_layout === 'list-two' ) && $is_customizer_layout ) || ( ! $is_customizer_layout && ( $archive_layout_meta === 'list-two' ) );
$post_format = blogzee_get_post_format();
if( in_array( $post_format, [ 'image', 'quote' ] ) ) $custom_class .= ' post-format';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?>>

    <div class="blogzee-article-inner">

        <?php
            if( ! in_array( $post_format, [ 'image', 'quote' ] ) ) :

                if( $is_list_two ) :

                    blogzee_archive_title();
        
                    echo '<div class="blog-inner-wrapper">';

                endif;

            endif;
        ?>
        <figure class="post-thumbnail-wrapper">

            <div class="post-thumnail-inner-wrapper<?php if( $post_format === 'gallery' ) echo esc_attr( ' swiper' ); ?>">

                <?php 
                    blogzee_archive_thumbnail(); 

                    if( $post_format === 'audio' && ! $is_grid_two ) blogzee_archive_audio();
                ?>

            </div>

            <?php
                blogzee_archive_category();

                blogzee_archive_post_format();
            ?>

        <?php if( ! in_array( $post_format, [ 'image', 'quote' ] ) ) echo '</figure>'; ?>

        <div class="inner-content">

            <div class="content-wrap">

                <?php if( in_array( $post_format, [ 'image', 'quote' ] ) ) echo '<div class="blogzee-inner-content-wrap-fi">'; ?>

                    <?php if( $post_format === 'quote' ) blogzee_archive_quote(); ?>
                    
                    <?php if( $post_format !== 'quote' ) : ?>

                        <?php if( ! $is_list_two ) blogzee_archive_title(); ?>

                        <div class="post-meta">

                            <?php
                                blogzee_archive_author();

                                if( ! $is_grid_two ) blogzee_archive_date();
                                
                                blogzee_archive_read_time();
                                
                                blogzee_archive_comment();
                            ?>

                        </div>

                        <?php 
                            blogzee_archive_excerpt();

                            if( $is_grid_two ) echo '<div class="button--wrapper">';

                                blogzee_archive_button();

                                if( $is_grid_two ) blogzee_archive_date();

                            if( $is_grid_two ) echo '</div>';

                            if( $post_format === 'audio' && $is_grid_two ) blogzee_archive_audio();
                        ?>

                    <?php endif; ?>

                <?php if( in_array( $post_format, [ 'image', 'quote' ] ) ) echo '</div>'; ?>

            </div>

        </div>

        <?php if( in_array( $post_format, [ 'image', 'quote' ] ) ) echo '</figure>'; ?>

    </div>
    <?php
        if( $is_list_two && ! in_array( $post_format, [ 'image', 'quote' ] ) ) echo '</div><!-- .blog-inner-wrapper -->';

        blogzee_entry_footer();
    ?>
</article>