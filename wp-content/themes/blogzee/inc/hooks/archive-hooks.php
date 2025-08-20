<?php
/**
 * Archive Hooks
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;
if( ! function_exists( 'blogzee_archive_title' ) ) :
    /**
     * Archive Title
     * 
     * @since 1.0.0
     */
    function blogzee_archive_title() {
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
    }
endif;

if( ! function_exists( 'blogzee_archive_date' ) ) :
    /**
     * Archive Date
     * 
     * @since 1.0.0
     */
    function blogzee_archive_date() {
        blogzee_posted_on( '', '' );
    }
endif;

if( ! function_exists( 'blogzee_archive_author' ) ) :
    /**
     * Archive Author
     * 
     * @since 1.0.0
     */
    function blogzee_archive_author() {
        blogzee_posted_by();
    }
endif;

if( ! function_exists( 'blogzee_archive_excerpt' ) ) :
    /**
     * Archive Excerpt
     * 
     * @since 1.0.0
     */
    function blogzee_archive_excerpt() {
        echo '<div class="post-excerpt">', wp_trim_words( get_the_excerpt(), 17 ), '</div>';
    }
endif;

if( ! function_exists( 'blogzee_archive_comment' ) ) :
    /**
     * Archive Comment
     * 
     * @since 1.0.0
     */
    function blogzee_archive_comment() {
        $archive_comment_number_on_mobile = BZ\blogzee_get_customizer_option( 'show_comment_number_mobile_option' );
        $comment_number_hide_on_mobile = ( ! $archive_comment_number_on_mobile ) ? ' hide-on-mobile' : '';
        $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
        $icon_html = blogzee_get_icon_control_html([ 'value' => 'far fa-comments', 'type' =>  'icon' ]);
        if( $icon_html ) $comments_num = $comments_num . $icon_html;
        echo '<a class="post-comments-num', esc_attr( $comment_number_hide_on_mobile ), '" href="', esc_url( get_the_permalink() ) , '#commentform">', $comments_num, '</a>';
    }
endif;

if( ! function_exists( 'blogzee_archive_read_time' ) ) :
    /**
     * Archive Read Time
     * 
     * @since 1.0.0
     */
    function blogzee_archive_read_time() {
        $archive_readtime_on_mobile = BZ\blogzee_get_customizer_option( 'show_readtime_mobile_option' );
        $readtime_hide_on_mobile = ( ! $archive_readtime_on_mobile ) ? ' hide-on-mobile' : '';
        $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
        $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
        $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogzee_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
        $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-book-open-reader', 'type' => 'icon' ]);
        if( $icon_html ) $read_time = $icon_html . $read_time;
        echo '<span class="post-read-time', esc_attr( $readtime_hide_on_mobile ), '">', $read_time, '</span>';
    }
endif;

if( ! function_exists( 'blogzee_archive_post_format' ) ) :
    /**
     * Archive Post Format
     * 
     * @since 1.0.0
     */
    function blogzee_archive_post_format() {
        $accepted_post_formats = [ 'standard', 'gallery', 'video', 'audio', 'quote', 'image' ];
        echo '<div class="post-format-ss-wrap">';
            $control_id = ( in_array( blogzee_get_post_format(), $accepted_post_formats ) && is_string( blogzee_get_post_format() ) ) ? blogzee_get_post_format() . '_post_format_icon_picker' : 'standard_post_format_icon_picker';
            $icon_picker = BZ\blogzee_get_customizer_option( $control_id );
            $post_format_icon = blogzee_get_icon_control_html( $icon_picker );
            $postFormatClass = 'post-format-icon';
            if( ! empty( $icon_picker ) && is_array( $icon_picker ) && array_key_exists( 'type', $icon_picker ) && $icon_picker['type'] == 'svg' ) $postFormatClass .= ' type--svg';
            if( $post_format_icon ) echo '<span class="', esc_attr( $postFormatClass ), '">', $post_format_icon, '</span>';
        echo '</div><!-- .post-format-ss-wrap -->';
    }
endif;

if( ! function_exists( 'blogzee_archive_thumbnail' ) ) :
    /**
     * Archive Thumbnail
     * 
     * @since 1.0.0
     */
    function blogzee_archive_thumbnail() {
        $archive_image_size = BZ\blogzee_get_customizer_option( 'archive_image_size' );
        $post_format = blogzee_get_post_format();
        switch( $post_format ) :
            case 'gallery':
                blogzee_archive_gallery();
                break;
            case 'video':
                blogzee_archive_video();
                break;
            case 'audio':
                blogzee_archive_not_audio();
                break;
            default:
                blogzee_post_thumbnail( $archive_image_size );
                break;
        endswitch;
    }
endif;

if( ! function_exists( 'blogzee_archive_category' ) ) :
    /**
     * Archive Category
     * 
     * @since 1.0.0
     */
    function blogzee_archive_category() {
        blogzee_get_post_categories( get_the_ID(), 1 );
    }
endif;

if( ! function_exists( 'blogzee_archive_button' ) ) :
    /**
     * Archive Button
     * 
     * @since 1.0.0
     */
    function blogzee_archive_button() {
        /**
         * hook - blogzee_section_block_view_all_hook
         * archive post button
         */
        if( has_action( 'blogzee_section_block_view_all_hook' ) ) do_action( 'blogzee_section_block_view_all_hook', [ 'show_button' => true ] );
    }
endif;

if( ! function_exists( 'blogzee_archive_entry_footer' ) ) :
    /**
     * Render the Edit button
     * 
     * @since 1.0.0
     */
    function blogzee_archive_entry_footer() {
        blogzee_entry_footer();
    }
endif;

if( ! function_exists( 'blogzee_archive_gallery' ) ) :
    /**
     * Archive Gallery
     * 
     * @since 1.0.0
     */
    function blogzee_archive_gallery() {
        $archive_image_size = BZ\blogzee_get_customizer_option( 'archive_image_size' );
        $gallery_content = get_post_gallery( get_the_ID(), false );
        $html = [];
        if( $gallery_content ) :
            if( isset( $gallery_content[ 'ids' ] ) ) :
                $source = explode( ',', $gallery_content[ 'ids' ] );
                $html[] = '<div class="thumbnail-gallery-slider swiper-wrapper">';
                    foreach( $source as $image ) :
                        $html[] = '<img class="swiper-slide" src="' . wp_get_attachment_image_url( $image, $archive_image_size ) . '" loading="lazy"/>';
                    endforeach;
                $html[] = '</div>';
                $html[] = '<div class="custom-button-prev swiper-arrow"><i class="fa-solid fa-arrow-left-long"></i></div>';
                $html[] = '<div class="custom-button-next swiper-arrow"><i class="fa-solid fa-arrow-right-long"></i></div>';
            endif;
        endif;
        echo implode( '', $html );
    }
endif;

if( ! function_exists( 'blogzee_archive_not_audio' ) ) :
    /**
     * Archive Audio
     * 
     * @since 1.0.0
     */
    function blogzee_archive_not_audio() {
        $archive_image_size = BZ\blogzee_get_customizer_option( 'archive_image_size' );
        $embeded_content = '';
        if( has_block('core/embed') ) {
            $embeds = get_media_embedded_in_content( apply_filters( 'the_content', get_the_content() ) );
            foreach( $embeds as $embed ) :
                if( strpos( $embed, 'soundcloud' ) || strpos( $embed, 'spotify' ) ) :
                    $embeded_content = $embed;
                    break; 
                endif;
            endforeach;
            echo $embeded_content;
        } else {
            blogzee_post_thumbnail( $archive_image_size );
        }
    }
endif;

if( ! function_exists( 'blogzee_archive_audio' ) ) :
    /**
     * Archive Audio
     * 
     * @since 1.0.0
     */
    function blogzee_archive_audio() {
        $is_audio = false;
        $embeded_content = '';
        if( has_block( 'core/audio' ) ) {
            $embeds = get_media_embedded_in_content( apply_filters( 'the_content', get_the_content() ) );
            foreach( $embeds as $embed ) :
                if( strpos( $embed, 'soundcloud' ) || strpos( $embed, 'spotify' ) || strpos( $embed, 'audio' ) ) :
                    if( strpos( $embed, 'audio' ) ) $is_audio = true;
                    $embeded_content = $embed;
                    break; 
                endif;
            endforeach;
        }
        if( $is_audio ) echo $embeded_content;
    }
endif;

if( ! function_exists( 'blogzee_archive_video' ) ) :
    /**
     * Archive Video
     * 
     * @since 1.0.0
     */
    function blogzee_archive_video() {
        if( has_block('core/embed') || has_block( 'core/video' ) ) :
            $embeded_content = '';
            $embeds = get_media_embedded_in_content( apply_filters( 'the_content', get_the_content() ) );
            foreach( $embeds as $embed ) :
                if( strpos( $embed, 'youtube' ) || strpos( $embed, 'video' ) ) :
                    $embeded_content = $embed;
                    break; 
                endif;
            endforeach;
            echo '<div class="video-overlay"></div>', $embeded_content;
        else :
            $archive_image_size = BZ\blogzee_get_customizer_option( 'archive_image_size' );
            blogzee_post_thumbnail( $archive_image_size );
        endif;
    }
endif;

if( ! function_exists( 'blogzee_archive_quote' ) ) :
    /**
     * Archive Quote
     * 
     * @since 1.0.0
     */
    function blogzee_archive_quote() {
        if( has_block('core/quote') ) :
            $blocksArray = parse_blocks( get_the_content() );
            foreach( $blocksArray as $singleBlock ) :
                if( 'core/quote' === $singleBlock['blockName'] ) { 
                    echo wp_kses_post( apply_filters( 'the_content', render_block( $singleBlock ) ) );
                    break;
                }
            endforeach;
        endif;
    }
endif;