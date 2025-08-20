<?php
/**
 * Header hooks and functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;

if( ! function_exists( 'blogzee_header_site_branding_part' ) ) :
    /**
     * Header site branding element
     * 
     * @since 1.0.0
     */
    function blogzee_header_site_branding_part() {
        ?>
            <div class="site-branding">
                <?php
                    $site_title_tag_for_frontpage = BZ\blogzee_get_customizer_option( 'site_title_tag_for_frontpage' );
                    $site_title_tag_for_innerpage = BZ\blogzee_get_customizer_option( 'site_title_tag_for_innerpage' );
                    $site_description_show_hide = BZ\blogzee_get_customizer_option( 'blogdescription_option' );

                    the_custom_logo();

                    if ( is_front_page() ) :
                        echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
                    else :
                        echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
                    endif;
                    $blogzee_description = get_bloginfo( 'description', 'display' );
                    if( $site_description_show_hide ) :
                        if ( $blogzee_description ) echo '<p class="site-description">'. $blogzee_description .'</p>';
                    endif;
                ?>
            </div><!-- .site-branding -->
        <?php
    }
    add_action( 'blogzee_header__site_branding_section_hook', 'blogzee_header_site_branding_part', 10 );
endif;

if( ! function_exists( 'blogzee_header_menu_part' ) ) :
    /**
     * Header menu element
     * 
     * @since 1.0.0
     */
    function blogzee_header_menu_part() {
        $nav_classes = 'hover-effect--' . BZ\blogzee_get_customizer_option( 'header_menu_hover_effect' );
      ?>
        <div class="site-navigation-wrapper">
            <nav id="site-navigation" class="main-navigation <?php echo esc_attr( $nav_classes ); ?>">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <div id="blogzee-menu-burger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="menu-txt"><?php esc_html_e( 'Menu', 'blogzee' ); ?></span>
                </button>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'container_class' =>    'blogzee-primary-menu-container'
                        )
                    );
                ?>
            </nav><!-- #site-navigation -->
        </div>
      <?php
    }
    add_action( 'blogzee_header__menu_section_hook', 'blogzee_header_menu_part', 10 );
 endif;

 if( ! function_exists( 'blogzee_header_custom_button_part' ) ) :
    /**
     * Header custom button element
     * 
     * @since 1.0.0
     */
    function blogzee_header_custom_button_part() {
        $custom_button_redirect_link = BZ\blogzee_get_customizer_option( 'custom_button_redirect_href_link' );
        $custom_button_label = BZ\blogzee_get_customizer_option( 'custom_button_label' );
        $custom_button_animation_type = BZ\blogzee_get_customizer_option( 'custom_button_animation_type' );
        
        $elementClass = 'header-custom-button blogzee-button';
        $elementClass .= ' animation-type--'. $custom_button_animation_type;
        ?>
            <div class="header-custom-button-wrapper">
                <a class="<?php echo esc_attr( $elementClass ); ?>" href="<?php echo esc_url( $custom_button_redirect_link ); ?>" target="_blank">
                    <span class="custom-button-icon"><i class="fas fa-bell"></i></span>
                    <?php if( $custom_button_label ) echo '<span class="custom-button-label">' . esc_html( $custom_button_label ) .'</span>'; ?>
                </a>
            </div>
        <?php
    }
    add_action( 'blogzee_header__custom_button_section_hook', 'blogzee_header_custom_button_part', 10 );
 endif;

 if( ! function_exists( 'blogzee_header_search_part' ) ) :
    /**
     * Header live search element
     * 
     * @since 1.0.0
     */
    function blogzee_header_search_part() {
        ?>
            <div class="search-wrap search-type--default">
                <button class="search-trigger"><i class="fas fa-search"></i></button>
                <div class="search-form-wrap">
                    <?php echo get_search_form(); ?>
                    <button class="search-form-close"><i class="fas fa-times"></i></button>
                </div>
            </div>
        <?php
    }
    add_action( 'blogzee_header_search_hook', 'blogzee_header_search_part', 10 );
 endif;

 if( ! function_exists( 'blogzee_header_theme_mode_part' ) ) :
    /**
     * Header theme mode element
     * 
     * @since 1.0.0
     */
    function blogzee_header_theme_mode_part() {
        $light_mode_icon_args = BZ\blogzee_get_customizer_option( 'theme_mode_light_icon' );
        $dark_mode_icon_args = BZ\blogzee_get_customizer_option( 'theme_mode_dark_icon' );
        $light_mode_icon_class = ( array_key_exists( 'value', $light_mode_icon_args ) && is_array( $light_mode_icon_args ) ) ? $light_mode_icon_args['value'] : '';
        $dark_mode_icon_class = ( array_key_exists( 'value', $dark_mode_icon_args ) && is_array( $dark_mode_icon_args ) ) ? $dark_mode_icon_args['value'] : '';
        ?>
            <div class="mode-toggle-wrap">
                <span class="mode-toggle">
                    <?php 
                        blogzee_theme_mode_switch( $light_mode_icon_args, 'light' );
                        blogzee_theme_mode_switch( $dark_mode_icon_args, 'dark' );
                    ?>
                </span>
            </div>
        <?php
    }
    add_action( 'blogzee_header_theme_mode_hook', 'blogzee_header_theme_mode_part', 10 );
 endif;

 if( ! function_exists( 'blogzee_header_canvas_menu_part' ) ) :
    /**
     * Header canvas menu element
     * 
     * @since 1.0.0
     */
    function blogzee_header_canvas_menu_part() {
        $elementClass = 'blogzee-canvas-menu';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <button class="canvas-menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="canvas-menu-sidebar">
                    <div class="canvas-menu-inner">
                        <?php if( is_active_sidebar( 'canvas-menu-sidebar' ) ) dynamic_sidebar( 'canvas-menu-sidebar' ); ?>
                    </div>
                </div>
            </div>
        <?php
    }
    add_action( 'blogzee_header_off_canvas_hook', 'blogzee_header_canvas_menu_part', 10 );
 endif;

 if( ! function_exists( 'blogzee_before_content_advertisement_part' ) ) :
    /**
     * Blogzee main banner element
     * 
     * @since 1.0.0
     */
    function blogzee_before_content_advertisement_part() {
        $advertisement_repeater = BZ\blogzee_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $before_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_before_post_content' ) ) return ( $element->item_checkbox_before_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $before_content_advertisement ) ) return;
        $image_option = array_column( $before_content_advertisement, 'item_image_option' );
        $alignment = array_column( $before_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogzee-advertisement-section-before-content blogzee-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $before_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>" loading="lazy">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_before_single_content_hook', 'blogzee_before_content_advertisement_part' );
 endif;

 if( ! function_exists( 'blogzee_after_content_advertisement_part' ) ) :
    /**
     * Blogzee main banner element
     * 
     * @since 1.0.0
     */
    function blogzee_after_content_advertisement_part() {
        $advertisement_repeater = BZ\blogzee_get_customizer_option( 'advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $after_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_after_post_content' ) ) return ( $element->item_checkbox_after_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $after_content_advertisement ) ) return;
        $image_option = array_column( $after_content_advertisement, 'item_image_option' );
        $alignment = array_column( $after_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogzee-advertisement-section-after-content blogzee-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogzee-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $after_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>" loading="lazy">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogzee_after_single_content_hook', 'blogzee_after_content_advertisement_part' );
 endif;

 if( ! function_exists( 'blogzee_get_background_and_cursor_animation' ) ) :
    /**
     * Renders html for cursor and background animation
     * 
     * @since 1.0.0
     */
    function blogzee_get_background_and_cursor_animation() {
        blogzee_shooting_star_animation_html();
        $cursor_animation = BZ\blogzee_get_customizer_option( 'cursor_animation' );
        $cursorclass = 'blogzee-cursor';
        if( $cursor_animation != 'none' ) $cursorclass .= ' type--' . $cursor_animation;
        if( in_array( $cursor_animation, [ 'one', 'two' ] ) ) echo '<div class="'. esc_attr( $cursorclass ) .'"></div>';
    }
    add_action( 'blogzee_animation_hook', 'blogzee_get_background_and_cursor_animation' );
 endif;

 if( ! function_exists( 'blogzee_get_toggle_button_html' ) ) :
    /**
     * Toggle Button Widget html
     * 
     * @since 1.0.0
     */
    function blogzee_get_toggle_button_html() {
        ?>
            <div class="toggle-button-wrapper">
                <button class="canvas-menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        <?php
    }
  endif;

  if( ! function_exists( 'blogzee_customizer_social_icons' ) ) :
	/**
	 * Function to get social icons from customizer
	 * 
	 * @since 1.0.0
	 * @package Blogzee Pro
	 */
	function blogzee_customizer_social_icons( $type = '' ) {
        $placement = ( $type !== '' ) ? $type . '_' : '';
		$social_icons = BZ\blogzee_get_customizer_option( $placement . 'social_icons' );
		$social_icons_decode = json_decode( $social_icons );
		$elementClass = 'blogzee-social-icon';
		echo '<div class="'. esc_attr( $elementClass ) .'">';
			foreach( $social_icons_decode as $social_icon ) :
				if( $social_icon->item_option == 'show' ) echo '<a href="'. esc_url( $social_icon->icon_url ) .'" target="_blank"><i class="'. esc_attr( $social_icon->icon_class ) .'"></i></a>';
			endforeach;
		echo '</div>';
	}
endif;