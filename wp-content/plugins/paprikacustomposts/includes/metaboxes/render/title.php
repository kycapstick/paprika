<?php
	if (!function_exists('paprika_render_subtitle_input')):
		function paprika_render_order_input($post) {
            $subtitleObject = get_post_meta($post->ID, 'title', true);
			$value_nonce = wp_create_nonce("update_value_nonce");
			ob_start();
		?>
			<label class="custom-label" for="order">Subtitle</label>
			<input  class="custom-input" type="text" name="subtitle_title" value="<?php echo ($subtitleObject->subtitle ?? '') ?>" id="subtitle">
            <label class="custom-label" for="order">Link</label>
			<input  class="custom-input" type="url" name="subtitle_link" value="<?php echo ($subtitleObject->link ?? '') ?>" id="subtitle_link">
            <label class="custom-label" for="order">Link Text</label>
			<input  class="custom-input" type="text" name="subtitle_text" value="<?php echo ($subtitleObject->text ?? '') ?>" id="subtitle_text">
			<button id="update-order" data-selector="order" data-nonce="<?php echo $value_nonce ?>" data-id="<?php echo $post->ID ?>">Update Order</button>
		<?php
			return ob_get_clean();
		}
	endif;