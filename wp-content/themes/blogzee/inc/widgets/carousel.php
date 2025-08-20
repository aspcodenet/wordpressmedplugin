<?php
/**
 * Adds Blogzee_Carousel_Widget widget.
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
class Blogzee_Carousel_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'blogzee_carousel_widget',
            esc_html__( 'Blogzee : Carousel Posts', 'blogzee' ),
            array( 'description' => __( 'A collection of posts from specific category for carousel slide.', 'blogzee' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_category = isset( $instance['posts_category'] ) ? $instance['posts_category'] : '';
        
        echo wp_kses_post($before_widget);
            // Slider direction
            $blogzee_widget_attr = '';
            if( empty( $widget_title ) ) $blogzee_widget_attr .= ' no_heading_widget';
            ?>
            <div class="blogzee-widget-carousel-posts blogzee_horizontal_slider<?php echo esc_attr( $blogzee_widget_attr ); ?>">
                <?php if( ! empty( $widget_title ) ) echo $before_title . esc_html( $widget_title ) .$after_title; ?>
                <div class="carousel-posts-wrap blogzee-card swiper">
                    <div class="swiper-wrapper">
                        <?php
                            $carousel_posts_args = array( 
                                        'numberposts' => -1,
                                        'cat' => absint( $posts_category )
                                    );
                            if( empty( $posts_category ) ) $carousel_posts_args['numberposts'] = 4;
                            $carousel_posts = get_posts( apply_filters( 'blogzee_query_args_filter', $carousel_posts_args ) );
                            if( $carousel_posts ) :
                                $total_posts = sizeof($carousel_posts);
                                foreach( $carousel_posts as $carousel_post_key => $carousel_post ) :
                                    $carousel_post_id  = $carousel_post->ID;
                                ?>
                                        <article class="post-item swiper-slide <?php if(!has_post_thumbnail($carousel_post_id)){ echo esc_attr(' no-feat-img');} ?>">
                                            <figure class="post-thumb-wrap">
                                                <?php if( has_post_thumbnail($carousel_post_id) ): ?> 
                                                    <a href="<?php echo esc_url(get_the_permalink($carousel_post_id)); ?>">
                                                        <img src="<?php echo esc_url( get_the_post_thumbnail_url($carousel_post_id, 'blogzee-list') ); ?>" loading="lazy"/>
                                                        <div class="thumb-overlay"></div>
                                                    </a>
                                                <?php endif; ?>
                                                <?php blogzee_get_post_categories( $carousel_post_id, 2 ); ?>
                                            </figure>
                                            <div class="post-element">
                                                <h2 class="post-title"><a href="<?php the_permalink($carousel_post_id); ?>"><?php echo wp_kses_post( get_the_title($carousel_post_id) ); ?></a></h2>
                                                <div class="post-meta">
                                                    <?php blogzee_posted_on( $carousel_post_id ); ?>
                                                </div>
                                            </div>
                                        </article>
                                <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                    <div class="custom-button-prev swiper-arrow"><i class="fas fa-chevron-left"></i></div>
                    <div class="custom-button-next swiper-arrow"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
    <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $categories = get_categories();
        $categories_options[''] = esc_html__( 'Select category', 'blogzee' );
        foreach( $categories as $category ) :
            $categories_options[$category->term_id] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'blogzee' ),
                    'description'=> esc_html__( 'Add the widget title here', 'blogzee' ),
                    'default'   => esc_html__( 'Highlights', 'blogzee' )
                ),
                array(
                    'name'      => 'posts_category',
                    'type'      => 'select',
                    'title'     => esc_html__( 'Categories', 'blogzee' ),
                    'description'=> esc_html__( 'Choose the category to display for carousel posts', 'blogzee' ),
                    'options'   => $categories_options
                )
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            blogzee_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = blogzee_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class Blogzee_Carousel_Widget