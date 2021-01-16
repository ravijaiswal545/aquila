<?php
/*
*Template Name: Custom Form
*/
ob_start();
get_header();
$user_id = get_current_user_id();
$existing_hobby = ( get_user_meta( $user_id, 'user-hobby', true ) ) ? get_user_meta( $user_id, 'user-hobby', true ) : '';
$existing_age = ( get_user_meta( $user_id, 'user-age', true ) ) ? get_user_meta( $user_id, 'user-age', true ) : '';

?>
<form action="" method="post" enctype="multipart/form-data">
	<label for="user-hobby">Hobby
		<input id="user-hobby" type="text" name="user-hobby" value="<?php echo $existing_hobby; ?>">
	</label>
	<label for="user-age">Age
		<input id="user-age" type="number" name="user-age" value="<?php echo $existing_age; ?>">
	</label>
		
	<input type="submit" name="submit" value="Submit">
</form>
 
<?php
print_r($_POST);
if( ! function_exists('wf_insert_update_user_meta')){
    function wf_insert_update_user_meta( $user_id, $meta_key, $meta_value ){
        $meta_key_not_exist = add_user_meta( $user_id, $meta_key, $meta_value, true );

        if( ! $meta_key_not_exist ){
            update_user_meta( $user_id, $meta_key, $meta_value );
            return true;
        }

    }
}
if( isset($_POST['submit']) ){
    $hobby = ( ! empty( $_POST['user-hobby'] ) ) ? sanitize_text_field( $_POST['user-hobby'] ) : '';
    $age = ( ! empty( $_POST['user-age'] ) ) ? intval( absint($_POST['user-age']) ) : '';

    wf_insert_update_user_meta( $user_id, 'user-hobby', $hobby );
    wf_insert_update_user_meta( $user_id, 'user-age', $age );

    $location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	wp_safe_redirect( $location );
}
get_footer();
