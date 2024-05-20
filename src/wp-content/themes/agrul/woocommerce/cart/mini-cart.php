<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>



<div class="dropdown-menu cart-list woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
    <div class="mini-cart-item-list">
	<?php if (!WC()->cart->is_empty()) : ?>

		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
		?>
				
					<div class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
						<div class="thumb">
							<?php if (!empty($thumbnail)) :   ?>
								<a href="<?php echo esc_url($product_permalink); ?>" class="photo"><?php echo apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key); ?></a>
							<?php endif; ?>
							<?php
							echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">%s</a>',
									esc_url(wc_get_cart_remove_url($cart_item_key)),
									esc_attr__('Remove this item', 'agrul'),
									esc_attr($product_id),
									esc_attr($cart_item_key),
									esc_attr($_product->get_sku()),
									'<i class="fas fa-times"></i>'
								),
								$cart_item_key
							);
							?>
						</div>
						<div class="info">
							<h6><a href="<?php echo esc_url($product_permalink); ?>"><?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key); ?> </a></h6>
							<p><?php echo esc_html($cart_item['quantity']); ?>x - <span class="price"><?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?></span></p>
						</div>
					</div>
				
		<?php
			}
		} ?>
	
		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>
		<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

	<?php else : ?>

		<div class="empty_cart text-center">

			<?php
			echo '<p>' . esc_html__('Your cart is currently empty.', 'agrul') . '</p>'; ?>
		</div>

	<?php endif; ?>

	<?php do_action('woocommerce_after_mini_cart'); ?>
</div>
	<div class="total">
			<span><?php echo esc_html__('Sub Total: ', 'agrul') ?> <strong><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></strong></span>
			<?php do_action('woocommerce_widget_shopping_cart_buttons'); ?>
		</div>
</div>