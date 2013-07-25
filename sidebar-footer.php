<?php 
	  if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer sidebar') ) :	
        else :?>	
	    <div class="non-widget">
	    <h3><?php echo _e('About This Sidebar', 'sptheme'); ?></h3>
	    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place Custom Menu widgets into the <strong><em>Footer sidebar</em></strong> Area', 'sptheme'); ?></p>
	    </div>
        <?php	
	    endif;?>  