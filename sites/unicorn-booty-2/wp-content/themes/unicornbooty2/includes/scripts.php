<?php global $shortname; ?>

<script type="text/javascript" src="http://use.typekit.com/noe6yvh.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>
	
	 <script type="text/javascript">
	 function init(){
	 	var inp = document.getElementsByTagName('input');
	 	for(var i = 0; i < inp.length; i++) {
	 		if(inp[i].type == 'text') {
	 			inp[i].setAttribute('rel',inp[i].defaultValue)
	 			inp[i].onfocus = function() {
	 				if(this.value == this.getAttribute('rel')) {
	 					this.value = '';
	 				} else {
	 					return false;
	 				}
	 			}
	 			inp[i].onblur = function() {
	 				if(this.value == '') {
	 					this.value = this.getAttribute('rel');
	 				} else {
	 					return false;
	 				}
	 			}
	 			inp[i].ondblclick = function() {
	 				this.value = this.getAttribute('rel')
	 			}
	 		}
	 	}
	 }
	 if(document.childNodes) {
	 	window.onload = init
	 }
	 </script>
	
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/jquery.masonry.min.js"></script>
	<script type="text/javascript">
		jQuery(window).load(function(){
			<?php if (get_option('ubooty_blog_style') == 'false') { ?>
				jQuery('#content #boxes').masonry({ columnWidth: 122, animate: true });
			<?php } ?>
			jQuery('#footer-content').masonry({ columnWidth: 305, animate: true });
			
			var $fixed_sidebar_content = jQuery('.sidebar-fixedwidth');
			
			if ( $fixed_sidebar_content.length ) {
				var sidebarHeight = $fixed_sidebar_content.find('#sidebar').height(),
					contentHeight = $fixed_sidebar_content.height();
				if ( contentHeight < sidebarHeight ) $fixed_sidebar_content.css('height',sidebarHeight);
			}
		});
	</script>
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/superfish.js"></script>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/cufon-yui.js"></script>
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/League_Gothic_400.font.js"></script>
	<script type="text/javascript" src="http://dev-unicorn-booty-2.pantheon.io/wp-content/themes/unicornbooty2/js/jquery.hoverIntent.minified.js"></script>
	
	
	<script type="text/javascript">
	//<![CDATA[
		jQuery.noConflict();		
		
		<?php if (get_option('ubooty_cufon') == 'on') { ?>
			<?php if (get_option('ubooty_color_scheme') == 'Gray') { ?>
				Cufon.replace('ul.nav a',{textShadow:'1px 1px 0px #ad791c', hover: { textShadow: '1px 1px 0px #ad791c' }})('h3.title',{textShadow:'1px 1px 0px #ad791c'})('.wp-pagenavi',{textShadow:'1px 1px 1px rgba(173,121,28,0.7)'});
				Cufon.replace('#breadcrumbs',{textShadow:'1px 1px 0px #ad791c', hover: { textShadow: '1px 1px 0px #ad791c' }})('h3.title',{textShadow:'1px 1px 0px #ad791c'})('.wp-pagenavi',{textShadow:'1px 1px 1px rgba(173,121,28,0.7)'});
			<?php } else { ?>
				Cufon.replace('ul.nav a',{textShadow:'1px 1px 1px #000', hover: { textShadow: '1px 1px 1px #000' }})('h3.title',{textShadow:'1px 1px 1px #000'})('.wp-pagenavi',{textShadow:'1px 1px 1px rgba(0,0,0,0.7)'});
				Cufon.replace('#breadcrumbs',{textShadow:'1px 1px 1px #000', hover: { textShadow: '1px 1px 1px #000' }})('h3.title',{textShadow:'1px 1px 1px #000'})('.wp-pagenavi',{textShadow:'1px 1px 1px rgba(0,0,0,0.7)'});
			<?php } ?>
			Cufon.replace('#featured h2.title')('div.category a',{textShadow:'1px 1px 1px rgba(0,0,0,0.3)'})('span.month',{textShadow:'1px 2px 4px rgba(0,0,0,0.3)'})('h2.title a')('p.postinfo')('h3.infotitle, h1.title, .blog-title, .post-meta, h3#comments, span.fn');
		<?php } ?>
		
		jQuery('ul.nav').superfish({ 
			delay:       200,                            // one second delay on mouseout 
			animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
			speed:       'fast',                          // faster animation speed 
			autoArrows:  true,                           // disable generation of arrow mark-up 
			dropShadows: false                            // disable drop shadows 
		});
		
		jQuery('ul.nav > li > a.sf-with-ul').parent('li').addClass('sf-ul');
		
		jQuery(".small").hoverIntent({
			over: makeTall,
			timeout: 100,
			out: makeShort
		}); 
		
		jQuery(".med").hoverIntent({
			over: makeTall,
			timeout: 100,
			out: makeShort
		}); 
		
		var $tabbed_area = jQuery('#tabbed'),
			$tab_content = jQuery('.tab-content'),
			$all_tabs = jQuery('#all_tabs');
		
		if ($tabbed_area.length) {
			$tabbed_area.tabs({ fx: { opacity: 'toggle' } });
		};
				
		et_search_bar();
	
		function makeTall(){ 
			jQuery(this).addClass('active').css('z-index','7').find('.bottom-bg .excerpt').animate({"height":75},0);
			jQuery('.entry').not(this).animate({opacity:1},130);
		}
		function makeShort(){ 
			jQuery(this).css('z-index','1').find('.bottom-bg .excerpt').animate({"height":0},0);
			jQuery('.entry').removeClass('active').animate({opacity:1},200);
		} 
		
		
		<!---- Search Bar Improvements ---->
		function et_search_bar(){
			var $searchform = jQuery('#header div#search-form'),
				$searchinput = $searchform.find("input#searchinput"),
				searchvalue = $searchinput.val();
				
			$searchinput.focus(function(){
				if (jQuery(this).val() === searchvalue) jQuery(this).val("");
			}).blur(function(){
				if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
			});
		}
		
		jQuery(".js ul.nav a, .js ul.nav ul a, .js ul.nav ul li, .js ul.nav li.sfHover ul, .js ul.nav li li.sfHover ul, .js div.category a, .js span.month, .js span.date, .js h2.title, .js p.postinfo, .js #tabbed-area li a, .js #sidebar h3.widgettitle, .js .wp-pagenavi span.current, .js .wp-pagenavi span.extend, .js .wp-pagenavi a, .js .wp-pagenavi span, .js #footer h3.title, .js .info-panel h3.infotitle, .js .post-text h1.title, .js .cufon-disabled .blog-title a, .js p.post-meta, .js h3#comments, .js span.fn, .js span.fn a, .js .commentmetadata span.month, .js .commentmetadata span.date").css('text-indent','0px');
		
		<?php if (get_option($shortname.'_disable_toptier') == 'on') echo('jQuery("ul.nav > li > ul").prev("a").attr("href","#");'); ?>
		
		jQuery('.entry').click(function(){
			window.location = jQuery(this).find('.title a').attr('href');
		});
		
		<?php if (get_option('ubooty_cufon') == 'on') { ?>
			Cufon.now();
		<?php } ?>
	//]]>	
	</script>