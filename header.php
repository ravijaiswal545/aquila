<?php
/*
*Header File
*@package Aquila
*/?>
<!doctype html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	   <title>Aquila</title>
	  <link rel="profile" href="https://gmpg.org/xfn/11" />
	  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon">
	  <link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon">
	  

            
	   <?php wp_head(); ?>
   </head>
  <body <?php body_class(); ?>>
<?php if(function_exists('wp_body_open')){ wp_body_open();} ?>
<div class="site" id="page">
<header id="mast-head" class="site-header" role="banner">
<?php get_template_part('template-parts/header/nav'); ?>
</header>
<div id="content" class="site-content">
      