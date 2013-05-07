
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
           
            <?php $cat_menu = $smof_data['cat_menu'];?>
            <?php $post_per_page = $smof_data['num-post-popular'];

                  if($post_per_page!="" || $post_per_page!=" "){

                  $query = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$cat_menu,'posts_per_page'=>$post_per_page));
                  }else{

                  $query = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$cat_menu));
                  }
            ?>
                  
            <?php if($query->have_posts()):?>

            <h3><a><?php echo $cat_menu;?></a></h3> 
            <section class="gallery-hover clearfix">
            <?php while($query->have_posts()): $query->the_post();?>
            
                    <div class="view view-fifth">
                        <?php if(has_post_thumbnail()){
                        the_post_thumbnail('product-thumb');
                        }?>
                        <div class="mask">
                            <h2><?php the_title();?></h2>
                            <p><span class="price">
                            <?php $meta_price = get_post_meta($post->ID, 'sp_product_price', true); 
                            echo $meta_price!=''?$meta_price.' $':'';?>
                            </span></p>
                            <a href="<?php the_permalink(); ?>" class="info">VIEW DETAIL</a>
                        </div>
                    </div> 
            
            <?php endwhile;?>
            </section>
            <!-- END Gallery Hover Effects -->
            <div class="clearfix"></div>
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