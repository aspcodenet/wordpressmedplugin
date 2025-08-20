<?php
/**
 * Blogzee Customizer
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogzee_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->default = 'f34601';
	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'blogzee' );
	$wp_customize->get_section( 'header_image' )->panel = 'blogzee_theme_header_panel';
	$wp_customize->get_section( 'background_image' )->priority = 90;
    $wp_customize->remove_control( 'background_color' );

	require get_template_directory() . '/inc/customizer/base.php'; // base
	require get_template_directory() . '/inc/customizer/custom-controls/repeater/repeater.php'; // repeater
	require get_template_directory() . '/inc/customizer/custom-controls/redirect-control/redirect-control.php'; // redirect-control
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading/section-heading.php'; // section-heading
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading-toggle/section-heading-toggle.php'; // section-heading-toggle
	require get_template_directory() . '/inc/customizer/custom-controls/icon-picker/icon-picker.php'; // icon picker
	require get_template_directory() . '/inc/customizer/custom-controls/builder/builder.php'; // builder
	require get_template_directory() . '/inc/customizer/custom-controls/responsive-builder/responsive-builder.php'; // responsive-builder
	require get_template_directory() . '/inc/customizer/custom-controls/text/text.php'; // text
	require get_template_directory() . '/inc/customizer/custom-controls/select/select.php'; // select
	require get_template_directory() . '/inc/customizer/custom-controls/checkbox/checkbox.php'; // checkbox
	require get_template_directory() . '/inc/customizer/custom-controls/number/number.php'; // number
	require get_template_directory() . '/inc/customizer/custom-controls/url/url.php'; // url
	require get_template_directory() . '/inc/customizer/custom-controls/upsell/upsell.php'; // upsell

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => 'header .site-title a',
				'render_callback' => 'blogzee_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogzee_customize_partial_blogdescription',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription_option',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogzee_customize_partial_blogdescription',
			)
		);
	}

	//section tab control = renders section tab control
	class Blogzee_WP_Section_Tab_Control extends Blogzee_WP_Base_Control {
		//control type
		public $type = 'section-tab';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['choices'] = $this->choices;
		}
	}

	// tab group control
	class Blogzee_WP_Default_Color_Control extends WP_Customize_Color_Control {
		/**
		 * Additional variable
		 */
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) :
				$this->json['tab'] = $this->tab;
			endif;
		}
	}

	// Typography Control
	class Blogzee_WP_Typography_Control extends Blogzee_WP_Base_Control {
		//control type
		public $type = 'typography';
		public $fields;

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json(){
			parent::to_json();
			$this->json['fields'] = $this->fields;
		}
	}

	// Toggle Control
	class Blogzee_WP_Toggle_Control extends Blogzee_WP_Base_Control {
		//conrol type
		public $type = 'toggle-button';
	}

	 // simple toggle control 
	 class Blogzee_WP_Simple_Toggle_Control extends Blogzee_WP_Base_Control {
        // control type
        public $type = 'simple-toggle';
    }

	class Blogzee_WP_Spacing_Control extends Blogzee_WP_Base_Control {
		/**
		 * List of controls for this theme
		* 
		* @since 1.0.0
		*/
		protected $type_array = [];
		public $type = 'spacing';
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template.
		* 
		* @since 1.0.0
		* @access public
		* @return void
		*/
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) $this->json['tab'] = $this->tab;
			if( $this->input_attrs ) $this->json['input_attrs'] = $this->input_attrs;
		}
	}

	// Radio Tab Control
	class Blogzee_WP_Radio_Tab_Control extends Blogzee_WP_Base_Control {
		// control type
		public $type = 'radio-tab';
		public $double_line = false;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['double_line'] = $this->double_line;
        }
	}

	// Responsive Radio Tab Control
	class Blogzee_WP_Responsive_Radio_Tab_Control extends Blogzee_WP_Base_Control {
		// control type
		public $type = 'responsive-radio-tab';
		public $double_line = false;
		public $responsive = true;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['double_line'] = $this->double_line;
            $this->json['responsive'] = $this->responsive;
        }
	}

	// info box control
    class Blogzee_WP_Info_Box_Control extends Blogzee_WP_Base_Control {
        // control type
        public $type = 'info-box';
        
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

    // number control
    class Blogzee_WP_Number_Range_Control extends Blogzee_WP_Base_Control {
        // control type
        public $type = 'number-range';
        public $fields;
        public $responsive = false;
		public $tab = 'general';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['fields'] = $this->fields;
            $this->json['responsive'] = $this->responsive;
            $this->json['input_attrs'] = $this->input_attrs;
        }
    }

    // color preset Control
	class Blogzee_WP_Preset_Control extends Blogzee_WP_Base_Control {
		// control type
		public $type = 'preset';

		/**
		 * choose between solid or gradient
		 * 
		 * @since 1.0.0
		 * @package Blogzee Pro
		 * @uses solid || gardient
		 */
		public $blend = 'solid';

		
		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['blend'] = $this->blend;
        }
	}

    // color Control
	class Blogzee_WP_Color_Control extends Blogzee_WP_Base_Control {
		// control type
		public $type = 'color-field';
		public $involve = [ 'solid' ];
		public $hover = false;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['involve'] = $this->involve;
            $this->json['hover'] = $this->hover;
        }
	}

    // multiselect control
    class Blogzee_WP_Post_Multiselect_Control extends Blogzee_WP_Base_control {
        // control type
        public $type = 'async-multiselect';
        public $endpoint = 'extend/get_posts';
        public $purpose = 'posts';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['endpoint'] = $this->endpoint;
            $this->json['purpose'] = $this->purpose;
        }
    }

	// typography preset Control
	class Blogzee_WP_Typography_Preset_Control extends Blogzee_WP_Base_Control {
		// control type
		public $type = 'typography-preset';
	}

	// preset color picker control
    class Blogzee_WP_Theme_Color_Control extends Blogzee_WP_Base_Control {
        // control type
        public $type = 'theme-color';
        public $variable;
		public $involve = 'solid';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->variable ) {
                $this->json['variable'] = $this->variable;
                $this->json['involve'] = $this->involve;
            }
        }
    }

	// Radio Image
	class Blogzee_WP_Radio_Image_Control extends Blogzee_WP_Base_Control {
		// control type
        public $type = 'radio-image';
		public $tab = 'general';
		public $choices = [];
		public $custom_callback = [];

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
            if( $this->tab ) {
                $this->json['tab'] = $this->tab;
            }
            $this->json['custom_callback'] = $this->custom_callback;
        }
	}

	// Builder Reflector
	class Blogzee_WP_Builder_Reflector_Control extends Blogzee_WP_Base_Control {
		// control type
        public $type = 'builder-reflector';
        public $placement = 'header';
        public $row = 1;
        public $builder;
        public $responsive;
        public $responsive_builder_id;

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['placement'] = $this->placement;
            $this->json['row'] = $this->row;
            $this->json['builder'] = $this->builder;
            $this->json['responsive'] = $this->responsive;
            $this->json['responsive'] = $this->responsive;
            $this->json['responsive_builder_id'] = $this->responsive_builder_id;
        }
	}

	// Responsive Radio Image
	class Blogzee_WP_Responsive_Radio_Image extends Blogzee_WP_Base_Control {
		// control type
        public $type = 'responsive-radio-image';
		public $choices = [];
		public $has_callback = true;
		public $row = 1;
		public $builder = 'header';

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
			$this->json['choices'] = $this->choices;
			$this->json['has_callback'] = $this->has_callback;
			$this->json['row'] = $this->row;
			$this->json['builder'] = $this->builder;
        }
	}
}
add_action( 'customize_register', 'blogzee_customize_register' );

add_filter( BLOGZEE_PREFIX . 'unique_identifier', function($identifier) {
    $bc_delimeter = '-';
    $bc_prefix = 'customize';
    $bc_sufix = 'control';
    $identifier_id = [$bc_prefix,$identifier,$bc_sufix];
    return implode($bc_delimeter,$identifier_id);
});

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogzee_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogzee_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogzee_customize_preview_js() {
	wp_enqueue_script( 'blogzee-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
}
add_action( 'customize_preview_init', 'blogzee_customize_preview_js' );

// Get list of image sizes
function blogzee_get_image_sizes_option_array_for_customizer() {
	$sizes_lists = [];
	$images_sizes = get_intermediate_image_sizes();
	if( $images_sizes ) {
		foreach( $images_sizes as $size ) {
			$sizes_lists[$size] = $size;
		}
	}
	return $sizes_lists;
}

require get_template_directory() . '/inc/customizer/handlers.php';
require get_template_directory() . '/inc/customizer/render.php';
require get_template_directory() . '/inc/customizer/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/selective-refresh.php';