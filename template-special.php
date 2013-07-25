<?php
/*
Template Name: Template Special
*/
?>
<?php get_header(); ?>
<div class="container">
    <div class="content-inner">
        <div class="special-content">
              <?php if(have_posts()):?>
              <?php while(have_posts()): the_post();?>
              <h1><?php the_title();?></h1>
              <p><?php the_content();?></p>
              <?php endwhile;?>
              <?php endif;?>
        </div>
        <div class="gallery clearfix">
            <?php 
			$cat_menu = $smof_data['cat_special'];
            
			$query = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$cat_menu,'posts_per_page'=> -1));
            ?>
            <?php if($query->have_posts()):?>

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
                            echo $meta_price2!=''?_e('Large ','sptheme').$meta_price2.' $':'';?>
                            </span></p>
                            <?php if($meta_price1=='' and $meta_price2==''){

                            }else{?>
                            <a href="<?php the_permalink(); ?>" class="info"><?php echo _e('VIEW DETAIL','sptheme');?></a>
                            <?php }?>
                        </div>
                    </div> 
            
            <?php endwhile;?>
            </section>
            <!-- END Gallery Hover Effects -->
            <div class="clearfix"></div>
            <?php endif;?>
        </div>
        <!-- end gallery -->
    </div>
    <!-- end .content-inner -->
</div>
 <!-- end .container -->         
	
<?php get_footer(); ?>