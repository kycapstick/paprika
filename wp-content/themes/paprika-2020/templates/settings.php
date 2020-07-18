<h1>Paprika Theme Settings</h1>
<form method="POST" action="/wp-admin/admin.php?page=theme-panel">
	<?php wp_nonce_field( 'admin_nonce', 'admin_nonce_field' ); ?>
	<?php $custom_colors = get_option('custom_colors', array()); ?>
	<table class="form-table" role="presentation">
		<tbody>
			<tr>
				<th scope="row">
					<label for="mailchimp">Mailchimp API Key</label>
				</th>
				<td>
					<input type="text" id="mailchimp" name="mailchimp" class="regular-text" value="<?php echo isset($options['mailchimp']) ? esc_attr( $options['mailchimp'] ) : null; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="about-color">About Color</label>
				</th>
				<td>
					<input type="color" id="about-color" name="about-color" class="regular-text" value="<?php echo isset($custom_colors['about']) ? esc_attr( $custom_colors['about'] ) : null; ?>"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="festivals-color">Festivals Color</label>
				</th>
				<td>
					<input type="color" id="festivals-color" name="festivals-color" class="regular-text" value="<?php echo isset($custom_colors['festivals']) ? esc_attr( $custom_colors['festivals'] ) : null; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="support-color">Support Color</label>
				</th>
				<td>
					<input type="color" id="support-color" name="support-color" class="regular-text" value="<?php echo isset($custom_colors['support']) ? esc_attr( $custom_colors['support'] ) : null; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="press-color">Press Color</label>
				</th>
				<td>
					<input type="color" id="press-color" name="press-color" class="regular-text" value="<?php echo isset($custom_colors['press']) ? esc_attr( $custom_colors['press'] ) : null; ?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<input type="submit" value="Save Settings" />
</form>