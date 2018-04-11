<?php
require_once locate_template('/wp-bootstrap-navwalker-master/class-wp-bootstrap-navwalker.php');
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);
function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}
add_filter('woocommerce_short_description','limit_short_descr');

function limit_short_descr($description){
  return ($description > 140) ? substr($description, 0 , 140) : $description;
}


add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

function hide_price_for_unavailable_products($price_html, $product) {
  $product_purchasable = $product->is_purchasable();

  /* Due to how WooCommerce is designed, a product with children may be returned
   * as "purchasable" even if none of its children are. This is the case with
   * variable products.
   * We want to hide prices for variable products that don't have any available
   * variation, therefore we have to check each variation's availability.
   */
  if($product_purchasable && $product->has_child()) {
    $product_purchasable = false;
    foreach($product->get_children(true) as $child_product_id) {
      $child_product = wc_get_product($child_product_id);
      // If any variation is purchasable, then the variable product is
      // purchasable as well, and we can stop here
      if($child_product->is_purchasable()) {
        $product_purchasable = true;
        break;
      }
    }
  }

  // Hide price if product is not purchasable
  if(!$product_purchasable) {
    $price_html = '';
  }

  return $price_html;
}
// Hide price for products that are not purchasable
add_filter('woocommerce_get_price_html','hide_price_for_unavailable_products', 9, 2);
// Optional - Hide price for variations that are not purchasable
add_filter('woocommerce_get_variation_price_html','hide_price_for_unavailable_products', 9, 2); 

?>
