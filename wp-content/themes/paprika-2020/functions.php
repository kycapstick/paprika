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
add_action( 'wp_head', 'paprika_custom_css' );

add_action( 'admin_menu', 'paprika_add_menu_item' );

// Block Utilities
require get_template_directory() . '/includes/gutenberg/customizations.php';
require get_template_directory() . '/includes/gutenberg/render-blocks.php';
require get_template_directory() . '/includes/gutenberg/render-content.php';

require get_template_directory() . '/includes/gutenberg/render-column.php';

// Layout Blocks
require get_template_directory() . '/includes/gutenberg/render-cta.php';

require get_template_directory() . '/includes/gutenberg/render-homepage-cards.php';
require get_template_directory() . '/includes/gutenberg/render-two-up-cards.php';
require get_template_directory() . '/includes/gutenberg/render-media-quote-block.php';
require get_template_directory() . '/includes/gutenberg/render-alumni-block.php';
require get_template_directory() . '/includes/gutenberg/render-alumnus-block.php';
require get_template_directory() . '/includes/gutenberg/render-image-text-block.php';
require get_template_directory() . '/includes/gutenberg/render-two-columns.php';

require get_template_directory() . '/includes/gutenberg/render-image-block.php';
require get_template_directory() . '/includes/gutenberg/render-mason-block.php';
require get_template_directory() . '/includes/gutenberg/render-mason-three-up.php';
require get_template_directory() . '/includes/gutenberg/render-mason-even-split.php';
require get_template_directory() . '/includes/gutenberg/render-mason-reverse-block.php';

// Post Blocks
require get_template_directory() . '/includes/gutenberg/render-news.php';
require get_template_directory() . '/includes/gutenberg/render-location.php';
require get_template_directory() . '/includes/gutenberg/render-artist-block.php';

// Donor Blocks
require get_template_directory() . '/includes/gutenberg/render-donors.php';
require get_template_directory() . '/includes/gutenberg/render-donor-two-up.php';
require get_template_directory() . '/includes/gutenberg/render-donor-fw.php';

// Show Blocks
require get_template_directory() . '/includes/gutenberg/render-show-block.php';

// Form Blocks
require get_template_directory() . '/includes/gutenberg/render-contact-form.php';
require get_template_directory() . '/includes/gutenberg/render-schedule.php';
require get_template_directory() . '/includes/gutenberg/render-participants.php';

