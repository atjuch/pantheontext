<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<?php
		if ( is_singular() ) { 
		$seo_title = get_post_meta( $post->ID, 'crumble_mb_seo_title', true );
		$seo_keywords = get_post_meta( $post->ID, 'crumble_mb_seo_keywords', true );
		$seo_description = get_post_meta( $post->ID, 'crumble_mb_seo_description', true );
	
	 		if ($seo_title != '') { ?> <title><?php echo $seo_title; ?></title>
                <meta property="og:title" content="<?php echo $seo_title;?>"/>
			<?php } else { ?> <title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>
                <meta property="og:title" content="<?php bloginfo('name');?> <?php wp_title(' | ', true, 'left'); ?>"/>
		<?php } if ($seo_keywords != '') { ?>
			<meta name="keywords" content="<?php echo $seo_keywords; ?>" />
			<?php } else { ?> <meta name="keywords" content="<?php bloginfo('name'); ?>" />
		
		<?php } if ($seo_description != '') { ?>
			
		<?php } else { ?>

			<meta name="description" content="<?php bloginfo('description'); ?>" />
            <?php } ?>
            <!-- facebook meta -->

            <meta property="og:url" content="<?php echo get_permalink( $post->ID ); ?>"/>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <meta property="og:description" content="<?php echo get_the_excerpt(); ?>"/>
            <?php endwhile; endif; ?>
            <meta property="og:site_name" content="<?php bloginfo( 'name' ) ?>"/>
            <meta property="og:type" content="article"/>
            <?php

            // featured image url
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
            if ( ! empty( $feat_image ) ) { ?>
                <meta property="og:image" content="<?php echo $feat_image; ?>"/>
            <?php } ?>
            <?php } else { ?>
		<title><?php bloginfo('name'); ?> <?php wp_title(' | ', true, 'left'); ?></title>	
		<meta name="keywords" content="<?php bloginfo('name'); ?>" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />  
	<?php } ?>
	
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
	

	<!-- Mobile Specific Metas  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php global $data; ?>

	<!-- Favicons ================================================== -->
	<link rel="shortcut icon" href="<?php echo stripslashes( $data['crumble_custom_favicon'] ); ?>">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-57-precomposed.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114-precomposed.png">


	
	<?php	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	
	

	<?php wp_enqueue_style('reset',get_template_directory_uri().'/css/reset.css','','','all'); ?>


	<?php wp_enqueue_style('flexslider',get_template_directory_uri().'/css/flexslider.css','','','all'); ?>	
	
	<?php 
		$theme_style = stripslashes( $data['crumble_theme_style'] );
		
		
		if ( $theme_style == 'dark.css' ) {
			wp_enqueue_style( 'style',get_stylesheet_directory_uri().'/style.css','','','all'); 
		} else if ( $theme_style == 'light.css' ) {
			wp_enqueue_style( 'style',get_stylesheet_directory_uri().'/light.css','','','all'); 
		} else {
			wp_enqueue_style( 'style',get_stylesheet_directory_uri().'/style.css','','','all'); 		
		}
	?>

	<?php 
		$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 
		if( $enable_slider == 'Enable' ) {
	?>
		<?php wp_enqueue_style('nivo-slider',get_template_directory_uri().'/css/nivo-slider.css','','','all'); ?>	
	<?php } ?>
	
	<?php wp_enqueue_style('css-skeleton',get_template_directory_uri().'/css/skeleton.css','','','all'); ?>
	<?php wp_enqueue_style('css-skeleton-layout',get_template_directory_uri().'/css/layout.css','','','all'); ?>
	


	<?php wp_enqueue_style('prettyPhoto-css',get_template_directory_uri().'/css/prettyphoto.css','','','all'); ?>		
	<?php wp_enqueue_style('custom-options',get_stylesheet_directory_uri().'/css/options.css','','','all'); ?>

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 0.3 - <?php bloginfo('name'); ?> " href="<?php bloginfo('atom_url'); ?>" />


	<?php wp_head(); ?>
	<link href='//fonts.googleapis.com/css?family=Oswald:400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<?php 
		$google_stylesheet = stripslashes( $data['crumble_google_stylesheet'] );
		$font_family = stripslashes( $data['crumble_google_fontfamily'] );
		
		if ( $google_stylesheet != '' ) echo $google_stylesheet; 
		
		if ( ( $font_family != '' ) &&  ( $google_stylesheet != '' ) ) {
			echo '<style type="text/css">h1, h2, h3, h4, h5, h6, .widget .tabs li, .tabs li { ' . $font_family . ' }</style>';
		}	
	?>
	
	
</head>

<body <?php body_class('body-class'); ?>>


<!-- Start Wrapper Content -->
<div id="wrapper">
		
		<!-- START TOP LINE SECTION (Date and Search) -->	
		<div class="top-line">
			<div class="container">
				
				<?php if( stripslashes( $data['crumble_show_second_menu'] ) == 'Show' ) { ?>					
					<?php 
						echo '<div class="eleven columns">';
							if ( has_nav_menu('secondary_menu') ) wp_nav_menu( array('theme_location' => 'secondary_menu', 'menu_class' => 'sf-menu add-nav')); 
						echo '</div>'; 						
					?>
				<?php } else if( stripslashes( $data['crumble_show_date'] ) == 'Show' ) : ?>				

				<!-- start date block -->
				<div class="eleven columns date">
						<img src="<?php echo get_template_directory_uri(); ?>/images/date-circle.png" alt="" />
						<div class="floatLeft"><?php echo date('l dS F Y, '); ?></div>											
						 <div id="timeNow"></div>
				</div> <!-- /date ( ten columns ) -->
				<?php endif; ?> 
				
				<?php if( stripslashes( $data['crumble_show_search'] ) == 'Show' ) : ?>				
				<!-- start search block -->
				<div class="five columns search search-block">
					<form method="get" id="search" action="<?php echo home_url(); ?>/">
						<input type="text" name="s" id="s" value="<?php _e('Search on site ...','crumble'); ?>" onfocus='if (this.value == "<?php _e('Search on site ...', 'crumble'); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e('Search on site ...', 'crumble'); ?>"; }' />
					</form>				
				</div> <!-- /search ( six columns ) -->
				<?php endif; ?>	
								
			</div> <!-- /container -->
		</div> <!-- /top-line -->	
		
		
	<!-- START LOGO AND BANNER SECTION -->
	<div class="container">
		
		<!-- start logo -->
		<div id="logo" class="seven columns">
		
		  		<?php $logo_type = stripslashes( $data['crumble_type_logo'] );  			
						if ( $logo_type == "image" ) { 
							if ( is_front_page() ) { ?>
    							<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['crumble_logo_upload'] ) ?>" alt="" /></a></h1>
							<?php } else { ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $data['crumble_logo_upload'] ) ?>" alt="" /></a>
							<?php }
						 }	
			
						if ( $logo_type == "text" ) { ?>
							<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $data['crumble_logo_text'] ); ?></a></h1>
							<span class="logo-slogan"><?php echo stripslashes( $data['crumble_logo_slogan'] ); ?></span>
				<?php }	?>
		
		</div> <!-- /logo ( seven columns ) -->
		
		<!-- start banner -->
		<div class="nine columns banner border">
		  	<?php
				$banner_upload = stripslashes( $data['crumble_banner_upload'] );
				$banner_code = stripslashes( $data['crumble_banner_code'] );
			
				if ( $banner_upload != '' ) {
			  ?>
			    <a href="<?php echo stripslashes( $data['crumble_banner_link'] ); ?>"><img src="<?php echo stripslashes( $data['crumble_banner_upload'] ) ?>" alt="" /></a>
			  <?php } else if ( $banner_code != '' ) { echo $banner_code; } ?>
		</div> <!-- /banner ( nine columns ) -->
		
		<div class="clear"></div>

		<div class="sixteen columns">
			<div class="divider-1px-top"></div>			

			<div class="navigation">
			    <div id="menu">
					<?php 
						if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu')); 					
					?>             
		        </div> <!-- /menu -->
			</div>  <!-- /navigation -->
		</div> <!-- /sixteen columns -->
	</div> <!-- /container -->		

	<div class="clear"></div>
