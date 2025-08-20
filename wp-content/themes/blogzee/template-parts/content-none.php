<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */

use Blogzee\CustomizerDefault as BZ;
?>

<section class="no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php echo esc_html__( 'Nothing Found', 'blogzee' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content entry-conten">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'blogzee' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'blogzee' ); ?></p>
			<div class="blogzee_search_page">
				<?php
					get_search_form();
				?>
			</div>
			<?php
			
		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'blogzee' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
