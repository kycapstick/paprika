<?php

if ( ! function_exists( 'paprika_server_side_block_render') ) {
    function paprika_server_side_block_render($block_content, $block) {
        switch( $block['blockName'] ) {

            case 'paprika/cta':
                $block_content = paprika_render_cta($block);
            break;

            case 'paprika/fw-image':
                $block_content = paprika_render_fw_image($block);
            break;

            case 'paprika/mason-image':
                $block_content = paprika_render_mason($block);
            break;

            case 'paprika/reverse-mason-image':
                $block_content = paprika_render_mason_reverse($block);
            break;

            case 'paprika/news':
                $block_content = paprika_render_news($block);
            break;

        }
        return $block_content;
    }
}

add_filter( 'render_block', 'paprika_server_side_block_render', 10, 2 );