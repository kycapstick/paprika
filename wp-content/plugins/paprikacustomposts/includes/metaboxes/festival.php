<?php 
	if(!function_exists('paprika_festival_meta_cb')):
		function paprika_festival_meta_cb($post) {
			wp_nonce_field( basename( __FILE__ ), 'festival_post_nonce' );
			$meta_tickets = get_post_meta($post->ID, 'tickets', true);
			$value_nonce = wp_create_nonce("update_value_nonce");
    ?>
		<p class="custom-title">Details</p>
		<label for="location">Ticket Link</label>

		<input type="text" class="custom-input" name="tickets" id="tickets" value="<?php echo isset($meta_tickets) && strlen($meta_tickets) > 0 ? $meta_tickets : null ?>">
    <?php
		echo paprika_render_dates_select($post);
    }
	endif;

	if (!function_exists('paprika_festival_metabox')):
		function paprika_festival_metabox() {
		add_meta_box('festival-meta-box', esc_html__('Festival Details'), 'paprika_festival_meta_cb', 'festival', 'normal', 'low');
	}
	endif;

	if (!function_exists('paprika_save_festival_meta')):
		function paprika_save_festival_meta($post_id, $post) {
		if(!isset($_POST['festival_post_nonce']) || !wp_verify_nonce($_POST['festival_post_nonce'], basename(__FILE__))):
			return $post_id;
		endif;
		$fields = array(
			'tickets' => '',
			'dateCount' => 0,
		);
		$fields = paprika_sanitize_fields($fields, $_POST);
		foreach($fields as $key=>$field):
			if (strlen($field) > 0):
				paprika_update_meta_fields($key, $field, $post_id);
			endif;
		endforeach;
		if (isset($_POST['dates'])):
			$dates = paprika_update_dates_with_count($_POST['dates'], $_POST['dateCount']);
			$dates = array_unique($dates);
			update_post_meta($post_id, 'dates', $dates);
		endif;
    }
endif;