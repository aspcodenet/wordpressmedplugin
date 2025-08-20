<?php
    /**
     * Footer Builder
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    namespace Blogzee_Builder;
    // require 'base.php';
    use Blogzee\CustomizerDefault as BZ;
    if( ! class_exists( 'Footer_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Footer_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BZ\blogzee_get_customizer_option( 'footer_builder' );
                $this->builder_value = $this->original_value;
                $this->assign_values();
                $this->prepare_value_for_render();
                $this->render();
            }

            /**
             * Assign values
             * 
             * @since 1.0.0
             */
            public function assign_values() {
                /* Column count */
                $footer_first_row_column = BZ\blogzee_get_customizer_option( 'footer_first_row_column' );
                $footer_second_row_column = BZ\blogzee_get_customizer_option( 'footer_second_row_column' );
                $footer_third_row_column = BZ\blogzee_get_customizer_option( 'footer_third_row_column' );
                $this->columns_array = [ $footer_first_row_column, $footer_second_row_column, $footer_third_row_column ];
                /* Columns layout */
                $footer_first_row_column_layout = BZ\blogzee_get_customizer_option( 'footer_first_row_column_layout' );
                $footer_second_row_column_layout = BZ\blogzee_get_customizer_option( 'footer_second_row_column_layout' );
                $footer_third_row_column_layout = BZ\blogzee_get_customizer_option( 'footer_third_row_column_layout' );
                $this->column_layouts_array = [ $footer_first_row_column_layout, $footer_second_row_column_layout, $footer_third_row_column_layout];
                /* Column Alignments */
                $this->column_alignments_array = $this->organize_column_alignments();
            }
            
            /**
             * Column alignments
             * 
             * @since 1.0.0
             */
            public function organize_column_alignments() {
                $column_alignments = [
                    [
                        /* First Row */
                        BZ\blogzee_get_customizer_option( 'footer_first_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'footer_first_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'footer_first_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'footer_first_row_column_four' )
                    ],
                    [
                        /* Second Row */
                        BZ\blogzee_get_customizer_option( 'footer_second_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'footer_second_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'footer_second_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'footer_second_row_column_four' )
                    ],
                    [
                        /* Third Row */
                        BZ\blogzee_get_customizer_option( 'footer_third_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'footer_third_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'footer_third_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'footer_third_row_column_four' )
                    ]
                ];

                $structured_alignements = [];
                if( count( $this->columns_array ) > 0 ) :
                    $columns_array_count = count( $this->columns_array );
                    for( $i = 0; $i < $columns_array_count; $i++ ) :
                        $structured_alignements[ $i ] = $column_alignments[ $i ];
                    endfor;
                endif;

                return $structured_alignements;
            }

            /**
             * Extra row classes
             * 
             * @since 1.0.0
             */
            public function get_extra_row_classes( $row_index ) {
                $row_widgets = $this->builder_value[ $row_index ];
                $only_widgets = array_reduce( $row_widgets, 'array_merge', [] );
                $classes = ' is-horizontal vertical-align--center';
                $classes .= ' tablet-layout-' . $this->column_layouts_array[ $row_index ]['tablet'];
                $classes .= ' smartphone-layout-' . $this->column_layouts_array[ $row_index ]['smartphone'];
                return $classes;
            }

            /**
             * Extra column classes
             * 
             * @since 1.0.0
             */
            public function get_extra_column_classes( $row, $column ) {
                $column_alignments = $this->column_alignments_array[ $row ][ $column ];
                $classes = '';
                $classes .= ' tablet-alignment--' . $this->column_alignments_array[ $row ][ $column ][ 'tablet' ];
                $classes .= ' smartphone-alignment--' . $this->column_alignments_array[ $row ][ $column ][ 'smartphone' ];
                return $classes;
            }

            /**
             * Get widget html
             * 
             * @since 1.0.0
             */
            public function get_widget_html( $widget ) {
                if( ! $widget ) return;
                switch( $widget ) :
                    case 'logo':
                        /**
                         * hook - blogzee_footer_logo_hook
                         * 
                         * @hooked - blogzee_footer_logo_part - 10
                         */
                        if( has_action( 'blogzee_footer_logo_hook' ) ) do_action( 'blogzee_footer_logo_hook' );
                        break;
                    case 'social-icons':
                        /**
                         * hook - blogzee_footer_social_hook
                         * 
                         * @hooked - blogzee_footer_social_icons - 10
                         */
                        if( has_action( 'blogzee_footer_social_hook' ) ) do_action( 'blogzee_footer_social_hook' );
                        break;
                    case 'copyright':
                        /**
                         * hook - blogzee_footer_copyright_hook
                         * 
                         * @hooked - blogzee_footer_copyright_part - 10
                         */
                        if( has_action( 'blogzee_footer_copyright_hook' ) ) do_action( 'blogzee_footer_copyright_hook' );
                        break;
                    case 'menu':
                        /**
                         * hook - blogzee_footer__menu_section_hook
                         * 
                         * @hooked - blogzee_footer_menu - 10
                         */
                        if( has_action( 'blogzee_footer__menu_section_hook' ) ) do_action( 'blogzee_footer__menu_section_hook' );
                        break;
                    case 'sidebar-one':
                        /**
                         * sidebar-id = 'footer-sidebar-column-1'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-1' );
                        break;
                    case 'sidebar-two':
                        /**
                         * sidebar-id = 'footer-sidebar-column-2'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-2' );
                        break;
                    case 'sidebar-three':
                        /**
                         * sidebar-id = 'footer-sidebar-column-3'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-3' );
                        break;
                    case 'sidebar-four':
                        /**
                         * sidebar-id = 'footer-sidebar-column-4'
                         */
                        dynamic_sidebar( 'footer-sidebar-column-4' );
                        break;
                    case 'you-may-have-missed':
                         /**
                         * hook - blogzee_you_may_have_missed_hook
                         * 
                         * @hooked - blogzee_you_may_have_missed_html - 10
                         */
                        if( has_action( 'blogzee_you_may_have_missed_hook' ) ) do_action( 'blogzee_you_may_have_missed_hook' );
                        break;
                    case 'scroll-to-top':
                         /**
                         * hook - blogzee_scroll_to_top_hook
                         * 
                         * @hooked - blogzee_scroll_to_top_html - 10
                         */
                        if( has_action( 'blogzee_scroll_to_top_hook' ) ) do_action( 'blogzee_scroll_to_top_hook' );
                        break;
                endswitch;
            }
        }
    endif;