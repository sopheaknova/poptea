<?php get_header(); ?>

<?php $has_sidebar = sp_check_page_layout(); ?>

<section id="content" class="<?php echo sp_check_sidebar_position(); ?>">

<div class="container">
	<div class="content-inner clearfix">
       
        <div class="menu-content">
        	        
 	   	<h1><?php single_cat_title();?></h1>

 	   	<?php if(category_description()){?>

 	   	<p><?php echo category_description();?></p>
 	   	<?php }?>

	 	</div>
	 	<div class="main">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php echo $post->ID; ?> clearfix">

					<?php get_template_part( 'content', get_post_format() ); ?>

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
