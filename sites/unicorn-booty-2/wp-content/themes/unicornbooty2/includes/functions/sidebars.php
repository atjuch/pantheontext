<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3><div class="widgetcontent">',
	));
	
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .footer-widget -->',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
    ));
    
     
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'HeaderAds',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .headerads-widget -->',
		'before_title' => '',
		'after_title' => '',
    ));
?>