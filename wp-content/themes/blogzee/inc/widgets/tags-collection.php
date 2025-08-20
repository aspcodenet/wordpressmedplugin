<?php
/**
 * Tags collection widget
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */

 class Blogzee_Tags_Collection_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogzee_tags_collection_widget',
            esc_html__( 'Blogzee: Tags Collection', 'blogzee' ),
            [ 'description' => __( 'A collection of post tags', 'blogzee' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = ( isset( $instance['widget_title'] ) ) ? $instance['widget_title'] : '';
        $post_tags = ( isset( $instance['post_tags'] ) ) ? $instance['post_tags'] : '';
        echo wp_kses_post( $before_widget );
            if( ! empty( $widget_title ) ) echo $before_title . esc_html( $widget_title ) .$after_title;
            ?>
                <div class="tags-wrap">
                    <?php
                        if( $post_tags ) :
                            $post_tags = get_tags( [ 'include' => explode( ',', $post_tags ) ] );
                        else:
                            $post_tags = get_tags( [ 'number' => '4' ] );
                        endif;
                        foreach( $post_tags as $tag ) :
                            $tag_name = $tag->name;
                            $tag_count = $tag->count;
                            $tag_id = $tag->term_id;
                            ?>
                                <div class="post-thumb tags-item tag-<?php echo esc_attr( $tag_id ); ?>">
                                    <a class="tag-meta-wrap" href="<?php echo esc_url( get_term_link( $tag_id ) ); ?>">
                                        <div class="tag-meta blogzee-post-title">
                                            <?php
                                                echo sprintf( '<span class="tags-name">%1s</span><span class="tags-count">%2s</span>', esc_html( $tag_name ), absint( $tag_count ) );
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        endforeach;
                    ?>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        $tags_query_args = get_tags();
        foreach( $tags_query_args as $tags ) :
            $tags_options[$tags->term_taxonomy_id] = $tags->name .'('. $tags->count .')';
        endforeach;
        $tags_options['type'] = 'tag';
        return [
            [
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'title' =>  esc_html( 'Widget Title', 'blogzee' ),
                'description'   =>  esc_html__( 'Add the widget title here', 'blogzee' ),
                'default'   =>  esc_html__( 'Tags Collection', 'blogzee' )
            ],
            [
                'name'  =>  'post_tags',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post tags', 'blogzee' ),
                'description'   =>  esc_html__( 'Choose the tags to display', 'blogzee' ),
                'options'   =>  $tags_options
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
        if( ! is_array( $widget_fields ) ) return $instance;
        foreach( $widget_fields as $widget_field ) :
            $instance[ $widget_field['name'] ] = blogzee_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;
        return $instance;
    }
 }