<?php
/**
 * The left sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogzee Pro
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
use Blogzee\CustomizerDefault as BZ;
?>
<aside id="secondary-aside" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside><!-- #secondary-aside -->