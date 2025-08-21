<?php

  $sports_agency_theme_custom_setting_css = '';

    // Global Color
    $sports_agency_first_theme_color = get_theme_mod('sports_agency_first_theme_color', '#479F49');
    $sports_agency_second_theme_color = get_theme_mod('sports_agency_second_theme_color', '#000000');

    $sports_agency_theme_custom_setting_css .=':root {';
        $sports_agency_theme_custom_setting_css .='--primary-theme-color: '.esc_attr($sports_agency_first_theme_color ).'!important;';
        $sports_agency_theme_custom_setting_css .='--secondary-theme-color: '.esc_attr($sports_agency_second_theme_color ).'!important;';
    $sports_agency_theme_custom_setting_css .='}';

	// Scroll to top alignment
	$sports_agency_scroll_alignment = get_theme_mod('sports_agency_scroll_alignment', 'right');

    if($sports_agency_scroll_alignment == 'right'){
        $sports_agency_theme_custom_setting_css .='.scroll-up{';
            $sports_agency_theme_custom_setting_css .='right: 30px;!important;';
			$sports_agency_theme_custom_setting_css .='left: auto;!important;';
        $sports_agency_theme_custom_setting_css .='}';
    }else if($sports_agency_scroll_alignment == 'center'){
        $sports_agency_theme_custom_setting_css .='.scroll-up{';
            $sports_agency_theme_custom_setting_css .='left: calc(50% - 10px) !important;';
        $sports_agency_theme_custom_setting_css .='}';
    }else if($sports_agency_scroll_alignment == 'left'){
        $sports_agency_theme_custom_setting_css .='.scroll-up{';
            $sports_agency_theme_custom_setting_css .='left: 30px;!important;';
			$sports_agency_theme_custom_setting_css .='right: auto;!important;';
        $sports_agency_theme_custom_setting_css .='}';
    }

    // Woocommerce Sale Position
    $sports_agency_sale_badge_position = get_theme_mod( 'sports_agency_sale_badge_position','right');
    if($sports_agency_sale_badge_position == 'left'){
        $sports_agency_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $sports_agency_theme_custom_setting_css .='left: 10px; right: auto;';
        $sports_agency_theme_custom_setting_css .='}';
    }else if($sports_agency_sale_badge_position == 'right'){
        $sports_agency_theme_custom_setting_css .='.woocommerce ul.products li.product .onsale{';
            $sports_agency_theme_custom_setting_css .='left: auto; right: 10px;';
        $sports_agency_theme_custom_setting_css .='}';
    }