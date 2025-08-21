<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<div class="header-image-box text-center">
  <div class="container">
	<?php if ( get_theme_mod('sports_agency_header_page_title' , true)) : ?>
		<h1><?php the_title(); ?></h1>
	<?php endif; ?>
  </div>
</div>

<?php
 $sports_agency_single_product_sidebar = get_theme_mod( 'sports_agency_single_product_sidebar',true );
 if ( $sports_agency_single_product_sidebar == false ) {
   $sports_agency_colsm = 'col-lg-12 col-md-12 col-sm-12';
 } else { 
   $sports_agency_colsm = 'col-lg-8 col-md-8 col-sm-8';
 } 
?>

<div class="container main-wrapper py-4 px-0">
	<main role="main" id="content">
		<div class="row m-0">
			<?php if(get_theme_mod( 'sports_agency_single_product_sidebar_layout','Right Sidebar') == 'Right Sidebar') : ?>
				<div class="<?php echo esc_attr( $sports_agency_colsm ); ?>">
					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
				<?php if ( false != $sports_agency_single_product_sidebar ) : ?>			
					<div class="col-lg-4 col-md-4 col-sm-4">
						<?php
							/**
							 * Hook: woocommerce_sidebar.
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							do_action( 'woocommerce_sidebar' );
						?>
					</div>
				<?php endif; ?>
			<?php elseif (get_theme_mod( 'sports_agency_single_product_sidebar_layout','Right Sidebar') == 'Left Sidebar') : ?>
				<?php if ( false != $sports_agency_single_product_sidebar ) : ?>			
					<div class="col-lg-4 col-md-4 col-sm-4">
						<?php
							/**
							 * Hook: woocommerce_sidebar.
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							do_action( 'woocommerce_sidebar' );
						?>
					</div>
				<?php endif; ?>
				<div class="<?php echo esc_attr( $sports_agency_colsm ); ?>">
					<?php
						/**
						 * woocommerce_before_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action( 'woocommerce_after_main_content' );
					?>
				</div>
			<?php endif; ?>	
		</div>
	</main>
</div>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
