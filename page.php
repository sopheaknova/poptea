<?php get_header(); ?>

<?php $has_sidebar = sp_check_page_layout(); ?>

<section id="content" class="clearfix <?php echo sp_check_sidebar_position(); ?>">

<div class="container">
	<div class="content-inner clearfix">

		<?php if( $has_sidebar ): ?>

		<div class="main">

		<?php if (have_posts()) while ( have_posts() ): the_post(); ?>
        <div class="page-body">	
            <h1><?php echo the_title(); ?></h1>
            
			<?php the_content(); ?>
			<div class="clear"></div>
			<p><?php edit_post_link( __( 'Edit', 'sptheme' ), '', '' ); ?></p>
        </div>

		<?php endwhile; ?>

		</div>
	 	<!-- end .main -->
			
		<div class="side-right">
        <?php get_sidebar(); ?>
        </div>

        <?php else :?>

        <?php if (have_posts()) while ( have_posts() ): the_post(); ?>
        <div class="page-content">
            <h1><?php echo the_title(); ?></h1>
            
			<?php the_content(); ?>
			<div class="clear"></div>
			<p><?php edit_post_link( __( 'Edit', 'sptheme' ), '', '' ); ?></p>
        </div>
		<?php endwhile; ?>

		<?php endif; ?>
        
    </div>
    <!-- end .content-inner -->
</div>
<!-- end .container.clearfix --> 

</section><!-- end #content -->

<?php get_footer(); ?>
