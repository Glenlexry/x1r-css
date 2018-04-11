<?php global $template;
	$footer_style = ya_options() -> getCpanelValue( 'footer_style' );
?>
<?php if (is_active_sidebar_YA('above-footer')){ ?>
	<div class="sidebar-above-footer theme-clearfix" id="sidebar-above-footer">					
		<?php dynamic_sidebar('above-footer'); ?>
	</div>
<?php } ?>
<?php 
	if($footer_style == 'default') {
?>
<footer class="footer theme-clearfix footer-<?php echo $footer_style; ?>" role="contentinfo">
	<div class="footer-in theme-clearfix">
		<div class="container theme-clearfix">
			<div class="row">
				<?php if (is_active_sidebar_YA('footer')){ ?>
					<div class="col-lg-12 col-md-12 col-sm-12 sidebar-footer">					
						<?php dynamic_sidebar('footer'); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<div class="copyright theme-clearfix">
		<div class="container clearfix">
			<div class="copyright-text pull-left">
				<div>&copy; 2017 X-1R. ASIA</div>
			</div>
			<?php if (is_active_sidebar_YA('footer-copyright')){ ?>
				<div class="sidebar-copyright pull-right">					
					<?php dynamic_sidebar('footer-copyright'); ?>
				</div>
			<?php } ?>
			
		</div>
	</div>
</footer>
<?php 
	} else {
		get_template_part('templates/footer', $footer_style);
	}
?>
<?php if (is_active_sidebar_YA('floating') ){ ?>
	<div class="floating theme-clearfix">
		<?php dynamic_sidebar('floating');  ?>
	</div>
<?php } ?>
<?php if(ya_options()->getCpanelValue('back_active') == '1') { ?>
<a id="ya-totop" href="#" ></a>
<?php }?>
</div>
<?php if( ya_options()-> getCpanelValue( 'effect_active' ) == 1 ){ ?>
<?php if( is_home() || is_front_page() ){?>
<script type="text/javascript">
jQuery(function($){
	// The starting defaults.
    var config = {
        reset: true,
        init: true
    };
    window.scrollReveal = new scrollReveal( );
});
</script>
<?php } } ?>
<?php wp_footer(); ?>