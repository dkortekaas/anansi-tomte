<?php
/**
 * Woocommerce
 *
 * @package WordPress
 * @subpackage logiqShop
 */

    /** Edge WooCommerce Declaration: WooCommerce Support and settings */    
    if (class_exists('WooCommerce')) :
        add_theme_support('woocommerce');
        require_once(WL_THEME_PATH. '/woo_function.php');
        // Disable WooCommerce Default CSS if set
        if (!empty($pvc_Options['woocommerce_disable_woo_css'])) :
            add_filter('woocommerce_enqueue_styles', '__return_false');
            wp_enqueue_style('woocommerce_enqueue_styles', get_template_directory_uri() . '/woocommerce.css');
        endif;

        // Display 9 products per page
        add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

        add_filter('loop_shop_columns', 'loop_columns');
        if (!function_exists('loop_columns')) :
            function loop_columns() {
                return 9;
            }
        endif;

        // Show all products
        if (isset($_GET['view'])) :
            if($_GET['view'] === 'all') :
                add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9999;' ), 20 );
            else:
                add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
            endif;
        endif;
    endif;

    if ( ! function_exists( 'wl_front_init_js_var' ) ) :
        function wl_front_init_js_var() {
            global $yith_wcwl, $post;
            ?>
            <script type="text/javascript">
                var MGK_PRODUCT_PAGE = false;
                var THEMEURL = '<?php echo esc_url(WL_THEME_URI) ?>';
                var IMAGEURL = '<?php echo esc_url(WL_THEME_URI) ?>/images';
                var CSSURL = '<?php echo esc_url(WL_THEME_URI) ?>/css';
                <?php if (isset($yith_wcwl) && is_object($yith_wcwl)) { ?>
                var MGK_ADD_TO_WISHLIST_SUCCESS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),htmlspecialchars_decode('Product successfully added to wishlist. <a href="%s">Browse Wishlist</a>')), esc_url($yith_wcwl->get_wishlist_url())) ?>';
                var MGK_ADD_TO_WISHLIST_EXISTS_TEXT = '<?php printf(preg_replace_callback('/(\r|\n|\t)+/',  create_function('$match', 'return "";'),htmlspecialchars_decode('The product is already in the wishlist! <a href="%s">Browse Wishlist</a>')), esc_url($yith_wcwl->get_wishlist_url()) )?>';
                <?php } ?>
                <?php if(is_singular('product')){?>
                MGK_PRODUCT_PAGE = true;
                <?php }?>
            </script>
            <?php
        }
        //add_action('wp_head', 'wl_front_init_js_var', 1);
    endif;



//Product Cat creation page
function wl_add_cat_subtitle() {
    ?>
    <div class="form-field">
        <label for="term_meta[wl_subtitle]"><?php _e('Subtitle', 'anansi-tomte'); ?></label>
        <input type="text" name="term_meta[wl_subtitle]" id="term_meta[wl_subtitle]">
        <p class="description"><?php _e('Enter a subtitle', 'anansi-tomte'); ?></p>
    </div>
    <?php
}
add_action('product_cat_add_form_fields', 'wl_add_cat_subtitle', 10, 1);

//Product Cat Edit page
function wl_edit_xat_subtitle($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option("taxonomy_" . $term_id);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[wl_subtitle]"><?php _e('Subtitle', 'anansi-tomte'); ?></label></th>
        <td>
            <input type="text" name="term_meta[wl_subtitle]" id="term_meta[wl_subtitle]" value="<?php echo esc_attr($term_meta['wl_subtitle']) ? esc_attr($term_meta['wl_subtitle']) : ''; ?>">
            <p class="description"><?php _e('Enter a subtitle', 'anansi-tomte'); ?></p>
        </td>
    </tr>
    <?php
}
add_action('product_cat_edit_form_fields', 'wl_edit_xat_subtitle', 10, 2);

// Save extra taxonomy fields callback function.
function save_cat_subtitle($term_id) {
    if (isset($_POST['term_meta'])) {
        $term_meta = get_option("taxonomy_" . $term_id);
        $cat_keys = array_keys($_POST['term_meta']);
        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option("taxonomy_" . $term_id, $term_meta);
    }
}
add_action('edited_product_cat', 'save_cat_subtitle', 10, 2);
add_action('create_product_cat', 'save_cat_subtitle', 10, 2);

// Renove Reviews Tab and add 
function wl_woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Remove the reviews tab
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wl_woo_remove_product_tabs', 98 );


// New 'Background' Tab
function wl_woo_new_product_tab( $tabs ) {
	$tabs['background'] = array(
		'title' 	=> __( 'Background to the product', 'annansi-tomte' ),
		'priority' 	=> 50,
		'callback' 	=> 'wl_woo_background_tab_content'
	);
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wl_woo_new_product_tab' );

// New content for new Tab
function wl_woo_background_tab_content() {
    //echo '<h2>'. __( 'Background to the product', 'annansi-tomte' ) .'</h2>';
    //echo '<p>Veld aanmaken in Woocommerce voor achtergrondtekst. En tabs nog sorteren.</p>';
    $var=get_field('background_info');
    echo '<p>'. $var .'</p>'; // out put the datafield    
}

// Reorder Tabs
function wl_woo_reorder_tabs( $tabs ) {
	$tabs['description']['priority'] = 5;               // Description first
    $tabs['background']['priority'] = 10;			    // Background second
	$tabs['additional_information']['priority'] = 15;	// Additional information third
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'wl_woo_reorder_tabs', 98 );

// Show price incl. Tax percentage
function wl_woo_price_plus_vat( $price ) {
     return $price . ' ' . __('incl. Vat', 'anansi-tomte') ;
}
add_filter( 'woocommerce_get_price_html', 'wl_woo_price_plus_vat' );

// Show other thank you page after purchase
function wl_custom_redirect_after_purchase() {
    global $wp;

    if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) :
        $order_id  = absint( $wp->query_vars['order-received'] );
        $order_key = wc_clean( $_GET['key'] );

        /**
         * Replace {PAGE_ID} with the ID of your page
         */
        $redirect  = get_permalink( 685 );
        $redirect .= get_option( 'permalink_structure' ) === '' ? '&' : '?';
        $redirect .= 'order=' . $order_id . '&key=' . $order_key;

        wp_redirect( $redirect );
        exit;
    endif;
}
add_action( 'template_redirect', 'wl_custom_redirect_after_purchase' );

// Custom Thank You page
function wl_custom_thankyou( $content ) {
	// Check if is the correct page
	if ( ! is_page( 685 ) ) {
		return $content;
	}

	// check if the order ID exists
	if ( ! isset( $_GET['order'] ) ) {
		return $content;
	}

	// intval() ensures that we use an integer value for the order ID
	$order = wc_get_order( intval( $_GET['order'] ) );

	ob_start();

	// Check that the order is valid
	if ( ! $order ) {
		// The order can't be returned by WooCommerce - Just say thank you
		?><p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p><?php
	} else {
		if ( $order->has_status( 'failed' ) ) {
			// Order failed - Print error messages and ask to pay again
			/**
			 * @hooked wc_custom_thankyou_failed - 10
			 */
			do_action( 'wl_custom_thankyou_failed', $order );
		} else {
			// The order is successfull - print the complete order review
			/**
			 * @hooked wc_custom_thankyou_header - 10
			 * @hooked wc_custom_thankyou_table - 20
			 * @hooked wc_custom_thankyou_customer_details - 30
			 */
			do_action( 'wl_custom_thankyou_successful', $order );
		}
	}
	$content .= ob_get_contents();
	ob_end_clean();
	return $content;
}
add_filter( 'the_content', 'wl_custom_thankyou' );

// Custom Thank You sections
function wl_custom_thankyou_failed( $order ) {
	wc_get_template( 'custom-thankyou/failed.php', array( 'order' => $order ) );
}
add_action( 'wl_custom_thankyou_failed', 'wl_custom_thankyou_failed', 10 );

function wl_custom_thankyou_header( $order ) {
	wc_get_template( 'custom-thankyou/header.php', array( 'order' => $order ) );
}
add_action( 'wl_custom_thankyou_successful', 'wl_custom_thankyou_header', 10 );

function wl_custom_thankyou_table( $order ) {
	wc_get_template( 'custom-thankyou/table.php', array( 'order' => $order ) );
}
add_action( 'wl_custom_thankyou_successful', 'wl_custom_thankyou_table', 20 );

function wl_custom_thankyou_customer_details( $order ) {
	wc_get_template( 'custom-thankyou/customer-details.php', array( 'order' => $order ) );
}
add_action( 'wl_custom_thankyou_successful', 'wl_custom_thankyou_customer_details', 30 );


//  function remove_title_from_shipping_label($full_label, $method){
//      //if ($method->id === 'local_pickup') :
// 	if (strpos($method->id, 'local_pickup') !== false) :
//          $full_label = str_replace(__('Free'), "", $full_label);
// //     else :
// //         $full_label = str_replace('Table Rate Shipping: ', "", $full_label);
// //         $full_label = str_replace('Table Rate Shipping ', "", $full_label);
// //         $full_label = str_replace('Table Rate Shipping', "", $full_label);
// // 		//$full_label = $full_label . ' ' . __('incl. BTW','anansi-tomte');
// else :
// 	$full_label = $method->id;
//     endif;


// //return $method->id;
//      return $full_label;
    
// }
// add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_title_from_shipping_label', 10, 2 );


// My Wislist
class My_Wishlist_Endpoint {

	/**
	 * Custom endpoint name.
	 *
	 * @var string
	 */
	public static $endpoint = 'my-wishlist';

	/**
	 * Plugin actions.
	 */
	public function __construct() {
		// Actions used to insert a new endpoint in the WordPress.
		add_action( 'init', array( $this, 'add_endpoints' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

		// Change the My Accout page title.
		add_filter( 'the_title', array( $this, 'endpoint_title' ) );

		// Insering your new tab/page into the My Account page.
		add_filter( 'woocommerce_account_menu_items', array( $this, 'new_menu_items' ) );
		add_action( 'woocommerce_account_' . self::$endpoint .  '_endpoint', array( $this, 'endpoint_content' ) );
	}

	/**
	 * Register new endpoint to use inside My Account page.
	 *
	 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
	 */
	public function add_endpoints() {
		add_rewrite_endpoint( self::$endpoint, EP_ROOT | EP_PAGES );
	}

	/**
	 * Add new query var.
	 *
	 * @param array $vars
	 * @return array
	 */
	public function add_query_vars( $vars ) {
		$vars[] = self::$endpoint;

		return $vars;
	}

	/**
	 * Set endpoint title.
	 *
	 * @param string $title
	 * @return string
	 */
	public function endpoint_title( $title ) {
		global $wp_query;

		$is_endpoint = isset( $wp_query->query_vars[ self::$endpoint ] );

		if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
			// New page title.
			$title = __( 'My Wishlist', 'anansi-tomte' );

			remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
		}

		return $title;
	}

	/**
	 * Insert the new endpoint into the My Account menu.
	 *
	 * @param array $items
	 * @return array
	 */
	public function new_menu_items( $items ) {
		// Remove the logout menu item.
		$logout = $items['customer-logout'];
		unset( $items['customer-logout'] );

		// Insert your custom endpoint.
		$items[ self::$endpoint ] = __( 'My Wishlist', 'anansi-tomte' );

		// Insert back the logout item.
		$items['customer-logout'] = $logout;

		return $items;
	}

	/**
	 * Endpoint HTML content.
	 */
	public function endpoint_content() {
        echo do_shortcode('[yith_wcwl_wishlist]');
	}

	/**
	 * Plugin install action.
	 * Flush rewrite rules to make our custom endpoint available.
	 */
	public static function install() {
		flush_rewrite_rules();
	}
}

new My_Wishlist_Endpoint();

// Flush rewrite rules on plugin activation.
register_activation_hook( __FILE__, array( 'My_Wishlist_Endpoint', 'install' ) );


// My Wislist
class My_Rewardpoint_Endpoint {

	/**
	 * Custom endpoint name.
	 *
	 * @var string
	 */
	public static $endpoint = 'my-rewardpoints';

	/**
	 * Plugin actions.
	 */
	public function __construct() {
		// Actions used to insert a new endpoint in the WordPress.
		add_action( 'init', array( $this, 'add_endpoints' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ), 0 );

		// Change the My Accout page title.
		add_filter( 'the_title', array( $this, 'endpoint_title' ) );

		// Insering your new tab/page into the My Account page.
		add_filter( 'woocommerce_account_menu_items', array( $this, 'new_menu_items' ) );
		add_action( 'woocommerce_account_' . self::$endpoint .  '_endpoint', array( $this, 'endpoint_content' ) );
	}

	/**
	 * Register new endpoint to use inside My Account page.
	 *
	 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
	 */
	public function add_endpoints() {
		add_rewrite_endpoint( self::$endpoint, EP_ROOT | EP_PAGES );
	}

	/**
	 * Add new query var.
	 *
	 * @param array $vars
	 * @return array
	 */
	public function add_query_vars( $vars ) {
		$vars[] = self::$endpoint;

		return $vars;
	}

	/**
	 * Set endpoint title.
	 *
	 * @param string $title
	 * @return string
	 */
	public function endpoint_title( $title ) {
		global $wp_query;

		$is_endpoint = isset( $wp_query->query_vars[ self::$endpoint ] );

		if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
			// New page title.
			$title = __( 'My Rewardpoints', 'anansi-tomte' );

			remove_filter( 'the_title', array( $this, 'endpoint_title' ) );
		}

		return $title;
	}

	/**
	 * Insert the new endpoint into the My Account menu.
	 *
	 * @param array $items
	 * @return array
	 */
	public function new_menu_items( $items ) {
		// Remove the logout menu item.
		$logout = $items['customer-logout'];
		unset( $items['customer-logout'] );

		// Insert your custom endpoint.
		$items[ self::$endpoint ] = __( 'My Rewardpoints', 'anansi-tomte' );

		// Insert back the logout item.
		$items['customer-logout'] = $logout;

		return $items;
	}

	/**
	 * Endpoint HTML content.
	 */
	public function endpoint_content() {
        echo do_shortcode('[rs_my_rewards_log]');
        //echo do_shortcode('[rs_unsubscribe_email]');       
	}

	/**
	 * Plugin install action.
	 * Flush rewrite rules to make our custom endpoint available.
	 */
	public static function install() {
		flush_rewrite_rules();
	}
}

new My_Rewardpoint_Endpoint();

// Flush rewrite rules on plugin activation.
register_activation_hook( __FILE__, array( 'My_Rewardpoint_Endpoint', 'install' ) );


// My Account menu items.
function wpb_woo_my_account_order() {
    $myorder = array(
        'edit-address' => __( 'My details', 'anansi-tomte' ),
        'orders' => __( 'My orders', 'anansi-tomte' ),
        'my-wishlist' => __( 'My Wishlist', 'anansi-tomte' ),
        'my-rewardpoints' => __( 'My Rewardpoints', 'anansi-tomte' ),
        'customer-logout' => __( 'Logout', 'woocommerce' ),

        // 'my-custom-endpoint' => __( 'My Stuff', 'woocommerce' ),
        // 'edit-account' => __( 'Change My Details', 'woocommerce' ),
        // 'dashboard' => __( 'Dashboard', 'woocommerce' ),
        // 'orders' => __( 'Orders', 'woocommerce' ),
        // 'downloads' => __( 'Download MP4s', 'woocommerce' ),
        // 'edit-address' => __( 'Addresses', 'woocommerce' ),
        // 'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
        // 'customer-logout' => __( 'Logout', 'woocommerce' ),
    );
    return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


// Add AV pdf to Order mails
function attach_terms_conditions_pdf_to_email ( $attachments , $id, $object ) {
	//$av_pdf_path = get_template_directory() . '/terms.pdf';
	$av_pdf_path = wp_upload_dir() . '/Algemene-voorwaarden.pdf';
	$attachments[] = $av_pdf_path;
	return $attachments;
}
add_filter( 'woocommerce_email_attachments', 'attach_terms_conditions_pdf_to_email', 10, 3);


// Remove Coupon messages
add_filter( 'woocommerce_coupon_message', '__return_empty_string' );


function hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) :
		if ( 'free_shipping' === $rate->method_id ) :
			$free[ $rate_id ] = $rate;
			break;
		endif;
	endforeach;
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'hide_shipping_when_free_is_available', 100 );

// Unchecked different shipping address
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );


// Add To Cart Message
function wc_add_to_cart_message_filter($message, $product_id = null) {
    $titles[] = get_the_title( $product_id );
	$_product = wc_get_product( $product_id );
	$oos_message = '';
	if ( $_product->get_stock_quantity() <= 0 ) :
		$oos_message = __('This product is not currently out of stock. We will reorder the product directly for you and inform you as soon as possible about the expected delivery time. For more information, please contact us.', 'anansi-tomte');
	endif;

    $titles = array_filter( $titles );
    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    $message = sprintf( '<span class="cart_msg">%s <br/><small>%s</small></span><span class="pull-right"><a href="%s" class="button">%s</a></span>',
                    esc_html( $added_text ),
					esc_html( $oos_message ),
                    esc_url( wc_get_page_permalink( 'cart' ) ),
                    esc_html__( 'View Cart', 'woocommerce' ));

    return $message;
}
add_filter ( 'wc_add_to_cart_message', 'wc_add_to_cart_message_filter', 10, 2 );


// Hides the product's weight and dimension in the single product page.
add_filter( 'wc_product_enable_dimensions_display', '__return_false' );


/**
 * Define image sizes
 */
function wc_image_dimensions() {
  	$catalog = array(
		'width' 	=> '250',					// px
		'height'	=> '250',					// px
		'crop'		=> array('center','top')	// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
}
add_action( 'init', 'wc_image_dimensions', 1 );


// Change number of posts on search page
function change_wp_search_size($queryVars) {
	if ( isset($_REQUEST['s']) ) :
		$queryVars['posts_per_page'] = 12;
	endif;
	return $queryVars;
}
add_filter('request', 'change_wp_search_size');


function wc_remove_password_strength() {
	if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
		wp_dequeue_script( 'wc-password-strength-meter' );
	}
}
add_action( 'wp_print_scripts', 'wc_remove_password_strength', 100 );
