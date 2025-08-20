<?php
/**
 * Includes helper hooks and function of the theme
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;

if( ! function_exists( 'blogzee_get_post_format' ) ) :
    /**
     * Gets the post format string
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_get_post_format( $id = null ) {
        $post_format = ( $id ) ? get_post_format($id): get_post_format();
        return apply_filters( 'blogzee_post_format_string_filter', $post_format );
    }
endif;

if( ! function_exists( 'blogzee_progress_bar' ) ) :
    /**
     * Display a progress bar
     * 
     * @since 1.0.0
     */
    function blogzee_progress_bar() {
        if( is_single() || is_page() || is_archive() || is_search() ) :
            echo '<div class="single-progress"></div>';
        endif;
    }
    add_action( 'blogzee_header_after_hook', 'blogzee_progress_bar', 10 );
endif;

if( ! function_exists( 'blogzee_ticker_html' ) ) :
    /**
     * Ticker News
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_ticker_html() {
        if( ! BZ\blogzee_get_customizer_option( 'ticker_news_option' ) || is_paged() || ! is_home() || ! is_front_page() ) return;
        // post query variables
        $ticker_news_categories = BZ\blogzee_get_customizer_option( 'ticker_news_categories' );
        $ticker_news_posts_to_include = BZ\blogzee_get_customizer_option( 'ticker_news_posts_to_include' );
        $ticker_news_post_order = BZ\blogzee_get_customizer_option( 'ticker_news_post_order' );
        $ticker_news_no_of_posts_to_show = BZ\blogzee_get_customizer_option( 'ticker_news_no_of_posts_to_show' );
        $ticker_news_hide_post_with_no_featured_image = BZ\blogzee_get_customizer_option( 'ticker_news_hide_post_with_no_featured_image' );
        
        $post_categories_id_args = ( ! empty( $ticker_news_categories ) ) ? implode( ",", array_column( $ticker_news_categories, 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $ticker_news_posts_to_include ) ) ? array_column( $ticker_news_posts_to_include, 'value' ) : '';

        // Query
        $post_order = explode( '-', $ticker_news_post_order );
        $ticker_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'posts_per_page'    =>  absint( $ticker_news_no_of_posts_to_show ),
            'order' =>  $post_order[1],
            'order_by'  =>  $post_order[0],
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $ticker_news_categories ) ) $ticker_args['cat'] = $post_categories_id_args;
        if( isset( $ticker_news_posts_to_include ) ) $ticker_args['post__in'] = $post_to_include_id_args;
        if( $ticker_news_hide_post_with_no_featured_image ) :
            $ticker_args['meta_query'] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
        ?>
            <div class="blogzee-ticker-news">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="ticker-title-wrapper">
                            <span class="ticker-icon"></span>
                            <h2 class="ticker-title"><?php echo esc_html__( 'Heading', 'blogzee' ); ?></h2>
                        </div>
                        <div class="ticker-news-wrap">
                            <ul class="ticker-item-wrap">
                                <?php
                                    $ticker_query = new WP_Query( $ticker_args );
                                    if( $ticker_query->have_posts() ) :
                                        while( $ticker_query->have_posts() ) : 
                                            $ticker_query->the_post();
                                            $figureClass = 'post-thumb';
                                            if( ! has_post_thumbnail()  ) $figureClass .= ' no-feat-image';
                                            ?>
                                                <li class="ticker-item">
                                                    <figure class="<?php echo esc_attr( $figureClass ); ?>">
                                                        <?php
                                                            if( has_post_thumbnail()  ) : ?>
                                                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                                    <?php
                                                                        the_post_thumbnail( 'post-thumbnail', [
                                                                            'title' => the_title_attribute([
                                                                                'echo'  => false
                                                                            ])
                                                                        ]);
                                                                    ?>
                                                                </a>
                                                        <?php 
                                                            endif;
                                                        ?>
                                                    </figure>
                                                    <div class="title-wrap">
                                                        <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                                                        <?php blogzee_posted_on( get_the_ID(), 'ticker' ); ?>
                                                    </div>
                                                </li>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <div class="controller-wrapper playing">
                            <button class="controller-icon">
                                <i class="fa-solid fa-play"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    add_action( 'blogzee_header_after_hook', 'blogzee_ticker_html', 20 );
endif;

if( ! function_exists( 'blogzee_main_banner_html' ) ) :
    /**
     * Main banner html
     * 
     * @since 1.0.0
     */
    function blogzee_main_banner_html() {
        if( ! BZ\blogzee_get_customizer_option( 'main_banner_option' ) || is_paged() || ! is_home() || ! is_front_page() ) return;
        // post query
        $main_banner_post_categories = BZ\blogzee_get_customizer_option( 'main_banner_slider_categories' );
        $main_banner_posts_to_include = BZ\blogzee_get_customizer_option( 'main_banner_slider_posts_to_include' );
        $main_banner_post_order = BZ\blogzee_get_customizer_option( 'main_banner_post_order' );
        $main_banner_no_of_posts_to_show = BZ\blogzee_get_customizer_option( 'main_banner_no_of_posts_to_show' );
        $hide_posts_with_no_featured_image = BZ\blogzee_get_customizer_option( 'main_banner_hide_post_with_no_featured_image' );
        
        $post_categories_id_args = ( ! empty( $main_banner_post_categories ) ) ? implode( ",", array_column( $main_banner_post_categories, 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $main_banner_posts_to_include ) ) ? array_column( $main_banner_posts_to_include, 'value' ) : '';

        // image settings and slider settings
        $main_banner_layouts = 'four';
        $main_banner_image_sizes = BZ\blogzee_get_customizer_option( 'main_banner_image_sizes' );
        $main_banner_aligment = BZ\blogzee_get_customizer_option( 'main_banner_post_elements_alignment' );
        
        $banner_class = 'blogzee-main-banner-section layout--' . $main_banner_layouts . ' banner-align--' . $main_banner_aligment;
        $banner_class .= ' main-banner-arrow-show';

        $main_banner_excerpt_on_mobile = BZ\blogzee_get_customizer_option( 'show_main_banner_excerpt_mobile_option' );
        $hide_on_mobile = ( ! $main_banner_excerpt_on_mobile ) ? ' hide-on-mobile' : '';

        // Query
        $thumbnails = [];
        $post_order = explode( '-', $main_banner_post_order );
        $post_query_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'posts_per_page'    =>  absint( $main_banner_no_of_posts_to_show ),
            'order' =>  $post_order[1],
            'order_by'  =>  $post_order[0],
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $main_banner_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
        if( isset( $main_banner_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
        if( $hide_posts_with_no_featured_image ) :
            $post_query_args['meta_query'] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
        $post_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $post_query_args ) ); 
        if( ! $post_query->have_posts() ) return;

        if( in_array( $main_banner_layouts, [ 'three', 'four' ] ) ) :
            /* Trailing Posts Variables and Query */
            $main_banner_trailing_post_order = BZ\blogzee_get_customizer_option( 'main_banner_trailing_post_order' );
            $main_banner_trailing_slider_categories = BZ\blogzee_get_customizer_option( 'main_banner_trailing_slider_categories' );
            $main_banner_trailing_slider_posts_to_include = BZ\blogzee_get_customizer_option( 'main_banner_trailing_slider_posts_to_include' );
            $main_banner_trailing_no_of_posts_to_show = BZ\blogzee_get_customizer_option( 'main_banner_trailing_no_of_posts_to_show' );
            $main_banner_trailing_hide_post_with_no_featured_image = BZ\blogzee_get_customizer_option( 'main_banner_trailing_hide_post_with_no_featured_image' );
    
            $trailing_post_order = explode( '-', $main_banner_trailing_post_order );
            $trailing_post_categories_id_args = ( ! empty( $main_banner_trailing_slider_categories ) ) ? implode( ",", array_column( $main_banner_trailing_slider_categories, 'value' ) ) : '';
            $trailing_post_to_include_id_args = ( ! empty( $main_banner_trailing_slider_posts_to_include ) ) ? array_column( $main_banner_trailing_slider_posts_to_include, 'value' ) : '';
    
            $trailing_post_query_args = [
                'post_type' =>  'post',
                'post_status'  =>  'publish',
                'posts_per_page'    =>  absint( $main_banner_trailing_no_of_posts_to_show ),
                'order' =>  $trailing_post_order[1],
                'order_by'  =>  $trailing_post_order[0],
                'ignore_sticky_posts'   =>  true
            ];
            if( isset( $main_banner_trailing_slider_categories ) ) $trailing_post_query_args['cat'] = $trailing_post_categories_id_args;
            if( isset( $main_banner_trailing_slider_posts_to_include ) ) $trailing_post_query_args['post__in'] = $trailing_post_to_include_id_args;
            if( $main_banner_trailing_hide_post_with_no_featured_image ) :
                $trailing_post_query_args['meta_query'] = [
                    [
                        'key'   =>  '_thumbnail_id',
                        'compare'   =>  'EXISTS'
                    ]
                ];
            endif;
            $trailing_post_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $trailing_post_query_args ) ); 
        endif;
        ?>
            <section class="<?php echo esc_attr( $banner_class )?>" id="blogzee-main-banner-section">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="main-banner-slider">
                            <div class="main-banner-wrap swiper">
                                <div class="swiper-wrapper">
                                    <?php
                                        while( $post_query->have_posts() ) :
                                            $post_query->the_post();
                                            $thumbnails[] = get_the_post_thumbnail_url();
                                            ?>
                                                <article class="post-item swiper-slide">
                                                    <?php if( $main_banner_layouts !== 'three' ) : ?>
                                                        <figure class="post-thumb">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php if( has_post_thumbnail() ) the_post_thumbnail( $main_banner_image_sizes ); ?>
                                                            </a>
                                                        </figure>
                                                    <?php endif; ?>
                                                    <div class="post-elements">
                                                        <?php 
                                                            blogzee_get_post_categories( get_the_ID(), 2 );
                                                            the_title( '<h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                            echo '<div class="post-excerpt'. esc_attr( $hide_on_mobile ) .'">'. esc_html( wp_trim_words( get_the_excerpt(), 15 ) ) .'</div>';
                                                            echo '<div class="author-date-wrap">';
                                                                blogzee_posted_by( 'banner' );
                                                                blogzee_posted_on( get_the_ID(), 'banner' );
                                                            echo '</div>';
                                                        ?>
                                                    </div>
                                                </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                                <!-- If we need navigation buttons -->
                                <?php blogzee_get_slider_navigation_buttons(); ?>
                            </div>

                        </div><!-- .main-banner-slider -->
                        <?php if( in_array( $main_banner_layouts, [ 'three', 'four' ] ) ) : ?>
                            <div class="main-banner-sidebar">
                                <h2 class="sidebar-title"><?php echo esc_html__( 'Trending', 'blogzee' ); ?></h2>
                                <div class="scrollable-posts-wrapper">
                                    <?php
                                        if( $trailing_post_query->have_posts() ) :
                                            while( $trailing_post_query->have_posts() ) :
                                                $trailing_post_query->the_post();
                                                ?>
                                                    <div class="scrollable-post">
                                                        <div class="count-image-wrapper">
                                                            <figure class="post-thumb">
                                                                <?php if( has_post_thumbnail() ) : ?>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_post_thumbnail( 'medium' ); ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </figure>
                                                        </div>
                                                        <div class="title-date-wrapper">
                                                            <?php
                                                                blogzee_get_post_categories( get_the_ID(), 2 );
                                                                the_title( '<h2 h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                                blogzee_posted_on( get_the_ID(), 'banner' );
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php
                                            endwhile;
                                        endif;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_header_after_hook', 'blogzee_main_banner_html', 30 );
endif;

if( ! function_exists( 'blogzee_category_collection_html' ) ) :
    /**
     * Category Collection html part
     * 
     * @since 1.0.0
     * @package Blogzee Pro
     */
    function blogzee_category_collection_html() {
        if( ! BZ\blogzee_get_customizer_option( 'category_collection_option' ) || is_paged() || ! is_home() || ! is_front_page() ) return;
        $category_collection_show_count = BZ\blogzee_get_customizer_option( 'category_collection_show_count' );
        $category_collection_number_of_columns = BZ\blogzee_get_customizer_option( 'category_collection_number_of_columns' );    
        $category_to_include = BZ\blogzee_get_customizer_option( 'category_to_include' );
        $category_to_exclude = BZ\blogzee_get_customizer_option( 'category_to_exclude' );
        $category_collection_number = BZ\blogzee_get_customizer_option( 'category_collection_number' );
        $category_collection_orderby = BZ\blogzee_get_customizer_option( 'category_collection_orderby' );
        $category_collection_sort = explode( '-', $category_collection_orderby );
        $category_collection_image_size = BZ\blogzee_get_customizer_option( 'category_collection_image_size' );
        $category_collection_hover_effects = BZ\blogzee_get_customizer_option( 'category_collection_hover_effects' );       
        $sectionClass = 'blogzee-category-collection-section layout--one';
        $catCollectionWrapperClass = 'category-collection-wrap';
        $catItemClass = 'category-wrap';
        $sectionClass .= ' hover-effect--' . $category_collection_hover_effects;
        $sectionClass .= ' column--' . blogzee_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['desktop'] ) );
        $sectionClass .= ' tab-column--' . blogzee_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['tablet'] ) );
        $sectionClass .= ' mobile-column--' . blogzee_convert_number_to_numeric_string( absint( $category_collection_number_of_columns['smartphone'] ) );
        if( $category_collection_show_count ) $sectionClass .= ' category-count--enabled';
        $category_args = [
                'number'    =>  absint( $category_collection_number ),
                'exclude'   =>  ( ! empty( $category_to_exclude ) ) ? array_column( $category_to_exclude, 'value' ) : [],
                'include'   =>  ( ! empty( $category_to_include ) ) ? array_column( $category_to_include, 'value' ) : [],                
                'orderby'   =>  $category_collection_sort[1],
                'order' =>  $category_collection_sort[0]
        ];
        $get_all_categories = get_categories( $category_args );
        ?>
            <section class="<?php echo esc_attr( $sectionClass ); ?>" id="blogzee-category-collection-section">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="<?php echo esc_attr( $catCollectionWrapperClass ); ?>">
                            <?php
                                if( ! is_null( $get_all_categories ) && is_array( $get_all_categories ) ) :
                                    foreach( $get_all_categories as $cat_key => $cat_value ) :
                                        $category_query_args = [
                                            'cat'   =>  absint( $cat_value->term_id ),
                                            'meta_query'    =>  [
                                                [
                                                    'key'   =>  '_thumbnail_id',
                                                    'compare'   =>  'EXISTS'
                                                ]
                                            ],
                                            'ignore_stick_posts'    =>  true
                                        ];
                                        $category_query = new WP_Query( apply_filters( 'blogzee_query_args_filter', $category_query_args ) );
                                        if( $category_query->have_posts() ) :
                                            $thumbnail_id = ( $category_query->posts[0]->ID != null ) ? $category_query->posts[0]->ID : '';
                                        else:
                                            $thumbnail_id = '';
                                        endif;

                                        ?>
                                            <div class="<?php echo esc_attr( $catItemClass ); ?>">
                                                <figure class="category-thumb">
                                                    <a href="<?php echo get_term_link( $cat_value->term_id, 'category' ); ?>">
                                                        <?php if( $thumbnail_id ) echo wp_kses_post( get_the_post_thumbnail( $thumbnail_id, $category_collection_image_size ) ); ?>
                                                    </a>
                                                </figure>
                                                <div class="category-item cat-meta">
                                                    <div class="category-item-inner">
                                                        <div class="category-name">
                                                        <a href="<?php echo get_term_link( $cat_value->term_id, 'category' ); ?>">
                                                            <span class="category-label"><?php echo esc_html( $cat_value->name );?></span>
                                                            <?php if( $category_collection_show_count ) echo '<span class="category-count">'. esc_html( $cat_value->count . ' posts' ) .'</span>';?>
                                                        </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_header_after_hook', 'blogzee_category_collection_html', 40 );
endif;

if( ! function_exists( 'blogzee_carousel_html' ) ) :
    /**
     * Carousel html
     * 
     * @since 1.0.0
     */
    function blogzee_carousel_html() {
        if( ! BZ\blogzee_get_customizer_option( 'carousel_option' ) || is_paged() || ! is_home() || ! is_front_page() ) return;
        // post query
        $carousel_post_categories = BZ\blogzee_get_customizer_option( 'carousel_slider_categories' );
        $carousel_posts_to_include = BZ\blogzee_get_customizer_option( 'carousel_slider_posts_to_include' );
        $carousel_post_order = BZ\blogzee_get_customizer_option( 'carousel_post_order' );
        $carousel_no_of_posts_to_show = BZ\blogzee_get_customizer_option( 'carousel_no_of_posts_to_show' );
        $hide_posts_with_no_featured_image = BZ\blogzee_get_customizer_option( 'carousel_hide_post_with_no_featured_image' );
        
        $post_categories_id_args = ( ! empty( $carousel_post_categories ) ) ? implode( ",", array_column( $carousel_post_categories, 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $carousel_posts_to_include ) ) ? array_column( $carousel_posts_to_include, 'value' ) : '';

        // image settings and slider settings
        $carousel_image_sizes = BZ\blogzee_get_customizer_option( 'carousel_image_sizes' );

        // element class
        $elementClass = 'blogzee-carousel-section carousel-layout--one carousel-banner-arrow-show arrow-on-hover--on no-of-columns--three';

        $carousel_aligment = BZ\blogzee_get_customizer_option( 'carousel_post_elements_alignment' );
        $elementClass .= ' carousel-align--'.$carousel_aligment;

        $carousel_banner_excerpt_on_mobile = BZ\blogzee_get_customizer_option( 'show_carousel_banner_excerpt_mobile_option' );
        $hide_on_mobile = ( ! $carousel_banner_excerpt_on_mobile ) ? ' hide-on-mobile' : '';

        $post_order = explode( '-', $carousel_post_order );
        $post_query_args = [
            'post_type' =>  'post',
            'post_status'  =>  'publish',
            'posts_per_page'    =>  absint( $carousel_no_of_posts_to_show ),
            'order' =>  $post_order[1],
            'order_by'  =>  $post_order[0],
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $carousel_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
        if( isset( $carousel_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
        if( $hide_posts_with_no_featured_image ) :
            $post_query_args['meta_query'] = [
                [
                    'key'   =>  '_thumbnail_id',
                    'compare'   =>  'EXISTS'
                ]
            ];
        endif;
        $post_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $post_query_args ) );
        if( ! $post_query->have_posts() ) return;
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogzee-carousel-section">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="carousel-wrap swiper">
                            <div class="swiper-wrapper">
                                <?php
                                    if( $post_query->have_posts() ) :
                                        while( $post_query->have_posts() ) :
                                            $post_query->the_post();
                                            ?>
                                                <article class="post-item swiper-slide">
                                                    <figure class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php if( has_post_thumbnail() ) the_post_thumbnail( $carousel_image_sizes ); ?>
                                                        </a>
                                                    </figure>
                                                    <div class="post-elements">
                                                        <?php
                                                            blogzee_get_post_categories( get_the_ID(), 2 );
                                                            the_title( '<h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                            echo '<div class="post-excerpt'. esc_attr( $hide_on_mobile ) .'"><span class="excerpt-content">'. esc_html( wp_trim_words( get_the_excerpt(), 10 ) ) .'</span></div>';
                                                            echo '<div class="post-meta">';
                                                                blogzee_posted_by( 'carousel' );
                                                                blogzee_posted_on( get_the_ID(), 'carousel' );
                                                            echo '</div>';
                                                        ?>
                                                    </div>
                                                </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                ?>
                            </div>
                            <?php blogzee_get_slider_navigation_buttons( 'carousel' ); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_header_after_hook', 'blogzee_carousel_html', 50 );
endif;

if( ! function_exists( 'blogzee_get_slider_navigation_buttons' ) ) :
    /**
     * Main Banner Navigation buttons
     * 
     * @since 1.0.0
     */
    function blogzee_get_slider_navigation_buttons( $type = 'main_banner' ) {
        $pagination_array = [
            'prev' => [ 'type'  => 'icon', 'value' => 'fa-solid fa-arrow-left-long' ],
            'next' => [ 'type'  => 'icon', 'value' => 'fa-solid fa-arrow-right-long' ]
        ];
        foreach( $pagination_array as $pagination_key => $pagination ) :
            $paginationClass = 'custom-button-' . $pagination_key;
            $paginationClass .= ' swiper-arrow';
            ?>
                <div class="<?php echo esc_attr( $paginationClass ); ?>">
                    <?php
                        $icon = blogzee_parse_icon_picker_value( $pagination );
                        if( $icon['type'] === 'icon' ) :
                            echo '<i class="'. esc_attr( $icon['value'] ) .'"></i>';
                        else: 
                            echo '<img src="'. esc_url( $icon['url'] ) .'" alt="" loading="lazy" />';
                        endif;
                    ?>
                </div>
            <?php
        endforeach;
    }
endif;

if( ! function_exists( 'blogzee_get_icon_control_html' ) ) :
    /**
     * Generates output for icon control
     * 
     * @since 1.0.0
     */
    function blogzee_get_icon_control_html( $icon ) {
        if( $icon['type'] == 'none' ) return;
        switch($icon['type']) {
            case 'svg' : $output = '<img src="' .esc_url( wp_get_attachment_url( $icon['value'] ) ). '" loading="lazy" />';
                    break;
            default: $output = '<i class="' .esc_attr( $icon['value'] ). '"></i>';
        }
        return $output;
    }
endif;

if( ! function_exists( 'blogzee_convert_number_to_numeric_string' )) :
    /**
     * Function to convert int parameter to numeric string
     * 
     * @return string
     */
    function blogzee_convert_number_to_numeric_string( $int ) {
        switch( $int ){
            case 2:
                return "two";
                break;
            case 3:
                return "three";
                break;
            case 4:
                return "four";
                break;
            case 5:
                return "five";
                break;
            case 6:
                return "six";
                break;
            case 7:
                return "seven";
                break;
            case 8:
                return "eight";
                break;
            case 9:
                return "nine";
                break;
            case 10:
                return "ten";
                break;
            default:
                return "one";
        }
    }
 endif;

 if( ! function_exists( 'blogzee_post_read_time' ) ) :
    /**
     * Function derives the read time
     * @return float
     */
    function blogzee_post_read_time( $string = '' ) {
    	$read_time = 0;
        if( empty( $string ) ) {
            return 0 . esc_html__( ' min', 'blogzee' );
        } else {
            $read_time = apply_filters( 'blogzee_content_read_time', round( str_word_count( wp_strip_all_tags( $string ) ) / 100 ), 2 );
            if( $read_time == 0 ) {
            	return 1 . esc_html__( ' min', 'blogzee' );
            } else {
            	return $read_time . esc_html__( ' mins', 'blogzee' );
            }
        }
    }
endif;

if( ! function_exists( 'blogzee_get_post_categories' ) ) :
    /**
     * Function contains post categories html
     * @return float
     */
    function blogzee_get_post_categories( $post_id, $number = 1, $args = [] ) {
        $hide_on_mobile = '';
    	$n_categories = wp_get_post_categories($post_id, array( 'number' => absint( $number ) ));
        if( array_key_exists( 'hide_on_mobile', $args ) ) :
            $hide_on_mobile = ( ! $args['hide_on_mobile'] ) ? ' hide-on-mobile' : '';
        endif;
		echo '<ul class="post-categories'. esc_attr( $hide_on_mobile ) .'">';
			foreach( $n_categories as $n_category ) :
				echo '<li class="cat-item ' .esc_attr( 'cat-' . $n_category ). '"><a href="' .esc_url( get_category_link( $n_category ) ). '" rel="category tag">' .get_cat_name( $n_category ). '</a></li>';
			endforeach;
		echo '</ul>';
    }
endif;

if( ! function_exists( 'blogzee_loader_html' ) ) :
	/**
     * Preloader html
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
	function blogzee_loader_html() {
        if( ! BZ\blogzee_get_customizer_option( 'preloader_option' ) ) return;
	?>
        <div class="blogzee_loading_box preloader-style--two display-preloader--every-load">
			<div class="box">
				<div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
                <div class="four"></div>
                <div class="five"></div>
			</div>
		</div>
	<?php
	}
    add_action( 'blogzee_page_prepend_hook', 'blogzee_loader_html', 1 );
endif;

 if( ! function_exists( 'blogzee_custom_header_html' ) ) :
    /**
     * Site custom header html
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_custom_header_html() {
        /**
         * Get custom header markup
         * 
         * @since 1.0.0 
         */
        the_custom_header_markup();
    }
    add_action( 'blogzee_page_prepend_hook', 'blogzee_custom_header_html', 20 );
 endif;

 if( ! function_exists( 'blogzee_pagination_fnc' ) ) :
    /**
     * Renders pagination html
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        $archive_pagination_type = BZ\blogzee_get_customizer_option( 'archive_pagination_type' );
        // the_post_navigation
        switch($archive_pagination_type) {
            case 'default': 
                $next_link = get_previous_posts_link( 'Newer Posts' );
                $prev_link = get_next_posts_link( 'Older Posts' );
                ?>
                    <nav class="navigation posts-navigation">
                        <div class="nav-links">
                            <div class="nav-previous"><?php if( ! is_null( $prev_link ) ) echo wp_kses_post( $prev_link ); ?></div>
                            <div class="nav-next"><?php if( ! is_null( $next_link ) ) echo wp_kses_post( $next_link ); ?></div>
                        </div>
                    </nav>
                <?php
                    break;
            default: echo '<div class="pagination">' .wp_kses_post( paginate_links( array( 'prev_text' => '<i class="fa-solid fa-angles-left"></i>', 'next_text' => '<i class="fa-solid fa-angles-right"></i>', 'type' => 'list' ) ) ). '</div>';
        }
        
    }
    add_action( 'blogzee_pagination_link_hook', 'blogzee_pagination_fnc' );
 endif;

 if( ! function_exists( 'blogzee_scroll_to_top_html' ) ) :
    /**
     * Scroll to top fnc
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_scroll_to_top_html() {
        $stt_text = BZ\blogzee_get_customizer_option( 'stt_text' );
        $classes = 'blogzee-scroll-btn align--right display--fixed';
        $show_scroll_to_top_on_mobile = BZ\blogzee_get_customizer_option( 'show_scroll_to_top_on_mobile' );
        if( ! $show_scroll_to_top_on_mobile ) $classes .= ' hide-on-mobile';
        ?>
            <div id="blogzee-scroll-to-top" class="<?php echo esc_attr( $classes ); ?>">
                <div class="scroll-top-wrap">
                    <?php if( $stt_text ) echo '<span class="icon-text">'. esc_html( $stt_text ) .'</span>'; ?>
                    <div class="scroll-to-top-wrapper">
                        <span class="icon-holder"><i class="fas fa-angle-up"></i></span>
                    </div>
                </div>
            </div><!-- #blogzee-scroll-to-top -->
        <?php
    }
    add_action( 'blogzee_scroll_to_top_hook', 'blogzee_scroll_to_top_html', 10 );
 endif;

 require get_template_directory() . '/inc/hooks/footer-hooks.php'; // footer hooks.
 require get_template_directory() . '/inc/hooks/archive-hooks.php'; // archive hooks.

if ( ! function_exists( 'blogzee_breadcrumb_trail' ) ) :
    /**
     * Theme default breadcrumb function.
     *
     * @since 1.0.0
     */
    function blogzee_breadcrumb_trail() {
        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            // load class file
            require_once get_template_directory() . '/inc/breadcrumb-trail/breadcrumb-trail.php';
        }

        // arguments variable
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false
        );
        breadcrumb_trail( $breadcrumb_args );
    }
    add_action( 'blogzee_breadcrumb_trail_hook', 'blogzee_breadcrumb_trail' );
endif;

if( ! function_exists( 'blogzee_breadcrumb_html' ) ) :
    /**
     * Theme breadcrumb
     *
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_breadcrumb_html() {
        $site_breadcrumb_option = BZ\blogzee_get_customizer_option( 'site_breadcrumb_option' );
        if ( ! $site_breadcrumb_option ) return;
        if ( is_front_page() || is_home() ) return;
        $site_breadcrumb_type = BZ\blogzee_get_customizer_option( 'site_breadcrumb_type' );
            ?>
                <div class="blogzee-breadcrumb-element row">
                    <div class="blogzee-breadcrumb-wrap">
                        <?php
                            switch( $site_breadcrumb_type ) {
                                case 'yoast': if( blogzee_compare_wand([blogzee_function_exists( 'yoast_breadcrumb' )] ) ) yoast_breadcrumb();
                                        break;
                                case 'rankmath': if( blogzee_compare_wand([blogzee_function_exists( 'rank_math_the_breadcrumbs' )] ) ) rank_math_the_breadcrumbs();
                                        break;
                                case 'bcn': if( blogzee_compare_wand([blogzee_function_exists( 'bcn_display' )] ) ) bcn_display();
                                        break;
                                default: do_action( 'blogzee_breadcrumb_trail_hook' );
                                        break;
                            }
                        ?>
                    </div>
                </div><!-- .row -->
        <?php
    }
endif;
add_action( 'blogzee_before_main_content', 'blogzee_breadcrumb_html', 10 );

if( ! function_exists( 'blogzee_theme_mode_switch' ) ) :
    /**
     * Function to return either icon html or image html
     * 
     * @param type
     * @since 1.0.0
     */
    function blogzee_theme_mode_switch( $mode, $theme_mode ) {
        $elementClass = ( $theme_mode == 'light' ) ? 'lightmode' : 'darkmode';
        switch( $mode['type'] ) :
            case 'icon' :
                echo '<i class="'. esc_attr( $mode['value'] . ' ' . $elementClass ) .'"></i>';
                break;
            case 'svg' :
                echo '<img class="'. esc_attr( $elementClass ) .'" src="'. esc_url( wp_get_attachment_image_url( $mode['value'], 'full' ) ) .'" loading="lazy">';
                break;
        endswitch;
    }
 endif;

if( ! function_exists( 'blogzee_button_html' ) ) :
    /**
     * View all html
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_button_html( $args ) {
        if( ! $args['show_button'] ) return;
        $classes = isset( $args['classes'] ) ? 'blogzee-button post-link-button' . ' ' .$args['classes'] : 'post-button blogzee-button';
        $link = isset( $args['link'] ) ? $args['link'] : get_the_permalink();
        $text = isset( $args['text'] ) ? $args['text'] : apply_filters( 'blogzee_global_button_label_fitler', esc_html__( 'continue reading..', 'blogzee' ) );
        $icon = isset( $args['icon'] ) ? $args['icon'] : '';
        $text_html = sprintf( '<span class="button-text">%1$s</span>', esc_html( $text ) );
        $icon_html = ( $icon != '' ) ? sprintf( '<span class="button-icon"><i class="%1$s"></i></span>', esc_attr( $icon ) ) : '';
        echo apply_filters( 'blogzee_button_html', sprintf( '<a class="%1$s" href="%2$s">%3$s%4$s</a>', esc_attr( $classes ), esc_url( $link ), wp_kses_post( $text_html ), wp_kses_post( $icon_html ) ) );
    }
    add_action( 'blogzee_section_block_view_all_hook', 'blogzee_button_html', 10, 1 );
endif;