<?php
/**
 * The template for displaying aside post formats
 * Used for index/archive/search.
 *
 * @package TheFour
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<a class="permalink" href="<?php the_permalink(); ?>">&infin;</a>

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
