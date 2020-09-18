<?php
add_action('show_user_profile', 'modernwpthemes_extra_profile');
add_action('edit_user_profile', 'modernwpthemes_extra_profile');
add_action('personal_options_update', 'modernwpthemes_save_extra_profile');
add_action('edit_user_profile_update', 'modernwpthemes_save_extra_profile');

function modernwpthemes_save_extra_profile($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
	update_user_meta($userID, 'linkedin', $_POST['linkedin']);
}

function modernwpthemes_extra_profile($user)
{
?>
	<h3>Social Information</h3>

	<table class='form-table'>
		<tr>
			<th><label for="twitter">Twitter</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text" />
				<br />
				<span class='description'>Please enter your Twitter username. http://www.twitter.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook">Facebook</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>" class="regular-text" />
				<br />
				<span class='description'>Please enter your Facebook username. http://www.facebook.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin">LinkedIn</label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr(get_the_author_meta('linkedin', $user->ID)); ?>" class="regular-text" />
				<br />
				<span class='description'>Please enter your LinkedIn username. http://www.linkedin.com/in/<strong>username</strong></span>
			</td>
		</tr>
	</table>
<?php } ?>