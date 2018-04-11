<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $post;
$col_lg = ya_options()->getCpanelValue('product_col_large');
$col_lg_feature = ya_options()->getCpanelValue('product_col_feature');
$col_md = ya_options()->getCpanelValue('product_col_medium');
$col_sm = ya_options()->getCpanelValue('product_col_sm');
$col_large = 12 / $col_lg;
$col_large_feature = 12 / $col_lg_feature;
$column1 = 12 / $col_md;
$column2 = 12 / $col_sm;
$class_col_feature= "";
$class_col= "";

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$class_col_feature .= ' col-lg-'.$col_large_feature.' col-md-'.$column1.' col-sm-'.$column2.'';
$class_col .= ' col-lg-'.$col_large.' col-md-'.$column1.' col-sm-'.$column2.'';

if (0 == ( $woocommerce_loop['loop']  ) % $col_lg || 1 == $col_lg ) {
	$class_col .= ' clear_lg';
}
if ( 0 == ( $woocommerce_loop['loop']  ) % $col_md || 1 == $col_md ) {
	$class_col .= ' clear_md';
}
// if ( 0 == ( $woocommerce_loop['loop'] ) % $col_sm || 1 == $col_sm ) {
// 	$class_col .= ' clear_sm';
// }

?>
<li id="hidden-home" <?php post_class( $class_col ); ?> >
	<div class="product-list clearfix">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <div class="product-img">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo $product->get_image(); ?>
			</a>
            <!-- <div class="ribbon"><span>new</span></div> -->
        </div>

        <div class="product-brd">
            <div class="product-title">
                <h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h5>
            </div>

            <div class="product-dec">
                <?php echo get_post_meta( get_the_ID(), 'description', true ); ?>
            </div>

            <div class="product-price noprice">
                <?php echo $product->get_price_html(); ?>
            </div>

            <div class="feature-view-more">
            	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="button feature-button">VIEW PRODUCT</a>
            </div>

            <div class="item-bottom">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
        </div>
    </div>

	<!-- <div class="products-entry clearfix">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );

			?>
			<?php $nonce = wp_create_nonce("ya_quickviewproduct_nonce");
				$link = admin_url('admin-ajax.php?ajax=true&amp;action=ya_quickviewproduct&amp;post_id='.$post->ID.'&amp;nonce='.$nonce);
				$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax sm_quickview_handler-list" title="Quick View Product">'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</a>';
				echo $linkcontent; ?>
		</div>

		<div class="products-content">
			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h4>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<?php if ( $price_html = $product->get_price_html() ){?>
			<div class="item-price">
				<span>
					<?php echo $price_html; ?>
				</span>
			</div>
			<?php } ?>
			<div class="desc std">
	        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
            </div>
			<div class="item-bottom">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_price - 10
             */
            ?>
		</div>
	</div> -->
</li>

<li id="hidden-all-product" <?php post_class( $class_col_feature); ?> >
	<div class="product-list clearfix">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
        <div class="product-img">
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo $product->get_image(); ?>
			</a>
            <!-- <div class="ribbon"><span>new</span></div> -->
        </div>

        <div class="product-brd">
            <div class="product-title">
                <h5><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h5>
            </div>

            <div class="product-dec">
                <?php echo get_post_meta( get_the_ID(), 'description', true ); ?>
            </div>

            <div class="product-price noprice">
                <?php echo $product->get_price_html(); ?>
            </div>

            <div class="feature-view-more">
            	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="button feature-button">VIEW PRODUCT</a>
            </div>

            <div class="item-bottom">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
        </div>
    </div>

	<!-- <div class="products-entry clearfix">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="products-thumb">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );

			?>
			<?php $nonce = wp_create_nonce("ya_quickviewproduct_nonce");
				$link = admin_url('admin-ajax.php?ajax=true&amp;action=ya_quickviewproduct&amp;post_id='.$post->ID.'&amp;nonce='.$nonce);
				$linkcontent ='<a href="'. $link .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax sm_quickview_handler-list" title="Quick View Product">'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</a>';
				echo $linkcontent; ?>
		</div>

		<div class="products-content">
			<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a></h4>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<?php if ( $price_html = $product->get_price_html() ){?>
			<div class="item-price">
				<span>
					<?php echo $price_html; ?>
				</span>
			</div>
			<?php } ?>
			<div class="desc std">
	        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
            </div>
			<div class="item-bottom">
				<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_price - 10
             */
            ?>
		</div>
	</div> -->
</li>
