<?php while (have_posts()) : the_post(); ?>
  <?php setPostViews(get_the_ID()); ?>
  <div <?php post_class(); ?>>
	<?php $pfm = get_post_format();?>
    <header class="header-single">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="pull-left">
            <ul class="post-meta2">
                <li><i><img src="http://s3-ap-southeast-1.amazonaws.com/x1r-wp-staging/wp-content/uploads/2018/03/19003430/date.png"></i> <?php echo ( get_the_title() ) ? date( 'j F Y',strtotime($post->post_date)) : '<a href="'.get_the_permalink().'">'.date( 'j F Y',strtotime($post->post_date)).'</a>'; ?></li>
                <li><i><img src="http://s3-ap-southeast-1.amazonaws.com/x1r-wp-staging/wp-content/uploads/2018/03/20144815/pen.png"></i> <?php echo get_the_author(); ?></li>
            </ul>
        </div>
    </header>
    <div class="entry-content">
	<?php if( $pfm == '' || $pfm == 'image' ){?>
	  <?php if( has_post_thumbnail() ){ ?>
	  <div class="single-thumb">
		<?php the_post_thumbnail(); ?>
	  </div>
	  <?php } }?>
	  <div class="single-content">
		  <?php the_content(); ?>
		  <!-- Tag -->
		  <?php if(get_the_tag_list()) { ?>
		  <div class="single-tag">
				<?php echo get_the_tag_list('<span>Tags: </span>',', ','');  ?>
		  </div>
		  <?php } ?>
	  </div>
	  <!-- Social -->
	  <?php get_social(); ?>
	  <!-- link page -->
	  <?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'yatheme' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>
	  <!-- Relate Post -->
	  <?php 
			global $post;
			global $related_term;
			$categories = get_the_category($post->ID);								
			$category_ids = array();
			foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
			if ($categories) {
			$related = array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=>3,
				'orderby'	=> 'rand',	
				'ignore_sticky_posts'=>1
			   );
		?>
	  <!-- <div class="single-post-relate">
		<h3><?php _e('Related Posts:', 'yatheme'); ?></h3>
		<div class="row">
		<?php
			$related_term = new WP_Query($related);
			while($related_term -> have_posts()):$related_term -> the_post();
		?>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<div class="item-relate-img">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				</div>
				<div class="item-relate-content">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p>
						<?php
							$text = strip_shortcodes( $post->post_content );
							$text = apply_filters('the_content', $text);
							$text = str_replace(']]>', ']]&gt;', $text);
							$content = wp_trim_words($text, 10,'...');
							echo esc_html($content);
						?>
					</p>
				</div>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		?>
		</div>
	  </div> -->
	  <?php } ?>
    </div>
    <div class="pagination-row">
			<div class="pagination-post">
			    <div class="prev-post">
			        <a href="#">
			            <div class="arrow">
			                <i class="fa fa-long-arrow-left"></i>
			            </div>
			            <div class="pagination-txt">
			             <span>PREVIOUS NEWS</span>
			             <small>Lorem Ipsum Dolor Sit Amet</small>
			            </div>
			        </a>
			    </div>

			    <div class="next-post">
			        <a href="#">
			            <div class="arrow">
			                <i class="fa fa-long-arrow-right"></i>
			            </div>
			            <div class="pagination-txt">
			                <span>NEXT NEWS</span>
			                 <small>Lorem Ipsum Dolor Sit Amet</small>
			            </div>
			        </a>
			    </div>
			</div>
	</div>

	<div class="clearfix our-news inline-block m-top-0 m-bot-0">
      <div class="pull-left">
      	<h3>Don’t want to missed our news?</h3>
       	<p>Follow us on our social media to get or quicker 
        updates and promotions!</p>
      </div>
      <div class="pull-right">
        <div class="widget-social-link circle">
		    
		    <div class="gplus">
		    <a href="#"><i class="fa fa-google-plus"></i></a>
		    </div>
		   
		    <div class="tws">
		    <a href="#"><i class="fa fa-twitter"></i></a>
		    </div>
		     
		    <div class="fbs">
		    <a href="#"><i class="fa fa-facebook"></i></a>
		    </div>
		    
		</div>
       </div>
   	</div>
    <?php comments_template('/templates/comments.php'); ?>
  </div>
<?php endwhile; ?>
<div class="vc_empty_space" style="height: 100px"><span class="vc_empty_space_inner"></span></div>



