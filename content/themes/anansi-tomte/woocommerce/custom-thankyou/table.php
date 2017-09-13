
<table class="shop_table order_details thnx" style="width:60%;">
    <tbody>
        <?php
        if ( sizeof( $order->get_items() ) > 0 ) {
            foreach( $order->get_items() as $item ) {
                $_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
                $item_meta    = new WC_Order_Item_Meta( $item, $_product );
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
                    <td class="product-name">
                        <?php
                            if ( $_product && ! $_product->is_visible() )
                                echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
                            else
                                echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
                                echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

                                if ( ! empty( $item_meta->meta ) ) :
                                    if ( ($item['Nabesteld'] != '') || ($item['Backordered'] != '') ) :
                                        echo '<br/><small style="font-size:11px;color:#D54D1D;">' . nl2br( $item_meta->display( true, true ) ) . '</small>';
                                        echo '<br/><small style="font-size:11px;color:#D54D1D;">'. __('Please note: this product must be re-ordered.<br/>We will inform you a.s.a.p. about the the expected delivery time', 'anansi-tomte') .'</small>';
                                    else :
                                        $item_meta->display();
                                    endif;
                                endif;

                                if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {
                                    $download_files = $order->get_item_downloads( $item );
                                    $i              = 0;
                                    $links          = array();
                                    foreach ( $download_files as $download_id => $file ) {
                                        $i++;
                                        $links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
                                    }
                                    echo '<br/>' . implode( '<br/>', $links );
                                }
                            ?>
                    </td>
                    <td class="product-total">
                        <?php echo $order->get_formatted_line_subtotal( $item ); ?>
                    </td>
                </tr>
                <?php
                if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
                    ?>
                    <tr class="product-purchase-note">
                        <td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
                    </tr>
                    <?php
                }
            }
        }
        do_action( 'woocommerce_order_items_table', $order );
        ?>
    </tbody>
    <tfoot>
    <?php
        if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :
            ?>
            <tr>
                <th scope="row"><?php echo $total['label']; ?></th>
                <td>
                    <?php if ( strtolower($total['label']) == 'subtotaal:' || strtolower($total['label']) == 'subtotal:') : ?>
                    <span style="border-top:1px solid #42210B;"><?php echo $total['value']; ?></span>
                    <?php else : ?>
                    <?php echo $total['value']; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        endforeach;
    ?>
    </tfoot>
</table>

<?php if (is_user_logged_in()) : ?>
<header style="margin-bottom:-75px;margin-top:30px;">
    <h2><?php _e( 'Reward Points', 'anansi-tomte' ); ?></h2>
</header>
<?php endif; ?>
<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>