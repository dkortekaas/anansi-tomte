<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Load colours
$bg              = get_option( 'woocommerce_email_background_color' );
$body            = get_option( 'woocommerce_email_body_background_color' );
$base            = '#F7931E'; //get_option( 'woocommerce_email_base_color' );
$base_text       = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text            = '#000000'; //get_option( 'woocommerce_email_text_color' );

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
?>
#wrapper {
    background-color: <?php echo esc_attr( $bg ); ?>;
    margin: 0;
    padding: 70px 0 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;
}

#template_container {
    /*box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important;*/
    background-color: <?php echo esc_attr( $bg ); ?>;
    /*border: 1px solid <?php echo esc_attr( $bg_darker_10 ); ?>;*/
    /*border-radius: 3px !important;*/
}

#template_header {
    background-color: <?php echo esc_attr( $bg ); ?>;
    border-radius: 3px 3px 0 0 !important;
    color: <?php echo esc_attr( $base ); ?>;
    border-bottom: 0;
    font-weight: bold;
    line-height: 100%;
    vertical-align: middle;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
}

#template_header h1 {
    color: <?php echo esc_attr( $base ); ?>;
    text-align: center;
    border-top: 1px solid <?php echo esc_attr( $text ); ?>;
    border-bottom: 1px solid <?php echo esc_attr( $text ); ?>;
    padding: 15px 0;
}

#template_footer td {
    padding: 0;
    -webkit-border-radius: 6px;
}

#template_footer #credit {
    border:0;
    color: #000;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size:10px;
    line-height:1.5;
    text-align:left;
    padding: 0 48px 48px 48px;
}

#template_footer #credit .address {
    font-size: 13px;
}

#body_content {
    background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
    padding: 20px 48px 10px 48px;
}

#body_content table td td {
    padding: 12px;
}

#body_content table td td small {
    /*display: none;*/
}

#body_content table td th {
    padding: 12px;
}

#body_content p {
    margin: 0 0 16px;
}

#body_content_inner {
    color: #000;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size: 13px;
    line-height: 150%;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

.td {
    color: <?php echo esc_attr( $text_lighter_20 ); ?>;
    border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
}

.text {
    color: <?php echo esc_attr( $text ); ?>;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
}

.link {
    color: <?php echo esc_attr( $text ); ?>;
}

#header_wrapper {
    padding: 36px 48px 10px 48px;
    display: block;
}

h1 {
    color: <?php echo esc_attr( $base ); ?>;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size: 30px;
    font-weight: 300;
    line-height: 150%;
    margin: 0;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
    -webkit-font-smoothing: antialiased;
}

h2 {
    color: <?php echo esc_attr( $base ); ?>;
    display: block;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 8px;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
    color: <?php echo esc_attr( $base ); ?>;
    display: block;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size: 16px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 8px;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h4 {
    color: <?php echo esc_attr( $base ); ?>;
    display: block;
    font-family: "Comic Sans MS", Segoe, cursive, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 0 0;
    text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
    color: <?php echo esc_attr( $text ); ?>;
    font-weight: normal;
    text-decoration: none;
}

img {
    border: none;
    display: inline;
    font-size: 14px;
    font-weight: bold;
    height: auto;
    line-height: 100%;
    outline: none;
    text-decoration: none;
    text-transform: capitalize;
}

.orange {
    color: <?php echo esc_attr( $base ); ?>;
}

#order-details>tfoot>tr:last-child .woocommerce-Price-amount:first-child { 
    display: block;
}
<?php
