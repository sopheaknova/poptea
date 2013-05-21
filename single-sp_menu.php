<?php get_header(); ?>

<?php $has_sidebar = sp_check_page_layout(); ?>

<section id="content" class="<?php echo sp_check_sidebar_position(); ?>">

<div class="container">
	<div class="content-inner clearfix">

		<div class="main">
        <?php if(is_single()) { ?>
		<h1 class="title"><?php the_title(); ?></h1>
        <?php } ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) :the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                
                <div class="entry-meta">
                
                <?php //echo sp_custom_meta(); ?>

                </div><!-- end .entry-meta -->
                
                
                 <?php $cat_special = $smof_data['cat_special'];  // SPECIALS Drink?>   
                 <?php $format = has_post_format('gallery',$post->ID); 
                        
                    if ($format && !taxonomy_exists($cat_special)){ ?>

                    <div class='special-single clearfix'>
                    <div class='single-slide'>
                    <?php $attachments = get_children( array('post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image') );
                    foreach ( $attachments as $attachment_id => $attachment ) {
						echo wp_get_attachment_image($attachment_id);
					}?>
                    </div>
                    <!-- end .single-single -->
                    <div class="single-nav">
                    	 <a id="nav-prev"><img src="<?php bloginfo('template_url');?>/images/previous-white.png"/></a>
                    	 <a id="nav-next"><img src="<?php bloginfo('template_url');?>/images/next-white.png" /></a>
                    </div>
                    <div class="prodcut-price">
	                <?php $meta_price1 = get_post_meta($post->ID, 'sp_medium_price', true); 
	                                      echo $meta_price1!=''?'Medium : $'.$meta_price1:'';?>&nbsp;&nbsp;
	                <?php $meta_price2 = get_post_meta($post->ID, 'sp_large_price', true); 
	                                      echo $meta_price2!=''?'Large : $'.$meta_price2:'';?>
	                </div>
                    </div>
                    <!-- end .special-single -->
                 <?php }else{ ?>

                    <?php if(has_post_thumbnail()){ ?>
	                <div class="description-pic">
	                <?php the_post_thumbnail('product-thumb'); ?>
	                
	                <div class="prodcut-price">
	                <?php $meta_price1 = get_post_meta($post->ID, 'sp_medium_price', true); 
	                                      echo $meta_price1!=''?'Medium : $'.$meta_price1:'';?>
	                <?php $meta_price2 = get_post_meta($post->ID, 'sp_medium_price', true); 
	                                      echo $meta_price2!=''?'Large : $'.$meta_price2:'';?>
	                </div>
	                </div>
				    <?php }?>
                   	    
                 <?php } //else?> 
              

                <?php echo sp_post_content(); ?>
                
				</article><!-- end .hentry -->

			<?php endwhile; ?>

			<?php // Pagination
				if(function_exists('wp_pagenavi'))
					wp_pagenavi();
				else 
					echo sp_pagination(); 
			?>
			
		<?php else: ?>
		
			<article id="post-0" class="post no-results not-found">
		
				<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for...', 'sptheme' ); ?></h3>

			</article><!-- end .hentry -->

		<?php endif; ?>

        </div>
	 	<!-- end .main -->
	 	<div class="side-right">
        <?php get_sidebar(); ?>
        </div>
	</div>
    <!-- end .content-inner -->
</div><!-- end .container.clearfix -->    

</section><!-- end #content -->
<?php get_footer(); ?>