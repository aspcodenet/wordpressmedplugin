<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sports Agency
*/

  global $post;
?>
<?php
  $sports_agency_archive_year  = get_the_time('Y');
  $sports_agency_archive_month = get_the_time('m');
  $sports_agency_archive_day   = get_the_time('d');
?>
<?php if ((get_theme_mod( 'sports_agency_post_layout','Right Sidebar') == 'Three Columns') || (get_theme_mod( 'sports_agency_post_layout','Right Sidebar') == 'Four Columns')) : ?> 
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4 ' . (get_theme_mod('sports_agency_enable_post_animation', true) ? 'zoomIn wow' : '')); ?>>
      <div class="box">
        <div class="post-thumbnail">  
          <?php if (get_theme_mod( 'sports_agency_blog_post_featured_image',true)) : ?>      
              <?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail(); ?>
              <?php } else { ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/post-dummy.png' ); ?>" alt="<?php esc_attr_e( 'Post Image', 'sports-agency' ); ?>">
              <?php }?>
          <?php endif; ?>
        </div>
        <div class="box-content">
          <p class="slider-button mb-0">
            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','sports-agency'); ?><i class="fas fa-angle-right ms-2"></i></a>
          </p>
        </div>
      </div>
      <div class="post-content-box p-3">
        <div class="post-info">
          <?php if( get_theme_mod( 'sports_agency_date_hide',true)) : ?>
            <span class="entry-date"><i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_date_icon_changer','fa fa-calendar')); ?>"></i> <a href="<?php echo esc_url( get_day_link( $sports_agency_archive_year, $sports_agency_archive_month, $sports_agency_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
          <?php endif; ?>
          <?php if( get_theme_mod( 'sports_agency_author_hide',true)) : ?>
            <span class="entry-author"><i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_author_icon_changer','fa fa-user')); ?>"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
          <?php endif; ?>
        </div>
        <h3 class="post-title mb-2 mt-2"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h3>
        <div class="post-content">
        <?php echo wp_trim_words( get_the_content(), get_theme_mod('sports_agency_length_setting','15')); ?>
        </div>
        <div class="post-info">
        <?php if( get_theme_mod( 'sports_agency_comment_hide',true)) : ?>
            <i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_comment_icon_changer','fas fa-comments')); ?>"></i><span class="entry-comments ms-2"><?php comments_number( __('0 Comments','sports-agency'), __('0 Comments','sports-agency'), __('% Comments','sports-agency') ); ?></span>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div id="post-<?php the_ID(); ?>" <?php post_class('post-box mb-4 ' . (get_theme_mod('sports_agency_enable_post_animation', true) ? 'zoomIn wow' : '')); ?>>
      <div class="box">
        <div class="post-thumbnail">  
          <?php if (get_theme_mod( 'sports_agency_blog_post_featured_image',true)) : ?>      
              <?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail(); ?>
              <?php } else { ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/post-dummy.png' ); ?>" alt="<?php esc_attr_e( 'Post Image', 'sports-agency' ); ?>">
              <?php }?>
          <?php endif; ?>
        </div>
        <div class="box-content">
          <p class="slider-button mb-0">
            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Read More','sports-agency'); ?><i class="fas fa-angle-right ms-2"></i></a>
          </p>
        </div>
      </div>
      <div class="post-content-box p-3">
        <div class="post-info">
          <?php if( get_theme_mod( 'sports_agency_date_hide',true)) : ?>
            <span class="entry-date"><i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_date_icon_changer','fa fa-calendar')); ?>"></i> <a href="<?php echo esc_url( get_day_link( $sports_agency_archive_year, $sports_agency_archive_month, $sports_agency_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
          <?php endif; ?>
          <?php if( get_theme_mod( 'sports_agency_author_hide',true)) : ?>
            <span class="entry-author"><i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_author_icon_changer','fa fa-user')); ?>"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
          <?php endif; ?>
        </div>
        <h3 class="post-title mb-2 mt-2"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h3>
        <div class="post-content">
        <?php echo wp_trim_words( get_the_content(), get_theme_mod('sports_agency_length_setting','15')); ?>
        </div>
        <div class="post-info">
        <?php if( get_theme_mod( 'sports_agency_comment_hide',true)) : ?>
            <i class="<?php echo esc_attr(get_theme_mod('sports_agency_post_comment_icon_changer','fas fa-comments')); ?>"></i><span class="entry-comments ms-2"><?php comments_number( __('0 Comments','sports-agency'), __('0 Comments','sports-agency'), __('% Comments','sports-agency') ); ?></span>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>