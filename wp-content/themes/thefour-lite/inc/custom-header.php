<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
<?php if ( get_header_image() ) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
</a>
<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package TheFour
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses thefour_header_style()
 */
function thefour_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'thefour_custom_header_args', array(
		'default-text-color' => 'fff',
		'width'              => 1920,
		'height'             => 540,
		'flex-width'         => true,
		'flex-height'        => true,
		'default-image'      => get_template_directory_uri() . '/img/header.jpg',
		'wp-head-callback'   => 'thefour_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'thefour_custom_header_setup' );

if ( ! function_exists( 'thefour_header_style' ) ) :
	/**
	 * Styles the header text displayed on the site.
	 */
	function thefour_header_style() {
		// If the header text option is untouched, let's bail.
		if ( display_header_text() ) {
			return;
		}

		// If the header text has been hidden.
		?>
		<style id="thefour-header-css">
		.site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
		</style>
		<?php
	}
endif;
