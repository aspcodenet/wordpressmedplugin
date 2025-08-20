<?php
/**
 * Theme hooks and functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;
if( ! function_exists( 'blogzee_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     * @package Blogzee Pro
     */
    function blogzee_single_related_posts() {
        if( get_post_type() != 'post' ) return;
        $single_post_related_posts_option = BZ\blogzee_get_customizer_option( 'single_post_related_posts_option' );
        if( ! $single_post_related_posts_option ) return;
        $related_posts_title = BZ\blogzee_get_customizer_option( 'single_post_related_posts_title' );
        $related_posts_args = array(
            'posts_per_page'   => 4,
            'post__not_in'  => array( get_the_ID() ),
            'ignore_sticky_posts'    => true
        );
        $related_posts_args['category__in'] = wp_get_post_categories( get_the_ID() );
        $related_posts = new WP_Query( apply_filters( 'blogzee_query_args_filter', $related_posts_args ) );
        if( ! $related_posts->have_posts() ) return;
  ?>
            <div class="single-related-posts-section-wrap layout--list layout--one column--two">
                <div class="single-related-posts-section">
                    <?php
                        if( $related_posts_title ) echo '<h2 class="blogzee-block-title"><span class="divider"></span><span>' .esc_html( $related_posts_title ). '</span></h2>';
                            echo '<div class="single-related-posts-wrap">';
                                while( $related_posts->have_posts() ) : $related_posts->the_post();
                            ?>
                                <article post-id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <figure class="post-thumb-wrap <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                                        <?php blogzee_post_thumbnail( 'medium' ); ?>
                                        <div class="post-element">
                                            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <div class="post-meta">
                                                <?php
                                                    blogzee_posted_by();
                                                    blogzee_posted_on();
                                                    $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                                                    $icon_html = blogzee_get_icon_control_html([ 'value' => 'far fa-comments', 'type' => 'icon' ]);
                                                    if( $icon_html ) $comments_num = $icon_html . $comments_num ;
                                                    echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                                                ?>
                                            </div>
                                        </div>
                                    </figure>
                                </article>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            echo '</div>';
                    ?>
                </div>
            </div>
    <?php
    }
endif;
add_action( 'blogzee_single_post_append_hook', 'blogzee_single_related_posts' );

if( ! function_exists( 'blogzee_archive_header_html' ) ) :
    /**
     * Archive info box hook
     * 
     * @since 1.0.0
     */
    function blogzee_archive_header_html() {
        if( ! is_archive() ) return;
        if( is_category() && ! BZ\blogzee_get_customizer_option( 'archive_category_info_box_option' ) ) return;
        if( is_tag() && ! BZ\blogzee_get_customizer_option( 'archive_tag_info_box_option' ) ) return;
        if( is_author() && ! BZ\blogzee_get_customizer_option( 'archive_author_info_box_option' ) ) return;
        echo '<header class="page-header">';
            echo '<div class="blogzee-container">';
                echo '<div class="row">';
                    blogzee_breadcrumb_html();
                    echo '<div class="archive-header">';
                        if( is_category() ) {
                            $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-layer-group', 'type' => 'icon' ]);
                            echo '<div class="archive-title">';
                                if( $icon_html  ) echo $icon_html;
                                the_archive_title( '<h2 class="page-title">', '</h2>' );
                            echo '</div>';
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        } else if( is_tag() ) {
                            $icon_html = blogzee_get_icon_control_html([ 'value' => 'fas fa-tag', 'type' => 'icon' ]);
                            echo '<div class="archive-title">';
                                if( $icon_html  ) echo $icon_html;
                                the_archive_title( '<h2 class="page-title">', '</h2>' );
                            echo '</div>';
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        } else if( is_author() ) {
                            echo '<div class="archive-title">';
                                $author_image = get_avatar( get_queried_object_id(), 90 );
                                if( $author_image ) echo $author_image;
                                the_archive_title( '<h2 class="page-title">', '</h2>' );
                            echo '</div>';
                            the_archive_description( '<div class="archive-description">', '</div>' );
                        } else {
                            the_archive_title( '<h1 class="page-title">', '</h1>' );
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</header><!-- .page-header -->';
    }
    add_action( 'blogzee_page_header_hook', 'blogzee_archive_header_html' );
endif;

if( ! function_exists( 'blogzee_shooting_star_animation_html' ) ) :
    /**
     * Background animation one
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_shooting_star_animation_html() {
        if( BZ\blogzee_get_customizer_option( 'site_background_animation' ) === 'none' ) return;
        $show_background_animation_on_mobile = BZ\blogzee_get_customizer_option( 'show_background_animation_on_mobile' ); 
        $elementClass = 'blogzee-background-animation';
        if( ! $show_background_animation_on_mobile ) $elementClass .= ' hide-on-mobile';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php
                    $data = array_map( fn( $num ) => '<span class="item"></span>', range( 0, 12 ));
                    echo implode( '', $data );
                ?>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'blogzee_get_opening_div_main_wrap' ) ) :
    /**
     * Renders the opening div to wrap main content
     */
    function blogzee_get_opening_div_main_wrap() {
        echo '<div id="blogzee-main-wrap" class="blogzee-main-wrap">';
    }
    add_action( 'blogzee_main_content_opening', 'blogzee_get_opening_div_main_wrap', 10 );
endif;

if( ! function_exists( 'blogzee_get_page_header_hook' ) ) :
    function blogzee_get_page_header_hook() {
        /**
         * Hook - blogzee_page_header_hook
         * 
         * Hooked - blogzee_archive_header_html - 10
         */
        do_action( 'blogzee_page_header_hook' );
    }
    add_action( 'blogzee_main_content_opening', 'blogzee_get_page_header_hook', 20 );
endif;

if( ! function_exists( 'blogzee_get_opening_div_container' ) ) :
    /**
     * Renders the opening div for .blogzee-container class
     * 
     * @since 1.0.0
     */
    function blogzee_get_opening_div_container() {
        echo '<div class="blogzee-container">';
    }
    add_action( 'blogzee_main_content_opening', 'blogzee_get_opening_div_container', 40 );
endif;

if( ! function_exists( 'blogzee_get_single_content_exclude_layout_three' ) ) :
    /**
     * Renders contents of single post excluding layout three
     * 
     * @since 1.0.0
     */
    function blogzee_get_single_content_exclude_layout_three() {
        /**
         * hook - blogzee_before_main_content
         * 
         * hooked - blogzee_breadcrumb_html - 10
         */
        do_action( 'blogzee_before_main_content' );
    }
    add_action( 'blogzee_main_content_opening', 'blogzee_get_single_content_exclude_layout_three', 50 );
endif;

if( ! function_exists( 'blogzee_get_opening_div_row' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogzee_get_opening_div_row() {
        echo '<div class="row">';
    }
    add_action( 'blogzee_main_content_opening', 'blogzee_get_opening_div_row', 60 );
endif;

if( ! function_exists( 'blogzee_get_closing_div_row' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogzee_get_closing_div_row() {
        echo '</div><!-- .row -->';
    }
    add_action( 'blogzee_main_content_closing', 'blogzee_get_closing_div_row', 10 );
endif;

if( ! function_exists( 'blogzee_get_closing_div_container' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogzee_get_closing_div_container() {
        echo '</div><!-- .row -->';
    }
    add_action( 'blogzee_main_content_closing', 'blogzee_get_closing_div_container', 20 );
endif;

if( ! function_exists( 'blogzee_get_closing_div_main_wrap' ) ) :
    /**
     * Renders the opening div for .row class
     * 
     * @since 1.0.0
     */
    function blogzee_get_closing_div_main_wrap() {
        echo '</div><!-- .blogzee-main-wrap -->';
    }
    add_action( 'blogzee_main_content_closing', 'blogzee_get_closing_div_main_wrap', 30);
endif;

