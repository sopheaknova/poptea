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
            <?php $cat_menu = $smof_data['cat_special'];?>
            <?php $query = new WP_Query(array('post_type'=>'sp_menu','menu-category'=>$cat_menu));?>
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
            <?php endif;?>
        </div>
        <!-- end gallery -->
    </div>
    <!-- end .content-inner -->
</div>
 <!-- end .container -->         
	
<?php get_footer(); ?>