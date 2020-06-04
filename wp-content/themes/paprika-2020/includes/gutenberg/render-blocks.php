<?php

if ( ! function_exists( 'paprika_server_side_block_render') ) {
    function paprika_server_side_block_render($block_content, $block) {
        switch( $block['blockName'] ) {

            case 'paprika/cta':
                $block_content = paprika_render_cta($block);
            break;

            case 'paprika/image-container':
                $block_content = paprika_render_image_block($block);
            break;

        }
        return $block_content;
    }
}

add_filter( 'render_block', 'paprika_server_side_block_render', 10, 2 );