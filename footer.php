<?php global $smof_data; ?>

<div class="footer-top clearfix">
        <div class="container">
	 	   <div class="footer-top-left">
	 	   	     <h3>ABOUT POPTEA</h3>
	 	   	     Welcome to the world of POPTEA. Whether it's our freshy made tea or our cool Real Fruit Smoothly, rich Shakes or a tasty Flappe, We're got something gauranteed to make your day.
	 	   	     <div id="like-us">
	 	   	     <a href="#"><img src="<?php bloginfo('template_url');?>/images/like-us.png" width="104" height="37" /></a>
	 	   	     </div>
	 	   </div>
	 	   <div class="footer-top-middle">
	 	   	     <h3>LATEST NEWS & EVENTS</h3>
	 	   	     <a href=""><img src="<?php bloginfo('template_url');?>/images/drinking.jpg" height="66" width="71" /></a>
	 	   	     <a href=""><h6>Lorem ipsum dolor sit amet</h6></a>
	 	   	     <div class="small">Posted on: 29 Jan 2013</div>
	 	   	     Pellentesque non tellus emin, ut accumsan risus ...
	 	   	     <hr>

	 	   	     <a href=""><img src="<?php bloginfo('template_url');?>/images/drinking.jpg" height="66" width="71" /></a>
	 	   	     <a href=""><h6>Lorem ipsum dolor sit amet</h6></a>
	 	   	     <div class="small">Posted on: 29 Jan 2013</div>
	 	   	     Pellentesque non tellus emin, ut accumsan risus ...
	 	   </div>
	 	   <div class="footer-top-right">
	 	   	      <h3>SHOP ADDRESS</h3>
	 	   	      <h6>Pop Tea</h6>
	 	   	      No9, Street 322, Beoeng Keng Kang I, Phnom Penh.
	 	   	      <div class="email">E-mail: <a href="">sales@popteacambodia.com</a></div>
	 	   	      <h2>+855 23 212 847</h2>
	 	   	      <h2>+855 23 220 362</h2>

	 	   </div>
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
<?php //echo $smof_data['google_analytics']; ?>
<?php wp_footer(); ?>

</body>
</html>