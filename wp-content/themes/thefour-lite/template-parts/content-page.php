<?php
/**
 * The template used for displaying page.
 *
 * @package TheFour
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content clearfix">
		<?php
		/**
		 * If page has more tag, then display the content after more tag only.
		 * The content before more tag is used in the hero area.
		 */
		$content = get_post_field( 'post_content', null );
		$content = get_extended( $content );
		$content = $content['extended'] ? $content['extended'] : $content['main'];

		/**
		 * Apply filters for the content. Mimic the_content() function.
		 *
		 * @see the_content()
		 */
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content; /* WPCS: xss ok. */
		?>

		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'thefour-lite' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</div>

</article>
