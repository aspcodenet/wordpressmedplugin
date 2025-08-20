<?php
/**
 * Icon Picker Control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :
    class Blogzee_WP_Icon_Picker_Control extends \Blogzee_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'icon-picker';
        public $tab = 'general';
        public $include_media = false;

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->tab ) {
                $this->json['tab'] = $this->tab;
            }
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            wp_enqueue_style( 'blogzee-customizer-icon-picker', get_template_directory_uri() . '/inc/customizer/custom-controls/icon-picker/control.css', array(), BLOGZEE_VERSION, 'all' );
            wp_enqueue_media();
            wp_enqueue_script( 'blogzee-customizer-icon-picker', get_template_directory_uri() . '/inc/customizer/custom-controls/icon-picker/control.js', array('jquery'), BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
        }

        // Render the control's content
        public function render_content() {
            $value = $this->value();
            $default = $this->setting->default;
            $current_icon = ( $value['type'] == 'icon' ) ? $value['value']: $default['value'];
    ?>
            <div class="customize-icon-picker">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="picker-buttons-wrap">
                    <span class="button-action select-none <?php if( $value['type'] == 'none' ) echo 'active' ?>" title="<?php echo esc_attr( 'None' ); ?>"><i class="fa-solid fa-ban"></i></span>
                    <?php if( $this->include_media ) : ?>
                        <span class="button-action select-upload <?php if( $value['type'] == 'svg' ) echo 'active' ?>" title="<?php echo esc_attr( 'Upload svg' ); ?>"><span class="dashicons dashicons-upload"></span></span>
                    <?php endif; ?>
                    <span class="button-action select-icon <?php if( $value['type'] == 'icon' ) echo 'active' ?>" title="<?php echo esc_attr( 'Select Icon' ); ?>"><i class="<?php echo esc_attr( $current_icon ); ?>"></i></span>
                </span>
                <?php
                    if( isset( $this->description ) && $this->description ) :
                ?>
                    <p class="customize-control-title"><?php echo esc_html( $this->description ); ?></p>
                <?php 
                    endif;

                    $icons_array = blogzee_get_all_fontawesome_icons();
                    if( $icons_array ) :
                        echo '<div class="icon-picker-modal" style="display:none">';
                            echo '<div class="icon-picker-search">';
                                echo '<input type="search" placeholder="' .esc_html__( 'Type to search . .', 'blogzee' ). '"/>';
                            echo '</div>';
                            echo '<div class="icon-picker-list">';
                                foreach( $icons_array as $icon ) :
                            ?>
                                    <span class="icon-item <?php if( $icon == $current_icon ) echo 'selected'; ?>"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
                            <?php
                                endforeach;
                            echo '</div>';
                        echo '</div>';
                    endif;
                ?>
                <input type="hidden" id="<?php echo esc_attr( '_customize-input-' . $this->id ); ?>">
            </div>
            <?php
        }
    }
endif;