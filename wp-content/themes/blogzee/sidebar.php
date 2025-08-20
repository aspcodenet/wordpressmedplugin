<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogzee Pro
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
use Blogzee\CustomizerDefault as BZ;
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
