<?php
/**
 * Includes the inline css
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;

// Value change single
if( ! function_exists( 'blogzee_value_change' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_value_change ( $selector, $control, $property ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      echo $selector, "{ ", esc_html( $property ), " : ", esc_html($decoded_control), "px; }";
   }
endif;

// Value change with responsive
if( ! function_exists( 'blogzee_value_change_responsive' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_value_change_responsive ( $selector, $control, $property, $unit = 'px' ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
            echo $selector, "{ ", esc_html( $property ), ": ", esc_html( $desktop ), esc_html( $unit ), "; }";
         endif;
         if( isset( $decoded_control['tablet'] ) ) :
            $tablet = $decoded_control['tablet'];
            echo "@media(max-width: 940px) { ", $selector, "{ ", esc_html( $property ), ": ", esc_html( $tablet ), esc_html( $unit ), "; } }\n";
         endif;
         if( isset( $decoded_control['smartphone'] ) ) :
            $smartphone = $decoded_control['smartphone'];
            echo "@media(max-width: 610px) { ", $selector, "{ ", esc_html( $property ), ": ", esc_html( $smartphone  ), esc_html( $unit ), "; } }\n";
      endif;
   }
endif;

if( ! function_exists( 'blogzee_typography_control' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_typography_control( $selector, $control, $is_variable = false ) {
      $property = $selector;
      if( $is_variable ) $selector = 'body.blogzee-variables';
      $value = ( ! empty( $control ) && is_array( $control ) ) ? $control : BZ\blogzee_get_customizer_option( $control );
      if( ! $value ) return;
      $is_preset = false;
      if( array_key_exists( 'preset', $value ) && $value['preset'] !== '-1' ) :
         $variable = '--blogzee-global-preset-typography-'. absint( (int) $value['preset'] + 1 ) .'-font';
         $is_preset = true;
      endif;
      echo $selector, "{\n";
      if( isset( $value['font_family'] ) ) echo ( $is_variable ? $property . '-family' : 'font-family' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-family)' ) : esc_html( $value['font_family']['value'] ) ), ";\n";
      if( isset( $value['font_weight'] ) ) echo ( $is_variable ? $property . '-weight': 'font-weight' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-weight)' ) : esc_html( $value['font_weight']['value'] ) ), ";\n", ( $is_variable ? $property . '-style' : 'font-style' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-style)' ) : esc_html( $value['font_weight']['variant'] ) ), ";\n";
      if( isset( $value['text_transform'] ) ) echo ( $is_variable ? $property . '-texttransform' : 'text-transform' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-texttransform)' ) : esc_html( $value['text_transform'] ) ), ";\n";
      if( isset( $value['text_decoration'] ) ) echo ( $is_variable ? $property . '-textdecoration' : 'text-decoration' ), " : ", ( $is_preset ? ( 'var(' . $variable . '-textdecoration)' ) : esc_html( $value['text_decoration'] ) ), ";\n";
      if( isset( $value['font_size'] ) && isset( $value['font_size']['desktop'] ) ) echo ( $is_variable ? $property . '-size' : 'font-size' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-size)' ) : esc_html( $value['font_size']['desktop'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['desktop'] ) ) echo ( $is_variable ? $property . '-lineheight' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight)' ) : esc_html( $value['line_height']['desktop'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['desktop'] ) ) echo ( $is_variable ? $property . '-letterspacing' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing)' ) : esc_html( $value['letter_spacing']['desktop'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}\n";
   
      // tablet responsive
      if( ! $is_variable ) echo "@media(max-width: 940px) {", $selector, "{\n"; 
      if( isset( $value['font_size'] ) && isset( $value['font_size']['tablet'] ) ) echo ( $is_variable ? $property . '-size-tab' : 'font-size' ) ,": ", ( $is_preset ? ( 'var(' . $variable . '-size-tab)' ) : esc_html( $value['font_size']['tablet'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['tablet'] ) ) echo ( $is_variable ? $property . '-lineheight-tab' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight-tab)' ) : esc_html( $value['line_height']['tablet'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['tablet'] ) ) echo ( $is_variable ? $property . '-letterspacing-tab' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing-tab)' ) : esc_html( $value['letter_spacing']['tablet'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}}\n"; 
      // mobile responsive
      if( ! $is_variable ) echo "@media(max-width: 610px) {", $selector, "{\n"; 
      if( isset( $value['font_size'] ) && isset( $value['font_size']['smartphone'] ) ) echo ( $is_variable ? $property . '-size-mobile' : 'font-size' ) ,": ", ( $is_preset ? ( 'var(' . $variable . '-size-mobile)' ) : esc_html( $value['font_size']['smartphone'] ) . 'px' ), ";\n";
      if( isset( $value['line_height'] ) && isset( $value['line_height']['smartphone'] ) ) echo ( $is_variable ? $property . '-lineheight-mobile' : 'line-height' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-lineheight-mobile)' ) : esc_html( $value['line_height']['smartphone'] ) . 'px' ), ";\n";
      if( isset( $value['letter_spacing'] ) && isset( $value['letter_spacing']['smartphone'] ) ) echo ( $is_variable ? $property . '-letterspacing-mobile' : 'letter-spacing' ), ": ", ( $is_preset ? ( 'var(' . $variable . '-letterspacing-mobile)' ) : esc_html( $value['letter_spacing']['smartphone'] ) . 'px' ), ";\n";
      if( ! $is_variable ) echo "}}\n";
      if( $is_variable ) echo "}\n";
   }
endif;

// Assign Variable
if( ! function_exists( 'blogzee_assign_var' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_assign_var( $selector, $control) {
      $decoded_control =  BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      echo " body { ", esc_html( $selector ), ": ", esc_html( $decoded_control ), ";}\n";
   }
endif;

// Text Color ( Variable Change Single )
if( ! function_exists( 'blogzee_variable_color_single' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_variable_color_single( $selector, $control) {
      $decoded_control =  BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      $type = $decoded_control['type'];
      echo "body  { ", $selector, ": ", blogzee_get_color_format( $decoded_control[ $type ]), ";}";
   }
endif;

// Text Color ( Variable Change )
if( ! function_exists( 'blogzee_variable_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_variable_color( $selector, $control) {
      $decoded_control =  BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['initial'] ) ) :
         $initial = $decoded_control['initial'];
         echo "body  { ", $selector, ": ", blogzee_get_color_format( $initial[ $initial['type'] ] ), ";}";
      endif;
      if( isset( $decoded_control['hover'] ) ) :
         $hover = $decoded_control['hover'];
         echo "body  { ", $selector, "-hover : ", blogzee_get_color_format( $hover[ $hover['type'] ] ), "; }";
      endif;
   }
endif;

// Color Group ( Variable Change )
if( ! function_exists( 'blogzee_variable_bk_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_variable_bk_color( $selector, $control, $var = '' ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if(isset($decoded_control['initial'] )):
         if( isset( $decoded_control['initial']['type'] ) ) :
            $type = $decoded_control['initial']['type'];
            if( isset( $decoded_control['initial'][$type] ) ) echo "body { ", $selector, ": ", blogzee_get_color_format( $decoded_control['initial'][$type] ), "}\n";
         endif;
      endif;

      if(isset($decoded_control['hover'])):
         if( isset( $decoded_control['hover']['type'] ) ) :
            $type = $decoded_control['hover']['type'];
            if( isset( $decoded_control['hover'][$type] ) ) echo "body { ", $selector, "-hover: ", blogzee_get_color_format( $decoded_control['hover'][$type] ), "}\n";
         endif;
      endif;
   }
endif;

// Category colors
if( ! function_exists( 'blogzee_category_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blogzee Pro
   * @since 1.0.0
   */
   function blogzee_category_bk_colors_styles() {
      $totalCats = get_categories();
      $is_category_archive = is_category();
      if( $totalCats ) :
         foreach( $totalCats as $singleCat ) :
            $term_id = absint( $singleCat->term_id );
            $category_color = BZ\blogzee_get_customizer_option( 'category_' . $term_id . '_color' );
            $initial_selector = "body .post-categories .cat-item.cat-" . $term_id . " a, .widget_blogzee_category_collection_widget .categories-wrap .category-item.cat-" . $term_id . " .category-name {";
            $hover_selector = "body .post-categories .cat-item.cat-" . $term_id . " a:hover, .widget_blogzee_category_collection_widget .categories-wrap .category-item.cat-" . $term_id . " .category-name:hover {";
            $archive_selector = "body.archive.category.category-" . $term_id;

            if( isset( $category_color['initial'] ) ):
               if( isset( $category_color['initial']['type'] ) ) :
                  $type = $category_color['initial']['type'];
                  if( isset( $category_color['initial'][$type] ) ) {
                     $initial_selector .= " color : " . blogzee_get_color_format( $category_color['initial'][$type] ) . ";\n";
                     if( $is_category_archive ) echo $archive_selector, " { color : ", blogzee_get_color_format( $category_color['initial'][$type] ), "} \n";
                  }
               endif;
            endif;

            if(isset($category_color['hover'] )):
               if( isset( $category_color['hover']['type'] ) ) :
                  $type = $category_color['hover']['type'];
                  if( isset( $category_color['hover'][$type] ) ) {
                     $hover_selector .= "color : " . blogzee_get_color_format( $category_color['hover'][$type] ) . ";\n";
                     if( $is_category_archive ) echo $archive_selector, ":hover { color : ", blogzee_get_color_format( $category_color['hover'][$type] ), "} \n";
                  }
               endif;
            endif;

            $category_color_bk = BZ\blogzee_get_customizer_option( 'category_background_' .$term_id. '_color' );
            if(isset($category_color_bk['initial'] )):
               if( isset( $category_color_bk['initial']['type'] ) ) :
                  $type = $category_color_bk['initial']['type'];
                  if( isset( $category_color_bk['initial'][$type] ) ) {
                     $initial_selector .= "background : " . blogzee_get_color_format( $category_color_bk['initial'][$type] ) . ";\n";
                     if( $is_category_archive ) echo $archive_selector, " .archive-title i { color : ", blogzee_get_color_format( $category_color_bk['initial'][$type] ), "}\n";
                  }
               endif;
            endif;

            if(isset($category_color_bk['hover'] )) :
               if( isset( $category_color_bk['hover']['type'] ) ) :
                  $type = $category_color_bk['hover']['type'];
                  if( isset( $category_color_bk['hover'][$type] ) ) $hover_selector .= "background : " . blogzee_get_color_format( $category_color_bk['hover'][$type] ) . ";\n";
               endif;
            endif;
            $initial_selector .=  "}\n";
            $hover_selector .=  "}\n";
            echo $initial_selector, $hover_selector;
         endforeach;
      endif;
   }
endif;

// tags colors
if( ! function_exists( 'blogzee_tags_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blogzee Pro
   * @since 1.0.0
   */
   function blogzee_tags_bk_colors_styles() {
      $totalTags = get_tags();
      if( $totalTags ) :
         foreach( $totalTags as $singleTag ) :
            $term_id = absint( $singleTag->term_id );
            $tag_color = BZ\blogzee_get_customizer_option( 'tag_' . $term_id . '_color' );
            $selector = "body .tags-wrap .tags-item.tag-" . $term_id;

            if(isset($tag_color['initial'] )):
               if( isset( $tag_color['initial']['type'] ) ) :
                  $type = $tag_color['initial']['type'];
                  if( isset( $tag_color['initial'][$type] ) ) echo $selector, " span { color : ", blogzee_get_color_format( $tag_color['initial'][$type] ), "} \n";
               endif;
            endif;

            if(isset($tag_color['hover'] )):
               if( isset( $tag_color['hover']['type'] ) ) :
                  $type = $tag_color['hover']['type'];
                  if( isset( $tag_color['hover'][$type] ) ) echo $selector, ":hover span { color : ", blogzee_get_color_format( $tag_color['hover'][$type] ), "} \n";
               endif;
            endif;

            $tag_color_bk = BZ\blogzee_get_customizer_option( 'tag_background_' . $term_id . '_color' );
            if(isset($tag_color_bk['initial'] )) :
               if( isset( $tag_color_bk['initial']['type'] ) ) :
                  $type = $tag_color_bk['initial']['type'];
                  if( isset( $tag_color_bk['initial'][$type] ) ) echo $selector, "{ background : ", blogzee_get_color_format( $tag_color_bk['initial'][$type] ), "} \n";
               endif;
            endif;

            if(isset($tag_color_bk['hover'] )) :
               if( isset( $tag_color_bk['hover']['type'] ) ) :
                  $type = $tag_color_bk['hover']['type'];
                  if( isset( $tag_color_bk['hover'][$type] ) ) echo $selector, ":hover { background : ", blogzee_get_color_format( $tag_color_bk['hover'][$type] ), "} \n";
               endif;
            endif;
         endforeach;
      endif;
   }
endif;

// Image ratio change
if( ! function_exists( 'blogzee_image_ratio' ) ) :
   /**
   * Generate css code image ration controls
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_image_ratio( $selector, $control, $is_variable = false ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      $value = '100%';
      if( ! $decoded_control ) return;
      if( $is_variable ) echo "body.blogzee-variables {\n";
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         if( $is_variable ) {
            echo $selector, " : ", esc_html( $decoded_control['desktop'] ), ";\n";
         } else {
            echo $selector, "{ padding-bottom : calc(", esc_html( $decoded_control['desktop'] ), " * ", esc_html( $value ), "); }";
         }
      endif;
      if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         if( $is_variable ) {
            echo $selector, "-tab : ", esc_html( $decoded_control['tablet'] ), ";\n";
         } else {
            echo "@media(max-width: 940px) { ", $selector, "{ padding-bottom : calc(", esc_html( $decoded_control['tablet'] ), "* ", esc_html( $value ), "); } }\n";
         }
      endif;
      if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         if( $is_variable ) {
            echo $selector, "-mobile : ", esc_html( $decoded_control['smartphone'] ), ";\n";
         } else {
            echo "@media(max-width: 610px) { ", $selector, "{ padding-bottom : calc(", esc_html( $decoded_control['smartphone'] ), " * ", esc_html( $value ), "); } }\n";
         }
      endif;
      if( $is_variable ) echo '}';
   }
endif;

// Background Color (Initial Variable)
if( ! function_exists( 'blogzee_initial_bk_color_variable' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogzee Pro
   * @since 1.0.0 
   */
   function blogzee_initial_bk_color_variable( $selector, $control ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( array_key_exists( 'type', $decoded_control ) && isset( $decoded_control[ $decoded_control['type'] ] ) )  echo "body { ", $selector, " : ", blogzee_get_color_format( $decoded_control[ $decoded_control['type'] ] ), "}\n";
   }
endif;

// Site Background Color
if( ! function_exists( 'blogzee_background_control' ) ) :
   /**
    * Generate css code for background control.
    *
    * @package Blogzee Pro
    * @since 1.0.0 
    */
   function blogzee_background_control( $selector, $control, $property = 'background' ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['type'] ) ) :
         $type = $decoded_control['type'];
         switch( $type ) {
            case 'image' : 
                  echo $selector, " { \n";
                  if( isset( $decoded_control[$type]['url'] ) ) echo "background-image: url(", esc_url( $decoded_control[$type]['url'] ), ");\n";
                  if( isset( $decoded_control['repeat'] ) ) echo "background-repeat: ", esc_html( $decoded_control['repeat'] ), ";\n";
                  if( isset( $decoded_control['position'] ) ) echo "background-position:", esc_html( $decoded_control['position'] ), ";\n";
                  if( isset( $decoded_control['attachment'] ) ) echo "background-attachment: ", esc_html( $decoded_control['attachment'] ), ";\n";
                  if( isset( $decoded_control['size'] ) ) echo "background-size: ", esc_html( $decoded_control['size'] ), ";\n";
                  echo '}';
               break;
            default: if( isset( $decoded_control[$type] ) ) echo $selector . "{ ". $property .": " .blogzee_get_color_format( $decoded_control[$type] ). "}";
         }
      endif;
   }
endif;

// spacing control
if( ! function_exists( 'blogzee_spacing_control' ) ) :
   /**
    * Generate css code for variable change with responsive for spacing controls
    *
    * @package Blogzee Pro
    * @since 1.0.0
    */
    function blogzee_spacing_control( $selector, $control, $property ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector, '{ ', esc_html( $property ), ' : ', esc_html( $desktop['top'] ), 'px ', esc_html( $desktop['right'] ), 'px ', esc_html( $desktop['bottom'] ),'px ', esc_html( $desktop['left'] ),'px; }';
      endif;
      if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo '@media(max-width: 940px) {', $selector, '{ ', esc_html( $property ), ' : ', esc_html( $tablet['top'] ), 'px ', esc_html( $tablet['right'] ), 'px ', esc_html( $tablet['bottom'] ), 'px ', esc_html( $tablet['left'] ), 'px ;} }';
      endif;
      if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo '@media(max-width: 610px) { ', $selector, '{ ', esc_html( $property ), ' : ', esc_html( $smartphone['top'] ), 'px ', esc_html( $smartphone['right'] ), 'px ', esc_html( $smartphone['bottom'] ), 'px ', esc_html( $smartphone['left'] ), 'px; } }';
      endif;
    }
endif;
if( ! function_exists( 'blogzee_preset_color_control' ) ) :
   /**
    * Generate css variable
    * 
    * @since 1.0.0
    */
    function blogzee_preset_color_control( $control, $variable ) {
      $decoded_control = BZ\blogzee_get_customizer_option( $control );
      if( empty( $decoded_control ) || ! is_array( $decoded_control ) ) return;
      if( array_key_exists( 'color_palettes', $decoded_control ) && array_key_exists( 'active_palette', $decoded_control ) ) :
         extract( $decoded_control );
         $colors = $color_palettes[ $active_palette ];
         if( ! empty( $colors ) && is_array( $colors ) ) :
            echo "body {\n";
            foreach( $colors as $index => $color ) :
               $count = $index + 1;
               echo $variable, $count, ": ", esc_html( $color ), ";\n";
            endforeach;
            echo "}\n";
         endif;
      endif;
    }
endif;
if( ! function_exists( 'blogzee_typography_preset' ) ) :
   /**
    * Generate css variable
    * 
    * @since 1.0.0
    */
    function blogzee_typography_preset() {
      $decoded_control = BZ\blogzee_get_customizer_option( 'typography_presets' );
      if( count( $decoded_control ) > 0 ) :
         $typographies = $decoded_control['typographies'];
         $labels = $decoded_control['labels'];
         if( count( $typographies ) > 0 ) :
            foreach( $typographies as $index => $typography ) :
               $variable = '--blogzee-global-preset-typography-';
               $count = $index + 1;
               $variable .= $count . '-font';
               blogzee_typography_control( $variable, $typography, true );
            endforeach;
         endif;
      endif;
    }
endif;