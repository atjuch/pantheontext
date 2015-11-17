<?php
	global $data;
?>
<?php
	/*
	----------------------------------------------------
			Start Footer
	----------------------------------------------------				
	*/
?>
	
<div class="clear"></div>				
	
<div class="pat-block"></div>			
		<div class="container">
			<div class="footer">
			
				<!-- start first column in footer -->
				<div class="four columns">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer: First Column") ) : ?>                
					<?php endif; ?> 
				</div> <!-- /four columns -->
			
				<!-- start second column in footer -->
				<div class="four columns">						
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer: Second Column") ) : ?>                
					<?php endif; ?> 
				</div> <!-- /four columns -->
			
				<!-- start third column in footer -->
				<div class="four columns">			
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer: Third Column") ) : ?>                
					<?php endif; ?> 
				</div> <!-- /four columns -->
			
				<!-- start fourth column in footer -->
				<div class="four columns">			
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer: Fourth Column") ) : ?>                
					<?php endif; ?> 
				</div> <!-- /four columns -->
				
				<div class="clear"></div>
			</div> <!-- /footer -->	
			<div class="clear"></div>
        </div> <!-- /container -->                

		<div class="clear"></div>


		<!-- START Copyright SECTION -->	
		<?php
			$copy = stripslashes( $data['crumble_copyrights'] );
			
			if(  $copy != ''  ) {
		?>
		<div class="copyright">
			<div class="container">
				
				<!-- start copyright -->
				<div class="eight columns">
					<p><?php echo stripslashes( $data['crumble_copyrights'] ); ?></p>
				</div> <!-- /copyright -->
			</div> <!-- /container -->
			<div class="clear"></div>
		</div> <!-- /copyright -->
		<?php } ?>


		
</div> <!--end wrapper END CONTENT -->
	

		
		
<?php wp_footer(); ?>
	<?php echo stripslashes ( $data['crumble_google_analytics'] ); ?>

<?php 
	$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 
	
	if( $enable_slider == 'Enable' ) {
?>
<script type="text/javascript">
/***************************************************
			Nivo Slider
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {
           $('#slider').nivoSlider({
			effect: '<?php echo stripslashes( $data['crumble_slider_effect'] ); ?>',
			animSpeed: <?php echo stripslashes( $data['crumble_slider_animation_speed'] ); ?>,
			pauseTime: <?php echo stripslashes( $data['crumble_slider_animation_pause'] ); ?>,
			captionOpacity: <?php echo stripslashes( $data['crumble_slider_caption_opacity'] ); ?>,
			directionNav: true
            
            });        

    });
});	

</script>
<?php } ?>

	<?php  
		/*
			Check for enable/disable carousel
		*/
		$carousel_visible = stripslashes ( $data['crumble_carousel_visible'] ); 
		if ( $carousel_visible == "Enable" ) {
	?>

	<script type="text/javascript">
		jQuery.noConflict()(function($){
			$(document).ready(function() {
	
				$('#crumble_carousel').jcarousel({
					   easing: '<?php echo stripslashes( $data['crumble_carousel_easing'] ); ?>',
		        	   animation : <?php echo stripslashes( $data['crumble_carousel_animation_speed'] ); ?>,
				});
	
	    	});
		});	
	</script>
	<?php } ?>

	<script type="text/javascript">
		jQuery.noConflict()(function($){
		    $(document).ready(function(){

			$('.flexslider').flexslider({
									    animation: "fade",
										directionNav: true,
										controlNav: false
									  });
		});
   	});
	</script>	

<?php if( (stripslashes( $data['crumble_show_date'] ) == 'Show') && (stripslashes( $data['crumble_show_second_menu'] ) == 'Hide') ) { ?>
	<script type="text/javascript">
		jQuery.noConflict()(function($){
			$(document).ready(function() {

		function crumble_get_time() {
		  	now=new Date();
	 	
		 	hour=now.getHours();
		 	min=now.getMinutes();
		 	sec=now.getSeconds();

			if (min<=9) { min="0"+min; }
			if (sec<=9) { sec="0"+sec; }

			if (hour>12) { hour=hour-12; add="pm"; }
				else { hour=hour; add="am"; }

			if (hour==12) { add="pm"; }
	
			time = ((hour<=9) ? "0"+hour : hour) + ":" + min + ":" + sec + " " + add;

			if (document.getElementById) { document.getElementById('timeNow').innerHTML = time; }
				else if (document.layers) {
					 document.layers.theTime.document.write(time);
					 document.layers.theTime.document.close(); }
		 
					 setTimeout(crumble_get_time, 1000);
			}
			window.onload = crumble_get_time;
		});
	});
	</script>
<?php } ?>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-25782645-5', 'auto');
	ga('require', 'linkid', 'linkid.js');
	ga('send', 'pageview');

</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>

</body>

</html>


