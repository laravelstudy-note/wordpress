<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" >

	<?php wp_head(); ?>

	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/layout.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/editor.css" rel="stylesheet">
	
</head>
<body>
	
<ul>
	<li><a href="#">HOME</a></li>
	<li><a href="#">About</a></li>
	<?php wp_nav_menu([
		'theme_location' => 'header_menu',
		'menu_class' => 'header_menu',
		'container_class' => 'header_menu_container',
		'container' => '',
		'items_wrap' => '%3$s'
	]); ?>
</ul>