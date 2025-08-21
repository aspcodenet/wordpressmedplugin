<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sports Agency
 */
?>

<footer class="footer-side">
  <?php if ( get_theme_mod( 'sports_agency_show_footer_widget', true ) ) : ?>
    <div class="footer-widget">
      <div class="container">
        <?php
          // Check if any footer sidebar is active
          $sports_agency_any_sidebar_active = false;
          for ( $sports_agency_i = 1; $sports_agency_i <= 4; $sports_agency_i++ ) {
            if ( is_active_sidebar( "footer{$sports_agency_i}-sidebar" ) ) {
              $sports_agency_any_sidebar_active = true;
              break;
            }
          }
          // Count active for responsive column classes
          $sports_agency_active_sidebars = 0;
          if ( $sports_agency_any_sidebar_active ) {
            for ( $sports_agency_i = 1; $sports_agency_i <= 4; $sports_agency_i++ ) {
              if ( is_active_sidebar( "footer{$sports_agency_i}-sidebar" ) ) {
                $sports_agency_active_sidebars++;
              }
            }
          }
          $sports_agency_col_class = $sports_agency_active_sidebars > 0 ? 'col-lg-' . (12 / $sports_agency_active_sidebars) . ' col-md-6 col-sm-12' : 'col-lg-3 col-md-6 col-sm-12';
        ?>
        <div class="row pt-2">
          <?php for ( $sports_agency_i = 1; $sports_agency_i <= 4; $sports_agency_i++ ) : ?>
            <div class="footer-area <?php echo esc_attr($sports_agency_col_class); ?>">
              <?php if ( $sports_agency_any_sidebar_active && is_active_sidebar("footer{$sports_agency_i}-sidebar") ) : ?>
                <?php dynamic_sidebar("footer{$sports_agency_i}-sidebar"); ?>
              <?php elseif ( ! $sports_agency_any_sidebar_active ) : ?>
                  <?php if ( $sports_agency_i === 1 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer1', 'sports-agency' ); ?>" id="Search" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Search', 'sports-agency' ); ?></h4>
                      <?php get_search_form(); ?>
                    </aside>

                  <?php elseif ( $sports_agency_i === 2 ) : ?>
                      <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer2', 'sports-agency' ); ?>" id="archives" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Archives', 'sports-agency' ); ?></h4>
                      <ul>
                          <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                      </ul>
                      </aside>
                  <?php elseif ( $sports_agency_i === 3 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer3', 'sports-agency' ); ?>" id="meta" class="sidebar-widget">
                      <h4 class="title"><?php esc_html_e( 'Meta', 'sports-agency' ); ?></h4>
                      <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                      </ul>
                    </aside>
                  <?php elseif ( $sports_agency_i === 4 ) : ?>
                    <aside role="complementary" aria-label="<?php echo esc_attr__( 'footer4', 'sports-agency' ); ?>" id="categories" class="sidebar-widget">
                      <h4 class="title" ><?php esc_html_e( 'Categories', 'sports-agency' ); ?></h4>
                      <ul>
                          <?php wp_list_categories('title_li=');  ?>
                      </ul>
                    </aside>
                  <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if( get_theme_mod( 'sports_agency_show_footer_copyright',true)) : ?>
    <div class="footer-copyright">
      <div class="container">
        <div class="row pt-2">
          <div class="col-lg-6 col-md-6 align-self-center">
            <p class="mb-0 py-3 text-center text-md-start">
              <?php
                if (!get_theme_mod('sports_agency_footer_text') ) { ?>
                <a href="<?php echo esc_url(__('https://www.wpelemento.com/products/sports-agency', 'sports-agency' )); ?>" target="_blank">
                  <?php esc_html_e('Sports Agency Theme','sports-agency'); ?>
                </a>
                <?php } else {
                  echo esc_html(get_theme_mod('sports_agency_footer_text'));
                }
              ?>
              <?php if ( get_theme_mod('sports_agency_copyright_enable', true) == true ) : ?>
              <?php
                /* translators: %s: WP Elemento */
                printf( esc_html__( ' By %s', 'sports-agency' ), 'WP Elemento' ); ?>
              <?php endif; ?>
            </p>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center text-center text-md-end">
            <?php if ( get_theme_mod('sports_agency_copyright_enable', true) == true ) : ?>
              <a href="<?php echo esc_url(__('https://wordpress.org','sports-agency') ); ?>" rel="generator"><?php  /* translators: %s: WordPress */ printf( esc_html__( 'Proudly powered by %s', 'sports-agency' ), 'WordPress' ); ?></a>
            <?php endif; ?>
          </div>
          <?php if(get_theme_mod('sports_agency_footer_social_icon_hide', false )== true){ ?>
            <div class="row">
              <div class="col-12 align-self-center py-1">
                <div class="footer-links">
                  <?php $sports_agency_settings_footer = get_theme_mod( 'sports_agency_social_links_settings_footer' ); ?>
                  <?php if ( is_array($sports_agency_settings_footer) || is_object($sports_agency_settings_footer) ){ ?>
                    <?php foreach( $sports_agency_settings_footer as $sports_agency_setting_footer ) { ?>
                      <a href="<?php echo esc_url( $sports_agency_setting_footer['link_url'] ); ?>" target="_blank">
                        <i class="<?php echo esc_attr( $sports_agency_setting_footer['link_text'] ); ?> me-2"></i>
                      </a>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <?php if ( get_theme_mod('sports_agency_scroll_enable_setting', true)== true) : ?>
    <div class="scroll-up">
      <a href="#tobottom"><i class="fas fa-angle-double-up"></i></a>
    </div>
  <?php endif; ?>
  <?php if(get_theme_mod('sports_agency_progress_bar', false )== true): ?>
    <div id="elemento-progress-bar" class="theme-progress-bar <?php if( get_theme_mod( 'sports_agency_progress_bar_position','top') == 'top') { ?> top <?php } else { ?> bottom <?php } ?>"></div>
  <?php endif; ?>
  <?php if(get_theme_mod('sports_agency_cursor_outline', false )== true): ?>
    <!-- Custom cursor -->
    <div class="cursor-point-outline"></div>
    <div class="cursor-point"></div>
    <!-- .Custom cursor -->
  <?php endif; ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>