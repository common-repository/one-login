<?php
/* 
Plugin Name: One Login Social Connector
Plugin URI: http://one-login.info/ 
Version: 1.4
Author: One-Login.info
Description: Add Social Box Login to your blog!
*/  
$plugin_dir = plugin_dir_path( __FILE__ );
require(ABSPATH.WPINC.'/pluggable.php');

define('API_KEY',get_option('one_login_api_key'));
define('API_DOMAIN', get_option('one_login_api_domain'));
define('PLUGIN_DIR',$plugin_dir);

require(PLUGIN_DIR . 'one-login/one-login.php');
require(PLUGIN_DIR . 'widget.php');
require(PLUGIN_DIR . 'auth.php');
require(PLUGIN_DIR . 'settings.php');

$social = new social (API_KEY,API_DOMAIN ); 
isset($_GET["auth"]) ? WP_One_Login($_GET["auth"]) : false; 

add_action('widgets_init', 'register_One_Login_Btt');
add_action('admin_menu', 'One_Login_Settings');
add_action('admin_init', 'register_mysettings');



?>