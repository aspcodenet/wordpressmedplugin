<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blogzee Pro
 */
use Blogzee\CustomizerDefault as BZ;

 if ( ! function_exists( 'blogzee_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blogzee_posted_on( $post_id = '', $for = '', $args = [] ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time = $post_id ? get_the_time( 'U', $post_id ) : get_the_time( 'U' );
		$modified_time = $post_id ? get_the_modified_time( 'U', $post_id ) : get_the_modified_time( 'U' );
		if ( $time !== $modified_time ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$hide_on_mobile = '';
		if( array_key_exists( 'hide_on_mobile', $args ) ) :
            $hide_on_mobile = ( ! $args['hide_on_mobile'] ) ? ' hide-on-mobile' : '';
        endif;
		$time_string = sprintf(
			$time_string,
			esc_attr( $post_id ? get_the_date( DATE_W3C, $post_id ) : get_the_date( DATE_W3C ) ),
			esc_html( blogzee_get_published_date($post_id) ),
			esc_attr( $post_id ? get_the_modified_date( DATE_W3C, $post_id ) : get_the_modified_date( DATE_W3C ) ),
			esc_html( blogzee_get_modified_date($post_id) )
		);
		$year = get_the_date( 'Y' );
		$month = get_the_date( 'm' );
		$posted_on = '<a href="' . esc_url( get_month_link( $year, $month ) ) . '" rel="bookmark">' . $time_string . '</a>';
		$icon_html = blogzee_get_icon_control_html([ 'type' => 'icon', 'value' => 'fas fa-calendar-days' ]);
		if( $for == 'banner' ) { 
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'carousel' ) {
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'ticker' ) {
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'you-may-have-missed' ) {
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		}else if( is_home() || is_archive() || is_search() ) {
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( is_single() ) {
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		}

		if( array_key_exists( 'icon_html', $args ) ) :
			$posted_on = $args['icon_html'] . $posted_on;
		endif;

		if( array_key_exists( 'return', $args ) && $args['return'] ) :
			$posted_on = $icon_html . '<span class="post-nav-time-string">'. $time_string .'</span>';
			return '<span class="post-date posted-on'. esc_attr( $hide_on_mobile ) .' '.esc_attr( BZ\blogzee_get_customizer_option( 'site_date_to_show' ) ). '">' . $posted_on . '</span>';
		else:
			echo '<span class="post-date posted-on'. esc_attr( $hide_on_mobile ) .' '.esc_attr( BZ\blogzee_get_customizer_option( 'site_date_to_show' ) ). '">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
	}
endif;

if ( ! function_exists( 'blogzee_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function blogzee_posted_by( $for = '', $blogzee_post_id = 0 ) {
		if( $blogzee_post_id > 0 ) :
			$author_id = get_post_field( 'post_author', $blogzee_post_id );
		else :
			$author_id = get_the_author_meta( 'ID' );
		endif;
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'blogzee' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
		);

		if( $for == 'banner' ) {
			$author_image = get_avatar( $author_id, 40 );
			if( $author_image ) $byline = $author_image . $byline;
		} else if( $for == 'carousel' ) {
			$author_image = get_avatar( $author_id, 40 );
			if( $author_image ) $byline = $author_image . $byline;
		} else {
			if( is_home() || is_archive() ) :
				$author_image = get_avatar( $author_id, 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
	
			if( is_single() ) :
				$single_author_image_option = BZ\blogzee_get_customizer_option( 'single_author_image_option' );
				if( $single_author_image_option ) {
					$author_image = get_avatar( $author_id, 40 );
					if( $author_image ) $byline = $author_image . $byline;
				}
			endif;
	
			if( is_search() ) :
				$author_image = get_avatar( $author_id, 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
		}

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if( ! function_exists( 'blogzee_tags_list' ) ) :
	/**
	 * print the html for tags list
	 */
	function blogzee_tags_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ' ' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'blogzee' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'blogzee_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogzee_entry_footer() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'blogzee' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'blogzee_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function blogzee_post_thumbnail( $size = 'thumbnail' ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<div class="post-thumbnail<?php if( ! has_post_thumbnail() ) echo ' no-single-featured-image'; ?>">
				<?php the_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if( ! function_exists( 'blogzee_get_published_date' ) ) :
	// Get post pusblished date
	function blogzee_get_published_date($post_id='') {
		$site_date_format = BZ\blogzee_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
												$post_id ? get_the_date('', $post_id) : get_the_date() : 
												human_time_diff($post_id ? get_the_time('U',$post_id) : get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'blogzee');
		return apply_filters( "blogzee_inherit_published_date", $n_date );
	}
endif;

if( ! function_exists( 'blogzee_get_modified_date' ) ) :
	// Get post pusblished date
	function blogzee_get_modified_date($post_id='') {
		$site_date_format = BZ\blogzee_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
											$post_id ? get_the_modified_date('', $post_id) : get_the_modified_date() : 
												human_time_diff($post_id ? get_the_modified_time('U', $post_id): get_the_modified_time('U'), current_time('timestamp')) .' '. __('ago', 'blogzee');
		return apply_filters( "blogzee_inherit_published_date", $n_date );
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
