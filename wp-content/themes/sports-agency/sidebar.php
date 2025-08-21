<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sports Agency
 */
?>

<div class="sidebar-area">
  <?php if ( ! dynamic_sidebar( 'sports-agency-sidebar' ) ) : ?>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar1', 'sports-agency' ); ?>" id="Search" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Search', 'sports-agency' ); ?></h4>
      <?php get_search_form(); ?>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar2', 'sports-agency' ); ?>" id="archives" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Archives', 'sports-agency' ); ?></h4>
      <ul>
          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
      </ul>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar3', 'sports-agency' ); ?>" id="meta" class="sidebar-widget">
      <h4 class="title"><?php esc_html_e( 'Meta', 'sports-agency' ); ?></h4>
      <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
      </ul>
    </div>
    <div role="complementary" aria-label="<?php echo esc_attr__( 'sidebar4', 'sports-agency' ); ?>" id="tag-cloud" class="sidebar-widget">
      <h4 class="title" ><?php esc_html_e( 'Tag Cloud', 'sports-agency' ); ?></h4>
      <?php wp_tag_cloud(); ?>
    </div>
  <?php endif; // end sidebar widget area ?>
</div>