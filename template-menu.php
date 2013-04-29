<?php
/*
Template Name: Template Menu
*/
?>
<?php get_header(); ?>
	 <div class="container">
	 	  <div class="content-inner">
	 	   	  <div class="menu-content">
	 	   	  	    <?php if(have_posts()):?>
	 	   	  	    <?php while(have_posts()): the_post();?>
	 	   	  	    <h1><?php the_title();?></h1>
	 	   	  	    <p><?php the_content();?></p>
	 	   	  	    <?php endwhile;?>
	 	   	  	    <?php endif;?>
	 	   	  </div>
              <!--START MENU OPTIONS TABS-->
	 	   	  <div class="menu-option">
	 	   	  	    <h3>Please choose menu options</h3>
	 	   	  	    <?php
	 	   	  	    $cat_menu = $smof_data['cat_menu'];  // POPULAR Drink
                $cat_special = $smof_data['cat_special'];  // SPECIALS Drink  
	 	   	  	    //echo $cat_menu;
	 	   	  	    $args = array(
							'type'                     => 'sp_menu',
							//'child_of'                 => 0,
							//'parent'                   => '',
							'orderby'                  => 'name',
							'order'                    => 'ASC',
							'taxonomy'                 => 'menu-category');
	 	   	  	    ?>
	 	   	  	    <ul class="tabs-menu">
	 	   	  	    <?php $categories = get_categories($args); 
	 	   	  	          $i = 1;
	 	   	  	          $get_cat[] = array();
	 	   	  	          foreach($categories as $cat){
	 	   	  	          	  
                            if($cat->parent == 0 ){
                              	$parent = $cat->name;
                              	if($parent==$cat_menu || $parent==$cat_special) // take Category POPULAR Drink out
                              	{
                                    // thing is empty;
                              	}else{
                                    $get_cat[$i-1] = $cat->term_id;//cat_ID
                              		echo "<li><a href='#menu-option-".$i."'>".$parent."</a></li>";
                              		$i++;
                              	}
                            }// end if parent
	 	   	  	          }
	 	   	  	    ?>
	 	   	  	    </ul>

	 	   	  	    <?php // Store array children of each parent
                        $option_arr_one = array();
                        $option_arr_two = array();
                        foreach ($get_cat as $get_c) {
                        $child_cat_id =$get_c;
                        $arg = array('orderby' => 'term_order',
                                'child_of' => $child_cat_id,
                                'type'     => 'sp_menu',
                                'taxonomy' => 'menu-category');
                        if($child_cat_id == $get_cat[0]){
                            $child_cats = get_categories($arg);
                            foreach ($child_cats as $child_cat) {
                                 array_push($option_arr_one, $child_cat->name);
                            }// end foreach

                        }// end if
                        elseif ($child_cat_id == $get_cat[1]) {
                            $child_cats = get_categories($arg);
                            foreach ($child_cats as $child_cat) {
                                 array_push($option_arr_two, $child_cat->name);
                            }// end foreach
                            
                        }// end else if

                        }// end foreach parent
                    
                    ?>
	 	   	  	   
	 	   	  </div>
              <!--END MENU OPTIONS TABS-->
              <!--START MENU CONTENTS TABS-->
              <div class="tabs-menu-container">
              	<div id="menu-option-1" class="tab-menu-content">
                	
                    <div class="top-navigation clearfix">
                         <span><a class="top-prev">
                        	  <img src="<?php bloginfo('template_url');?>/images/previous.png" width="9" height="15"/></a></span>
                         <span class="title-menu">
                              <ul class="slider-nav">
                                  <?php foreach ($option_arr_one as $option_one) {
                                        echo '<li><a href="#">'.$option_one.'</a></li>';
                                        }?>

                              </ul>
                         </span>
                         <span><a class="top-next">
                        	  <img src="<?php bloginfo('template_url');?>/images/next.png" width="9" height="15"/></a></span>
                    </div>
                    <!--end .top-navigation .clearfix-->
                  
                  <div class="gallery menu-gallery clearfix">
                    
                    <div class="inner-menu ">
                          <?php foreach ($option_arr_one as $option_1) { ?>
                              <?php $query_post = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$option_1));?>
                              <?php if($query_post->have_posts()): ?>
                              <div class="slides">
                              <?php while($query_post->have_posts()): $query_post->the_post(); ?>
                              <div class="view view-fifth">
                                   <?php if(has_post_thumbnail()){
                                         the_post_thumbnail('product-thumb');
                                   }?>
                                   <div class="mask">
                                      <h2><?php the_title();?></h2>
                                      <p><span class="price">
                                      <?php $meta_price = get_post_meta($post->ID, 'sp_product_price', true); 
                                      echo $meta_price!=''?'$'.$meta_price:'';?>
                                      </span></p>
                                      <a href="<?php the_permalink(); ?>" class="info">View Detail</a>
                                   </div>
                              </div>
                              <?php endwhile; ?>
                              </div>
                              <!-- end .slides -->
                              <?php endif; ?>
                              <?php wp_reset_postdata(); ?>
                              <?php  }//end foreach ?>
                    </div>
                    <!-- end .inner-menu -->
                    
                    <div class="clearfix"></div>
                  </div>
                  <!-- end .gallery .menu-gallery -->
                </div>
                <!-- end #menu-option-1 .tab-menu-content -->
                
                <div id="menu-option-2" class="tab-menu-content">
                	<div class="top-navigation clearfix">
                         <span><a class="top-prev">
                        	  <img src="<?php bloginfo('template_url');?>/images/previous.png" width="9" height="15"/></a></span>
                         <span class="title-menu">
                              <ul class="slider-nav">
                                  <?php foreach ($option_arr_two as $option_two) {
                                        echo '<li><a href="#">'.$option_two.'</a></li>';
                                        }
                                  ?>
                              </ul>
                         </span>
                         <span><a class="top-next">
                        	  <img src="<?php bloginfo('template_url');?>/images/next.png" width="9" height="15"/></a></span>
                    </div>
                    <!--end .top-navigation .clearfix-->
                    <div class="gallery menu-gallery clearfix">
                         <div class="inner-menu">
                              <?php foreach ($option_arr_two as $option_2) { ?>
                              <?php $query_post = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$option_2));?>
                              <?php if($query_post->have_posts()): ?>
                              <div class="slides">
                              <?php while($query_post->have_posts()): $query_post->the_post(); ?>
                              <div class="view view-fifth">
                                   <?php if(has_post_thumbnail()){
                                         the_post_thumbnail('product-thumb');
                                   }?>
                                   <div class="mask">
                                      <h2><?php the_title();?></h2>
                                      <p><span class="price">
                                      <?php $meta_price = get_post_meta($post->ID, 'sp_product_price', true); 
                                      echo $meta_price!=''?'$'.$meta_price:'';?>
                                      </span></p>
                                      <a href="<?php the_permalink(); ?>" class="info">View Detail</a>
                                   </div>
                              </div>
                              <?php endwhile; ?>
                              </div>
                              <!-- end .slides -->
                              <?php endif; ?>
                              <?php wp_reset_postdata(); ?>
                              <?php  }//end foreach ?>
                             
                         </div>
                         <!-- end .inner-menu -->
                    
                         <div class="clearfix"></div>
                    </div>
                    <!-- end .gallery .menu-gallery -->

                </div>
                <!-- end #menu-option-2 .tab-menu-content -->
              </div>
              <!--END MENU CONTENTS TABS-->
              
		  </div>
		  <!-- end .content-inner -->
	 </div>
	 <!-- end .container -->
<?php get_footer(); ?>