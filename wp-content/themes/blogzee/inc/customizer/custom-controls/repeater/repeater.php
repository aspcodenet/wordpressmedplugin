<?php
/**
 * Custom WP Repeater Control
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
class Blogzee_WP_Custom_Repeater extends \Blogzee_WP_Base_Control {
    /**
     * Control Type
     */
    public $type = 'custom-repeater';

    /**
     * Arguments passed to this class
     * 
     * 
     */
    private $args;
    
    /**
     * Default values passed when control is registered
     * 
     * 
     */
    private $defaults;

    /**
     * Row label key value
     * 
     * 
     */
    private $row_label;

    /**
     * Main function
     * 
     * Blogzee_WP_Custom_Repeater class name 
     */
    public function __construct($manager, $id, $args = array()) {
        $this->args = $args;
        $this->row_label = $args['row_label'];
        parent::__construct( $manager, $id, $args );
        $this->defaults = $this->setting->default;
    }
    
    /**
     * Enqueue Scripts
     * 
     */
    function enqueue() {
        wp_enqueue_media();
        wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/external/fontawesome/css/all.min.css', array(), '6.4.2', 'all' );
        wp_enqueue_style( 'blogzee-wp-repeater', get_template_directory_uri() . '/inc/customizer/custom-controls/repeater/repeater.css', array(), BLOGZEE_VERSION, 'all' );
        wp_enqueue_script( 'blogzee-wp-repeater', get_template_directory_uri() . '/inc/customizer/custom-controls/repeater/repeater.js', array( 'jquery' ), BLOGZEE_VERSION, [ 'strategy' => 'defer', 'in_footer' => true ] );
    }

    /**
     * For The displaying the structure in Customizer
     */
    public function render_content() {
        $fields = json_decode( json_encode( $this->args['fields'] ) );
        $control_values = $this->value();
        $control_values = ( ! empty( $control_values ) ) ? json_decode( $control_values ) : json_decode( json_encode( array( $fields ) ) );
        $item_count = 1;
        ?>
        <div class="blogzee-repeater-control">
            <label class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
            <?php if( $this->description ) { ?>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
            <?php } ?>
            <div class="blogzee-repeater-control-inner">
                <?php 
                $row_label = $this->row_label;
                 foreach( $control_values as $control_value_key => $control_value ) :
                    if( str_contains( $this->row_label, 'inherit' ) )  {
                        $label_array = explode( "-", $this->row_label );
                        if( $label_array[1] == 'icon_class' ) {
                            $newlabel_array = explode( "-", $control_value->{$label_array[1]} );
                            $row_label = $newlabel_array[1];
                        } else {
                            $row_label = $control_value->{$label_array[1]};
                        }
                    }
                  ?>
                    <div class="blogzee-repeater-item <?php if( $control_value->item_option === 'show' ) : echo 'visible'; else : echo 'not-visible'; endif; ?>">
                        <div class="item-heading-wrap">
                            <span class="item-heading"><?php echo esc_html( $row_label ); ?></span>
                            <div class="visibility-dropdown-wrapper">
                                <span class="settings-icon dashicons dashicons-arrow-down-alt2"></span>
                                <span class="display-icon dashicons dashicons-<?php if( $control_value->item_option === 'show' ) : echo 'visibility'; else : echo 'hidden'; endif; ?>"></span>
                            </div>
                        </div>
                        <div class="item-control-fields isHidden">
                            <?php
                                foreach( $fields as $field_key => $field_val ) :
                                    if( $field_key != 'item_option' ) {
                                        $this->render_control( $field_key, $field_val, $control_value );
                                    } else {
                                        echo '<input type="hidden" class="repeater-field-value-holder" data-default="' .esc_attr($field_val). '" data-key="' .esc_attr( $field_key ). '" value="' .esc_attr( $control_value->$field_key ). '">';
                                    }
                                endforeach;
                            ?>
                        </div>
                    </div>
                <?php $item_count++; endforeach; ?>
                <div class="buttons-wrap">
                    <input class="repeater-control-value-holder" id="<?php echo esc_attr( '_customize-input-' . $this->id ); ?>" type="hidden" <?php echo esc_attr( $this->link() ); ?> value=<?php echo esc_attr(json_encode( $control_values )); ?>/>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render control field w.r.t paramater 
     * 
     */
    function render_control( $field_key, $field, $current_item_value ) {
        $type = $field->type;
        $label = isset( $field->label ) ? $field->label : esc_html__( 'Item Label', 'blogzee' );
        $description = isset( $field->description ) ? $field->description : false;
        $default_value = isset( $field->default ) ? $field->default : '';
        $options = isset( $field->options ) ? $field->options : '';
        $families = isset( $field->families ) ? $field->families : '';
        // filter the contrrol type parameter
        switch( $type ) {
            case 'text' : ?>
                <div class="single-control text-field">
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <?php if( $description ) { ?>
                        <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                    <?php } ?>
                    <input class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" type="text" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>">
                </div>
            <?php
            break;
            case 'image' : ?>
                <div class="single-control image-field">
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <?php if( $description ) { ?>
                        <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                    <?php } ?>
                    <div class="image-holder">
                        <div class="image-element <?php if( ! $current_item_value->$field_key ) echo 'no-image'; ?>">
                            <?php
                                if( $current_item_value->$field_key ) :
                                    if( wp_get_attachment_image_url( $current_item_value->$field_key ) ) :
                                        echo '<img src="' .esc_url( wp_get_attachment_image_url( $current_item_value->$field_key ) ). '" loading="lazy">';
                                    endif;
                                else :
                                    echo '<img>';
                                endif;
                            ?>
                            <span class="remove-image dashicons dashicons-trash"></span>
                        </div>
                        <div class="add-image-trigger <?php if( $current_item_value->$field_key ) echo 'no-trigger'; ?>"><?php echo esc_html__( 'Upload Image', 'blogzee'); ?></div>
                        <input class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" type="hidden" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>"/>
                    </div>
                </div>
            <?php
                break;
            case 'fontawesome-icon-picker' : $icons_list = blogzee_get_all_fontawesome_icons( $families ); ?>
                <div class="single-control fontawesome-icon-picker">
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <?php if( $description ) { ?>
                        <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                    <?php } ?>
                    <div class="icon-holder">
                        <div class="icon-header">
                            <div class="active-icon"><i class="<?php echo esc_attr( $current_item_value->$field_key ); ?>"></i></div>
                            <div class="icon-list-trigger"><i class="fa-solid fa-angle-down"></i></div>
                        </div>
                        <div class="icons-list" style="display:none;">
                            <input class="icon-search-input" type="text" placeholder="<?php echo esc_attr__( "Type to search", 'blogzee' ); ?>"/>
                            <?php
                                foreach( $icons_list as $icon ) :
                                ?>
                                    <i class="<?php echo esc_attr( $icon ); ?> <?php if( $icon === $current_item_value->$field_key ) echo 'selected'; ?>"></i>
                                <?php
                                endforeach;
                            ?>
                        </div>
                        <input class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" type="hidden" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>"/>
                    </div>
                </div>
            <?php
                break;
            case 'textarea' : ?>
                <div class="single-control textarea-field">
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <?php if( $description ) { ?>
                        <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                    <?php } ?>
                    <textarea class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" rows="5"><?php echo wp_kses_post( $current_item_value->$field_key ); ?></textarea>
                </div>
            <?php
            break;
            case 'url' : ?>
                <div class="single-control url-field">
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <?php if( $description ) { ?>
                        <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                    <?php } ?>
                    <input class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" type="url" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>"/>
                </div>
            <?php
            break;
            case 'select': ?>
                    <div class="single-control select-field">
                        <h2 class="control--item-label"><?php echo esc_html( $label );?></h2>
                        <?php if( $description ) { ?>
                            <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                        <?php } ?>
                        <select class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>">
                            <?php
                                if( ! empty( $options ) ) :
                                    foreach( $options as $option_key => $option_value ) :
                                        ?>
                                            <option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $current_item_value->$field_key ); ?>><?php echo esc_html( $option_value );?></option>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </select>
                    </div>
                <?php
                break;
            case 'checkbox': ?>
                    <div class="single-control checkbox-field">
                        <div class="control-inner">
                            <input class="repeater-field-value-holder" type="checkbox" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" <?php checked( 1, $current_item_value->$field_key ); ?>>
                            <label><?php echo esc_html( $label ); ?></label>
                        </div>
                            <?php if( $description ) { ?>
                            <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                        <?php } ?>
                    </div>
                <?php
                break;
            case 'heading': ?>
                    <div class="single-control heading-field">
                        <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    </div>
                <?php
                break;
            case 'alignment': ?>
                <div class="single-control alignment-field" >
                    <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                    <div class="alignment-items">
                        <?php
                            if( ! empty( $options ) ) :
                                foreach( $options as $option_key => $option_value ) :
                                    $is_active_class = ( $current_item_value->$field_key == $option_key ) ? ' isactive' : '';
                                    ?>
                                        <span class="alignment-item<?php echo $is_active_class .' '. $option_key; ?>"><i class="<?php echo esc_attr( $option_value ); ?>"></i></span>
                                    <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                    <input class="repeater-field-value-holder" type="hidden" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>">
                </div>
                <?php
                break;
            case 'social-share': 
                $icons_list = blogzee_get_all_social_share();
                ?>
                    <div class="single-control fontawesome-icon-picker">
                        <h2 class="control--item-label"><?php echo esc_html( $label ); ?></h2>
                        <?php if( $description ) { ?>
                            <span class="control--item-description"><?php echo esc_html( $description ); ?></span>
                        <?php } ?>
                        <div class="icon-holder">
                            <div class="icon-header">
                                <div class="active-icon"><i class="<?php echo esc_attr( $current_item_value->$field_key ); ?>"></i></div>
                                <div class="icon-list-trigger"><i class="fa-solid fa-angle-down"></i></div>
                            </div>
                            <div class="icons-list" style="display:none;">
                                <input class="icon-search-input" type="text" placeholder="<?php echo esc_attr__( "Type to search", 'blogzee' ); ?>"/>
                                <?php
                                    foreach( $icons_list as $icon_key => $icon_value ) :
                                    ?>
                                        <i class="<?php echo esc_attr( $icon_key ); ?><?php if( $icon_key === $current_item_value->$field_key ) echo ' selected'; ?>"></i>
                                    <?php
                                    endforeach;
                                ?>
                            </div>
                            <input class="repeater-field-value-holder" data-default="<?php echo esc_attr( $default_value ); ?>" data-key="<?php echo esc_attr( $field_key ); ?>" type="hidden" value="<?php echo esc_attr( $current_item_value->$field_key ); ?>"/>
                        </div>
                    </div>
                <?php
                break;
            default: echo 'Not set';
        }   
    }
}