<?php 
    if (!function_exists('paprika_page_metabox')):
        function paprika_page_metabox() {
            add_meta_box('paprika-page-box', esc_html__('Subtitle Customization'), 'paprika_page_meta_cb', 'page', 'normal', 'high', null);
        }
    endif;

    if (!function_exists('paprika_page_meta_cb')):
        function paprika_page_meta_cb($post) {
            $postMeta = get_post_meta($post->ID);
            $subtitleObject = get_post_meta($post->ID, 'subtitle', true);
            $nonce = wp_create_nonce("update_value_nonce");
    ?>
        <div>
            <label for="artist_title">Subtitle</label>
            <input class="custom-input" type="text" name="subtitle" id="subtitle" value="<?php echo isset($subtitleObject['subtitle']) ? $subtitleObject['subtitle'] : ''; ?>">
            <label for="artist_title">Link Text</label>
            <input class="custom-input" type="text" name="subtitle_text" id="subtitle_text" value="<?php echo isset($subtitleObject['subtitle_text']) ? $subtitleObject['subtitle_text'] : ''; ?>">
            <label for="artist_title">Link</label>
            <input class="custom-input" type="url" name="subtitle_link" id="subtitle_link" value="<?php echo isset($subtitleObject['subtitle_link']) ? $subtitleObject['subtitle_link'] : ''; ?>">
        </div>
        <?php
    }
endif;

if (!function_exists('paprika_save_page_meta')):
    function paprika_save_page_meta($post_id, $post) {
        $fields = array(
            'subtitle' => '',
            'subtitle_text' => '',
            'subtitle_link' => '',
        );
        $fields = paprika_sanitize_fields($fields, $_POST);
        $subtitle = array();
        foreach($fields as $key=>$field):
            $subtitle[$key] = $field;
        endforeach;
        update_post_meta($post_id, 'subtitle', $subtitle);
    }
endif;

add_action( 'add_meta_boxes', 'paprika_page_metabox' );