<?php 

function paprika_custom_block_categories( $categories, $post ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' => 'donor-blocks',
				'title' => __( 'Donor Blocks' ),
			),
			array(
				'slug' => 'post-blocks',
				'title' => __( 'Post Blocks' ),
			),
		),
	);
}
add_filter( 'block_categories', 'paprika_custom_block_categories', 10, 2);

add_filter( 'allowed_block_types', 'paprika_allowed_block_types' );

function paprika_allowed_block_types( $allowed_blocks ) {

	return array(
		// Core Blocks
		'core/image',
		'core/paragraph',
		'core/heading',
		'core/list',
		'core/quote',
		'core/video',
		'core/button',
		
		// Component Blocks
		'paprika/card-title-copy',
		'paprika/card-title',
		'paprika/donor-title',
		'paprika/fine-print',
		'paprika/artist-select',
		'paprika/news-select',

		// Layout Blocks
		'paprika/cta',

		'paprika/homepage-cards',
		'paprika/two-up-cards',

		'paprika/fw-image',
		'paprika/mason-even-split',
		'paprika/mason-three-up',
		'paprika/mason-image',
		'paprika/reverse-mason-image',
		
		// Donor Blocks
		'paprika/donor-fw',
		'paprika/donor-two-up', 

		// Post Blocks
		'paprika/artist',
		'paprika/news',
	);

}