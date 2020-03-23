<?php
/*
* Plugin Name: Multi Picture Profile
* Plugin URI: https://github.com/edmargomes/multi-picture-profile-wp
* Description: Add multiupload field to Picture Profile on your user profile page.
* Author: Edmar Gomes
* Version: 0.1
* Requires at least: 5.2
* Author URI: https://github.com/edmargomes
* Text Domain: multi-picture-profile
* License: GPL2
*/

/**
 * Add profile field to upload images to profile.
 * @param $user
 */
function eg_add_photo_profile_field($user) {
	?>
	<table class="form-table">
		<tbody>
		<tr>
			<th>
				<label for="eg-upload-images"><?php _e('Profile Photos', 'multi-picture-profile'); ?></label>
			</th>
			<td>
				<div class="wp-media-buttons">
					<button class="button" id="eg-upload-images"><?php _e('Add', 'multi-picture-profile'); ?></button>
					<button class="button"><?php _e('Remove', 'multi-picture-profile'); ?></button>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'show_user_profile', 'eg_add_photo_profile_field' );
add_action( 'edit_user_profile', 'eg_add_photo_profile_field' );