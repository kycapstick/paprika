<?php
/**
 * Theme setting form
 *
 * Theme settings
 *
 * @package WordPress
 * @subpackage community-portal
 * @version 1.0.0
 * @author  Playground Inc.
 */

?>
<h1>Paprika Theme Settings</h1>
<form method="POST" action="/wp-admin/admin.php?page=theme-panel">
	<?php wp_nonce_field( 'admin_nonce', 'admin_nonce_field' ); ?>
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
		</tbody>
	</table>
	<input type="submit" value="Save Settings" />
</form>