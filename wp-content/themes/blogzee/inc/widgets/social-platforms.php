<?php
/**
 * Social Platforms Widget
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

 class Blogzee_Social_Platforms_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogzee_social_platforms_widget',
            esc_html__( 'Blogzee: Social Platforms', 'blogzee' ),
            [ 'description' => __( 'A collection of social platforms', 'blogzee' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $icon_inherit_color = isset( $instance['icon_inherit_color'] ) ? $instance['icon_inherit_color'] : '';
        echo wp_kses_post( $before_widget );
            if( ! empty( $widget_title ) ) echo $before_title . $widget_title . $after_title;
            ?>
                <div class="social-platforms-widget<?php if( $icon_inherit_color ) echo esc_attr( ' global-color-icon' ); ?>">
                    <?php blogzee_customizer_social_icons(); ?>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        return [
            [
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'title' =>  esc_html__( 'Widget Title', 'blogzee' ),
                'description'   =>  esc_html__( 'Add the widget title here', 'blogzee' ),
                'default'   =>  esc_html__( 'Find Me On', 'blogzee' )
            ],
            [
                'name'  =>  'icon_inherit_color',
                'type'  =>  'checkbox',
                'title' =>  esc_html__( 'Inherit global default social icons color', 'blogzee' ),
                'default'   =>  true
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
        ?>
            <div class="refer-note">
                <p>
                    <?php echo esc_html__( 'Manage social icons from customizer ', 'blogzee' ); ?>
                    <a href="<?php echo admin_url( 'customize.php?autofocus[control]=social_icons_section_heading' ); ?>" target="_blank"><?php echo esc_html__( 'go to manage social icons', 'blogzee' ); ?></a>
                </p>
            </div>
        <?php
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