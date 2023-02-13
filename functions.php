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

// Prevent payment processing from moving to pending
function custom_woocommerce_valid_order_statuses_for_payment_complete( $array, $instance ){ 
	//custom code here
	 return array('on-hold');
} 
add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', 'custom_woocommerce_valid_order_statuses_for_payment_complete', 10, 2 ); 


// New order notification only for "Pending" Order status
add_action( 'woocommerce_checkout_order_processed', 'pending_new_order_notification', 20, 1 );
function pending_new_order_notification( $order_id ) {
    // Get an instance of the WC_Order object
    $order = wc_get_order( $order_id );

		$customer_email_address = $order->get_billing_email();

    // Only for "pending" order status
    if( ! $order->has_status( 'pending' ) ) return;

    // Get an instance of the WC_Email_New_Order object
    $wc_email = WC()->mailer()->get_emails()['WC_Email_New_Order'];

    ## -- Customizing Heading, subject (and optionally add recipients)  -- ##
    // Change Subject
    $wc_email->settings['subject'] = __('{site_title} - New Pending Order ({order_number}) - {order_date}');

    // Change Heading
    $wc_email->settings['heading'] = __('New Pending Order'); 
    // $wc_email->settings['recipient'] .= ',name@email.com'; // Add email recipients (coma separated)

    // Send "New Email" notification (to admin)
    $wc_email->trigger( $order_id );

		$customer_email = WC()->mailer()->get_emails()['WC_Email_Customer_On_Hold_Order'];

		$customer_email->trigger( $order_id );
}