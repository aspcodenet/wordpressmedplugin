<?php
/**
 * Checkbox Control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

if( class_exists( 'Blogzee_WP_Base_Control' ) ) :
    class Blogzee_WP_Checkbox_Control extends \Blogzee_WP_Base_Control {
        /**
         * Control type
         * 
         * @since 1.0.0
         */
        public $type = 'blogzee-checkbox';

        /** 
         * Render the control's content
         * 
         * /** @since 1.0.0
         */
        public function render_content() {
            ?>
                <span class="customize-inside-control-row">
                    <input type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php checked( $this->value() ); ?> />
                    <?php
                        if ( ! empty( $this->label ) ) echo '<label class="customize-control-title">', esc_html( $this->label ), '</label>';
                        if ( ! empty( $this->description ) ) echo '<p class="customize-control-description">', esc_html( $this->description ), '</p>';
                    ?>
                </span>
            <?php

        }
    }
endif;