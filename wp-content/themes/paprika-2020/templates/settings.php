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
					<label for="mailchimp">Mailchimp List ID</label>
				</th>
				<td>
					<input type="text" id="mailchimp_list" name="mailchimp_list" class="regular-text" value="<?php echo isset($options['mailchimp_list']) ? esc_attr( $options['mailchimp_list'] ) : null; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="mailchimp">Contact Form Email Address</label>
				</th>
				<td>
					<input type="text" id="contact_email" name="contact_email" class="regular-text" value="<?php echo isset($options['contact_email']) ? esc_attr( $options['contact_email'] ) : null; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="donations">Donation Link</label>
				</th>
				<td>
					<input type="text" id="donations" name="donations" class="regular-text" value="<?php echo isset($options['donations']) ? esc_attr( $options['donations'] ) : null; ?>" />
					<p class="copy--italic">Requires full url.</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="about-color">About Color</label>
				</th>
				<td>
					<input type="color" id="about-color" name="about-color" class="regular-text" value="<?php echo isset($custom_colors['about']) ? esc_attr( $custom_colors['about'] ) : '#a74482'; ?>"/>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="festivals-color">Festivals Color</label>
				</th>
				<td>
					<input type="color" id="festivals-color" name="festivals-color" class="regular-text" value="<?php echo isset($custom_colors['festivals']) ? esc_attr( $custom_colors['festivals'] ) : '#e6007a'; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="support-color">Support Color</label>
				</th>
				<td>
					<input type="color" id="support-color" name="support-color" class="regular-text" value="<?php echo isset($custom_colors['support']) ? esc_attr( $custom_colors['support'] ) : '#177e72'; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="press-color">Press Color</label>
				</th>
				<td>
					<input type="color" id="press-color" name="press-color" class="regular-text" value="<?php echo isset($custom_colors['press']) ? esc_attr( $custom_colors['press'] ) : '#0c628b'; ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="land-acknowledgement">Land Acknowledgement</label>
				</th>
				<td>
					<textarea name="land_acknowledgement" id="land_acknowledgement" cols="30" rows="10" style="width: 80%; resize: none;"><?php echo isset($options['land_acknowledgement']) ? esc_attr( $options['land_acknowledgement'] ) : null; ?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="submit" value="Save Settings" />
</form>