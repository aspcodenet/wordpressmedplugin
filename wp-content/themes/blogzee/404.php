<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

get_header();

	do_action( 'blogzee_main_content_opening' );
	?>
		<main id="primary" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can\'t be found.', 'blogzee' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'blogzee' ); ?></p>
					<div class="back_to_home_btn">
						<a href="<?php echo esc_url( home_url() ); ?>">
							<?php
								echo blogzee_get_icon_control_html([ 'value' => 'fa-solid fa-tent-arrow-turn-left', 'type' => 'icon' ]);

								echo '<span class="button-label">'. esc_html__( 'Back to Home', 'blogzee' ) .'</span>';
							?>
						</a>	
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->

	<?php
	get_sidebar();
	do_action( 'blogzee_main_content_closing' );

get_footer();