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

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

                <div class="entry-meta">

                <?php echo sp_post_meta(); ?>

                </div><!-- end .entry-meta -->

                <?php if(has_post_thumbnail()){
                the_post_thumbnail('standart-post');
			    }?>
			    
                <?php if( sp_get_custom_field( 'sp_video_id', $post->ID ) ) { ?>
			    <div class="entry-video">
			    <iframe width="600" height="338" src="http://www.youtube.com/embed/<?php echo sp_get_custom_field( 'sp_video_id', $post->ID ); ?>?rel=0" frameborder="0" allowfullscreen></iframe>		
				</div><!-- end .entry-video -->
			    <?php } ?>

                <p><?php echo sp_post_content(); ?><p>

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
</div>
<!-- end .container.clearfix -->    

</section><!-- end #content -->
<?php get_footer(); ?>
