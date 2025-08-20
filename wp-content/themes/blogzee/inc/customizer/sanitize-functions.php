<?php
/**
 * Includes sanitize functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

 if( ! function_exists( 'blogzee_sanitize_solid_color' )  ) :
    /**
     * Sanitize color code
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_solid_color( $color_code ) {
        if( is_null( $color_code ) ) return false;
        if( sanitize_hex_color( $color_code ) ) { // 3 or 6 hex digits, or the empty string.
            return $color_code;
        } else if ( preg_match( '|^#([A-Fa-f0-9]{8})|', $color_code ) ) { // 8 hex digits, or the empty string.
            return $color_code;
        } else if ( strlen( $color_code ) > 8 && substr( $color_code, 0, 23 ) === "--blogzee-global-preset" ) {
			return $color_code;
		} else {
            return false;
        }
    }
 endif;

 if( ! function_exists( 'blogzee_sanitize_color_value' ) ) :
    /**
     * Sanitize color value
     * 
     * @var $color holds the color and its type
     * @since 1.0.0
     */
    function blogzee_sanitize_color_value( $color ) {
        if( empty( $color ) && ! is_array( $color ) ) return false;
        if( ! array_key_exists( 'type', $color ) ) return false;

        $expected_color_types = [ 'solid', 'gradient', 'image' ];
        $sanitized_color = [];
        if( in_array( $color['type'], $expected_color_types ) ) :
            $type = $color['type'];
            $sanitized_color['type'] = sanitize_text_field( $type );
            switch( $type ) :
                case 'solid':
                    $filtered_color = blogzee_sanitize_solid_color( $color[ $type ] );
                    if( ! $filtered_color ) return $color;
                    $sanitized_color[ $type ] = blogzee_sanitize_solid_color( $color[ $type ] );
                    break;
                case 'gradient':
                    $sanitized_color[ $type ] = sanitize_text_field( $color[ $type ] );
                    break;
                case 'image':
                    $image = $color[ $type ];
                    if( ! array_key_exists( 'id', $image ) || ! array_key_exists( 'url', $image ) ) return false;
                    if( ! is_int( $image[ 'id' ] ) ) return false;

                    $sanitized_color[ $type ][ 'id' ] = absint( $image[ 'id' ] );
                    $sanitized_color[ $type ][ 'url' ] = esc_url( $image[ 'url' ] );
                    $sanitized_color[ 'position' ] = ( array_key_exists( 'position', $color ) ) ? sanitize_text_field( $color[ 'position' ] ) : 'left top';
                    $sanitized_color[ 'repeat' ] = ( array_key_exists( 'repeat', $color ) ) ? sanitize_text_field( $color[ 'repeat' ] ) : 'no-repeat';
                    $sanitized_color[ 'attachment' ] = ( array_key_exists( 'attachment', $color ) ) ? sanitize_text_field( $color[ 'attachment' ] ) : 'fixed';
                    $sanitized_color[ 'size' ] = ( array_key_exists( 'size', $color ) ) ? sanitize_text_field( $color[ 'size' ] ) : 'auto';
                    break;
            endswitch;
        endif;
        return $sanitized_color;
    }
endif;

 if( ! function_exists( 'blogzee_sanitize_initial_hover_color' ) ) :
    /**
     * Sanitize initial and hover color
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_initial_hover_color( $color ) {
        if( ! array_key_exists( 'initial', $color ) && ! array_key_exists( 'hover', $color ) ) return false;
        $sanitized_value = [];
        $initial = $color[ 'initial' ];
        $hover = $color[ 'hover' ];
        $filtered_initial = blogzee_sanitize_color_value( $initial );
        $filtered_hover = blogzee_sanitize_color_value( $hover );
        $sanitized_value[ 'initial' ] = $filtered_initial;
        $sanitized_value[ 'hover' ] = $filtered_hover;
        return $sanitized_value;
    }
 endif;

if( ! function_exists( 'blogzee_sanitize_toggle_control' )  ) :
    /**
     * Sanitize customizer toggle control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_toggle_control( $value ) {
        return rest_sanitize_boolean( $value );
    }
 endif;

 if( ! function_exists( 'blogzee_sanitize_get_responsive_integer_value' )  ) :
    /**
     * Sanitize number value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_get_responsive_integer_value( $value ) {
        $value['desktop'] = isset( $value['desktop'] ) ? $value['desktop'] : 0;
        $value['tablet'] = isset( $value['tablet'] ) ? $value['tablet'] : 0;
        $value['smartphone'] = isset( $value['smartphone'] ) ? $value['smartphone'] : 0;
        return apply_filters( BLOGZEE_PREFIX . 'custom_responsive_integer_value', $value );
    }
 endif;

  if( ! function_exists( 'blogzee_sanitize_url' )  ) :
    /**
     * Sanitize customizer url control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_url( $value ) {
        return esc_url_raw( $value );
    }
 endif;

 if( ! function_exists( 'blogzee_sanitize_select_control' )  ) :
    /**
     * Sanitize customizer select control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_select_control( $input, $setting ) {
        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
endif;

if( ! function_exists( 'blogzee_sanitize_responsive_range' )  ) :
    /**
     * Sanitize range slider control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_responsive_range($range, $setting) {
        // Ensure input is an absolute integer.
        foreach( $range as $rangKey => $rang ) :
            $range[$rangKey] = is_numeric( $rang ) ? $rang: 0;
        endforeach;
        // Get the input attributes associated with the setting.
        $atts = $setting->manager->get_control($setting->id)->input_attrs;

        // Get minimum number in the range.
        $min = ( isset($atts['min']) ? $atts['min'] : $number );
        // Get maximum number in the range.
        $max = ( isset($atts['max']) ? $atts['max'] : $number );
        // Get step.
        $step = ( isset($atts['step']) ? $atts['step'] : 1 );

        // If the number is within the valid range, return it; otherwise, return the default
        return ( ( $min <= $range['smartphone'] && $range['smartphone'] <= $max && is_numeric($range['smartphone'] / $step) && ( $min <= $range['tablet'] && $range['tablet'] <= $max && is_numeric($range['tablet'] / $step) ? $range : $setting->default ) && ( $min <= $range['desktop'] && $range['desktop'] <= $max && is_numeric($range['desktop'] / $step) ? $range : $setting->default ) ) ? $range : $setting->default );
    }
endif;

 if( ! function_exists( 'blogzee_sanitize_icon_picker_control' )  ) :
    /**
     * Sanitize array icon picker control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */ 
    function blogzee_sanitize_icon_picker_control( $value ) {
        $unslashed_value = wp_unslash( $value );
        if( ! in_array( $unslashed_value['type'], ['icon','svg','none'] ) ) {
            $unslashed_value['type'] = 'none';
            $unslashed_value['value'] = '';
        }
        return $unslashed_value;
    }
 endif;

 if( !function_exists( 'blogzee_sanitize_repeater_control' )  ) :
    /**
     * Sanitize color group image control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_repeater_control($value,$setting) {
        return apply_filters( BLOGZEE_PREFIX . 'repeater_control_value', wp_kses_post($value) );
    }
 endif;

 if( !function_exists( 'blogzee_sanitize_checkbox' )  ) :
    /**
     * Sanitize checkbox value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_checkbox($value) {
        return (  ( isset( $value ) && true === $value ) ? true : false );
    }
 endif;

 if( !function_exists( 'blogzee_sanitize_color_image_group_control' )  ) :
    /**
     * Sanitize color group image control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_color_image_group_control($value,$setting) {
        return apply_filters( BLOGZEE_PREFIX . 'color_image_group_control_value', wp_kses_post($value) );
    }
 endif;

 /**
 * Function to sanitize responsive spacing control
 */

if( ! function_exists( 'blogzee_sanitize_spacing_control' ) ) :
    function blogzee_sanitize_spacing_control( $value, $setting ) {
        if( ! is_array( $value ) ) return $settings->default;
        // for desktop
        $value['desktop']['top'] = isset( $value['desktop']['top'] ) && is_int( $value['desktop']['top'] ) ? $value['desktop']['top'] : $setting->default['desktop']['top'];
        $value['desktop']['right'] = isset( $value['desktop']['right'] ) && is_int( $value['desktop']['right'] ) ? $value['desktop']['right'] : $setting->default['desktop']['right'];
        $value['desktop']['bottom'] = isset( $value['desktop']['bottom'] ) && is_int( $value['desktop']['bottom'] ) ? $value['desktop']['bottom'] : $setting->default['desktop']['bottom'];
        $value['desktop']['left'] = isset( $value['desktop']['left'] ) && is_int( $value['desktop']['left'] ) ? $value['desktop']['left'] : $setting->default['desktop']['left'];
        $value['desktop']['link'] = isset( $value['desktop']['link'] ) && is_bool( $value['desktop']['link'] ) ? $value['desktop']['link'] : $setting->default['desktop']['link'];
        // for tablet
        $value['tablet']['top'] = isset( $value['tablet']['top'] ) && is_int( $value['tablet']['top'] ) ? $value['tablet']['top'] : $setting->default['tablet']['top'];
        $value['tablet']['right'] = isset( $value['tablet']['right'] ) && is_int( $value['tablet']['right'] ) ? $value['tablet']['right'] : $setting->default['tablet']['right'];
        $value['tablet']['bottom'] = isset( $value['tablet']['bottom'] ) && is_int( $value['tablet']['bottom'] ) ? $value['tablet']['bottom'] : $setting->default['tablet']['bottom'];
        $value['tablet']['left'] = isset( $value['tablet']['left'] ) && is_int( $value['tablet']['left'] ) ? $value['tablet']['left'] : $setting->default['tablet']['left'];
        $value['tablet']['link'] = isset( $value['tablet']['link'] ) && is_bool( $value['tablet']['link'] ) ? $value['tablet']['link'] : $setting->default['tablet']['link'];
        // for smartphone
        $value['smartphone']['top'] = isset( $value['smartphone']['top'] ) && is_int( $value['smartphone']['top'] ) ? $value['smartphone']['top'] : $setting->default['smartphone']['top'];
        $value['smartphone']['right'] = isset( $value['smartphone']['right'] ) && is_int( $value['smartphone']['right'] ) ? $value['smartphone']['right'] : $setting->default['smartphone']['right'];
        $value['smartphone']['bottom'] = isset( $value['smartphone']['bottom'] ) && is_int( $value['smartphone']['bottom'] ) ? $value['smartphone']['bottom'] : $setting->default['smartphone']['bottom'];
        $value['smartphone']['left'] = isset( $value['smartphone']['left'] ) && is_int( $value['smartphone']['left'] ) ? $value['smartphone']['left'] : $setting->default['smartphone']['left'];
        $value['smartphone']['link'] = isset( $value['smartphone']['link'] ) && is_bool( $value['smartphone']['link'] ) ? $value['smartphone']['link'] : $setting->default['smartphone']['link'];

        return $value;
    }
 endif;

 if( ! function_exists( 'blogzee_sanitize_color_control' ) ) :
    /**
     * Sanitize social share control value
     * @var $setting holds the instance of WP_Customize_Setting class
     * @var $values holds the current value of the control
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_color_control( $values, $setting ) {
        $default = $setting->default;
        if( empty( $values ) || ! is_array( $values ) ) return $default;   /* Return Default */

        $hover = $setting->manager->get_control( $setting->id )->hover;
        $sanitized_value = [];
        if( $hover ) :
            $filtered_color = blogzee_sanitize_initial_hover_color( $values );
            if( ! $filtered_color ) return $default;
            $sanitized_value = $filtered_color;
        else:
            $filtered_color = blogzee_sanitize_color_value( $values );
            if( ! $filtered_color ) return $default;
            $sanitized_value = $filtered_color;
        endif;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_async_multiselect_control' ) ) :
    /**
     * Sanitize async multiselect controls
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_async_multiselect_control( $values, $setting ) {
        if( empty( $values ) || ! is_array( $values ) ) return $setting->default; /* Return Default if $values is ( empty || not array ) */
        $sanitized_value = [];
        
        foreach( $values as $index => $value ) :
            $label = '';
            $id = '';
            if( array_key_exists( 'value', $value ) ) $id = $value['value'];
            if( array_key_exists( 'label', $value ) ) $label = $value['label'];
            if( is_string( $label ) ):
                $sanitized_value[ $index ]['label'] = sanitize_text_field( $label );
            else:
                return $setting->default;   /* Return Default */
            endif;

            if( is_int( $id ) ):
                $sanitized_value[ $index ]['value'] = absint( $id );
            else:
                return $setting->default;   /* Return Default */
            endif;
        endforeach;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_typography_values' ) ) :
    /**
     * Sanitize typography values
     * 
     * @param value
     * @param default
     * @since 1.0.0
     */
    function blogzee_sanitize_typography_values( $value, $default ) {
        $value['font_family']['value'] = isset( $value['font_family']['value'] ) ? esc_html( $value['font_family']['value'] ) : $default['font_family']['value'];
        $value['font_weight']['value'] = isset( $value['font_weight']['value'] ) ? esc_html( $value['font_weight']['value'] ) : '400';
        $value['font_size'] = isset( $value['font_size'] ) ? blogzee_sanitize_get_responsive_integer_value( $value['font_size'] ) : $default['font_size'];
        $value['line_height'] = isset( $value['line_height'] ) ? blogzee_sanitize_get_responsive_integer_value( $value['line_height'] ) : $default['line_height'];
        $value['letter_spacing'] = isset( $value['letter_spacing'] ) ? blogzee_sanitize_get_responsive_integer_value( $value['letter_spacing'] ) : $default['letter_spacing'];
        if( isset( $value['text_transform'] ) ) {
            $value['text_transform'] = in_array( $value['text_transform'], ['unset','capitalize','uppercase','lowercase'] ) ? esc_html( $value['text_transform'] ) : 'capitalize';
        } else {
            $value['text_transform'] = $default['text_transform'];
        }
        if( isset( $value['text_decoration'] ) ) {
            $value['text_decoration'] = in_array( $value['text_decoration'], ['none','underline','line-through'] ) ? esc_html( $value['text_decoration'] ) : 'none';
        } else {
            $value['text_decoration'] = $default['text_decoration'];
        }
        return apply_filters( BLOGZEE_PREFIX . 'typo_control_value', $value );
    }
endif;

if( ! function_exists( 'blogzee_sanitize_typo_control' ) ) :
    /**
     * Sanitize customizer typography control value
     * 
     * @package Blogzee Pro
     * @since 1.0.0
     */
    function blogzee_sanitize_typo_control( $control, $setting ) {
        return blogzee_sanitize_typography_values( $control, $setting->default );
    }
 endif;

if( ! function_exists( 'blogzee_sanitize_typography_preset_control' ) ) :
    /**
     * Sanitize typography presets controls
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_typography_preset_control( $control, $setting ) {
        $default = $setting->default;
        if( empty( $control ) || ! is_array( $control ) ) return $setting->default;   /* Return Default if $values is ( empty || not array ) */

        $sanitized_value = [];
        $typographies = array_key_exists( 'typographies', $control ) ? $control['typographies'] : [];
        $labels = array_key_exists( 'labels', $control ) ? $control['labels'] : [];
        if( empty( $typographies ) || ! is_array( $typographies ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        if( empty( $labels ) || ! is_array( $labels ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        foreach( $typographies as $index => $typography ) :
            $sanitized_value['typographies'][] = blogzee_sanitize_typography_values( $typography, $default['typographies'][ $index ] );
        endforeach;
        foreach( $labels as $label ) :
            $sanitized_value['labels'][] = sanitize_text_field( $label );
        endforeach;
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_preset_colors' ) ) :
    /**
     * Sanitize preset colors
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_preset_colors( $control, $setting ) {
        if( empty( $control ) || ! is_array( $control ) ) return $setting->default;   /* Return Default if $values is ( empty || not array ) */
        if( ! array_key_exists( 'color_palettes', $control ) && ! array_key_exists( 'active_palette', $control ) ) return $setting->default;
        $color_palettes = $control['color_palettes'];
        $active_palette = $control['active_palette'];
        $sanitized_value = [];
        if( count( $color_palettes ) > 0 ) :
            foreach( $color_palettes as $index => $palette ) :
                foreach( $palette as $color ) :
                    $sanitized_value['color_palettes'][$index][] = sanitize_text_field( $color );
                endforeach;
            endforeach;
        endif;
        $sanitized_value['active_palette'] = sanitize_text_field( $active_palette );
        return $sanitized_value;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_responsive_radio_image' ) ) :
    /**
     * Sanitize preset colors
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_responsive_radio_image( $value, $setting ) {
        $default = $setting->default;
        if( empty( $value ) || ! is_array( $value ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        if( array_key_exists( 'desktop', $value ) && array_key_exists( 'tablet', $value ) && array_key_exists( 'smartphone', $value ) ) :
            $sanitized_value['desktop'] = sanitize_text_field( $value['desktop'] );
            $sanitized_value['tablet'] = sanitize_text_field( $value['tablet'] );
            $sanitized_value['smartphone'] = sanitize_text_field( $value['smartphone'] );
            return $sanitized_value;
        else:
            return $default;
        endif;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_responsive_radio_tab' ) ) :
    /**
     * Sanitize preset colors
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_responsive_radio_tab( $value, $setting ) {
        $default = $setting->default;
        if( empty( $value ) || ! is_array( $value ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        $choices = $setting->manager->get_control( $setting->id )->choices;
        $choice_keys = [];
        foreach( $choices as $choice ):
            $choice_keys[] = $choice['value'];
        endforeach;
        if( array_key_exists( 'desktop', $value ) && array_key_exists( 'tablet', $value ) && array_key_exists( 'smartphone', $value ) ) :
            $sanitized_value['desktop'] = in_array( $value['desktop'], $choice_keys ) ? sanitize_text_field( $value['desktop'] ) : $default['desktop'];
            $sanitized_value['tablet'] = in_array( $value['tablet'], $choice_keys ) ? sanitize_text_field( $value['tablet'] ) : $default['tablet'];
            $sanitized_value['smartphone'] = in_array( $value['smartphone'], $choice_keys ) ? sanitize_text_field( $value['smartphone'] ) : $default['smartphone'];
            return $sanitized_value;
        else:
            return $default;
        endif;
    }
endif;

if( ! function_exists( 'blogzee_sanitize_builder_control' ) ) :
    /**
     * Sanitize Builder Control
     * @var $value holds the current value of the control
     * @var $setting holds the instance of WP_Customize_Setting class
     * 
     * @since 1.0.0
     */
    function blogzee_sanitize_builder_control( $values, $setting ) {
        $default = $setting->default;
        if( empty( $values ) || ! is_array( $values ) ) return $default;   /* Return Default if $values is ( empty || not array ) */
        $control_widgets = $setting->manager->get_control( $setting->id )->widgets;
        $all_widgets = array_keys( $control_widgets );
        $sanitized_value = [];
        foreach( $values as $container_id => $widgets ) :
            if( empty( $widgets ) ) :
                $sanitized_value[ $container_id ] = $widgets;
            else: 
                $filtered_widgets = [];
                foreach( $widgets as $widget ):
                    if( in_array( $widget, $all_widgets ) ) :
                        $filtered_widgets[] = sanitize_text_field( $widget );
                    else:
                        return $default;
                    endif;
                endforeach;
                $sanitized_value[ $container_id ] = $filtered_widgets;
            endif;
        endforeach;
        return $sanitized_value;
    }
endif;