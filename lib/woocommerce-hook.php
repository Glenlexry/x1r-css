<?php
add_theme_support( 'woocommerce' );
/*

/*
** WooCommerce Compare Version
*/
if( !function_exists( 'sw_woocommerce_version_check' ) ) :
	function sw_woocommerce_version_check( $version = '3.0' ) {
		global $woocommerce;
		if( version_compare( $woocommerce->version, $version, ">=" ) ) {
			return true;
		}else{
			return false;
		}
	}
endif;

/*minicart via Ajax*/
$filter = sw_woocommerce_version_check( $version = '3.0.3' ) ? 'woocommerce_add_to_cart_fragments' : 'add_to_cart_fragments';
add_filter($filter , 'ya_add_to_cart_fragment', 100);
 
function ya_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
	<?php
	$fragments['.top-form-minicart'] = ob_get_clean();
	return $fragments;
	
}
/*
add_filter( 'woocommerce_variable_price_html', 'ya_price_html', 100, 2 );
function ya_price_html( $price, $product ){
	$variation_id = get_post_meta( get_the_id(), '_min_regular_price_variation_id', true );
	$price        = get_post_meta( $variation_id, '_regular_price', true );
	return $price;
}*/
/* change position */
/*remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',10);*/
/*remove woo breadcrumb*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/*YITH wishlist*/
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
	//woocommerce_after_single_variation

	add_action( 'woocommerce_after_single_variation', 'ya_add_wishlist_variation', 10 );
	add_action( 'woocommerce_single_product_summary', 'ya_before_addcart', 11);

	add_action( 'woocommerce_after_add_to_cart_button', 'ya_after_addcart', 38);
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_after_shop_loop_item', 'ya_add_loop_add_to_cart', 15 );
	add_action('woocommerce_after_shop_loop_item','ya_add_loop_compare_link', 20);
	add_action( 'woocommerce_after_shop_loop_item', 'ya_add_loop_wishlist_link', 25 );
	add_action( 'woocommerce_after_add_to_cart_button', 'ya_add_wishlist_link', 10);
	function ya_before_addcart(){
		echo '<div class="product-summary-bottom clearfix">';
	}
	function ya_after_addcart(){
		echo '</div>';
	}

	function ya_add_loop_add_to_cart( $args = array() ){
		global $product;

		if ( $product ) {
			$product_type = ( sw_woocommerce_version_check( '3.0' ) ) ? $product->get_type() : $product->product_type;
			$defaults = array(
				'quantity' => 1,
				'class'    => implode( ' ', array_filter( array(
						'button',
						'product_type_' . $product_type,
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) )
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			wc_get_template( 'loop/add-to-cart.php', $args );
		}
	}	
	function ya_add_loop_compare_link(){
		global $product, $post;
		$product_id = $post->ID;
     echo '<div class="woocommerce product compare-button"><a href="javascript:void(0)" class="compare button" data-product_id="'. $product_id .'" rel="nofollow">'. esc_html__( '', 'yatheme' ) .'</a></div>';								
	}
	function ya_add_loop_wishlist_link(){
		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}
	function ya_add_wishlist_link(){
		global $product, $post;
		$product_id = $post->ID;
		$product_type = ( sw_woocommerce_version_check( '3.0' ) ) ? $product->get_type() : $product->product_type;
		if( $product_type != 'variable' ){
			
			echo '<div class="woocommerce product compare-button"><a href="javascript:void(0)" class="compare button" data-product_id="'. $product_id .'" rel="nofollow">'. esc_html__( '', 'yatheme' ) .'</a></div>';								
			echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
			
		}else{
			return ;
		}
	}
	function ya_add_wishlist_variation(){	
		global $product, $post;
		$product_id = $post->ID;
		echo '<div class="woocommerce product compare-button"><a href="javascript:void(0)" class="compare button" data-product_id="'. $product_id .'" rel="nofollow">'. esc_html__( '', 'yatheme' ) .'</a></div>';								
		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}

}

/*add second thumbnail loop product*/
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ya_woocommerce_template_loop_product_thumbnail', 10 );
	function ya_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post;
		$html = '';
		$id = get_the_ID();
		$gallery = get_post_meta($id, '_product_image_gallery', true);
		$attachment_image = '';
		if(!empty($gallery)) {
			$gallery = explode(',', $gallery);
			$first_image_id = $gallery[0];
			$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image back'));
		}
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
		
		/* quickview */
		$nonce = wp_create_nonce("ya_quickviewproduct_nonce");
		$link = admin_url('admin-ajax.php?ajax=true&amp;action=ya_quickviewproduct&amp;post_id='.$post->ID.'&amp;nonce='.$nonce);
		$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="group fancybox fancybox.ajax" title="Quick View Product"></a>';		
		
		if ( has_post_thumbnail() ){
			if( $attachment_image ){
				$html .= '<div class="product-thumb-hover">';
				$html .= '<a href="'.get_permalink($post->ID).'"  title="'.get_the_title($post->ID).'" class="item-link-thumb" >';
				$html .= (get_the_post_thumbnail( $post->ID, $size )) ? get_the_post_thumbnail( $post->ID, $size ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
				$html .= $attachment_image;
				$html .= '</a>';
				$html .= '<div class="woocommerce_quick_view">';
				$html .= $linkcontent;
				$html .= '</div>';
				$html .= '</div>';
			}else{
				$html .= (get_the_post_thumbnail( $post->ID, $size )) ? get_the_post_thumbnail( $post->ID, $size ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
			}			
			return $html;
		}else{
			$html .= '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
			return $html;
		}
	}
	function ya_woocommerce_template_loop_product_thumbnail(){
		echo ya_product_thumbnail();
	}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
/*
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'ya_woocommerce_template_single_excerpt', 35 );
function ya_woocommerce_template_single_excerpt() {
	wc_get_template( 'single-product/short-description.php' );
}
*/
/*filter order*/
function ya_addURLParameter($url, $paramName, $paramValue) {
     $url_data = parse_url($url);
     if(!isset($url_data["query"]))
         $url_data["query"]="";

     $params = array();
     parse_str($url_data['query'], $params);
     $params[$paramName] = $paramValue;
     $url_data['query'] = http_build_query($params);
     return ya_build_url($url_data);
}


function ya_build_url($url_data) {
 $url="";
 if(isset($url_data['host']))
 {
	 $url .= $url_data['scheme'] . '://';
	 if (isset($url_data['user'])) {
		 $url .= $url_data['user'];
			 if (isset($url_data['pass'])) {
				 $url .= ':' . $url_data['pass'];
			 }
		 $url .= '@';
	 }
	 $url .= $url_data['host'];
	 if (isset($url_data['port'])) {
		 $url .= ':' . $url_data['port'];
	 }
 }
 if (isset($url_data['path'])) {
	$url .= $url_data['path'];
 }
 if (isset($url_data['query'])) {
	 $url .= '?' . $url_data['query'];
 }
 if (isset($url_data['fragment'])) {
	 $url .= '#' . $url_data['fragment'];
 }
 return $url;
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action('woocommerce_before_shop_loop', 'ya_woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'ya_woocommerce_pagination', 55);
add_action('woocommerce_before_shop_loop','ya_woommerce_view_mode_wrap',15);
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
add_action('woocommerce_message','wc_print_notices', 10);

function ya_woommerce_view_mode_wrap () {
	$product_grid = isset($_COOKIE['product_grid']) ? $_COOKIE['product_grid'] : 0;
	$grid_sel = ( $product_grid == 1 ) ? 'sel' : '';
	$list_sel = ( $product_grid == 0 ) ? 'sel' : '';
	$html  = '';
	$html .= '<ul class="view-mode-wrap">
		<li class="view-grid '.$list_sel.'">
			<a><i class="icon-th"></i></a>
		</li>
		<li class="view-list '.$grid_sel.'">
			<a><i class="icon-list-ul"></i></a>
		</li>
	</ul>';
	echo $html;
}

function ya_woocommerce_pagination() {
	wc_get_template( 'loop/pagination.php' );
}

function ya_woocommerce_catalog_ordering() {
	global $data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	$query_string = '?'.$_SERVER['QUERY_STRING'];

	$option_number 	=  ya_options()->getCpanelValue( 'product_number' );
	// replace it with theme option
	if( $option_number ) {
		$per_page = $option_number;
	} else {
		$per_page = 8;
	}

	$pob = !empty( $params['orderby'] ) ? $params['orderby'] : get_option( 'woocommerce_default_catalog_orderby' );
	$po  = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
	$pc  = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	$html = '';
	$html .= '<div class="catalog-ordering">';

	$html .= '<div class="orderby-order-container">';

	$html .= '<ul class="orderby order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><span class="current-li-content"><a>'.__('Sort by', 'yatheme').'</a></span></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($pob == 'menu_order') ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'orderby', 'menu_order').'">'.__('Sort by Default', 'yatheme').'</a></li>';
	$html .= '<li class="'.(($pob == 'popularity') ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'orderby', 'popularity').'">'.__('Sort by Popularity', 'yatheme').'</a></li>';
	$html .= '<li class="'.(($pob == 'price') ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'orderby', 'price').'">'.__('Sort by Price', 'yatheme').'</a></li>';
	$html .= '<li class="'.(($pob == 'date') ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'orderby', 'date').'">'.__('Sort by Date', 'yatheme').'</a></li>';
	$html .= '<li class="'.(($pob == 'rating') ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'orderby', 'rating').'">'.__('Sort by Rating', 'yatheme').'</a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';
    $html .= '<ul class="order">';
	if($po == 'desc'):
	$html .= '<li class="desc"><a href="'.ya_addURLParameter($query_string, 'product_order', 'asc').'"><i class="icon-arrow-up"></i></a></li>';
	endif;
	if($po == 'asc'):
	$html .= '<li class="asc"><a href="'.ya_addURLParameter($query_string, 'product_order', 'desc').'"><i class="icon-arrow-down"></i></a></li>';
	endif;
	$html .= '</ul>';
	$html .= '<ul class="sort-count order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><a>'. $per_page .'</a></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($pc == $per_page) ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'product_count', $per_page).'">'.$per_page.'</a></li>';
	$html .= '<li class="'.(($pc == $per_page*2) ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'product_count', $per_page*2).'">'.($per_page*2).'</a></li>';
	$html .= '<li class="'.(($pc == $per_page*3) ? 'current': '').'"><a href="'.ya_addURLParameter($query_string, 'product_count', $per_page*3).'">'.($per_page*3).'</a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</div>';
	$html .= '</div>';
	
	echo $html;
}


add_action('woocommerce_get_catalog_ordering_args', 'ya_woocommerce_get_catalog_ordering_args', 20);
function ya_woocommerce_get_catalog_ordering_args($args)
{
	global $woocommerce;

	parse_str($_SERVER['QUERY_STRING'], $params);
	$orderby_value = !empty( $params['orderby'] ) ? $params['orderby'] : get_option( 'woocommerce_default_catalog_orderby' );
	$pob = $orderby_value;

	$po = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
	
	switch($po) {
		case 'desc':
			$order = 'desc';
		break;
		case 'asc':
			$order = 'asc';
		break;
		default:
			$order = 'asc';
		break;
	}
	$args['order'] = $order;

	if( $pob == 'rating' ) {
		$args['order']    = $po == 'desc' ? 'desc' : 'asc';
		$args['order']	  = strtoupper( $args['order'] );
	}

	return $args;
}
add_filter('loop_shop_per_page', 'ya_loop_shop_per_page');
function ya_loop_shop_per_page()
{
	global $data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	$option_number 	=  ya_options()->getCpanelValue( 'product_number' );
	// replace it with theme option
	if( $option_number ) {
		$per_page = $option_number;
	} else {
		$per_page = 8;
	}

	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	return $pc;
}
/*********QUICK VIEW PRODUCT**********/

add_action("wp_ajax_ya_quickviewproduct", "ya_quickviewproduct");
add_action("wp_ajax_nopriv_ya_quickviewproduct", "ya_quickviewproduct");
function ya_quickviewproduct(){
	
	$productid = (isset($_REQUEST["post_id"]) && $_REQUEST["post_id"]>0) ? $_REQUEST["post_id"] : 0;
	
	$query_args = array(
		'post_type'	=> 'product',
		'p'			=> $productid
	);
	$outputraw = $output = '';
	$r = new WP_Query($query_args);
	if($r->have_posts()){ 

		while ($r->have_posts()){ $r->the_post(); setup_postdata($r->post);
			global $product;
			ob_start();
			wc_get_template_part( 'content', 'quickview-product' );
			$outputraw = ob_get_contents();
			ob_end_clean();
		}
	}
	$output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $outputraw);
	echo $output;exit();
}

/*
**Hook into review for rick snippet
*/
add_action( 'woocommerce_review_before_comment_meta', 'ya_title_ricksnippet', 10 ) ;
function ya_title_ricksnippet(){
	global $post;
	echo '<span class="hidden" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
    <span itemprop="name">'. $post->post_title .'</span>
  </span>';
}
?>