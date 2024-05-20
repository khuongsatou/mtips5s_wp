<?php
/**
 * The Template for displaying dropdown wishlist products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/ti-wishlist-product-counter.php.
 *
 * @version             1.9.0
 * @package           TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wp_enqueue_script( 'tinvwl' );

?>
<a href="<?php echo esc_url( tinv_url_wishlist_default() ); ?>" class="wishlist_products_counter cart-icon me-4 me-lg-3 mr-xl-0 has-badge sideMenuToggler">
	<i class="fal fa-heart"></i>
	<?php if ( $show_counter ) : ?>
		<span class="wishlist_products_counter_number badge"></span>
	<?php endif; ?>
</a>