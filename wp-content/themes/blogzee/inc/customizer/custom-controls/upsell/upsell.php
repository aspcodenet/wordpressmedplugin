<?php
/**
 * Upsell Control
 * 
 * @package Blogzee
 * @since 1.0.3
 */
if( ! class_exists( 'Blogzee_WP_Upsell_Control' ) ) :
    class Blogzee_WP_Upsell_Control extends Blogzee_WP_Base_Control {
        // control type
        public $type = 'upsell';
        public $features = [];
        public $button_label = '';
        public $url = '';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->tab ) $this->json['tab'] = $this->tab;
            $this->json['features'] = $this->features;
            $this->json['button_label'] = $this->button_label;
        }

        // Render the control's content
        public function render_content() {
            if( ! $this->button_label ) $this->button_label = esc_html__( 'View Premium', 'blogzee' );
            if( ! $this->url ) $this->url = '//blazethemes.com/theme/blogzee-pro/';
            ?>
                <div class="customize-upsell">
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php if( ! empty( $this->features ) && is_array( $this->features ) ) : ?>
                        <ul class="features-wrap">
                            <?php 
                                foreach( $this->features as $feature ) :
                                    echo '<li class="feature">', esc_html( $feature ) ,'</li>';
                                endforeach;
                            ?>
                        </ul>
                    <?php endif; ?>
                    <a class="upsell-btn" href="<?php echo esc_url( $this->url ); ?>" target="_blank"><?php echo esc_html( $this->button_label ); ?></a>
                </div>
            <?php
        }
    }
endif;