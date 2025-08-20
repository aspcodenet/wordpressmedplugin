<?php
    /**
     * Base class for responsive header builder
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    namespace Blogzee_Builder;
    require 'header-builder.php';
    use Blogzee\CustomizerDefault as BZ;
    if( ! class_exists( 'Responsive_Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Responsive_Header_Builder_Render extends Header_Builder_Render {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BZ\blogzee_get_customizer_option( 'responsive_header_builder' );
                $this->builder_value = $this->original_value;
                $this->responsive = 'tablet';
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Opening div
             * 
             * @since 1.0.0
             */
            protected function opening_div() {
                $wrapperClass = $this->prefix_class . '-responsive';
                echo '<div class="'. esc_attr( $wrapperClass ) .'">';
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                require get_template_directory() . '/inc/hooks/top-header-hooks.php';
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'site-logo':
                        /**
                        * hook - blogzee_header__site_branding_section_hook
                        * 
                        * @hooked - blogzee_header_menu_part - 10
                        */
                        if( has_action( 'blogzee_header__site_branding_section_hook' ) ) do_action( 'blogzee_header__site_branding_section_hook' );
                        break;
                    case 'date-time':
                        /**
                        * hook - blogzee_date_time_hook
                        * 
                        * @hooked - blogzee_date_time_part - 10
                        */
                        if( has_action( 'blogzee_date_time_hook' ) ) do_action( 'blogzee_date_time_hook' );
                        break;
                    case 'social-icons':
                        /**
                        * hook - blogzee_social_icons_hook
                        * 
                        * @hooked - blogzee_social_part - 10
                        */
                        if( has_action( 'blogzee_social_icons_hook' ) ) do_action( 'blogzee_social_icons_hook' );
                        break;
                    case 'search':
                        /**
                         * hook - blogzee_header_search_hook
                         * 
                         * @hooked - blogzee_header_search_part - 10
                         */
                        if( has_action( 'blogzee_header_search_hook' ) ) do_action( 'blogzee_header_search_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - blogzee_header__menu_section_hook
                         * 
                         * @hooked - blogzee_header_menu_part - 10
                         */
                        if( has_action( 'blogzee_header__menu_section_hook' ) ) do_action( 'blogzee_header__menu_section_hook' );
                        break;
                    case 'button':
                        /**
                         * hook - blogzee_header__custom_button_section_hook
                         * 
                         * @hooked - blogzee_header_custom_button_part - 10
                         */
                        if( has_action( 'blogzee_header__custom_button_section_hook' ) ) do_action( 'blogzee_header__custom_button_section_hook' );
                        break;
                    case 'theme-mode':
                        /**
                         * hook - blogzee_header_theme_mode_hook
                         * 
                         * @hooked - blogzee_header_theme_mode_part - 10
                         */
                        if( has_action( 'blogzee_header_theme_mode_hook' ) ) do_action( 'blogzee_header_theme_mode_hook' );
                        break;
                    case 'off-canvas':
                        /**
                         * hook - blogzee_header_off_canvas_hook
                         * 
                         * @hooked - blogzee_header_canvas_menu_part - 10
                         */
                        if( has_action( 'blogzee_header_off_canvas_hook' ) ) do_action( 'blogzee_header_off_canvas_hook' );
                        break;
                    case 'toggle-button':
                        /**
                         * Function - blogzee_get_toggle_button_html
                         */
                        return blogzee_get_toggle_button_html();
                        break;
                endswitch;
            }

            /**
             * Mobile canvas
             * 
             * @since 1.0.0
             */
            public function get_mobile_canvas() {
                $rowClass = $this->prefix_class . 'row';
                $rowClass .= ' mobile-canvas';
                $responsive_header_builder = BZ\blogzee_get_customizer_option( 'responsive_header_builder' );
                $mobile_canvas_alignment = BZ\blogzee_get_customizer_option( 'mobile_canvas_alignment' );
                $rowClass .= ' alignment--' . $mobile_canvas_alignment;
                $canvas = $responsive_header_builder['responsive-canvas'];
                $only_widgets = array_reduce( $this->original_value, 'array_merge', [] );
                if( ! in_array( 'toggle-button', $only_widgets ) ) return;
                ?>
                    <div class="<?php echo esc_attr( $rowClass ); ?>">
                        <?php
                            if( ! empty( $canvas ) && is_array( $canvas ) ) :
                                foreach( $canvas as $widget_index => $widget ) :
                                    $this->render_widget( $widget, $widget_index );
                                endforeach;
                            endif;
                        ?>
                    </div>
                <?php
            }
        }
    endif;