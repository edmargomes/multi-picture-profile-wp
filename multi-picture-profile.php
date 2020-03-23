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

	$hooks = ['user-new.php', 'user-edit.php', 'profile.php'];
	if( in_array($hook,$hooks )) {
		$translates = [
		        'Remove' => __('Remove', 'multi-picture-profile')
        ];
		wp_enqueue_media();
		wp_enqueue_style('multi-picture-style', plugins_url('css/style.css', __FILE__), array(), null);
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
	$attachment_ids = get_user_meta( (int)$user->ID, 'eg_pictures_ids', true );
	?>
	<table class="form-table">
		<tbody>
		<tr>
			<th>
				<label for="eg-upload-images"><?php _e('Profile Photos', 'multi-picture-profile'); ?></label>
			</th>
			<td>
                <div class="eg-images">
                    <?php
                    if ($attachment_ids > 0) {
                    foreach ($attachment_ids as $id => $attachment_id) { ?>
	                    <div class="picture-container-profile">
                            <input type="hidden" name="eg_pictures_ids[]" value="<?= $id ?>"/>
                            <?= wp_get_attachment_image($id) ?>
                            <button class="button"><?= _e('Remove', 'multi-picture-profile')?></button>
                        </div>
                    <?php } }?>
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

/**
 * Save profile pictures.
 * @param $user_id
 * @return bool
 */
function eg_user_profile($user_id) {
	if( !current_user_can('edit_user', (int)$user_id) ) return false;

	delete_user_meta( (int)$user_id, 'eg_pictures_ids') ; //delete meta

	if( //validate POST data
		isset($_POST['eg_pictures_ids'])
		&& $_POST['eg_pictures_ids'] > 0
	) {
	    $picture_ids = [];
		foreach ( $_POST['eg_pictures_ids'] as $eg_pictures_id ) {
			$picture_ids[$eg_pictures_id] = 1;
	    }
		add_user_meta( (int)$user_id, 'eg_pictures_ids', $picture_ids); //add user meta
	} else {
		return false;
	}

	return true;
}
add_action( 'personal_options_update', 'eg_user_profile' );
add_action( 'edit_user_profile_update', 'eg_user_profile' );