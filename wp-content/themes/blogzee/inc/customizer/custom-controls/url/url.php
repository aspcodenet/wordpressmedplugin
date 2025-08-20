<?php
/**
 * Url Control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

if( class_exists( 'Blogzee_WP_Base_Control' ) ) :
    class Blogzee_WP_Url_Control extends \Blogzee_WP_Base_Control {
        /**
         * Control type
         * 
         * @since 1.0.0
         */
        public $type = 'blogzee-url';

        /**
         * Render the control's content
         * 
         * @since 1.0.0
         */
        public function render_content() {
            if ( ! empty( $this->label ) ) echo '<span class="customize-control-title">', esc_html( $this->label ), '</span>';
            if ( ! empty( $this->description ) ) echo '<p class="customize-control-description">', esc_html( $this->description ), '</p>';
            ?>
                <input type="url" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->get_link(); ?> />
            <?php
        }
    }
endif;