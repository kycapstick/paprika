<?php 

function paprika_custom_block_categories( $categories, $post ) {
	return array_merge(
		array(
			array(
				'slug' => 'image-blocks',
				'title' => __( 'Image Blocks' ),
			),
			array(
				'slug' => 'post-blocks',
				'title' => __( 'Post Blocks' ),
			),
			array(
				'slug' => 'festivals-blocks',
				'title' => __( 'Festivals Blocks' ),
			),
			array(
				'slug' => 'about-blocks',
				'title' => __( 'About Blocks' ),
			),
			array(
				'slug' => 'support-blocks',
				'title' => __( 'Support Blocks' ),
			),
			array(
				'slug' => 'press-blocks',
				'title' => __( 'Press Blocks' ),
			),
		),
		$categories	
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
		'core/column',
		
		// Component Blocks
		'paprika/card-title-copy',
		'paprika/card-title',
		'paprika/donor-title',
		'paprika/fine-print',
		'paprika/artist-select',
		'paprika/location-select',
		'paprika/news-select',
		'paprika/media-title-copy',
		'paprika/alumnus',
		'paprika/column',

		// Layout Blocks
		'paprika/cta',

		'paprika/homepage-cards',
		'paprika/two-up-cards',
		'paprika/alumni',
		'paprika/two-up-columns',

		'paprika/fw-image',
		'paprika/mason-even-split',
		'paprika/mason-three-up',
		'paprika/mason-image',
		'paprika/reverse-mason-image',
		'paprika/media-quote',
		'paprika/image-text',
		
		// Donor Blocks
		'paprika/donor-fw',
		'paprika/donors',
		'paprika/donor-two-up', 

		// Post Blocks
		'paprika/artist',
		'paprika/artist-reverse',
		'paprika/news',
		'paprika/location',

		// Show Blocks
		'paprika/show',
		'paprika/team-member',

		// Form Blocks
		'paprika/contact-form',
		'paprika/schedule',
		'paprika/participants'
	);

}