<?php
/**
 * Show options for ordering
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering" method="get">
    <div id="sort-by"><label class="left"><?php _e('Sort By','anansi-tomte')?>: </label>
        <select name="orderby" class="orderby">
            <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                <option
                    value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php
    // Keep query string vars intact
    foreach ($_GET as $key => $val) {
        if ('orderby' === $key || 'submit' === $key) {
            continue;
        }
        if (is_array($val)) {
            foreach ($val as $innerVal) {
                echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($innerVal) . '" />';
            }
        } else {
            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" />';
        }
    }
    ?>
</form>
