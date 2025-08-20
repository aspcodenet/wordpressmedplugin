<?php
/**
 * Post Grid widget
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */

 class Blogzee_Post_Grid_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogzee_post_grid_widget',
            esc_html__( 'Blogzee: Post Grid', 'blogzee' ),
            [ 'description' => __( 'A collection of post in a grid', 'blogzee' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = ( isset( $instance['widget_title'] ) ) ? $instance['widget_title'] : '';
        $number_of_posts_to_show = ( isset( $instance['number_of_posts_to_show'] ) ) ? $instance['number_of_posts_to_show'] : '';
        $posts_categories = ( isset( $instance['post_catgories'] ) ) ? $instance['post_catgories'] : '';
        $post_to_include = ( isset( $instance['post_to_include'] ) ) ? $instance['post_to_include'] : '';
        $image_size = ( isset( $instance['image_size'] ) ) ? $instance['image_size'] : '';
        $image_ratio = ( isset( $instance['image_ratio'] ) ) ? $instance['image_ratio'] : json_encode([ 'desktop' => 0.55, 'tablet' => 0.55, 'smartphone' => 0.55 ]);
        $post_grid_query_args = [
            'post_type' =>  'post',
            'post_status'   =>  'publish',
            'posts_per_page'    =>  absint( $number_of_posts_to_show ),
            'ignore_sticky_posts'   =>  true
        ];
        if( isset( $posts_categories ) ) $post_grid_query_args['cat'] = $posts_categories;
        if( ! empty( $post_to_include ) ) $post_grid_query_args['post__in'] = explode( ',', $post_to_include );

        echo wp_kses_post( $before_widget );
            if( isset( $widget_id ) ) :
                echo '<style id="'. esc_attr( $widget_id ) .'">';
                    $image_ratio = json_decode( $image_ratio );
                    echo "#". $widget_id ." .post-grid-wrap .post-thumb-image { padding-bottom: calc( ". $image_ratio->desktop ." * 100% ) }\n";
                    echo "@media (max-width: 994px){ #". $widget_id ." .tags-wrap .tags-item.post-thumb { padding-bottom: calc( ". $image_ratio->tablet ." * 100% ) } }\n";
                    echo "@media (max-width: 610px){ #". $widget_id ." .tags-wrap .tags-item.post-thumb { padding-bottom: calc( ". $image_ratio->smartphone ." * 100% ) } }\n";

                echo '</style>';
            endif;
            if( ! empty( $widget_title ) ) echo $before_title . $widget_title . $after_title;
            $post_grid_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $post_grid_query_args ) );
            if( $post_grid_query->have_posts() ) :
                $elementClass = 'post-grid-wrap';
                ?>
                    <div class="<?php echo esc_attr( $elementClass ); ?>">
                        <?php
                            while( $post_grid_query->have_posts() ) :
                                $post_grid_query->the_post();
                                ?>
                                    <div class="post-item format-standard">
                                        <div class="post-thumb-image<?php if( ! has_post_thumbnail() ) echo ' no-feat-img'?>">
                                            <figure class="post-thumb">
                                                <?php if( has_post_thumbnail() ) the_post_thumbnail( $image_size ); ?>
                                            </figure>
                                            <?php echo blogzee_get_post_categories( get_the_ID() ); ?>
                                        </div>
                                        <div class="post-content-wrap">
                                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php 
                                                echo '<div class="post-meta">';
                                                    blogzee_posted_on();
                                                echo '</div>';
                                            ?>
                                        </div>
                                    </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        ?>
                    </div>
                <?php
            endif;
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        // for category
        $post_categories_args = get_categories();
        foreach( $post_categories_args as $category ) :
            $category_list[$category->term_id] = $category->name .'('. $category->count .')';
        endforeach;
        $category_list['type'] = 'category';

        // for posts
        $post_args = [
            'post_type' =>  'post',
            'post_status'=>  'publish',
            'posts_per_page'    =>  -1
        ];
        $posts_query = new \WP_Query( apply_filters( 'blogzee_query_args_filter', $post_args ) );
        if( $posts_query->have_posts() ) :
            while( $posts_query->have_posts() ) :
                $posts_query->the_post();
                $post_list[ get_the_ID() ] = get_the_title();
            endwhile;
        endif;
        $post_list['type'] = 'post';
        wp_reset_postdata();
        return [
            [
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'title' =>  esc_html( 'Widget Title', 'blogzee' ),
                'description'   =>  esc_html__( 'Add the widget title here', 'blogzee' ),
                'default'   =>  esc_html__( 'Post Grid', 'blogzee' )
            ],
            [
                'name'  =>  'post_catgories',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post Categories', 'blogzee' ),
                'description'   =>  esc_html__( 'Choose the category to display list of posts', 'blogzee' ),
                'options'   =>  $category_list
            ],
            [
                'name'  =>  'post_to_include',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post to Include', 'blogzee' ),
                'description'   =>  esc_html__( 'Choose the posts to display in the list of posts', 'blogzee' ),
                'options'   =>  $post_list
            ],
            [
                'name'  =>  'number_of_posts_to_show',
                'title' =>  esc_html__( 'Number of posts to show', 'blogzee' ),
                'type'  =>  'number',
                'default'   =>  4,
                'max'   =>  6
            ],
            [
                'name'  =>  'image_settings_heading',
                'type'  =>  'heading',
                'label' =>  esc_html__( 'Image Settings', 'blogzee' )
            ],
            [
                'name'  =>  'image_size',
                'type'  =>  'select',
                'title' =>  esc_html__( 'Image Size', 'blogzee' ),
                'options'   =>  blogzee_get_image_sizes_option_array(),
                'default'   =>  'medium'
            ],
            [
                'name'  =>  'image_ratio',
                'type'  =>  'responsive-number',
                'title' =>  esc_html__( 'Image Ratio', 'blogzee' ),
                'min'   =>  0,
                'max'   =>  2,
                'step'  =>  0.1,
                'default'   =>  json_encode([
                    'desktop'    =>  0.55,
                    'tablet'    =>  0.55,
                    'smartphone'    =>  0.55
                ])
            ]
        ];
    }

    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if( isset( $instance[ $widget_field['name'] ] ) ) :
                $field_value = $instance[ $widget_field['name'] ];
            elseif( isset( $widget_field['default'] ) ) :
                $field_value = $widget_field['default'];
            else:
                $field_value = '';
            endif;
            blogzee_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) return;
        foreach( $widget_fields as $widget_field ) :
            $instance[ $widget_field['name'] ] = blogzee_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;
        return $instance;
    }
 }