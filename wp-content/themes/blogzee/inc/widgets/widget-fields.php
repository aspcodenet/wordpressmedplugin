<?php
/**
 * Includes widget fields
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */

function blogzee_widget_fields( $instance, $args, $field_value ) {
    echo '<div class="blogzee-widget-field blogzee-' .esc_html( $args['type'] ). '-field">';
        switch( $args['type'] ) {
            case 'number' :
                if( ! array_key_exists( 'max', $args ) ) $args['max'] = 100;
                if( ! array_key_exists( 'min', $args ) ) $args['min'] = 0;
                if( ! array_key_exists( 'step', $args ) ) $args['step'] = 1;
            ?>
                            <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                            <?php
                                if( isset( $args['description'] ) ) {
                                    echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                }
                            ?>
                            <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="number"  min="<?php echo esc_attr( $args['min'] ); ?>" max="<?php echo esc_attr( $args['max'] ); ?>" step="<?php echo esc_attr( $args['step'] ); ?>" value="<?php echo esc_attr( $field_value ); ?>"/>
                <?php
                break;
            case 'responsive-number' :
                    $field_value_parsed = json_decode( $field_value );
                 ?>
                                <div class="widget-heading-wrap">
                                    <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                                    <?php
                                        if( isset( $args['description'] ) ) {
                                            echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                        }
                                    ?>
                                    <div class="responsive-devices">
                                        <span class="dashicons dashicons-desktop isActive" data-device="desktop"></span>
                                        <span class="dashicons dashicons-tablet" data-device="tablet"></span>
                                        <span class="dashicons dashicons-smartphone" data-device="smartphone"></span>
                                    </div>
                                </div>
                                <div class="responsive-fields-wrapper">
                                    <input class="single-field desktop-field" data-device="desktop" type="number" min="<?php echo esc_attr( $args['min'] ); ?>" max="<?php echo esc_attr( $args['max'] ); ?>" step="<?php echo esc_attr( $args['step'] ); ?>" value="<?php echo esc_attr( $field_value_parsed->desktop ); ?>"/>
                                    <input class="single-field tablet-field" data-device="tablet" type="number" min="<?php echo esc_attr( $args['min'] ); ?>" max="<?php echo esc_attr( $args['max'] ); ?>" step="<?php echo esc_attr( $args['step'] ); ?>" value="<?php echo esc_attr( $field_value_parsed->tablet ); ?>"/>
                                    <input class="single-field smartphone-field" data-device="smartphone" type="number" min="<?php echo esc_attr( $args['min'] ); ?>" max="<?php echo esc_attr( $args['max'] ); ?>" step="<?php echo esc_attr( $args['step'] ); ?>" value="<?php echo esc_attr( $field_value_parsed->smartphone ); ?>"/>
                                </div>
                                <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="hidden" value="<?php echo esc_attr( $field_value ); ?>"/>
                        <?php
                        break;
            case 'heading' : ?>
                        <div class="heading"><?php echo esc_html( $args['label'] ); ?></div>
            <?php
            break;
            case 'text' : ?>
                            <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                            <?php
                                if( isset( $args['description'] ) ) {
                                    echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                }
                            ?>
                            <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="text" value="<?php echo esc_attr( $field_value ); ?>"/>
                <?php
                break;
            case 'icon-text' : $field_value_formatted = json_decode( $field_value );
                               $icons = blogzee_get_tabbed_icon_classes();
             ?>
                        <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                        <?php
                            if( isset( $args['description'] ) ) {
                                echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                            }
                        ?>
                        <div class="field-group-wrap">
                            <div class="icon-field" data-value="<?php echo esc_attr( $field_value_formatted->icon ); ?>">
                                <span class="icon-selector"><i class="<?php echo esc_attr( $field_value_formatted->icon ); ?>"></i></span>
                            </div>
                            <div class="text-field">
                                <input type="text" value="<?php echo esc_attr( $field_value_formatted->title ); ?>">
                            </div>
                            <span class="icon-selector-wrap">
                                <?php
                                    foreach( $icons as $icon ) :
                                        echo '<i class="' .esc_attr( $icon ). '"></i>';
                                    endforeach; 
                                ?>
                            </span>
                        </div>
                        <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="hidden" value="<?php echo esc_attr( $field_value ); ?>"/>
            <?php
            break;
            case 'url' : ?>
                            <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                            <?php
                                if( isset( $args['description'] ) ) {
                                    echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                }
                            ?>
                            <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="url" placeholder="<?php esc_attr_e( 'Add url here . .', 'blogzee' ); ?>" value="<?php echo esc_url( $field_value ); ?>" />
                <?php
                break;
            case 'textarea' : ?>
                            <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                            <?php
                                if( isset( $args['description'] ) ) {
                                    echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                }
                            ?>
                            <textarea class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" ><?php echo wp_kses_post( $field_value ); ?></textarea>
                <?php
                break;
            case 'checkbox' : ?>
                    <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="checkbox" value="<?php echo esc_attr( $field_value ); ?>" <?php checked( $field_value, true ); ?> />
                    <label for="<?php echo $instance->get_field_id( $args['name'] ); ?>"><?php echo esc_html( $args['title'] ); ?></label>
                    <?php
                        if( isset( $args['description'] ) ) {
                            echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                        }
                break;
            case 'upload' : ?>
                            <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                            <?php
                                if( isset( $args['description'] ) ) {
                                    echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                                }
                            ?>
                            <div class="upload-trigger<?php if( $field_value ) echo ' selected'; ?>">
                                <span><?php esc_html_e( 'Add image', 'blogzee' ); ?></span>
                            </div>
                            <div class="upload-buttons<?php if( ! $field_value ) echo ' not-selected'; ?>">
                                <img class="image-holder <?php if( ! $field_value ) echo 'nothasImage'; ?>" src="<?php echo esc_url( $field_value ); ?>" loading="lazy">
                                <button class="button button-link-delete remove-image"><?php esc_html_e( 'Remove image', 'blogzee' ); ?></button>
                            </div>
                            <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="hidden" value="<?php echo esc_url( $field_value ); ?>" />
                <?php
                break;
            case 'multicheckbox' :
                    $options = $args['options'];
            ?>
                    <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                    <?php
                        if( isset( $args['description'] ) ) {
                            echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                        }
                    ?>
                    <div class="multicheckbox-content" style="width: 300px;">
                        <?php
                        if( empty( $field_value ) ) {
                            $field_value = [];
                        } else {
                            $field_value = json_decode( $field_value, true );
                        }
                            foreach( $options as $option_key => $option_value ) :
                        ?>
                                <div class="multicheckbox-single-item">
                                    <input type="checkbox" id="<?php echo $instance->get_field_name( $args['name'] ).'['.$option_key.']'; ?>" value="<?php echo esc_attr( $option_key ); ?>" <?php if( is_array( $field_value ) ) if( in_array( $option_key, $field_value ) ) echo 'checked'; ?>>
                                    <label for="<?php echo $instance->get_field_name( $args['name'] ).'['.$option_key.']'; ?>"><?php echo esc_html( $option_value ); ?></label>
                                </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                    <input class="widefat" id="<?php echo $instance->get_field_id( $args['name'] ); ?>" name="<?php echo $instance->get_field_name( $args['name'] ); ?>" type="hidden" value=<?php echo json_encode( $field_value ); ?> />
            <?php
                break;
            case 'select' :
                $options = $args['options'];
        ?>
                <h2 class="title"><?php echo esc_html( $args['title'] ); ?></h2>
                <?php
                    if( isset( $args['description'] ) ) {
                        echo '<p class="description">' .esc_html( $args['description'] ). '</p>';
                    }
                    echo '<select class="widefat" id="' .$instance->get_field_id( $args['name'] ). '" name="' .$instance->get_field_name( $args['name'] ). '">';
                        foreach( $options as $option_key => $option_value ) :
                ?>
                            <option value="<?php echo esc_attr( $option_key ); ?>" <?php if( $option_key === $field_value ) echo 'selected'; ?>><?php echo esc_html( $option_value ); ?></option>
                <?php
                        endforeach;
                    echo '</select>';
                    ?>
                <?php
                break;
            case 'select-two':
                $options = $args['options'];
                echo '<h2 class="title">'. esc_html( $args['title'] ) .'</h2>';
                if( isset( $args['description'] ) ) echo '<p class="description">'. esc_html( $args['description'] ) .'</p>';
                echo '<select class="widefat" name="'. $instance->get_field_name( $args['name'] ) .'" id="'. $instance->get_field_id( $args['name'] ) .'" style="width: 100%" multiple>';
                    foreach( $options as $option_key => $option_value ) :
                        $selected = ( in_array( $option_key, explode( ',', $field_value ) ) ) ? ' selected' : '';
                        echo '<option value="'. esc_attr( $option_key ) .'"'. esc_attr( $selected ) .'>'. esc_html( $option_value ) .'</option>';
                    endforeach;
                echo '</select>';
                echo '<input type="hidden" data-type="'. esc_attr( $options['type'] ) .'" class="widefat" value="'. esc_attr( $field_value ) .'" name="'. $instance->get_field_name( $args['name'] ) .'" id="'. $instance->get_field_id( $args['name'] ) .'">';
                break;
            default : esc_html( 'Undefined control field', 'blogzee' );
                break;
        }
    echo '</div>';
}

// Sanitize widget fields
function blogzee_sanitize_widget_fields( $widget_field, $new_instance ) {
    if( $widget_field['type'] === 'text' || $widget_field['type'] === 'select' || $widget_field['type'] === 'multicheckbox' ) {
        return sanitize_text_field( $new_instance[$widget_field['name']] );
    } else if( $widget_field['type'] === 'checkbox' ) {
        return ( isset($new_instance[$widget_field['name']]) && $new_instance[$widget_field['name']] ) ? true : false;
    } else if( $widget_field['type'] === 'number' ) {
        return absint( $new_instance[$widget_field['name']] );
    } else if( $widget_field['type'] === 'textarea' ) {
        return wp_kses_post( $new_instance[$widget_field['name']] );
    } else if( $widget_field['type'] === 'upload' ) {
        return esc_url_raw( $new_instance[$widget_field['name']] );
    } else if( $widget_field['type'] === 'select-two' ) {
        return sanitize_text_field( $new_instance[ $widget_field['name'] ] );
    } else {
        if( isset($new_instance[$widget_field['name']]) ) {
            return sanitize_text_field( $new_instance[$widget_field['name']] );
        } else {
            return;
        }
    }
}