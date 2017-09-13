<?php global $wpo_wcpdf; ?>
<table class="head container">
	<tr>
		<td align="center" class="header">
		<?php
		if( $wpo_wcpdf->get_header_logo_id() ) {
			$wpo_wcpdf->header_logo();
		} else {
			echo apply_filters( 'wpo_wcpdf_invoice_title', __( 'Invoice', 'wpo_wcpdf' ) );
		}
		?>
		</td>
		<!--
		<td class="shop-info">
			<div class="shop-name"><h3><?php //$wpo_wcpdf->shop_name(); ?></h3></div>
			<div class="shop-address"><?php //$wpo_wcpdf->shop_address(); ?></div>
		</td>
		-->
	</tr>
</table>

<h1 class="document-type-label">
<?php if( $wpo_wcpdf->get_header_logo_id() ) echo apply_filters( 'wpo_wcpdf_invoice_title', __( 'Invoice', 'wpo_wcpdf' ) ); ?>
</h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address billing-address">
			<!-- <h3><?php _e( 'Billing Address:', 'wpo_wcpdf' ); ?></h3> -->
			<?php $wpo_wcpdf->billing_address(); ?>
			<?php if ( isset($wpo_wcpdf->settings->template_settings['invoice_email']) ) { ?>
			<div class="billing-email"><?php $wpo_wcpdf->billing_email(); ?></div>
			<?php } ?>
			<?php if ( isset($wpo_wcpdf->settings->template_settings['invoice_phone']) ) { ?>
			<div class="billing-phone"><?php $wpo_wcpdf->billing_phone(); ?></div>
			<?php } ?>
		</td>
		<td class="address shipping-address">
			<?php if ( isset($wpo_wcpdf->settings->template_settings['invoice_shipping_address']) && $wpo_wcpdf->ships_to_different_address()) { ?>
			<h3><?php _e( 'Ship To:', 'wpo_wcpdf' ); ?></h3>
			<?php $wpo_wcpdf->shipping_address(); ?>
			<?php } ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>
				<?php if ( isset($wpo_wcpdf->settings->template_settings['display_number']) && $wpo_wcpdf->settings->template_settings['display_number'] == 'invoice_number') { ?>
				<tr class="invoice-number">
					<th><?php _e( 'Invoice Number:', 'wpo_wcpdf' ); ?></th>
					<td><?php $wpo_wcpdf->invoice_number(); ?></td>
				</tr>
				<?php } ?>
				<?php if ( isset($wpo_wcpdf->settings->template_settings['display_date']) && $wpo_wcpdf->settings->template_settings['display_date'] == 'invoice_date') { ?>
				<tr class="invoice-date">
					<th><?php _e( 'Invoice Date:', 'wpo_wcpdf' ); ?></th>
					<td><?php strtolower($wpo_wcpdf->invoice_date()); ?></td>
				</tr>
				<?php } ?>
				<tr class="order-number">
					<th><?php _e( 'Order Number:', 'wpo_wcpdf' ); ?></th>
					<td><?php $wpo_wcpdf->order_number(); ?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Order Date:', 'wpo_wcpdf' ); ?></th>
					<td><?php strtolower($wpo_wcpdf->order_date()); ?></td>
				</tr>
				<tr class="payment-method">
					<th><?php _e( 'Payment Method:', 'wpo_wcpdf' ); ?></th>
					<td><?php $wpo_wcpdf->payment_method(); ?></td>
				</tr>
				<?php do_action( 'wpo_wcpdf_after_order_data', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>
			</table>			
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th width="50%" class="product"><?php _e('Product', 'wpo_wcpdf'); ?></th>
			<th width="35%" class="quantity"><?php _e('Quantity', 'wpo_wcpdf'); ?></th>
			<th width="15%" class="price"><?php _e('Price', 'wpo_wcpdf'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $items = $wpo_wcpdf->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order, $item_id ); ?>">
			<td width="50%" class="product">
				<?php $description_label = __( 'Description', 'wpo_wcpdf' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
				<span class="item-meta">
				<?php
				if (strpos($item['meta'], 'Nabesteld') !== false || strpos($item['meta'], 'Backordered') !== false) :
					echo '<br/><small style="font-size:11px;color:#D54D1D;">' . $item['meta'] . '</small>';
					echo '<small style="font-size:10px;color:#D54D1D;">'. __('Please note: this product must be re-ordered.<br/>We will inform you a.s.a.p. about the the expected delivery time', 'anansi-tomte') .'</small>';
				else :
					echo $item['meta'];
				endif;
				?>
				</span>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
			</td>
			<td width="35%" class="quantity"><?php echo $item['quantity']; ?></td>
			<td width="15%" class="price"><?php echo $item['order_price']; ?></td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
	<tfoot>
		<tr class="no-borders">
			<td class="no-borders">
				<div class="customer-notes">
					<?php if ( $wpo_wcpdf->get_shipping_notes() ) : ?>
						<h3><?php _e( 'Customer Notes', 'wpo_wcpdf' ); ?></h3>
						<?php $wpo_wcpdf->shipping_notes(); ?>
					<?php endif; ?>
				</div>				
			</td>
			<td class="no-borders" colspan="2">
				<table class="totals">
					<tfoot>
						<?php foreach( $wpo_wcpdf->get_woocommerce_totals() as $key => $total ) : ?>
						<tr class="<?php echo $key; ?>">
							<td class="no-borders"></td>
							<th class="description"><?php echo $total['label']; ?></th>
							<td class="price"><span class="totals-price">
							<?php if( $total['value'] == "" ) :
								_e('FREE','wpo_wcpdf');
							else :
								echo str_replace('(', '<br/>(', $total['value']);
							endif; ?>
							</span></td>
						</tr>
						<?php endforeach; ?>
					</tfoot>
				</table>
			</td>
		</tr>
	</tfoot>
</table>

<?php do_action( 'wpo_wcpdf_after_order_details', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<div id="footer">
	<table width="100%">
		<tr>
			<td colspan="3" class="av">
				<a href="https://www.anansi-tomte.nl/?page_id=21">Klik hier voor de van toepassing zijnde <span class="orange" style="vertical-align:bottom;display:inline;">algemene voorwaarden</span></a>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<hr/>
			</td>
		</tr>
		<tr>
			<td width="33%">
				Anansi & Tomte VOF<br/>
				Trévouxperenlaan 89<br/>
				3452 DT Vleuten
			</td>
			<td width="33%">
				<span class="orange">T:</span> 06-49889282<br/>
				<span class="orange">E:</span> info@anansi-tomte.nl<br/>
				<span class="orange">W:</span> www.anansi-tomte.nl
			</td>
			<td width="33%">
				<span class="orange">KvK:</span> 67318134<br/>
				<span class="orange">BTW:</span> NL.856929074.B01<br/>
				<span class="orange">IBAN:</span> NL38 KNAB 0255640005
			</td>
		</tr>
	</table>	
	<?php if ( $wpo_wcpdf->get_footer() ): ?>
		<?php $wpo_wcpdf->footer(); ?>
	<?php endif; ?>
</div><!-- #letter-footer -->