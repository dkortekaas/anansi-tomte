<?php
/**
 * Loop Price
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>
    <span class="price"><?php echo htmlspecialchars_decode($price_html); ?></span>
<?php endif; ?>
    <div class="loyalty-points">
        <span class="or">of</span>
        <?php
            $price = $product->get_price();
            $buypoints = round(($price * 2), 0, PHP_ROUND_HALF_UP);
        ?>
        <span><?php echo $buypoints . ' ' . __('loyalty points', 'anansi-tomte'); ?></span>    
    </div>