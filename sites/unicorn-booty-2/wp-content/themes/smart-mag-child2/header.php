<!DOCTYPE html>

<!--[if IE 8]> <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]> <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<?php 
/**
 * Match wp_head() indent level
 */
?>

<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); // stay compatible with SEO plugins ?></title>

<?php if (!Bunyad::options()->no_responsive): // don't add if responsiveness disabled ?> 
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php endif; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="p:domain_verify" content="284b2477c9211b594c09c3512eb37031"/>
<?php if (Bunyad::options()->favicon): ?>
<link rel="shortcut icon" href="<?php echo esc_attr(Bunyad::options()->favicon); ?>" />	
<?php endif; ?>

<?php if (Bunyad::options()->apple_icon): ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo esc_attr(Bunyad::options()->apple_icon); ?>" />
<?php endif; ?>
	
<?php wp_head(); ?>
	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-25782645-5', 'auto');
        ga('require', 'linkid', 'linkid.js');
        ga('send', 'pageview');

    </script>
</head>

<body <?php body_class(); ?>>

<div class="main-wrap">

	<?php 
	
	/**
	 * Get the partial template for top bar
	 */
	get_template_part('partials/header/top-bar'); 
	
	?>
	
	<div id="main-head" class="main-head">
		
		<div class="wrap">
		
			<header>
				<div class="title">
				
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
				<?php if (Bunyad::options()->image_logo): // custom logo ?>
					
					<img src="<?php echo esc_attr(Bunyad::options()->image_logo); ?>" class="logo-image" alt="<?php 
						 echo esc_attr(get_bloginfo('name', 'display')); ?>" <?php 
						 echo (Bunyad::options()->image_logo_retina ? 'data-at2x="'. Bunyad::options()->image_logo_retina .'"' : ''); 
					?> />
						 
				<?php else: ?>
					<?php echo do_shortcode(Bunyad::options()->text_logo); ?>
				<?php endif; ?>
				</a>
				
				</div>
				
				<div class="right">
					<?php 
						dynamic_sidebar('header-right');
					?>
				</div>
			</header>
			
			<?php
				/**
				 * Setup data variables to enable or disable sticky nav functionality
				 */
				$nav_data = array();
				
				if (Bunyad::options()->sticky_nav) {
					
					$nav_data[] = 'data-sticky-nav="1"';
								
					// sticky navigation logo?
					if (Bunyad::options()->sticky_nav_logo) {
						$nav_data[] = 'data-sticky-logo="1"';
					}
				}

			?>
			
			<nav class="navigation cf" <?php echo implode(' ', $nav_data); ?>>
			
				<div class="mobile" data-type="<?php echo Bunyad::options()->mobile_menu_type; ?>" data-search="<?php echo Bunyad::options()->mobile_nav_search; ?>">
					<a href="#" class="selected">
						<span class="text"><?php _e('Navigate', 'bunyad'); ?></span><span class="current"></span> <i class="hamburger fa fa-bars"></i>
					</a>
				</div>
				
				<?php wp_nav_menu(array('theme_location' => 'main', 'fallback_cb' => '', 'walker' =>  'Bunyad_Menu_Walker')); ?>
			</nav>
			
		</div>
		
	</div>
	
<?php if (!Bunyad::options()->disable_breadcrumbs): ?>
	<div class="wrap">
		<?php Bunyad::core()->breadcrumbs(); ?>
	</div>
<?php endif; ?>

<?php do_action('bunyad_pre_main_content'); ?>