<?php

// Change wp-login link
// add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
// function my_theme_enqueue_styles() {
// wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
// }

// add_filter( 'logout_url', 'custom_logout_url' );
// function custom_logout_url( $default )
// {
// return str_replace( 'wp-login', 'login', $default );
// }
// add_filter( 'login_url', 'custom_login_url' );
// function custom_login_url( $default )
// {
// return str_replace( 'wp-login', 'login', $default );
// }



// New order notification only for "Pending" Order status
// add_action( 'woocommerce_checkout_order_processed', 'pending_new_order_notification', 20, 1 );
// function pending_new_order_notification( $order_id ) {
//     // Get an instance of the WC_Order object
//     $order = wc_get_order( $order_id );

// 		$customer_email_address = $order->get_billing_email();

//     // Only for "pending" order status
//     if( ! $order->has_status( 'pending' ) ) return;

//     // Get an instance of the WC_Email_New_Order object
//     $wc_email = WC()->mailer()->get_emails()['WC_Email_New_Order'];

//     ## -- Customizing Heading, subject (and optionally add recipients)  -- ##
//     // Change Subject
//     $wc_email->settings['subject'] = __('{site_title} - New Pending Order ({order_number}) - {order_date}');

//     // Change Heading
//     $wc_email->settings['heading'] = __('New Pending Order'); 
//     // $wc_email->settings['recipient'] .= ',name@email.com'; // Add email recipients (coma separated)

//     // Send "New Email" notification (to admin)
//     $wc_email->trigger( $order_id );

// 		$customer_email = WC()->mailer()->get_emails()['WC_Email_Customer_On_Hold_Order'];

// 		$customer_email->trigger( $order_id );
// }

// function my_cors_domains( $allowed_origins ) {
// 	global $FRONTEND_BASE_URL;
// 	$your_origins = array(
// 		$FRONTEND_BASE_URL,
// 		'https://api.eiramknitwear.com',
// 		'https://eiramknitwear.com',
// 	  'https://local.eiramknitwear.com'
// 	);

//   return array_unique(array_merge( $allowed_origins, $your_origins));
// }

// add_filter( 'allowed_http_origins' , 'my_cors_domains' , 10 , 1 );


// New order notification only for "Pending" Order status
// add_action( 'woocommerce_checkout_order_processed', 'pending_new_order_notification', 20, 1 );
// function pending_new_order_notification( $order_id ) {
//     // Get an instance of the WC_Order object
//     $order = wc_get_order( $order_id );

// 		$customer_email_address = $order->get_billing_email();

//     // Only for "pending" order status
//     if( ! $order->has_status( 'pending' ) ) return;

//     // Get an instance of the WC_Email_New_Order object
//     $wc_email = WC()->mailer()->get_emails()['WC_Email_New_Order'];

//     ## -- Customizing Heading, subject (and optionally add recipients)  -- ##
//     // Change Subject
//     $wc_email->settings['subject'] = __('{site_title} - New Pending Order ({order_number}) - {order_date}');

//     // Change Heading
//     $wc_email->settings['heading'] = __('New Pending Order'); 
//     // $wc_email->settings['recipient'] .= ',name@email.com'; // Add email recipients (coma separated)

//     // Send "New Email" notification (to admin)
//     $wc_email->trigger( $order_id );

// 		$customer_email = WC()->mailer()->get_emails()['WC_Email_Customer_On_Hold_Order'];

// 		$customer_email->trigger( $order_id );
// }


// Prevent payment processing from moving to pending
// function custom_woocommerce_valid_order_statuses_for_payment_complete( $array, $instance ){ 
// 	//custom code here
// 	 return array('on-hold');
// } 
// add_filter( 'woocommerce_valid_order_statuses_for_payment_complete', 'custom_woocommerce_valid_order_statuses_for_payment_complete', 10, 2 ); 
