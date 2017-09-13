<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
global $pvc_Options;
/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if (!empty($tabs)) : ?>
<div class="add_info">
  <div class="woocommerce-tabs">
    <div class="tabs">
      <ul class="tabs nav nav-tabs product-tabs" id="product-detail-tab">
      <?php foreach ($tabs as $key => $tab) : ?>
        <?php if ( $tab['title'] != '') : ?>
        <li class="<?php echo esc_attr($key); ?>_tab">
          <a href="#tab-<?php echo esc_attr($key); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
        </li>
        <?php endif; ?>
      <?php endforeach; ?>
      </ul>
    </div>
    <div id="productTabContent" class="tab-content colored bordered">
    <?php foreach ($tabs as $key => $tab) : ?>
      <div class="panel entry-content" id="tab-<?php echo esc_attr($key) ?>">
        <?php call_user_func($tab['callback'], $key, $tab) ?>
      </div>
    <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>