<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
require get_template_directory() . '/builder/footer-builder.php';
use Blogzee_Builder as BB;

	/**
	 * Hook - blogzee_before_footer_hook
	 */
	if( has_action( 'blogzee_before_footer_hook' ) ) do_action( 'blogzee_before_footer_hook' );

	$footer_builder_section_width = BZ\blogzee_get_customizer_option( 'footer_builder_section_width' );
	$footerClass = 'site-footer dark_bk';
	$footerClass .= ' ' . $footer_builder_section_width;
	?>
		<footer id="colophon" class="<?php echo esc_attr( $footerClass ); ?>">
			<div class="blogzee-container">
				<div class="row">
					<?php
						new BB\Footer_Builder_Render();
					?>
				</div>
			</div>
		</footer><!-- #colophon -->

		<?php
			/**
			 * hook - blogzee_animation_hook
			 * 
			 * hooked - blogzee_get_background_and_cursor_animation
			 */
			if( has_action( 'blogzee_animation_hook' ) ) do_action( 'blogzee_animation_hook' );
		?>
	</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
