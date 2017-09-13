<?php
/**
 * Change WordPress default login screen
 *
 * @package WordPress
 * @subpackage logiqShop
 */

// Add custom login logo
if ( ! function_exists( 'logiqshop_login_logo' ) ) :
function logiqshop_login_logo() {
    
	$css = '';

	if(LOGIN_BMC == true) :
	    $css = '<style type="text/css">';
	        $css.= '.login h1 a {';
	            $css .= 'background-image: url(https://www.bmcinternetmarketing.nl/wp-content/themes/bmc/assets/images/bmc/BMC-WP-Login.jpg) !important;';
	            $css .= '-webkit-background-size: 150px !important;;';
	            $css .= 'background-size: 150px !important;;';
	            $css .= 'width: 150px !important;;';
	            $css .= 'height: 150px !important;;';
	        $css .= '}';
	    $css .= '</style>';
    else :
		$css = '<style type="text/css">';
			$css.= '.login{background-color:#18222a !important;}';
			$css.= '.login #backtoblog a,.login #nav a{color:#a9a9a9 !important;}';
			$css.= '.wp-core-ui .button-primary{background:#378ec9 !important;border-color:#378ec9 !important;-webkit-box-shadow:0 1px 0 #378ec9 !important;box-shadow:0 1px 0 #378ec9 !important;text-shadow: 0 -1px 1px #378ec9, 1px 0 1px #378ec9, 0 1px 1px #378ec9, -1px 0 1px #378ec9 !important;}';
			$css.= '.login #login_error, .login .message{border-left: 4px solid #378ec9 !important;}';
			$css.= '.login #nav{width: auto;float:right;padding:25px 5px 0 0 !important;margin:0 !important;}';
			$css.= '.login #backtoblog{width:55%;float:left;padding:25px 0 0 5px !important;margin:0 !important;}';
			$css.= '.login #backtoblog a:hover,.login #nav a:hover,.login #backtoblog a:focus,.login #nav a:focus,.login #backtoblog a:active,.login #nav a:active{color: #378ec9 !important;}';
			$css.= '.login h1 a{background-image: url('.get_parent_theme_file_uri('/assets/images/login/weblogiq-logo.svg').') !important;-webkit-background-size:260px !important;background-size:260px !important;width:260px !important;59px !important;}';
			$css.= 'a:focus {-webkit-box-shadow: none !important;box-shadow: none !important;}';
		$css.= '</style>';
	endif;
    echo $css;
}
add_action( 'login_enqueue_scripts', 'logiqshop_login_logo' );
endif;

// Add custom login url
if ( ! function_exists( 'logiqshop_login_logo_url' ) ) :
function logiqshop_login_logo_url() {
	if(LOGIN_BMC == true) :
    	return "https://www.bmcinternetmarketing.nl";
   	else :
		return "https://weblogiq.nl";
	endif;
}
add_filter( 'login_headerurl', 'logiqshop_login_logo_url' );
endif;

// Add custom login url title
if ( ! function_exists( 'logiqshop_login_logo_url_title' ) ) :
function logiqshop_login_logo_url_title() {
	if(LOGIN_BMC == true) :
    	return 'Ontwikkeld door BMC Internet Marketing';
	else :
		return 'Ontwikkeld door internetbureau Weblogiq';
	endif;
}
add_filter( 'login_headertitle', 'logiqshop_login_logo_url_title' );
endif;
?>