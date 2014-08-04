<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Added CSS from the original -->
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600,700' rel='stylesheet' type='text/css'>
	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet" media="screen"> 
	<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" media="screen">
	<link href="<?php echo get_template_directory_uri(); ?>/css/spokiyo-app.css" rel="stylesheet" media="screen">
	<link href="<?php echo get_template_directory_uri(); ?>/css/socialsprites.css" rel="stylesheet" media="screen">
	<link href="<?php echo get_template_directory_uri(); ?>/css/datepicker.css" rel="stylesheet" media="screen">
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/json2.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>	
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap-datepicker.js"></script>
	<!-- END: Added CSS from the original -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>	
	    <style>
		body {background:#ffffff; overflow-x:hidden;}
	</style>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header container" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

			<div id="navbar" class="navbar">
				
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<div class="row">
						<div class="col-lg-2 col-md-2" style="padding-left:5px !important;padding-right:5px !important;">
							<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
							<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
							<img src="<?php echo get_template_directory_uri(); ?>/images/spokiyo/home-logo.png" class="home-logo">
						</div>
						<div class="col-lg-10 col-md-10" style="padding-left:5px !important;padding-right:5px !important;">
							
							<!-- Removed Search form here -->
							<?php //get_search_form(); ?>
							<div class="socialbar_transparent borderless visible-lg visible-md visible-sm">
				            		<ul style="text-align:right" class="ss sscircle">
										<li class="facebook"><a href="https://facebook.com/spokiyo" target="_blank">facebook</a></li>		
										<li class="linkedin"><a href="http://www.linkedin.com/groups/SPOKIYO-4246125/about" target="_blank">linkedin</a></li>
										<li class="twitter"><a href="https://twitter.com/spokiyo" target="_blank">twitter</a></li>
									</ul>
							</div>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
						</div>
					 <!--<div class="col-lg-2 col-md-2">
			            		
		            	</div> -->
					</div>
					 <div class="row visible-xs center">
						<div class="col-lg-12 visible-xs" >
			            		<div class="socialbar_transparent2 borderless">
				            		<ul style="text-align:right" class="ss sscircle">
										<li class="facebook"><a href="https://facebook.com/spokiyo" target="_blank">facebook</a></li>		
										<li class="linkedin"><a href="http://www.linkedin.com/groups/SPOKIYO-4246125/about" target="_blank">linkedin</a></li>
										<li class="twitter"><a href="https://twitter.com/spokiyo" target="_blank">twitter</a></li>
									</ul>
								</div>
		            	</div>
					</div> 
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main container">
