/* 
# Create custom field "Phone" and show it on Create/Edit/Update user profile screens.
@ Codex ref- https://developer.wordpress.org/reference/hooks/user_new_form/
@ Codex ref- https://developer.wordpress.org/reference/hooks/show_user_profile/
@ Codex ref- https://developer.wordpress.org/reference/hooks/edit_user_profile/
*/

function extra_user_phone_profile_fields( $user ) {
?>
  <h3><?php _e("Extra profile information", "text-domain"); ?></h3>
  <table class="form-table">
    <tr>
      <th><label for="phone"><?php _e("Phone"); ?></label></th>
      <td>
        <input type="text" name="phone" id="phone" class="regular-text" 
            value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" /><br />
        <span class="description"><?php _e("Please enter your phone number"); ?></span>
    </td>
    </tr>
  </table>
<?php
}
add_action( 'user_new_form', 'extra_user_phone_profile_fields' ); // during creating a new user - https://prnt.sc/247yq8p
add_action( 'show_user_profile', 'extra_user_phone_profile_fields' ); // editing your own profile - https://prnt.sc/247z0bp
add_action( 'edit_user_profile', 'extra_user_phone_profile_fields' ); // editing another user - https://prnt.sc/247z4qv

/*
# Save the custom field in database. 
@ Codex ref- https://developer.wordpress.org/reference/hooks/user_register/
@ Codex ref- https://developer.wordpress.org/reference/hooks/personal_options_update/
@ Codex ref- https://developer.wordpress.org/reference/hooks/edit_user_profile_update/
*/

function save_extra_user_phone_profile_fields( $user_id ) {
  $saved = false;
  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
    $saved = true;
  }
  return true;
}
add_action('user_register', 'save_extra_user_phone_profile_fields'); // during creating a new user
add_action( 'personal_options_update', 'save_extra_user_phone_profile_fields' ); // editing your own profile
add_action( 'edit_user_profile_update', 'save_extra_user_phone_profile_fields' ); // editing another user
