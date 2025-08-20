<?php
/**
 * Top Header hooks and functions
 * 
 * @package Blogzee Pro
 * @since 1.0.0
 */
use Blogzee\CustomizerDefault as BZ;

if( ! function_exists( 'blogzee_date_time_part' ) ) :
    /**
     * Top header menu element
     * 
    * @since 1.0.0
    */
    function blogzee_date_time_part() {
        $elementClass = 'top-date-time';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <span class="top-date-time-inner">
                    <span class="time"></span>
                    <span class="date"><?php echo date_i18n( get_option( 'date_format' ), current_time( 'timestamp' )); ?></span>
                </span>
            </div>
        <?php
    }
    add_action( 'blogzee_date_time_hook', 'blogzee_date_time_part', 10 );
endif;

if( ! function_exists( 'blogzee_social_part' ) ) :
    /**
     * Top header social element
     * 
     * @since 1.0.0
     */
    function blogzee_social_part() {
        ?>
            <div class="social-icons-wrap blogzee-show-hover-animation">
                <?php blogzee_customizer_social_icons(); ?>
            </div>
        <?php
    }
    add_action( 'blogzee_social_icons_hook', 'blogzee_social_part', 10 );
endif;