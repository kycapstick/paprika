<?php

function paprika_blocks() {
    wp_enqueue_script('footer-banner', get_template_directory_uri() . '/dist/gutenberg.js', array('wp-blocks', 'wp-element', 'wp-data', 'wp-editor', 'wp-i18n', 'wp-compose', 'wp-api-fetch'));
}

add_action('enqueue_block_editor_assets', 'paprika_blocks', 10, 1);
