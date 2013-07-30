
<?php get_header(); ?>
<?php global $smof_data; ?>
<?php $cp_query = new WP_Query(array('post_type'=>'sp_slide','posts_per_page'=>4)); ?>
  
<?php if($cp_query->have_posts()) : ?>
<div id="featured-container">
    <div class="featured-slideshow container">
    <?php while($cp_query->have_posts()): $cp_query->the_post(); ?>
      <div class="item-slide">
          <?php if (has_post_thumbnail()) {
          the_post_thumbnail();
          }?>
          <!--<div class="slide-content">
                <div class="slide-cont-info">
                      <a class="new-promotion" href="#"><?php echo get_post_meta($post->ID, 'sp_product_promotion', true); ?></a>
                      <h1><?php the_title();?></h1>
                      <p><?php the_content();?></p>
                      <a class="learn-more" href="<?php echo get_post_meta($post->ID, 'sp_product_url', true);?>">
                      Learn more</a>
                </div>
          </div> -->
          <!-- end .slide-content -->
      </div>
    <!-- end .item-slide -->
    <?php endwhile; ?>
    
    <div class="slide-nav"></div>
    
    </div> <!-- end .featured-slideshow .container -->
</div> <!-- end #featured-container -->

<?php else:?>
<h1>No any slides has created.</h1>
<?php endif; ?>
 <div class="main-container">
	 <div class="container">
	 	  <div class="gallery clearfix">
           
           <?php
		   //view full menu link 
		   $menu_page = $smof_data['page_menu'];
		   $menu_slug = get_page_by_path($menu_page); // get page by slug name
           $menu_url = get_page_link($menu_slug->ID); // id
		   
		   $special_page = $smof_data['page_special'];
		   $special_slug = get_page_by_path($special_page); // get page by slug name
           $special_url = get_page_link($special_slug->ID); // id
		   ?>
                      
            <?php 
			$cat_top_12 = $smof_data['cat_special'];
            $title_top_12 = (string)$smof_data['title_top_12'];
            $post_per_page = $smof_data['num-post-top-12'];
            
            $terms = get_terms('menu-category');

            foreach ( $terms as $term ) {
            	if ( $term->name == $cat_top_12 )
            		$tax_id = $term->term_id;
            }

            $query = new WP_Query(array(
            					'post_type'=>'sp_menu',
            					'tax_query' => array(
										array(
											'taxonomy' => 'menu-category',
											'field' => 'id',
											'terms' => $tax_id
										)
									),
            					'posts_per_page'=>$post_per_page
            					));
            ?>
                  
            <?php if($query->have_posts()):?>
            
			<?php echo '<h3><a href="' . $special_url . '">' .$title_top_12 . $term_id .'</a></h3>';?> 
            
            <section class="gallery-hover clearfix">
            <?php while($query->have_posts()): $query->the_post();?>
            
                    <div class="view view-fifth">
                        <?php if(has_post_thumbnail()){
                        the_post_thumbnail('product-thumb');
                        }?>
                        <div class="mask">
                            <h2><?php the_title();?></h2>
                            <p><span class="price">
                            <?php $meta_price1 = get_post_meta($post->ID, 'sp_medium_price', true); 
                            echo $meta_price1!=''?_e('Medium ','sptheme').$meta_price1.' $':'';?>
                            <?php $meta_price2 = get_post_meta($post->ID, 'sp_large_price', true); 
                            echo $meta_price2!=''?_e('Large','sptheme') .$meta_price2.' $':'';?>
                            </span></p>
                            <?php if($meta_price1=='' and $meta_price2==''){

                            }else{?>
                            <a href="<?php the_permalink(); ?>" class="info"><?php echo _e('VIEW DETAIL', 'sptheme'); ?></a>
                            <?php }?>
                  
                        </div>
                    </div> 
            
            <?php endwhile;?>
            </section>
            <!-- END Gallery Hover Effects -->
            <div class="clearfix"></div>
            <div class="view-full-menu">
               <h6><a href="<?php echo $menu_url;?>"><?php echo _e('VIEW FULL MENU', 'sptheme'); ?></a></h6>
            </div>
            <?php endif;?>
               
	 	  </div>
	 </div>
	 <!-- end .container -->
 </div>
 <!-- end .main-container -->

<?php get_footer(); ?>