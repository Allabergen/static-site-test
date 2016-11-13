<?php
/**
 * Custom template tags for the frontend
 *
 * @package TheFour
 */

add_filter( 'excerpt_more', 'thefour_excerpt_more' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function thefour_excerpt_more() {
	$text = wp_kses_post( sprintf( __( 'Continue reading &raquo; %s', 'thefour-lite' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( '&hellip; <p><a href="%s" class="more-link">%s</a></p>', esc_url( get_permalink() ), $text );

	return $more;
}

add_filter( 'the_content_more_link', 'thefour_content_more' );

/**
 * Auto add more links.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function thefour_content_more() {
	$text = wp_kses_post( sprintf( __( 'Continue reading &raquo; %s', 'thefour-lite' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( '<p><a href="%s#more-%d" class="more-link">%s</a></p>', esc_url( get_permalink() ), get_the_ID(), $text );

	return $more;
}

add_filter( 'excerpt_length', 'thefour_excerpt_length' );

/**
 * Change excerpt length
 *
 * @return int
 */
function thefour_excerpt_length() {
	return 25;
}

if ( ! function_exists( 'thefour_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function thefour_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = sprintf(
			'<span class="screen-reader-text">%s</span> %s',
			esc_html_x( 'Posted on', 'Used before publish date.', 'thefour-lite' ),
			'<a class="entry-date-wrapper" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo $posted_on; // WPCS: XSS OK.
	}
endif;
