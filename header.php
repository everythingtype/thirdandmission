<!doctype html>  
<!--[if lte IE 8]> <html class="legacy"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php 
		wp_title( '&mdash;', true, 'right' );
		bloginfo( 'name' ); 
		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) )
			echo ' &mdash; ' . $site_description;
		if ( $paged >= 2 || $page >= 2 )
			echo ' &mdash; ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );
		?></title>

	<meta name="author" content="http://www.everything-type-company.com, http://martyspellerberg.com" />

	<meta name="viewport" content="initial-scale=1.0, width=device-width" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Fav Icons: Browser, iOS, Windows 8 -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon.ico">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-114.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-72.png" />
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-57.png" />
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>"/> 
	<meta name="msapplication-TileColor" content="#ffffff"/> 
	<meta name="msapplication-TileImage" content="<?php echo get_stylesheet_directory_uri() ?>/images/favicons/favicon-144.png"/>

	<link href="//cloud.webtype.com/css/9238a48b-c8c0-440c-a350-4ce565fbb2d9.css" rel="stylesheet" type="text/css" />

	<?php wp_head(); ?>

</head>
<body>
	
	<div class="layout">

		<div class="logo"><a href="http://ybca.org/"><?php include( TEMPLATEPATH . "/images/ybca.svg"); ?></a></div>

		<div class="header">

			<p class="tagline">An arts and culture journal by Y<span>erba </span>B<span>uena </span>C<span>enter for the </span>A<span>rts</span></p>

			<div class="viewtoggle">
				<ul>
					<li id="viewgrid" class="selected" title="View as grid"><?php include( TEMPLATEPATH . "/images/gridview.svg"); ?><span> View as grid</span></li>
					<li id="viewlist" title="View as list"><?php include( TEMPLATEPATH . "/images/listview.svg"); ?><span> View as list</span></li>
				</ul>
			</div>

			<p class="weather"></p>

			<div class="topmenu">

				<h1 class="thirdandmission"><a href="<?php bloginfo('url'); ?>"><span class="box">3rd</span> <span>&amp;</span> <span class="box">Mission</span></a></h1>
		
				<div class="navcontainer">

					<ul class="nav">
					<li <?php if ( is_category_or_subcategory('journal') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/journal">Journal</a></li>
					<li <?php if ( is_category_or_subcategory('events') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/events">Events</a></li>
					<li <?php if ( is_tag('text') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/text">Texts</a></li>
					<li <?php if ( is_tag('art') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/art">Art</a></li>
					<li <?php if ( is_tag('video') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/video">Video</a></li>
					<li <?php if ( is_category('recent') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/recent">Recent</a></li>
					<li <?php if ( is_page('archive') || is_archive() && !is_category_or_subcategory('events') && !is_category_or_subcategory('journal') && !is_category('recent') && !is_tag() ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/archive">Archive</a></li>
					<li <?php if ( is_page('about') ) echo 'class="selected"' ?>><span>+</span> <a href="<?php bloginfo('url'); ?>/about">About</a></li>
					</ul>
		
					<div class="search"><span class="amp">+</span> <form method="get" action="<?php bloginfo('home'); ?>/"><label for="s"><span class="imagelabel"><?php include( TEMPLATEPATH . "/images/search.svg"); ?></span><span class="textlabel">Search</span></label><span class="searchinput"><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input class="icon" type="image" src="<?php echo get_stylesheet_directory_uri() ?>/images/search.svg" /></span></form></div>
		
				</div>
		
			</div>
		
		</div>
		
		<div class="main">