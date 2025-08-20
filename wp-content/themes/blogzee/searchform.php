<?php 
/**
 * Search form
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label>
    <span class="screen-reader-text">
        <?php
            /* translators: Hidden accessibility text. */
            _x( 'Search for:', 'label', 'blogzee' );
        ?>
    </span>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blogzee' ); ?>" value="<?php echo get_search_query()?>" name="s" />
</label>
<input type="submit" class="search-submit" value="<?php echo esc_attr__( 'Search', 'blogzee' ); ?>" />
</form>