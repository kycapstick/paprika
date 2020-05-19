<?php

function paprika_blocks() {
    wp_enqueue_script('footer-banner', get_template_directory_uri() . '/dist/gutenberg.js', array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'));
}

add_action('enqueue_block_editor_assets', 'paprika_blocks', 10, 1);
