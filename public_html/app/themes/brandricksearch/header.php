<!DOCTYPE html>
<!--[if IE 9]><html class="no-js ie9"><![endif]-->
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
	<meta name="theme-color" content="#ffffff">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<?php wp_head(); ?>
	<!-- GA code -->
	<script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body <?php body_class('push-menu'); ?>>

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'brandricksearch' ); ?></a>

	<nav class="push-menu-container" id="main_menu_push">
    	<div class="main-menu-wrapper">
        	<div class="main-menu-inner">
                <div class="menu-btn">
        			<div id="showRightPush_inmenu">
            		    <div class="burger-click-region">
            		    </div>
        			</div>
        		</div> 
        		
            	<?php wp_nav_menu( 
            	[
            		'theme_location'	=> 'primary',
            		'menu_id'			=> 'primary_menu',
                    'menu'              => 'primary',
                    'theme_location'    => 'primary',
                    'depth'             => 0,
                    'container'         => 'div',
                    'container_class'   => '',
            		'container_id'      => 'main_navigation',
                    'menu_class'        => 'menu-container',
        
                    'items_wrap'        => '<ul id="%1$s" class="%2$s" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>'
        
            	]);
                ?> 
        	</div> 
    	</div>                    
	</nav>
    <div class="body-cover"></div>

    <header id="masthead" class="site-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
	    <div class="header-wrapper">
	
            <div class="logo-container">
                <a href="/" title="Domus Executive"><img src="<?php bloginfo('template_url'); ?>/images/brandricksearch-logo.svg" class="svg" alt="Domus Executive Logo"></a>
            </div>
            
            
    		<div class="menu-btn">
    			<div id="showRightPush">
        		    <div class="burger-click-region">  
        		    </div>
    			</div>
    		</div>   

	    </div>
    </header><!-- #masthead -->