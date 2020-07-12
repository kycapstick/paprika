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

            case 'paprika/mason-three-up':
                $block_content = paprika_render_mason_three_up($block);
            break;

            case 'paprika/mason-even-split':
                $block_content = paprika_render_mason_even_split($block);
            break;

            case 'paprika/news':
                $block_content = paprika_render_news($block);
            break;

            case 'paprika/homepage-cards': 
                $block_content = paprika_render_homepage_cards($block);
            break;

            case 'paprika/two-up-cards':
                $block_content = paprika_render_two_up_cards($block);
            break;

            case 'paprika/artist':
                $block_content = paprika_render_artist_block($block);
            break;

            case 'paprika/donors':
                $block_content = paprika_render_donors_block($block);
            break;

            case 'paprika/donor-fw':
                $block_content = paprika_render_donor_fw($block);
            break;

            case 'paprika/media-quote':
                $block_content = paprika_render_media_quote($block);
            break;

            case 'paprika/alumni':
                $block_content = paprika_render_alumni_block($block);
            break;
            
            case 'paprika/show':
                $block_content = paprika_render_show_block($block);
            break;

            case 'paprika/image-text':
                $block_content = paprika_render_image_text_block($block);
            break;

            case 'paprika/location':
                $block_content = paprika_render_location($block);
            break;

            case 'paprika/two-up-columns':
                $block_content = paprika_render_two_up_columns($block);
            break;

            case 'paprika/contact-form':
                $block_content = paprika_render_contact_form($block);
            break;
            
            case 'paprika/schedule':
                $block_content = paprika_render_schedule($block);
            break;

            default: 
                $block_content = paprika_render_content($block);
            break;

        }
        return $block_content;
    }
}

add_filter( 'render_block', 'paprika_server_side_block_render', 10, 2 );