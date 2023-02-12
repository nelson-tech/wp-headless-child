<?php

$FRONTEND_BASE_URL = defined('FRONTEND_BASE_URL') && !empty(FRONTEND_BASE_URL) ? FRONTEND_BASE_URL : null;
global $FRONTEND_BASE_URL;



// Disable jetpack warning
add_filter('jetpack_just_in_time_msgs', '__return_false');

//
// WP-GraphQL
//

// Customize password reset email

add_filter('retrieve_password_message', function ($message, $key, $user_login, $user_data) {
	global $FRONTEND_BASE_URL;
	$site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	$message   = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
	/* translators: %s: Site name. */
	$message .= sprintf(__('Site Name: %s', ''), $site_name) . "\r\n\r\n";
	/* translators: %s: User login. */
	$message .= sprintf(__('Username: %s', ''), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
	$message .= $FRONTEND_BASE_URL . '/reset-password?email=' . rawurlencode($user_data->get('user_email')) . "&key=$key\r\n\r\n";
	$requester_ip = $_SERVER['REMOTE_ADDR'];
	if ($requester_ip) {
		$message .= sprintf(
			/* translators: %s: IP address of password reset requester. */
			__('This password reset request originated from the IP address %s.'),
			$requester_ip
		) . "\r\n";
	}
	return $message;
}, 10, 4);
