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

function eg_head_scripts($hook) {
	$hooks = ['user-new.php', 'user-edit.php'];
	if( in_array($hook,$hooks )) {
		$translates = [
		        'Remove' => __('Remove', 'multi-picture-profile')
        ];
		wp_enqueue_media();
		wp_enqueue_script( 'multi-picture', plugins_url( 'js/scripts.js', __FILE__ ), array( 'jquery' ), '0.1', true );
		wp_localize_script( 'multi-picture', 'Translates', $translates );
	}
}
add_action( 'admin_enqueue_scripts', 'eg_head_scripts' );

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
                <div class="eg-images">
                </div>
				<div class="wp-media-buttons">
					<button class="button eg-upload" id="eg-upload-images"><?php _e('Add', 'multi-picture-profile'); ?></button>
				</div>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'show_user_profile', 'eg_add_photo_profile_field' );
add_action( 'edit_user_profile', 'eg_add_photo_profile_field' );
add_action( 'user_new_form', 'eg_add_photo_profile_field' );