<!DOCTYPE html>
<!--[if lt IE 7]> 		<html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    		<html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>   		<html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>   		<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 	<html class="no-js" lang="en"> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php echo(is_search()) ? '<meta name="robots" content="noindex, nofollow" />' : ''; ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="title" content="<?php wp_title( '|', true, 'right' ); ?>">
<meta name="description" content="<?php bloginfo('description');?>">
<meta name="google-site-verification" content="">
<meta name="author" content="Scarbrough Studios">
<meta name="Copyright" content="<?php echo ' Copyright' . bloginfo('name') . '. All Rights Reserved.';?>">
<meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=10.0,initial-scale=1.0" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
	<div class="page-wrapper">
		<!-- HEADER BEGINS -->
		<div class="header-type-1">
			<header class="header header1">
				<div class="container">
					<div class="logo">                    
						<a href="<?php bloginfo('url'); ?>">
							<?php if(get_custom_text('logo_image', false)): ?>
								<img id="main-logo-img" style="width: <?php echo get_custom_text('logo_image_width'); ?>px;" src="<?php echo get_custom_text('logo_image'); ?>" alt="<?php bloginfo('name'); ?>">
							<?php else: ?>
								<img id="main-logo-img" src="<?php bloginfo('template_url'); ?>/img/Overseas-Press-Club-Puerto-Rico-Logo-200.png" alt="<?php bloginfo('name'); ?>">
							<?php endif; ?>
						</a>
	        		</div>
					<div class="menu-icon hidden-desktop"><i class="icon-reorder"></i></div>
				</div>
			</header>
			<div class="main-nav visible-desktop">
				<div class="container">
					<div class="menu-wrapper">
						<div class="logo-with-menu">
							<a href="http://localhost/~jorgesilva/2013/the_leader_theme"><img src="http://localhost/~jorgesilva/2013/the_leader_theme/wp-content/themes/theleader/images/logo.png" alt="THEME TEST"></a>
	        			</div>
						<div class="menu-main-container">
							<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
								<?php wp_nav_menu(array(
									'theme_location' => 'main_menu',
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
									'depth' => 4,
									'fallback_cb' => false,
									'walker' => new Et_Navigation
								)); ?>
							<?php else: ?>
								Set your main menu in <strong>Apperance &gt; Menus</strong>
							<?php endif; ?>
						</div>									
					</div>
				</div>
			</div>
		</div>
		<!-- HEADER ENDS -->