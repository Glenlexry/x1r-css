<?php
	$colorset = ya_options()->getCpanelValue('scheme');
?>
<header id="header" role="banner" class="header hidden-md hidden-sm hidden-xs">
	<div class="top-header">
		<div id="header__container" class="container">
			<!--  Sidebar top -->
			<!-- <?php if (is_active_sidebar_YA('top')) {?>
				<div id="sidebar-top" class="sidebar-top">
					<?php dynamic_sidebar('top'); ?>
				</div>
			<?php }?> -->
			<?php if (is_active_sidebar_YA('top-header')) {?>
				<div id="sidebar-top-header" class="sidebar-top-header">
						<?php dynamic_sidebar('top-header'); ?>
				</div>
			<?php }?>
			<?php if ( has_nav_menu('top-logged-in') ) {?>
				<!-- Primary navbar -->
					<div id="main-menu" class="main-menu">
						<nav id="primary-menu" class="primary-menu" role="navigation">
							<div class="mid-header clearfix">
								<div class="navbar-inner navbar-inverse">
										<?php
											$menu_class = 'nav nav-pills';
											if ( 'mega' == ya_options()->getCpanelValue('menu_type') ){
												$menu_class .= ' nav-mega';
											} else $menu_class .= ' nav-css';
										?>
										<?php wp_nav_menu(array('theme_location' => 'top-logged-in', 'menu_class' => $menu_class)); ?>
								</div>
							</div>
						</nav>
					</div>
					<?php
						}
					?>
		</div>
	</div>
    <div class="header-msg">
		<div class="header-wrapper">
			<div class="right-header">
				<div id="header__container" class="container">
					<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
				<!-- Logo -->
				<div class="ya-logo pull-left">
					<a class="logo-top" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php if(ya_options()->getCpanelValue('sitelogo')){ ?>
							<img src="<?php echo esc_attr( ya_options()->getCpanelValue('sitelogo') ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php }else{
							if ($colorset){$logo = get_template_directory_uri().'/assets/img/logo-'.$colorset.'.png';}
							else $logo = get_template_directory_uri().'/assets/img/logo-default.png';
						?>
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php } ?>
					</a>
				</div>

				<?php if ( has_nav_menu('primary_menu') ) {?>
				<!-- Primary navbar -->
					<div id="main-menu" class="main-menu">
						<nav id="primary-menu" class="primary-menu" role="navigation">
							<div class="mid-header clearfix">
								<a href="#" class="phone-icon-menu"></a>
								<div class="navbar-inner navbar-inverse">
										<?php
											$menu_class = 'nav nav-pills';
											if ( 'mega' == ya_options()->getCpanelValue('menu_type') ){
												$menu_class .= ' nav-mega';
											} else $menu_class .= ' nav-css';
										?>
										<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => $menu_class)); ?>

			                                <div id="toggle-search" class="product-search">
			                                   <a href="#">PRODUCT SEARCH <i class="fa fa-search"></i></a>
			                                </div>
			                                <form id="search-form" action="product-rangesearch.php" method="POST">
			                                   <fieldset>
			                                      <div class="col-md-4 no-paddings">
			                                         <select id="type" name="type" class="col-md-12 no-paddings">
			                                              <option value="selected">Select Type</option>
			                                              <option value="application">APPLICATION</option>
			                                              <option value="product">PRODUCT</option>
			                                            </select>
			                                      </div>
			                                      <div class="col-md-8 no-paddings">
			                                          <select id="productpage" name="productpage" class="col-md-12 no-paddings">
			                                              <option value="selected">Select Application</option>
			                                              <option value="/product/fuel-system-cleaner/">SYSTEM CLEANER</option>
			                                              <option value="/product/petrol-system-treatment/">FUEL PETROL TREATMENT</option>
			                                              <option value="/product/engine-flush/">ENGINE FLUSH</option>
			                                              <option value="/product/automatic-transmission-treatment/">AUTOMATIC TRANSMISSION TREATMENT</option>
			                                            </select>
			                                          <input type="text" name="search" id="search" class="col-md-12 no-paddings hide" placeholder="  Search" maxlength="100">
			                                      </div>
			                                   </fieldset>
			                                   <button type="button" id="closeButton2" class="btn btn-theme-color"><img src="http://s3-ap-southeast-1.amazonaws.com/x1r-wp-staging/wp-content/uploads/2018/03/19125945/close.png"></button>
			                                </form>
								</div>
							</div>
						</nav>
					</div>
					<!-- /Primary navbar -->
					<?php
						}
					?>
				</div>
			</div>
		</div>
    </div>
</header>

<header id="header" role="banner" class="header hidden-lg">

	    <div class="header-msg">
		<div class="header-wrapper">
			<div class="right-header">
				<div class="container">
					<div class="navbar-header">
<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <img src="<?php echo esc_attr( ya_options()->getCpanelValue('sitelogo') ); ?>" width="95" alt="">
        </a>
        <button type="button mobile-button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarResponsive" aria-expanded="false" aria-controls="navbarResponsive">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
         <?php /* Primary navigation */
			wp_nav_menu( array(
			  'menu'              => 'header_menu',
              'theme_location'    => 'header_menu',
                        'depth'             => 5,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'main-menu',
                        'menu_class'        => 'nav navbar-nav navbar-right',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
			);
			?>
			<?php if (is_active_sidebar_YA('top-header')) {?>
				<div id="sidebar-top-header" class="sidebar-top-header">
						<?php dynamic_sidebar('top-header'); ?>
				</div>
			<?php }?>
        </div>
      </div>
      <div class="mobile-search">
            <div class="product-search-mo">
                <div id="toggle-search-mo" class="product-search">
                    <a href="#">PRODUCT SEARCH <i class="fa fa-search"></i></a>
                </div>
                <div>
                    <form id="search-form-mo" action="product-rangesearch.php"  method="POST">
                        <fieldset>
                            <div class="col-xs-4 mob-place-t no-paddings">
                                 <select id="type-mo" name="type-mo" class="col-md-12 no-paddings">
                                              <option value="selected">Select Type</option>
                                              <option value="application">APPLICATION</option>
                                              <option value="product">PRODUCT</option>
                                            </select>
                            </div>

                            <div class="col-xs-8 mob-place-a no-paddings">
                                <select id="productpage-mo" name="productpage-mo" class="col-md-12 no-paddings">
                                            <span class="btn-select-arrow fa fa-angle-down"></span>
                                              <option value="selected">Select Application</option>
                                              <option value="/product/fuel-system-cleaner/">SYSTEM CLEANER</option>
                                              <option value="/product/petrol-system-treatment/">FUEL PETROL TREATMENT</option>
                                              <option value="/product/engine-flush/">ENGINE FLUSH</option>
                                              <option value="/product/automatic-transmission-treatment/">AUTOMATIC TRANSMISSION TREATMENT</option>
                                            </select>

                               <input type="text" name="search-mo" id="search-mo" class="col-md-12 no-paddings hide" placeholder="  Search" maxlength="100">

                            </div>
                        </fieldset>
                        <button type="button" id="closeButton-mo" class="btn btn-theme-color"><img src="http://s3-ap-southeast-1.amazonaws.com/x1r-wp-staging/wp-content/uploads/2018/03/19125945/close.png"></button>
                        <button type="submit" form="search-form-mo" value="Submit" id="searchButton" class="btn btn-theme-color hide"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


</div>
</div>
</div>
</div>
</div>
</header>
