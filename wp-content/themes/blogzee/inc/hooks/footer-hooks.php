<?php
/**
 * Footer hooks and functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;

if( ! function_exists( 'blogzee_footer_logo_part' ) ) :
    /**
     * Bottom Footer logo element
     * 
     * @since 1.0.0
     */
    function blogzee_footer_logo_part() {
        $logo_from = BZ\blogzee_get_customizer_option( 'bottom_footer_header_or_custom' );
        $show_site_title = false;
        if( $logo_from == 'header' ) {
            $footer_logo = get_theme_mod( 'custom_logo' );
            if( ! $footer_logo ) $show_site_title = true;
        } else {
            $footer_logo = BZ\blogzee_get_customizer_option( 'bottom_footer_logo_option' );
        };
        ?>
            <div class="footer-logo">
                <?php
                    if( $logo_from !== 'header' ) {
                        if( wp_get_attachment_image( $footer_logo, 'full' ) ) echo '<a href="'. home_url() .'" class="footer-site-logo">'. wp_get_attachment_image( $footer_logo, 'full' ) .'</a>';
                    } else {
                        $site_title_tag_for_frontpage = BZ\blogzee_get_customizer_option( 'site_title_tag_for_frontpage' );
                        $site_title_tag_for_innerpage = BZ\blogzee_get_customizer_option( 'site_title_tag_for_innerpage' );

                        the_custom_logo();

                        if ( is_front_page() && ! get_custom_logo() ) :
                            echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
                        else :
                            echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
                        endif;
                    }
                ?>
            </div>
        <?php
    }
    add_action( 'blogzee_footer_logo_hook', 'blogzee_footer_logo_part', 10 );
endif;

if( ! function_exists( 'blogzee_footer_social_icons' ) ) :
   /**
    * Bottom Footer copyright element
    * 
    * @since 1.0.0
    */
    function blogzee_footer_social_icons() {
        require get_template_directory() . '/inc/hooks/top-header-hooks.php'; // footer hooks.
        ?>
            <div class="social-icons-wrap footer blogzee-show-hover-animation">
                <?php blogzee_customizer_social_icons( 'footer' ); ?>
            </div>
        <?php
    }
    add_action( 'blogzee_footer_social_hook', 'blogzee_footer_social_icons', 10 );
endif;

if( ! function_exists( 'blogzee_footer_copyright_part' ) ) :
   /**
    * Bottom Footer copyright element
    * 
    * @since 1.0.0
    */
    function blogzee_footer_copyright_part() {
      $bottom_footer_site_info = BZ\blogzee_get_customizer_option( 'bottom_footer_site_info' );
      if( ! $bottom_footer_site_info ) return;
     ?>
        <div class="site-info">
            <?php echo wp_kses_post( str_replace( '%year%', date('Y'), $bottom_footer_site_info ) ); ?>
        </div>
     <?php
    }
    add_action( 'blogzee_footer_copyright_hook', 'blogzee_footer_copyright_part', 10 );
endif;

if( ! function_exists( 'blogzee_you_may_have_missed_html' ) ) :
    /**
     * You May Have Missed Section html
     * 
     * @since 1.0.0
     */
    function blogzee_you_may_have_missed_html() {
        if( ! BZ\blogzee_get_customizer_option( 'you_may_have_missed_section_option' ) || is_paged() ) return;
        // post query
        $you_may_have_missed_post_categories = BZ\blogzee_get_customizer_option( 'you_may_have_missed_categories' );
        $you_may_have_missed_posts_to_include = BZ\blogzee_get_customizer_option( 'you_may_have_missed_posts_to_include' );
        $you_may_have_missed_post_order = BZ\blogzee_get_customizer_option( 'you_may_have_missed_post_order' );
        $you_may_have_missed_no_of_posts_to_show = BZ\blogzee_get_customizer_option( 'you_may_have_missed_no_of_posts_to_show' );
        $hide_posts_with_no_featured_image = BZ\blogzee_get_customizer_option( 'you_may_have_missed_hide_post_with_no_featured_image' );
        $post_categories_id_args = ( ! empty( $you_may_have_missed_post_categories ) ) ? implode( ",", array_column( $you_may_have_missed_post_categories, 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $you_may_have_missed_posts_to_include ) ) ? array_column( $you_may_have_missed_posts_to_include, 'value' ) : '';

        // image settings and slider settings
        $you_may_have_missed_image_sizes = BZ\blogzee_get_customizer_option( 'you_may_have_missed_image_sizes' );
        $you_may_have_missed_no_of_columns = absint( BZ\blogzee_get_customizer_option( 'you_may_have_missed_no_of_columns' ) );

        // element class
        $elementClass = 'blogzee-you-may-have-missed-section section--grid';
        $elementClass .= ( $you_may_have_missed_no_of_columns ) ? ' no-of-columns--'. blogzee_convert_number_to_numeric_string( $you_may_have_missed_no_of_columns ) : '';

        $you_may_have_missed_aligment = BZ\blogzee_get_customizer_option( 'you_may_have_missed_post_elements_alignment' );
        $elementClass .= ' you-may-have-missed-align--'. $you_may_have_missed_aligment;
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogzee-you-may-have-missed-section">
                <div class="blogzee-you-may-missed-inner-wrap">
                    <?php
                        $you_may_have_missed_title_option = BZ\blogzee_get_customizer_option( 'you_may_have_missed_title_option' );
                        if( $you_may_have_missed_title_option ) :
                            $you_may_have_missed_title = BZ\blogzee_get_customizer_option( 'you_may_have_missed_title' );
                            if( $you_may_have_missed_title ) :
                                ?>
                                    <div class="section-title">
                                        <span class="divider"></span>
                                        <span class="title"><?php echo esc_html( $you_may_have_missed_title ); ?></span>
                                    </div>
                                <?php
                            endif;
                        endif;
                    ?>
                    <div class="you-may-have-missed-wrap">
                        <?php
                            $post_order = explode( '-', $you_may_have_missed_post_order );
                            $post_query_args = [
                                'post_type' =>  'post',
                                'post_status'  =>  'publish',
                                'posts_per_page'    =>  absint( $you_may_have_missed_no_of_posts_to_show ),
                                'order' =>  $post_order[1],
                                'order_by'  =>  $post_order[0],
                                'ignore_sticky_posts'   =>  true
                            ];
                            if( isset( $you_may_have_missed_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
                            if( isset( $you_may_have_missed_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
                            if( $hide_posts_with_no_featured_image ) :
                                $post_query_args['meta_query'] = [
                                    [
                                        'key'   =>  '_thumbnail_id',
                                        'compare'   =>  'EXISTS'
                                    ]
                                ];
                            endif;
                            $post_query = new \WP_Query( $post_query_args );
                            if( $post_query->have_posts() ) :
                                while( $post_query->have_posts() ) :
                                    $post_query->the_post();
                                    ?>
                                        <article class="post-item">
                                            <figure class="post-thumbnail-wrapper">
                                                <div class="post-thumnail-inner-wrapper">
                                                    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                                        <?php if( has_post_thumbnail() ) the_post_thumbnail( $you_may_have_missed_image_sizes ); ?>
                                                    </a>
                                                </div>
                                                <div class="inner-content">
                                                    <div class="content-wrap">
                                                        <div class="blogzee-inner-content-wrap-fi">
                                                            <?php 
                                                                blogzee_get_post_categories( get_the_ID(), 2 );
                                                                the_title( '<h2 class="entry-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                                echo '<div class="post-meta">';
                                                                    blogzee_posted_by( 'you-may-have-missed' );
                                                                    blogzee_posted_on( get_the_ID(), 'you-may-have-missed' );
                                                                echo '</div>';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figure>
                                        </article>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_you_may_have_missed_hook', 'blogzee_you_may_have_missed_html', 10 );
endif;

if( ! function_exists( 'blogzee_footer_menu' ) ) :
    /**
     * Footer menu
     * 
     * @since 1.0.0
     */
    function blogzee_footer_menu() {
        $footer_menu_hover_effect = BZ\blogzee_get_customizer_option( 'footer_menu_hover_effect' );
        $menuClass = 'menu';
        $menuClass .= ' hover-effect--' . $footer_menu_hover_effect;
        wp_nav_menu(
            array(
                'theme_location'    =>  'menu-2',
                'menu_class'    =>  esc_attr( $menuClass ),
                'container' =>  'ul'
            )
        );
    }
    add_action( 'blogzee_footer__menu_section_hook', 'blogzee_footer_menu' );
endif;