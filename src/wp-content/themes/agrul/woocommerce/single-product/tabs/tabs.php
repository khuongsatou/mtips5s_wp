<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
	<!-- Product Bottom Info  -->
    <div class="single-product-bottom-info">
        <div class="row">
            <div class="col-lg-12">
                <!-- Tab Nav -->
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                	<?php $counter = 1; foreach ( $product_tabs as $key => $product_tab ) : ?>	
                        <button class="nav-link <?php if($counter == '1'){echo esc_attr("active");}?>" id="<?php echo esc_attr( $key ); ?>-tab-control" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr( $key ); ?>-tab" type="button" role="tab" aria-controls="<?php echo esc_attr( $key ); ?>-tab" aria-selected="true">
                              <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                            </button>
                    <?php $counter++; endforeach; ?>
                </div>
                <!-- End Tab Nav -->
                <!-- Start Tab Content -->
                <div class="tab-content tab-content-info" id="myTabContent">
                <?php $counter = 1; foreach ( $product_tabs as $key => $product_tab ) : ?>		
                    <!-- Tab Single -->
                    <div class="tab-pane fade <?php if($counter == '1'){echo esc_attr("show active");}?>" id="<?php echo esc_attr( $key ); ?>-tab" role="tabpanel" aria-labelledby="<?php echo esc_attr( $key ); ?>-tab">
                    <?php
						if ( isset( $product_tab['callback'] ) ) {
							call_user_func( $product_tab['callback'], $key, $product_tab );
						}
					?>   
                    </div>
                    <!-- End Single -->
                <?php $counter++; endforeach; ?>    	
                </div>
                <!-- End Tab Content -->
            </div>
        </div>
    </div>
    <!-- End Product Bottom Info  -->
<?php endif; ?>
