<?php
    /**
     * Adds post meta and title in single
     * 
     * @since 1.0.0
     * @package Blogzee Pro
    */

    use Blogzee\CustomizerDefault as BZ;

    /* Category */
    blogzee_get_post_categories( get_the_ID(), 2 );

    /* Title */
    the_title( '<h2 class="entry-title" ' .blogzee_schema_article_name_attributes(). '>', '</h2>' );

    /* Meta */
    $single_author_option = BZ\blogzee_get_customizer_option( 'single_author_option' );
    ?>
        <div class="post-meta-wrap">
            <?php 
                /* Author */
                if( $single_author_option ) blogzee_posted_by( 'single-layout-two', get_the_ID() ); 
            ?>
            <span class="post-meta">
                <?php
                    /* Date */
                    blogzee_posted_on();

                    /* Read Time */
                    $read_time_option = metadata_exists( 'post', get_the_ID(), 'read_time_option' ) ? get_post_meta( get_the_ID(), 'read_time_option', true ) : 'customizer';
                    $read_time_meta = metadata_exists( 'post', get_the_ID(), 'read_time' ) ? get_post_meta( get_the_ID(), 'read_time', true ) : '1 Mins';
                    $read_time = '<span class="time-context">' .( ( $read_time_option == 'customizer' ) ? blogzee_post_read_time( get_the_content() ) : $read_time_meta ) . '</span>';
                    $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-book-open-reader', 'type' => 'icon' ]);
                    if( $icon_html ) $read_time = $icon_html . $read_time;
                    echo '<span class="post-read-time">' .$read_time. '</span>';

                    /* Comments */
                    $comments_num = '<span class="comments-context">' .get_comments_number( get_the_ID() ). '</span>';
                    $icon_html = blogzee_get_icon_control_html([ 'value' => 'far fa-comments', 'type' => 'icon' ]);
                    if( $icon_html ) $comments_num = $icon_html . $comments_num ;
                    echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                ?>
            </span>
        </div>
    <?php