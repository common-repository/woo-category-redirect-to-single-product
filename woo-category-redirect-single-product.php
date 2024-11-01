<?php
/**
 * Plugin Name: WooCommerce Category Redirect to Single Product
 * Plugin URI: https://www.ohyeahdev.es/plugins/woo-category-redirect-single-product
 * Description: Redirect to single product page when a category only have one product.
 * Author: Oh! Yeah Dev
 * Author URI: https://www.ohyeahdev.es
 * Version: 1.0
 * License: GPLv2 or later
 */

// Go away!!
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'template_redirect', 'ohyd_redirect_to_single');

function ohyd_redirect_to_single() {

	global $wp_query;

	// Redirect to the product page if we have a single product
	if ( is_product_category() && $wp_query->found_posts == 1) {
		$product = wc_get_product( $wp_query->posts[0]->ID );
	
		if ( $product && $product->is_visible() ) {
			wp_safe_redirect( get_permalink( $wp_query->posts[0]->ID ), 302 );
			exit;
		}
	}

}
?>