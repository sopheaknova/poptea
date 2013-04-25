<?php
/*
Template Name: Under Construction
*/
?>
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo ($smof_data['theme_favico'] == '') ? SP_BASE_URL.'favicon.ico' : $smof_data['theme_favico']; ?>" type="image/x-icon" /> 

<style type="text/css">
	.wrapper{width:960px; margin:50px auto;}
</style>

</head>

<body>
<div class="wrapper">
<img src="<?php echo SP_BASE_URL; ?>images/underconstruction.jpg" alt="coming soon" />
</div>
<?php echo $smof_data['google_analytics']; ?>
<?php wp_footer(); ?>
</body>
</html>