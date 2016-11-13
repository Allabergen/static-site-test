<?php
/**
 * The template used for displaying child page on the grid template.
 *
 * @package TheFour
 */

?>
<div class="column one-third">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'template-parts/content', 'media' ); ?>
		<div class="entry-text">
			<header class="entry-header">
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
			</header>

			<div class="entry-summary">
				<?php the_excerpt(); ?>

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
		</div>
	</article>
</div>
