<?php global $smof_data; ?>

<div class="footer-top clearfix">
        <div class="container">
	 	<?php get_sidebar('footer');?>
	 	</div>
	 	<!-- end .container -->
 </div>
 <!-- end .footer-top -->
 <div class="footer-bottom">
 	   <div class="container clearfix">
	 	   	<div class="footer-bottom-menu">
	 	   		 <?php echo sp_footer_navigation();?>
	 	   	</div>
	 	   	<div class="footer-bottom-poptea">
	 	   		<?php if($smof_data['footer_text'] !== '') :
  	                  echo $smof_data['footer_text'] ; 
	                  else: ?>  
	                  © <?php echo date('Y'); ?> Popteacambodia.com.
                <?php endif;  ?>
	 	   	</div>
 	   </div>
 </div>
 <!-- end .footer-bottom -->
<?php echo $smof_data['google_analytics']; // google analytics?>
<?php wp_footer(); ?>

</body>
</html>