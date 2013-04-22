<?php get_header(); ?>
<?php global $smof_data; ?>
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
            <?php 
            /*$args = array(
                'type'          => 'sp_menu',
                'orderby'       => 'name', 
                'taxonomy'      => 'menu-category',
            );
            $cats = get_categories( $args ); 

            foreach($cats as $cat){
              //if($cat->name =='POPULAR DRINK'){
                // $popular = 
               echo $cat->term_id." = ".$cat->name."<br>";
              //}
            } */?>
            <?php $cat_menu = $smof_data['cat_menu'];?>
            <?php $query = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$cat_menu));?>
            <?php if($query->have_posts()):?>

            <h3><a href="#"><?php echo $cat_menu;?></a></h3> 
            <?php while($query->have_posts()): $query->the_post();?>
            <div class="item-gallery">
                  <div class="item-img">
                  <?php if(has_post_thumbnail()){
                     the_post_thumbnail();
                  }?>
                  <h6><?php the_title();?><h6>
                  </div>
                  <div class="item-desc">
                        
                        <div class="desc-detail">
                         <h5><?php the_title();?></h5>
                         <?php the_excerpt();?>
                         <h6><a href="<?php the_permalink(); ?>">VIEW DETAIL</a></h6>
                        </div>
                        <div class="social-network">
                           Share it to:
                           <img src="<?php bloginfo('template_url');?>/images/facebook-like.jpg" width="248" height="29"/> 
                        </div>
                  </div>
            </div>
            <!-- end .item-gallery -->
            <?php endwhile;?>
            <div class="view-full-menu">
               <?php $menu_page = $smof_data['page_menu'];?>
                      <?php $menu_slug = get_page_by_path($menu_page); // get page by slug name?>
                      <?php $menu_url = get_page_link($menu_slug->ID); // id?>
               <h6><a href="<?php echo $menu_url;?>">VIEW FULL MENU</a></h6>
            </div>
            <?php endif;?>
               
	 	  </div>
	 </div>
	 <!-- end .container -->
 </div>
 <!-- end .main-container -->

<?php get_footer(); ?>