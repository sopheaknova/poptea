<?php get_header(); ?>

<?php $cp_query = new WP_Query(array('post_type'=>'sp_slide','posts_per_page'=>4)); ?>
  
<?php if($cp_query->have_posts()) : ?>
<div class="featured">
<?php while($cp_query->have_posts()): $cp_query->the_post(); ?>
  <div class="item-slide">
      <?php if (has_post_thumbnail()) {
      the_post_thumbnail();
      }?>
      <div class="slide-content">
            <div class="slide-cont-info">
                  <a class="new-promotion" href="#"><?php echo get_post_meta($post->ID, 'sp_product_promotion', true); ?></a>
                  <h1><?php the_title();?></h1>
                  <p><?php the_content();?></p>
                  <a class="learn-more" href="<?php echo get_post_meta($post->ID, 'sp_product_url', true);?>">
                  Learn more</a>
            </div>
      </div> 
      <!-- end .slide-content -->
  </div>
<!-- end .item-slide -->
<?php endwhile; ?>
</div>
<div class="slide-nav"></div>
<!-- end .featured -->
<?php else:?>
<h1>No any slides has created.</h1>
<?php endif; ?>
 <div class="main-container">
	 <div class="container">
	 	  <div class="gallery clearfix">
           <?php ?>
	 	  	   <h3><a href="#">POPULAR DRINK</a></h3>  
               <div class="item-gallery">
               	    <div class="item-img">
               	        <a href="#">
               	        <img src="<?php bloginfo('template_url');?>/images/grapefruit-1.jpg" height="176" width="114" /></a>
               	        <h6>Grapefruit</h6>
               	        
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="#">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	        <a href="">
               	        <img src="<?php bloginfo('template_url');?>/images/strawberry.jpg" height="176" width="151" /></a>
               	        <h6>Strawberry</6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/strawberry-1.jpg" height="176" width="131" /></a>
               	    <h6>Strawberry</h6>
               	    </div>
               	    <div class="item-desc">
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/strawberry.jpg" height="176" width="151" /></a>
               	    <h6>Strawberry</h6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/grapefuit.jpg" height="176" width="144" /></a>
               	    <h6>Grapefruit</h6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/strawberry-1.jpg" height="176" width="131" /></a>
               	    <h6>Strawberry</h6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/grapefruit-1.jpg" height="176" width="114" /></a>
               	    <h6>Strawberry</h6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <!-- end .item-gallery -->
               <div class="item-gallery">
               	    <div class="item-img">
               	    <a href="">
               	    <img src="<?php bloginfo('template_url');?>/images/grapefruit-1.jpg" height="176" width="114" /></a>
               	    <h6>Strawberry</h6>
               	    </div>
               	    <div class="item-desc">
               	    	
               	    	<div class="desc-detail">
	               	    <h5>Strawberry Lemonaes</h5>
	               	    Lucious strawberry lemonade with
	               	    flavourful basil seeds.
	               	    <h6><a href="">VIEW DETAIL</a></h6>
	               	    </div>
	               	    <div class="social-network">
	               	    	Share it to:
	               	    	<img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
	               	    </div>
                    </div>
               </div>
               <div class="clearfix"></div>
               <!-- end .item-gallery -->
               <div class="view-full-menu">
               	     <h6><a href="#">VIEW FULL MENU</a></h6>
               </div>
	 	  </div>
	 </div>
	 <!-- end .container -->
 </div>
 <!-- end .main-container -->

<?php get_footer(); ?>