<style>
table.thnx td, table.thnx th {
    padding: 5px 0;
    vertical-align: text-top;
}
table.thnx tfoot tr:first-child td:first-child .woocommerce-Price-amount {
    border-top: 1px solid #000000;
}

table.thnx tfoot tr:last-child .woocommerce-Price-amount:nth-child(1) {
    display: block;
    font-weight: bold;
}
</style>
<header>
    <h2 style="margin-bottom:10px;margin-top:30px;"><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
</header>
<dl class="customer_details">
<?php
    if ( $order->billing_email ) echo '<dt>' . __( 'Email:', 'woocommerce' ) . '</dt><dd>' . $order->billing_email . '</dd><br/>';
    if ( $order->billing_phone ) echo '<dt>' . __( 'Telephone:', 'woocommerce' ) . '</dt><dd>' . $order->billing_phone . '</dd>';
    // Additional customer details hook
    do_action( 'woocommerce_order_details_after_customer_details', $order );
?>
</dl>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

<div class="col2-set addresses">

    <div class="col-1">

<?php endif; ?>

        <header class="title">
            <h3 style="margin-bottom:10px;"><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
        </header>
        <address>
            <?php
                if ( ! $order->get_formatted_billing_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_billing_address();
            ?>
        </address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

    </div><!-- /.col-1 -->

    <div class="col-2">

        <header class="title">
            <h3 style="margin-bottom:10px;"><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
        </header>
        <address>
            <?php
                if ( ! $order->get_formatted_shipping_address() ) _e( 'N/A', 'woocommerce' ); else echo $order->get_formatted_shipping_address();
            ?>
        </address>

    </div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>