<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TheFour
 */

// If users select to display blog posts on the front page, load the index file.
if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}

// Custom front page template.
get_header(); ?>

	<section class="intro section">

		<?php if ( have_posts() ) :  the_post(); ?>

			<?php
			/**
			 * If page has more tag, then display the content after more tag only.
			 * The content before more tag is used in the hero area.
			 */
			$content = get_post_field( 'post_content', null );
			$content = get_extended( $content );
			$content = $content['extended'] ? $content['extended'] : $content['main'];
			echo wp_kses_post( wpautop( $content ) );
			?>

		<?php endif; ?>

	</section>

<?php get_template_part( 'template-parts/home/cta' ); ?>
<?php get_template_part( 'template-parts/home/blog' ); ?>
<?php get_template_part( 'template-parts/home/flourish' ); ?>

<?php get_footer(); ?>
