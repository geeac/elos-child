<?php
 
/* Call CSS stylesheet for custom login page */

function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
return 'IDS Real Estate Group';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/* Hide the Login Error Message */

function login_error_override() {
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

/* Remove the Login Page Shake */

function my_login_head() {
	remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

/* Set “Remember Me” To Checked */

function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

?>