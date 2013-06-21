<?php
/*
Template Name: Contact us Page
*/
?>
<?php 


$nameError = '';
$emailError = '';
$messageError = '';
if(isset($_POST['submitted'])) {
		if(trim($_POST['contactname']) === '') {
			$nameError = __('Please enter your name.', 'sptheme');
			$hasError = true;
		} else {
			$name = trim($_POST['contactname']);
		}
		
		if(trim($_POST['email']) === '')  {
			$emailError = __('Please enter your email address.', 'sptheme');
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['message']) === '') {
			$messageError = __('Please enter a message.', 'sptheme');
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$messages = stripslashes(trim($_POST['message']));
			} else {
				$messages = trim($_POST['message']);
			}
		}
			
		if(!isset($hasError)) {
			$emailTo = $smof_data['email'];
			if (!isset($emailTo) || ($emailTo == '') ){
				$emailTo = $smof_data['email'];
			}
			$subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $messages";
			$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);
			$emailSent = true;
		}
	
} ?>


<?php get_header(); ?>


<!--Map of casaankorhotel-->
<div id="map-wide">
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">					
  jQuery(document).ready(function ($)
	{
		var latitude = <?php echo $smof_data['map_lat'];?>;
		var longitude = <?php echo $smof_data['map_long'];?>;
		var myLatlng = new google.maps.LatLng(latitude, longitude);
		var myOptions = {
		  scrollwheel: false, 									  
		  zoom: 16,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById("contact-map"), myOptions);
		
		var image = '<?php echo SP_BASE_URL;?>images/pop-tea-marker.png';
		var marker = new google.maps.Marker({
			position: myLatlng, 
			map: map,
			icon: image,
			animation: google.maps.Animation.DROP,
			title:"<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>"
		});
	});
</script>
<div id="contact-map"></div>
</div><!--/#map-wide-->

	<div class="cover-container">
		 <div class="container clearfix">
         
        <div class="entry-contact"> 
    	<h1><?php echo the_title(); ?></h1>
        <div class="one_third">
        <?php if (have_posts()) while ( have_posts() ): the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>        
        
    	</div><!-- end .one_third -->
    
    	<div class="two_third last">
		<?php if(isset($emailSent) && $emailSent == true) { ?>
             <div class="success">
                <h5><?php _e('Thanks, your email was sent successfully.', 'sptheme') ?></h5>
            </div>

        <?php } ?>
        <form class="contact-page" action="<?php the_permalink(); ?>" id="contactForm" method="post">
        	<div class="one_half">
        	<label for="name"><?php _e('Name', 'sptheme'); ?> <font>*</font></label>
            <input type="text" name="contactname" class="name" value="<?php if(isset($_POST['contactname'])) echo $_POST['contactname'];?>" />
            <?php if($nameError != '') { ?>
                <span class="error"><?php echo $nameError; ?></span> 
            <?php } ?>
            </div>
            <div class="one_half last">
            <label for="email"><?php _e('E-mail', 'sptheme'); ?> <font>*</font></label>
            <input type="text" name="email" class="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />
            <?php if($emailError != '') { ?>
                <span class="error"><?php echo $emailError; ?></span>
            <?php } ?>
            </div>
            <div class="clear"></div>
            <label for="message"><?php _e('Message', 'sptheme'); ?> <font>*</font></label>
            <textarea name="message" cols="81" rows="5" class="message"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
            <?php if($messageError != '') { ?>
                <span class="error"><?php echo $messageError; ?></span> 
            <?php } ?>
            
            <input type="hidden" name="submitted" id="submitted" value="true" />
            <button id="submit" type="submit" class="button"><?php _e('Send', 'sptheme') ?></button>
        </form>
        
    	</div><!-- end .two_third -->
        <div class="clear"></div>
    	</div><!-- end .entry-contact -->
    </div><!-- end container .clearfix-->
</div><!-- end .cover-container -->

<?php get_footer(); ?>