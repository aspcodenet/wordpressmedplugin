<?php
/**
 * Section Heading Control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

if( class_exists( 'WP_Customize_Control' ) ) :
    class Blogzee_WP_Section_Heading_Toggle_Control extends \Blogzee_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'section-heading-toggle';
        public $tab = 'general';
        public $initial = true;
        
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
                $this->json['initial'] = $this->initial;
            }
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since 3.4.0
         */
        public function enqueue() {
            wp_enqueue_script( 'blogzee-customizer-section-heading-toggle', get_template_directory_uri() . '/inc/customizer/custom-controls/section-heading-toggle/control.js', array('jquery'), BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
            wp_enqueue_style( 'blogzee-customizer-section-heading-toggle', get_template_directory_uri() . '/inc/customizer/custom-controls/section-heading-toggle/control.css', array(), BLOGZEE_VERSION, 'all' );
        }

        // Render the control's content
        public function render_content() {
    ?>
            <div class="customize-section-heading">
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="toggle-button"><span class="dashicons dashicons-arrow-up-alt2"></span></span>
            </div>
            <?php
        }
    }
endif;