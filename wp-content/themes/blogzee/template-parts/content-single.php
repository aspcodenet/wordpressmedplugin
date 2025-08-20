<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;
$single_post_content_alignment = BZ\blogzee_get_customizer_option( 'single_post_content_alignment' );
$previous = get_previous_post();
$next = get_next_post();
$articleClass = '';
if( empty( $previous ) ) $articleClass .= 'no-prev';
if( empty( $next ) ) $articleClass .= 'no-next';
$postInnerClass = 'post-inner';
?>
<article <?php blogzee_schema_article_attributes(); ?> id="post-<?php the_ID(); ?>" <?php post_class( $articleClass ); ?>>
	<div class="<?php echo esc_attr( $postInnerClass ); ?>">
		<?php
			$single_image_size = BZ\blogzee_get_customizer_option( 'single_image_size' );
			get_template_part( 'template-parts/single/partial', 'meta' );

			blogzee_post_thumbnail( $single_image_size );

			$contentClass = 'entry-content';
			$contentClass .= ' content-alignment--' . esc_attr( $single_post_content_alignment );
		?>
		<div <?php blogzee_schema_article_body_attributes(); ?> class="<?php echo esc_attr( $contentClass ); ?>">
			<?php
				do_action( 'blogzee_before_single_content_hook' );
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogzee' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				do_action( 'blogzee_after_single_content_hook' );

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogzee' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
				$tag_count = get_tags([ 'object_ids' => get_the_ID() ]);
				if( count( $tag_count ) != 0 ) :
					blogzee_tags_list();
				endif;
					blogzee_entry_footer();
			?>
		</footer><!-- .entry-footer -->

	</div>

	<div class="post-card author-wrap">
		<div class="bmm-author-thumb-wrap">
			<figure class="post-thumb"><?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?></figure>
			<div class="author-elements">
				<h2 class="author-name"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></h2>
				<div class="author-desc"><?php echo get_the_author_meta( 'description' ); ?></div>
			</div>
		</div>
	</div>
	<?php
		// date
		$prev_post_date = ! empty( $previous ) ? '<span class="nav-post-date">' . blogzee_posted_on( $previous->ID, '', [ 'return' => true ] ) . '</span>' : '';
		$next_post_date = ! empty( $next ) ? '<span class="nav-post-date">' . blogzee_posted_on( $next->ID, '', [ 'return' => true ] ) . '</span>' : '';

		// thumbnail
		$prev_post_thumbnail = ( ! empty( $previous ) ) ? get_the_post_thumbnail_url( $previous->ID ) : '';
		$next_post_thumbnail = ( ! empty( $next ) ) ? get_the_post_thumbnail_url( $next->ID  ) : '';

		// sub-title
		$prev_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-left"></i></span>';
		$next_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-right"></i></span>';

		// title
		$post_navigation_title = '<span class="nav-title">%title</span>';
		
		the_post_navigation(
			[
				'prev_text' => '<div class="button-thumbnail">'. $prev_post_navigation_sub_title .'<figure class="nav-thumb" style="background-image:url('. $prev_post_thumbnail .')"></figure></div><div class="nav-post-elements">'. $prev_post_date . '<div class="nav-title-wrap">' . $post_navigation_title. '</div></div>',
				'next_text' => '<div class="nav-post-elements">'. $next_post_date . '<div class="nav-title-wrap">' . $post_navigation_title .'</div></div><div class="button-thumbnail"><figure class="nav-thumb" style="background-image:url('. $next_post_thumbnail .')"></figure>'. $next_post_navigation_sub_title .'</div>'
			]
		);
	?>
		
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php
	/**
	 * hook - blogzee_single_post_append_hook
	 * 
	 * @since 1.0.0
	 */
	do_action( 'blogzee_single_post_append_hook' );