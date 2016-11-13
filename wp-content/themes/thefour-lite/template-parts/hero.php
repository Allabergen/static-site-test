<?php
/**
 * Display the content in the hero area.
 *
 * @package TheFour
 */

/**
 * For homepage displaying latest posts: Show site title and description.
 */
if ( is_front_page() && is_home() ) {
	?>
	<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

	<?php
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<h3><?php echo $description; /* WPCS: xss ok */ ?></h3>
		<?php
	endif;

	return;
}

/**
 * For pages, including static front page & static blog page:
 * Show the content before more tag if there's a more tag, otherwise show title.
 */
if ( is_page() || is_home() ) {
	$page_id = is_page() ? get_the_ID() : get_option( 'page_for_posts' );
	$content = get_post_field( 'post_content', $page_id );
	$content = get_extended( $content );
	if ( ! empty( $content['main'] ) && ! empty( $content['extended'] ) ) {
		echo wp_kses_post( do_shortcode( $content['main'] ) );
	} else {
		echo '<h1>' . get_the_title( $page_id ) . '</h1>';
	}

	return;
}

/**
 * For single post: show entry meta and title.
 */
if ( is_single() ) :
	?>
	<?php thefour_posted_on(); ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<p class="entry-meta">
		<?php
		$byline = sprintf(
			'<span class="byline"><span class="author vcard"><a class="url fn n" href="%s">%s</a></span></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		printf( esc_html__( '%1$s by %2$s &mdash; in %3$s.', 'thefour-lite' ), get_avatar( get_the_author_meta( 'user_email' ), 32 ), $byline, get_the_category_list( ', ' ) ); // WPCS: XSS OK.

		comments_popup_link(
			esc_html__( 'No comment.', 'thefour-lite' ),
			esc_html__( '1 Comment.', 'thefour-lite' ),
			esc_html__( '% Comments.', 'thefour-lite' ),
			'comments-link',
			esc_html__( 'Comments are closed.', 'thefour-lite' )
		);
		?>
	</p>
	<?php
	return;
endif;

/**
 * For other archive pages.
 */
if ( is_search() ) {
	echo '<h2>';
	echo esc_html( sprintf( __( 'Search results: "%s"', 'thefour-lite' ), get_search_query() ) );
	echo '</h2>';
} elseif ( is_404() ) {
	echo '<h1>' . esc_html__( 'Not found', 'thefour-lite' ) . '</h1>';
} elseif ( is_category() || is_archive() ) {
	the_archive_title( '<h2>', '</h2>' );
	the_archive_description( '<h3>', '</h3>' );
}
