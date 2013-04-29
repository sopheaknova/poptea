<?php if(has_post_thumbnail()){ ?>
<div class="live-image">
	 <?php the_post_thumbnail('standart-post');?>
</div>
<?php }?>
<div class="live-comment">
	    <ul>
	    	<li>
	    		<span class="comment-info">
	    		<img src="<?php bloginfo('template_url');?>/images/thumb-comment.jpg" width="32" height="33" />
	    		</span>
	    		<span class="comment-text">
	    		<?php if(is_single()) { ?>
	              <h3 class="title-msg"><?php the_title(); ?></h3>
            <?php } else {?>
	              <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'sptheme'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
	              <h3 class="title-msg"><?php the_title(); ?></h3>
                  </a>
            <?php } ?>
	    		</span>
	    	</li>
	    	<li>
	    		<span class="comment-info">
	    		<strong>Posted:</strong>&nbsp;<i><?php echo get_the_date('M d Y');?></i>
	    		</span>
	    		<span class="comment-text">
	    		<?php //echo sp_excerpt_length(20);
	    		      //echo sp_post_content();
                  echo sp_excerpt_length(20);
	    		?>
	    		</span>
	    	</li>
	    	
	    </ul>
</div>
<!-- end .live-comment -->