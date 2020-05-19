<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package pg-wp-starter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pg_wp_starter_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pg_wp_starter_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pg_wp_starter_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'pg_wp_starter_pingback_header' );

// Used for resetting Admin Columns
if (!function_exists('pg_reset_date_column')) {

	function pg_reset_date_column($columns) {

		// Date will end up as 2nd item, remove it and push it to the end
		$date = $columns['date'];
		unset($columns['date']);
		$columns['date'] = $date;

		return $columns;
	}

}
