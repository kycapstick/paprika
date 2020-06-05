<?php 

require get_template_directory() . '/includes/setup.php';
require get_template_directory() . '/includes/theme-scripts.php';
require get_template_directory() . '/includes/gutenberg.php';
require get_template_directory() . '/includes/utilities.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/includes/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/includes/jetpack.php';
}


	function paprika_head_metadata() {

?>

	<meta name="google" content="notranslate" />

	<?php

}
add_action( 'wp_head', 'paprika_head_metadata' );

require get_template_directory() . '/includes/gutenberg/render-cta.php';
require get_template_directory() . '/includes/gutenberg/render-image-block.php';
require get_template_directory() . '/includes/gutenberg/render-mason-block.php';
require get_template_directory() . '/includes/gutenberg/render-blocks.php';

