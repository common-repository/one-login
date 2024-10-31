<?php
function WP_One_Login($auth) {
 global $wpdb;
 global $social;
 
 $info = $social->get_user($auth); // Get user data from our DataBase;
 $user_email=$info["email"];
 $user_name=$info["username"];
 
if ($user_name and $user_email) {
	$user_id = username_exists( $user_name );
	if ( !$user_id and email_exists($user_email) == false ) {
	$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
	$user_id = wp_create_user( $user_name, $random_password, $user_email );
	 auto_login( $user_id, $user_name );} 
	 else 	$random_password = __('User already exists.  Password inherited.');
 }
 if ($user_id) auto_login( $user_id, $user_name );
}
function auto_login( $user_id, $user ) {
	wp_set_current_user( $user_id, $user );
	wp_set_auth_cookie( $user_id );
	do_action( 'wp_login', $user_login );
}

?>