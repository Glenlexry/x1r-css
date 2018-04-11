<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$sidebar = ya_options() -> getCpanelValue('sidebar_product');
?>

<?php get_template_part('header'); ?>

<div class="container">
<div class="row m-top-60">
<div id="contents-detail" class="col-lg-12 col-md-12 col-sm-12" role="main">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	<div class="single-product clearfix">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
<!--- contents-detail -->
</div>

<div class="row">
	<div class="container related-product">
		<div class="col-md-12 relate-title-pad">
            <div class="heading-title text-left heading-border-bottom">
              <h4 class="text-uppercase">Related Products</h4>
            </div>
         </div>
		<?php echo do_shortcode("[wpb-product-slider theme='grid_no_animation' items='4' items_desktop_small='3' items_tablet='2' items_mobile='1']"); ?>
	</div>
</div>

<?php if ( is_active_sidebar_YA('right-detail-product') && $sidebar == 'right' ):
	$right_span_class = 'col-lg-'.ya_options()->getCpanelValue('sidebar_right_expand');
	$right_span_class .= ' col-md-'.ya_options()->getCpanelValue('sidebar_right_expand_md');
	$right_span_class .= ' col-sm-'.ya_options()->getCpanelValue('sidebar_right_expand_sm');
?>
<aside id="right" class="sidebar <?php echo esc_attr($right_span_class); ?>">
	<?php dynamic_sidebar('right-detail-product'); ?>
</aside>
<?php endif; ?>
</div>
</div>
<div class="full-banner">
          <div class="container ">
            <div class="row">
              <div class="col-md-8" style="text-align: center">
                <div class="heading-title-alt inline-block">
                  <h2 class="text-uppercase light-txt">NEED HELP FINDING THE RIGHT PRODUCT?</h2>
                </div>
              </div>
              <div class="col-md-4" style="text-align: center">
                <div class="m-top-0">
                  <a href="/contact-us" class="btn btn-medium btn-dark-solid"> X-1R SUPPORT </a>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php get_template_part('footer'); ?>
