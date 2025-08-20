<?php
    /**
     * Base class for header and footer builder
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    namespace Blogzee_Builder;
    use Blogzee\CustomizerDefault as BZ;
    if( ! class_exists( 'Header_Builder_Render' ) ) :
        /**
         * Builder Base class
         * 
         * @since 1.0.0
         */
        class Header_Builder_Render extends Builder_Base {
            /**
             * Method that gets called when class is instantiated
             * 
             * @since 1.0.0
             */
            public function __construct() {
                $this->original_value = BZ\blogzee_get_customizer_option( 'header_builder' );
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
                /* Columns count */
                $this->columns_array = [ 
                    BZ\blogzee_get_customizer_option( 'header_first_row_column' ),
                    BZ\blogzee_get_customizer_option( 'header_second_row_column' ),
                    BZ\blogzee_get_customizer_option( 'header_third_row_column' )
                ];
                /* Columns layout */
                $this->column_layouts_array = [
                    BZ\blogzee_get_customizer_option( 'header_first_row_column_layout' ),
                    BZ\blogzee_get_customizer_option( 'header_second_row_column_layout' ),
                    BZ\blogzee_get_customizer_option( 'header_third_row_column_layout' )
                ];
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
                        BZ\blogzee_get_customizer_option( 'header_first_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'header_first_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'header_first_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'header_first_row_column_four' )
                    ],
                    [
                        /* Second Row */
                        BZ\blogzee_get_customizer_option( 'header_second_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'header_second_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'header_second_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'header_second_row_column_four' )
                    ],
                    [
                        /* Third Row */
                        BZ\blogzee_get_customizer_option( 'header_third_row_column_one' ),
                        BZ\blogzee_get_customizer_option( 'header_third_row_column_two' ),
                        BZ\blogzee_get_customizer_option( 'header_third_row_column_three' ),
                        BZ\blogzee_get_customizer_option( 'header_third_row_column_four' )
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
                $header_sticky = $this->get_row_header_sticky_value( $row_index );
                $classes = '';
                if( $header_sticky ) $classes .= ' row-sticky';
                if( in_array( 'menu', $only_widgets ) ) $classes .= ' has-menu';
                return $classes;
            }

            /**
             * Header sticky controls in an array
             * 
             * @since 1.0.0
             */
            public function get_row_header_sticky_value( $row_index ) {
                $header_sticky_controls = [
                    BZ\blogzee_get_customizer_option( 'header_first_row_header_sticky' ),
                    BZ\blogzee_get_customizer_option( 'header_second_row_header_sticky' ),
                    BZ\blogzee_get_customizer_option( 'header_third_row_header_sticky' )
                ];
                return $header_sticky_controls[ $row_index ];
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
                endswitch;
            }
        }
    endif;