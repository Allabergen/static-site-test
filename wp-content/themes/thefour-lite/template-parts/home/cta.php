<?php
/**
 * The template part that shows call to action text and button on the front page.
 *
 * @package TheFour
 */

if ( ! ( $cta = get_theme_mod( 'front_page_cta' ) ) ) {
	return;
}
?>
<section class="section call-to-action">
	<?php echo wp_kses_post( do_shortcode( $cta ) ); ?>
</section>
