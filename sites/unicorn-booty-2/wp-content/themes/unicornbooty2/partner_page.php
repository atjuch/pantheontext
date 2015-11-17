<?php
/*
Template Name: Partner Page
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php elegant_titles(); ?></title>
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />

<link rel="stylesheet" href="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/style.css" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="http://feeds.feedburner.com/UnicornBootyFeed" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	//expand all or hide all options
	$('#tools a.expand').click(function() { $('#reveal .content').slideDown('slow'); $('#reveal .header a').addClass('active'); });
	$('#tools a.hide').click(function() { $('#reveal .content').slideUp('slow'); $('#reveal .header a').removeClass('active'); });
	//individual header click toggle
	$('#reveal .header a').click(function(){
		//collapse and remove active class, if the div is opened it will close
		var activeHeader = $(this).hasClass('active');
		$(this).removeClass('active').parent('div').next('.content').slideUp('slow');
		//open the div if it is closed and add the active class
		if(activeHeader==0)
		{ $(this).addClass('active').parent('div').next('.content').slideDown('slow'); }
	});
});
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(function() {
	
		function filterPath(string) {
			return string
			.replace(/^\//,'')
			.replace(/(index|default).[a-zA-Z]{3,4}$/,'')
			.replace(/\/$/,'');
		}
	
		var locationPath = filterPath(location.pathname);
		var scrollElem = scrollableElement('html', 'body');
	
		// Any links with hash tags in them (can't do ^= because of fully qualified URL potential)
		$('a[href*=#]').each(function() {
	
			// Ensure it's a same-page link
			var thisPath = filterPath(this.pathname) || locationPath;
			if (  locationPath == thisPath
				&& (location.hostname == this.hostname || !this.hostname)
				&& this.hash.replace(/#/,'') ) {
	
					// Ensure target exists
					var $target = $(this.hash), target = this.hash;
					if (target) {
	
						// Find location of target
						var targetOffset = $target.offset().top;
						$(this).click(function(event) {
	
							// Prevent jump-down
							event.preventDefault();
	
							// Animate to target
							$(scrollElem).animate({scrollTop: targetOffset}, 1000, function() {
	
								// Set hash in URL after animation successful
								location.hash = target;
	
							});
						});
					}
			}
	
		});
	
		// Use the first element that is "scrollable"  (cross-browser fix?)
		function scrollableElement(els) {
			for (var i = 0, argLength = arguments.length; i <argLength; i++) {
				var el = arguments[i],
				$scrollElement = $(el);
				if ($scrollElement.scrollTop()> 0) {
					return el;
				} else {
					$scrollElement.scrollTop(1);
					var isScrollable = $scrollElement.scrollTop()> 0;
					$scrollElement.scrollTop(0);
					if (isScrollable) {
						return el;
					}
				}
			}
			return [];
		}
	
	});
	</script>


<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/css/ie6style.css" />
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, #search-form, .thumbnail .overlay, .big .thumbnail .overlay, .entry-content, .bottom-bg, #controllers span#left-arrow, #controllers span#right-arrow, #content-bottom-bg, .post, #comment-wrap, .post-content, .single-thumb .overlay, .post ul.related-posts li, .hr, ul.nav ul li a, ul.nav ul li a:hover, #comment-wrap #comment-bottom-bg, ol.commentlist, .comment-icon, #commentform textarea#comment, .avatar span.overlay, li.comment, #footer .widget ul a, #footer .widget ul a:hover, #sidebar .widget, #sidebar h3.widgettitle, #sidebar .widgetcontent ul li, #tabbed-area, #tabbed-area li a, #tabbed .tab ul li');</script>
<![endif]--> 
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/css/ie7style.css" />
<![endif]--> 
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/css/ie8style.css" />
<![endif]--> 
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body class="partnerpage">
	<div id="container">
	  <div id="container1">
		<div id="container2">
		
		 
		  <div id="header"> 
		  <a href="http://unicornbooty.com" class="badge2"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/badge2.png" alt="badge" id="badge"/></a>
		  		  		  	
		  	<ul id="topnav">
		  	   
		  	   <li><a href="/submit-a-storytip">Submit a Story or Tip</a></li>  
		  	</ul>
		  	
		  	<div id="header-bottom" class="clearfix">
		  										
		  															
		  					</div> <!-- end #header-bottom -->	
		  </div>
		 
		
			
<?php the_post(); ?>

<div id="content" class="clearfix">
	<?php if (get_option('ubooty_integration_single_top') <> '' && get_option('ubooty_integrate_singletop_enable') == 'on') echo(get_option('ubooty_integration_single_top')); ?>
	<div id="whole-area">
		<div id="post" class="post">
			<div class="post-content clearfix">
			
				
				<div class="post-text">
					<div class="partnerbadge"><img src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/images/partnerwithus.png" alt="partner with us" id="partnerbadge"/></div>
										
					
					
					<?php the_content(); ?>
					
					<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','ubooty').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php edit_post_link(__('Edit this page','ubooty')); ?>
					
					<?php if (get_option('ubooty_integration_single_bottom') <> '' && get_option('ubooty_integrate_singlebottom_enable') == 'on') echo(get_option('ubooty_integration_single_bottom')); ?>
					
					
				</div> <!-- .post-text -->
			</div> <!-- .post-content -->			
		</div> <!-- #post -->
		
		
	</div> <!-- #left-area -->
</div> <!-- #content -->
			
<div id="content-bottom-bg"></div>
			
<?php get_footer(); ?>