<?php
	if (!function_exists('paprika_render_order_input')):
		function paprika_render_order_input($post) {
			$order = get_post_meta($post->ID, 'order', true);
			$value_nonce = wp_create_nonce("update_value_nonce");
			ob_start();
		?>
			<label class="custom-label" for="order">Order</label>
			<input  class="custom-input" type="number" name="order" value="<?php echo ($order ? $order :'') ?>" id="order">
			<button id="update-order" data-selector="order" data-nonce="<?php echo $value_nonce ?>" data-id="<?php echo $post->ID ?>">Update Order</button>
		<?php
			return ob_get_clean();
		}
	endif;