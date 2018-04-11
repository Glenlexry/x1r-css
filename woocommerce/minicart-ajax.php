<?php global $woocommerce; ?>
<div class="top-form top-form-minicart pull-right">
	<div class="top-minicart pull-right">
	<?php 
		$header_style = ya_options() -> getCpanelValue( 'header_style' );
		if( $header_style != 'style2' ){ 
	?>
		<span><?php _e('My Cart','yatheme');?></span>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'yatheme'); ?>"><?php echo '<span class="minicart-number">'.$woocommerce->cart->cart_contents_count.'</span>'; _e('item(s)', 'yatheme');?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php } else { ?>
		<?php if( count($woocommerce->cart->cart_contents) <= 0 ){ ?>
			<a class="cart-contents-style2"><?php _e('My Cart', 'yatheme'); ?></a>
		<?php } else{ ?>
			<a class="cart-contents-style2" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'yatheme'); ?>"><?php echo $woocommerce->cart->cart_contents_count; _e(' item(s)', 'yatheme');?> </a>
	<?php } } ?>
	</div>
	<?php if( count($woocommerce->cart->cart_contents) > 0 ){?>
	<div class="wrapp-minicart">
		<div class="minicart-padding">
			<ul class="minicart-content">
			<?php foreach($woocommerce->cart->cart_contents as $cart_item):
					$_product  = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_name = ( sw_woocommerce_version_check( '3.0' ) ) ? $_product->get_name() : $_product->get_title();
			?>
				<li>
					<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
						<?php echo $_product->get_image( 'shop_thumbnail' ); ?>
						<div class="cart-desc">
							<span class="cart-title"><?php echo esc_html( $product_name ); ?></span>
							<div class="block-qty">
								<?php echo $woocommerce->cart->get_product_subtotal($cart_item['data'], 1); ?>
								<span class="product-quantity">Qty:<?php echo '<span class="quantity">'.esc_html( $cart_item['quantity'] ).'</span>'; ?></span>
							</div>
						</div>
					</a>
				</li>
			<?php
			endforeach;
			?>
			</ul>
			<div class="cart-checkout">
				<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" title="Cart"><?php _e('Go To Cart', 'yatheme'); ?></a></div>
				<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" title="Check Out"><?php _e('Check Out', 'yatheme'); ?></a></div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>