<?php
/**
 * Customer completed order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-completed-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php
$shipping_method = @array_shift($order->get_shipping_methods());
$shipping_method_id = $shipping_method['method_id'];

if (strpos($shipping_method_id, 'local_pickup') !== false) : ?>
	<p><?php printf( __( "Recently, you have picked up your order from us. We hope everything is satisfied! If you have any questions or concerns, please feel free to contact us. Below you will find the further specifications of your order and, if you participate in our savings program, you will also find an overview of your current savings point balance.", 'anansi-tomte' ), get_option( 'blogname' ) ); ?></p>
<?php else : ?>
	<p><?php printf( __( "We have packed your order and are about to send it to you! After we have offered the package at PostNL, you will receive a Track & Trace link by mail so you can track the shipment properly. Further details of your order and shipping address can be found below. If you participate in our savings program, you will also find an overview of your current savings point balance.", 'anansi-tomte' ), get_option( 'blogname' ) ); ?></p>
<?php endif; ?>

<?php
/**
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Emails::order_schema_markup() Adds Schema.org markup.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
