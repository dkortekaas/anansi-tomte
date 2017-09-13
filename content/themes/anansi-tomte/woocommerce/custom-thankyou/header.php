<?php
global $woocommerce;
$woocommerce->cart->empty_cart(); 
?>
<h2 style="margin-bottom:10px;margin-top:30px;"><?php _e( 'Order Details', 'woocommerce' ); ?></h2>

<ul class="order_details" style="margin-bottom:0;">
    <li class="order" style="margin-bottom:10px;">
        <?php _e( 'Order:', 'woocommerce' ); ?>
        <strong><?php echo $order->get_order_number(); ?></strong>
    </li>
    <li class="date" style="margin-bottom:10px;">
        <?php _e( 'Date:', 'woocommerce' ); ?>
        <strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
    </li>
</ul>
<div class="clear"></div>
