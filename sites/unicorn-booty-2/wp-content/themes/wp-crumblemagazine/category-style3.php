
<?php get_header(); ?>


	<div class="pat-block"></div>

<?php
	/*
		------------------------------------------
			Start Content
		------------------------------------------				
	*/
?>
<div id="content-bg-wrapper">
	<div class="container">

		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Left' ) get_sidebar(); 
		?>	

							
		<div class="eleven columns standard-link">		
		
							<div class="pages-titles">
									<h1><?php echo single_cat_title('', false); ?></h1>
									<div class="clear"></div>
							</div> <!-- /pages-titles -->

			<?php if ( is_rtl() ) : $ct_rtl = '1'; else : $ct_rtl = '0'; endif; ?>

			<script type="text/javascript">
				/* <![CDATA[ */
				jQuery.noConflict()(function($){

					<?php if ( $ct_rtl ) : ?>
						$('#content_masonry').masonry({ isRTL: true });
					<?php else : ?>
						$('#content_masonry').masonry();
					<?php endif; ?>

					$(window).resize(function() {
						
						var 
							$content_masonry = $('#content_masonry');
							$masonry_box = $('#content_masonry .masonry_box');

				        if( $(window).width() > 959 ) {               
							$content_masonry.css({ 'width' : '680px' } );	
							$masonry_box.css({ 'width' : '290px' });	
						} 

        				if( ($(window).width() > 768) && ($(window).width() < 959)) {
							$content_masonry.css({ 'width' : '600px' } );	
							$masonry_box.css({ 'width' : '225px' });	
						} 

        				if( ($(window).width() > 479) && ($(window).width() <= 768)) {
							$content_masonry.css({ 'width' : '600px' } );	
							$masonry_box.css({ 'width' : '400px' });	
						} 

						if( ($(window).width() <= 479)) {               
							$content_masonry.css({ 'width' : '300px' } );	
							$masonry_box.css({ 'width' : '280px' });	
						} 

   						$('#content_masonry').masonry('reload');
   					});
				});
				/* ]]> */
			</script>

	
		<div id="content_masonry">		
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	

		<div class="masonry_box">				
				<div id="post-<?php the_ID(); ?>" >	
					<a href="<?php the_permalink(); ?>" class="blog-link"><h2 class="single-title"><?php the_title(); ?></h2></a>
				
					<div class="single-meta-information">
					
						<ul class="single-post-meta">
							<li class="date-icon"><?php the_time('F d, Y'); ?></li>
							<li class="user-icon"><?php echo the_author_link(); ?></li>
							<li class="category-icon"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></li>
							<li class="comments-icon"><?php comments_popup_link(__('No Comments','crumble'),__('1 Comment','crumble'),__('% Comments','crumble')); ?></li>
						</ul> <!-- /single-post-meta -->

						<?php if ( has_post_format('audio') ) echo '<div class="single-post-format-icon format-audio-icon"></div>'; ?>
						<?php if ( has_post_format('video') ) echo '<div class="single-post-format-icon format-video-icon"></div>'; ?>
						<?php if ( has_post_format('gallery') ) echo '<div class="single-post-format-icon format-gallery-icon"></div>'; ?>
						<?php if ( has_post_format('image') ) echo '<div class="single-post-format-icon format-image-icon"></div>'; ?>

						<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) echo '<div class="single-post-format-icon format-standard-icon"></div>'; ?>									
					
						<div class="clear"></div>

					</div> <!-- /single-meta-information -->	
				
			
<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Image or Standard  
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                   	<?php 
							if ( has_post_format( 'image' ) || ( !has_post_format( 'image' ) &&  !has_post_format( 'video' ) && !has_post_format( 'audio' ) && !has_post_format( 'gallery' ) )  ) {	                   	?>
									<?php
										if ( has_post_thumbnail() ) { 
									?>
										<div class="single-media-thumb"> 							
										<?php										
		                        			$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb'); 
											$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 	                        	
				                        ?>  
				
				                    	<a data-rel="prettyPhoto" href="<?php echo $large_image_url[0]; ?>" class="zoom"><img src="<?php echo $small_image_url[0]; ?>" alt="" /></a>				
									</div> <!-- /single-media-thumb -->									

								<?php } ?>

						<?php } ?>
						

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Gallery
-----------------------------------------------------------------------------------------------------------------							
*/
?>

	                   	<?php 
					  		$image1 = get_post_meta( $post->ID, 'crumble_mb_image1_upload', true );	                   		
					  		$image2 = get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ); 					  		
					  		$image3 = get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ); 					  		
					  		$image4 = get_post_meta( $post->ID, 'crumble_mb_image4_upload', true ); 					  							  		
					  		$image5 = get_post_meta( $post->ID, 'crumble_mb_image5_upload', true ); 					  							  		
					  		
							if ( has_post_format( 'gallery' ) && ( ( $image1 != '') or ( $image2 != '') or ( $image3 != '' ) or ( $image4 != '') or ( $image5 != '' ) ) ) {	                   	
						?>

							<!-- Start FlexSlider -->				
							<div class="flexslider">
								  <ul class="slides">
								  	<?php 
								  		if ( $image1 != ''  ) {	
								  	?>
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image1_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image1_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>

								  	<?php 

								  		if ( $image2 != ''  ) {	
								  	?>							    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image2_upload', true ) ?>" alt=""></a>
								    </li>
								    <?php } ?>
								    

								  	<?php 
								  		if ( $image3 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image3_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>

								  	<?php 
								  		if ( $image4 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image4_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image4_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>

								  	<?php 
								  		if ( $image5 != ''  ) {	
								  	?>							    						    
								    <li>
										<a href="<?php echo get_post_meta( $post->ID, 'crumble_mb_image5_upload', true ) ?>" data-rel="prettyPhoto[gal]"><img src="<?php echo get_post_meta( $post->ID, 'crumble_mb_image5_upload', true ) ?>" alt=""></a>																							
								    </li>
								    <?php } ?>
								    								    
								  </ul>
							</div> <!-- /flexSlider -->		

						<?php } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Video  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
						<?php 
							if ( has_post_format ( 'video' ) ) {
						?>
				

						
								<?php	
									$video_type = get_post_meta( $post->ID, 'crumble_mb_post_video_type', true );							
									$videoid = get_post_meta( $post->ID, 'crumble_mb_post_video_file', true );
								if( $videoid != '' ) { ?>
									<div class="single-video-post">
							
									<?php								
		            					if ( $video_type == 'youtube' ) {
			            					echo '<iframe height="315" src="http://www.youtube.com/embed/' . $videoid . '?autohide=1&amp;showinfo=0"></iframe>';
			            				} else if ( $video_type == 'vimeo' ) {	            					
			            					echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '" height="315"></iframe>';	            				
			            				}	
										else if( $video_type == 'dailymotion' ) { 
											echo '<iframe height="220" src="http://www.dailymotion.com/embed/video/' . $videoid . '?logo=0"></iframe>';
										 } ?>
		            				
								</div> <!-- /single-video-post-->		
						<?php } } ?>

<?php 
/*
-----------------------------------------------------------------------------------------------------------------						
	Post Format = Audio  
-----------------------------------------------------------------------------------------------------------------							
*/
?>
						
						<?php 
							if ( has_post_format ( 'audio' ) ) {
						?>
				
							
						
								<?php	
									
									$soundcloud = get_post_meta( $post->ID, 'crumble_mb_post_soundcloud', true );

	            					if ( $soundcloud != '' ) { ?>
	            					<div class="single-audio-post">
		            			<?php	echo $soundcloud; ?>
									</div> <!-- /single-audio-post-->				            			
								<?php } ?>
		            				

						<?php } ?>



						<?php						
						/*
						-----------------------------------------------------------------------------------------------------------------						
								CONTENT
						-----------------------------------------------------------------------------------------------------------------							
						*/	
							if (isset( $data['crumble_readmore_blog'] ) ) $read_more = stripslashes ( $data['crumble_readmore_blog'] ); 						
							
							if ( $read_more == 'Show' ) {
								the_content('<div class="clear"></div><a style="float:right;" href="'. get_permalink($post->ID) . '">' . __('Read more...', 'crumble') . '</a><div class="margin-30b clearfix"></div>',FALSE,'');  
							} else {
								the_content('',TRUE,'');
							}	

						?>			
				
					<div class="clear"></div>

		        	<div style="float: right">
			    	    <?php the_tags('', '  ', '<br />'); ?> 
		        	</div>
				
					<div class="clear"></div>
				</div>

		<div class="margin-30t"></div>

							
		<div class="clear"></div>
</div>
				<?php
			  			endwhile;  
					endif;  
				?>		

				<div class="clear"></div>


</div>
				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
					<!-- Begin Navigation -->
					<div class="before-nav"></div>
							<div class="single-post-navigation">
								<?php if(function_exists('wp_corenavi')) { wp_corenavi(); } ?>  					
								<div class="clear"></div>
							</div> <!-- /single-post-navigation -->
	
						<div class="after-nav"></div>

				<?php endif; ?>		
		</div> <!-- eleven columns -->				
		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Right' ) get_sidebar();
		 ?>			

		<div class="clear"></div>
	
	</div> <!-- /container -->
	
</div> <!-- content-wrapper -->

<?php get_footer(); ?>