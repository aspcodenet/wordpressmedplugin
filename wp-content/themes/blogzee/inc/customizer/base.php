<?php
/**
 * Blogzee Custom Controls
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

 if( class_exists( 'WP_Customize_Control' ) ) :
    class Blogzee_WP_Base_Control extends \WP_Customize_Control {
      /**
      * List of controls for this theme
      * 
      * @since 1.0.0
      */
      protected $type_array = [];
      public $tab = 'general';
      public $bottom_separator = false;

      /**
      * Add custom JSON parameters to use in the JS template.
      * 
      * @since 1.0.0
      * @access public
      * @return void
      */
      public function to_json() {
         parent::to_json();
         $this->json['default'] = $this->setting->default;
         if( $this->tab && $this->type != 'section-tab' ) {
            $this->json['tab'] = $this->tab;
         }
         $this->json['bottom_separator'] = $this->bottom_separator;
      }

      /**
       * Generates the unique identifier for the control
       */
      function identifier_id() {
         return apply_filters( 'blogzee_unique_identifier', $this->type );
      }

      /**
      * Renders the control wrapper and calls $this->render_content() for the internals.
      *
      * @since 1.0.0
      */
      protected function render() {
         $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
         $class = 'customize-control customize-control-' . $this->type;
         if( $this->bottom_separator ) $class .= ' blogzee-bottom-separator';

         printf( '<li id="%s" class="%s">', esc_attr( $id ), esc_attr( $class ) );
         $this->render_content();
         echo '</li>';
      }

      /**
       * Override control's content
       */
      public function render_content() {
         ?>
            <div class="<?php echo esc_attr( $this->identifier_id() ); ?>" data-setting="<?php if( isset( $this->setting->id ) ) echo esc_attr( $this->setting->id ); ?>"></div>
         <?php
      }

    }
 endif;