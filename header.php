<?php global $smof_data; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
<title><?php wp_title('|', true, 'right'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <!-- feeds, pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo ($smof_data['feedburner'] == '') ? bloginfo( 'rss2_url' ) :  $smof_data['feedburner']; ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo ($smof_data['theme_favico'] == '') ? SP_BASE_URL.'favicon.ico' : $smof_data['theme_favico']; ?>" type="image/x-icon" /> 
    
	<?php wp_head(); ?>
</head>

<body>

<div class="header">
      <div class="header-content">
      		
      		<div class="logo">
            <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                <?php if($smof_data['theme_logo'] !== '') : ?>
                <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                <?php else: ?>
                <h1><?php bloginfo('name'); ?></h1>
                <?php endif; ?>
            </a>
            </div>
            
            <div class="content-top clearfix">
            	<?php
            	if ( current_user_can('edit_theme_options') ) { 
				//WPML Language Switcher
				if (function_exists('icl_get_languages')) {
					languages_list_header(); 
				}
				}
				?>
            	<?php if ( (!empty($smof_data['social_facebook']) && $smof_data['social_facebook'] != ' ') || ( !empty( $smof_data['social_instagram'] ) && $smof_data['social_instagram'] != ' ' ) ) { ?> 
            	<div class="social-icons icon_24">
                    <span><?php echo _e('Join with us on:', 'sptheme'); ?></span>
                <?php if ( !empty($smof_data['social_facebook']) && $smof_data['social_facebook'] != ' ' ) { ?>    
                    <a class="facebook-tieicon" title="Facebook" href="<?php echo $smof_data['social_facebook']; ?>" target="_blank"><img src="<?php echo SP_BASE_URL; ?>images/socialicons/facebook.png" alt="Facebook"  /></a>
                <?php } ?>    
                <?php if ( !empty( $smof_data['social_instagram'] ) && $smof_data['social_instagram'] != ' ' ) { ?>
                    <a class="instagram-tieicon" title="Istagram" href="<?php echo $smof_data['social_instagram']; ?>" target="_blank"><img src="<?php echo SP_BASE_URL; ?>images/socialicons/instagram.png" alt="instagram"  /></a>
                <?php } ?>    
                  </div>
                  <div class="clear"></div>
                  <?php } ?>   
                 <div class="top-menu">
                    <?php echo sp_main_navigation(); ?>
                 </div>
                 <div class="top-info">
                      
                      <?php if($smof_data['opent_time_1']!=''||$smof_data['opent_time_2']!=''){?>
                      <span>
                            <a class="grey"><?php echo _e('Open Daily:', 'sptheme'); ?></a>
                            <a class="dark-yellow"><?php echo $smof_data['opent_time_1'];?></a>
                      </span>
                      <?php }?>

                      <?php $store = $smof_data['page_contact'];?>
                      <?php $page = get_page_by_path($store); // get page by slug name?>
                      <?php $page_url = get_page_link($page->ID); // id?>
                      <span id="right"><a href="<?php echo $page_url;?>"><?php echo _e('GET MAP', 'sptheme'); ?></a></span>
                     
                      <?php if($smof_data['opent_time_2']!=''){?>
                      <div id="sat-sun">
                            <a class="dark-yellow"><?php echo $smof_data['opent_time_2'];?></a>
                      </div> 
                      <?php }?> 
                      <?php if($smof_data['tel_1']!=''||$smof_data['tel_2']!=''){?>               
                      <a class="grey"><?php echo _e('Tel:', 'sptheme'); ?></a>
                      &nbsp;<a id="big-num"><?php echo $smof_data['tel_1']." / ".$smof_data['tel_2'];?></a>
                      <?php }?>
                 </div>
                 
            </div>
            <!-- end .content-top -->
      </div>
      <!-- end .header-content -->
 </div>
 <!-- end .header -->



