<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Blogzee Pro
 */

use Blogzee\CustomizerDefault as BZ;

get_header();

	do_action( 'blogzee_main_content_opening' );
	$elementClass = ' archive-align--' . BZ\blogzee_get_customizer_option('archive_post_elements_alignment');
	?>

		<main id="primary" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
							/* translators: %s: search query. */
							echo '<span class="search-page-title">'. esc_html__( 'Search Results for', 'blogzee' ) .'</span>';
							echo '<span>'. get_search_query() .'</span>';
						?>
					</h1>
					<div class="blogzee_search_page">
						<?php get_search_form(); ?>
					</div>
				</header><!-- .page-header -->

				<?php
				echo '<div class="blogzee-inner-content-wrap'. esc_attr( $elementClass ) .'">'; //inner-content-wrap
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/archive/layout' );

					endwhile;
				echo '</div>';

				/**
				 * hook - blogzee_pagination_link_hook
				 * 
				 * hooked - blogzee_pagination_fnc - 10
				 * 
				 * @package Blogzee Pro
				 * @since 1.0.0
				 */
				do_action( 'blogzee_pagination_link_hook' );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->

	<?php
	get_sidebar();
	do_action( 'blogzee_main_content_closing' );

get_footer();
