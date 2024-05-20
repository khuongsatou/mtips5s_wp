<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// $buscom_opt = get_option('buscom_redux_opt');
// $buscom_woo_relproduct_display = $buscom_opt['buscom_woo_relproduct_display'];

global $post;
$related_products = get_posts( 
  array( 
  'category__in' => wp_get_post_categories( $post->ID ), 
  'numberposts'  => 4, 
  'post__not_in' => array( $post->ID ),
  'post_type'    => 'product'
  ) 
);
print_r($related_products);
if ( $related_products) : ?>

	<div class="related-products carousel-shadow">
		<div class="row">
            <div class="col-md-12">

			<?php
			$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'agrul' ) );

			if ( $heading ) :
				?>
				
			<?php endif; ?>

			<ul class="vt-products related-product-carousel owl-carousel owl-theme">
			
				<?php foreach ( $related_products as $related_product ) : ?>

						<?php
						$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'content', 'product' );
						?>

				<?php endforeach; ?>
			</ul>

		</div>
	</div>
</div>
	<?php
endif;

wp_reset_postdata();
