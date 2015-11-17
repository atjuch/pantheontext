<?php get_header(); ?>

	<?php setPostViews(get_the_ID()); ?>
	
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
			<?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
				
				<div id="post-<?php the_ID(); ?>" <?php post_class('crumble-post'); ?> itemscope itemtype="http://schema.org/BlogPosting">
					<h1 class="single-title" itemprop="name headline"><?php the_title(); ?></h1>
				
					<div class="single-meta-information">
					
						<ul class="single-post-meta">
							<li class="date-icon"><time datetime="<?php the_time('F d, Y'); ?>" itemprop="datePublished"><?php the_time('F d, Y'); ?></time></li>
							<li class="user-icon"><?php echo the_author_link(); ?><meta itemprop="author" content="<?php echo get_the_author_meta( 'nickname' ); ?>"></li>
							<li class="category-icon"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></li>
							<li class="comments-icon"><?php comments_popup_link(__('No Comments','crumble'),__('1 Comment','crumble'),__('% Comments','crumble')); ?></li>
						</ul> <!-- /single-post-meta -->
					
						<div class="clear"></div>

						<?php if ( has_post_format('audio') ) echo '<div class="single-post-format-icon format-audio-icon"></div>'; ?>
						<?php if ( has_post_format('video') ) echo '<div class="single-post-format-icon format-video-icon"></div>'; ?>
						<?php if ( has_post_format('gallery') ) echo '<div class="single-post-format-icon format-gallery-icon"></div>'; ?>
						<?php if ( has_post_format('image') ) echo '<div class="single-post-format-icon format-image-icon"></div>'; ?>

						<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) echo '<div class="single-post-format-icon format-standard-icon"></div>'; ?>									

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
		                        		<?php	$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb'); 
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
				
							<div class="single-video-post">
						
								<?php	$video_type = get_post_meta( $post->ID, 'crumble_mb_post_video_type', true );							
									$videoid = get_post_meta( $post->ID, 'crumble_mb_post_video_file', true );

	            					if ( $video_type == 'youtube' ) {
		            					echo '<iframe height="315" src="http://www.youtube.com/embed/' . $videoid . '?autohide=1&amp;showinfo=0"></iframe>';
		            				} else if ( $video_type == 'vimeo' ) {	            					
		            					echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '" height="315"></iframe>';	            				
		            				}	
									else if( $video_type == 'dailymotion' ) { 
										echo '<iframe height="220" src="http://www.dailymotion.com/embed/video/' . $videoid . '?logo=0"></iframe>';
									 } ?>
		            				
							</div> <!-- /single-video-post-->		
						<?php } ?>

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
				
							<div class="single-audio-post">
						
								<?php	
									
									$soundcloud = get_post_meta( $post->ID, 'crumble_mb_post_soundcloud', true );

	            					if ( $video_type != '' ) {
		            					echo $soundcloud;
									 } ?>
		            				
							</div> <!-- /single-audio-post-->		
						<?php } ?>



						<?php						
						/*
						-----------------------------------------------------------------------------------------------------------------						
								CONTENT
						-----------------------------------------------------------------------------------------------------------------							
						*/?>

                    <?php
                    // ultimatesocial top post
                    if(shortcode_exists('ultimatesocial')) {
                        echo do_shortcode( '[ultimatesocial networks="facebook,twitter,googleplus,pinterest,linkedin,reddit,stumble,mail" align="right" skin="round" count="false"]' );
                    } ?>

						<span itemprop="articleBody"><?php the_content(); ?></span>
						<?php ct_wp_link_pages(); ?>

                    <?php
                    // ultimatesocial bottom post
                    if(shortcode_exists('ultimatesocial')) {
                        echo do_shortcode( '[ultimatesocial networks="facebook,twitter,googleplus,pinterest,linkedin,reddit,stumble,mail" align="right"]' );
                    } ?>

                    <div class="clear"></div>

		        	<div style="float: right">
			    	    <?php the_tags('', '  ', '<br />'); ?>
			    	    <meta itemprop="keywords" content="<?php echo strip_tags(get_the_tag_list('',', ','')); ?>">
		        	</div>
				
					<div class="clear"></div>
				</div>

		<div class="margin-30t"></div>

		<?php		
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Post Widget") ) : ?>                
		<?php endif; ?> 
							
		<div class="clear"></div>

				<?php
			  			endwhile;  
					endif;  
				?>		

				<div class="clear"></div>


		<?php wp_link_pages(); ?>

<?php wp_reset_postdata(); comments_template(); ?>

				<?php if( get_previous_post() || get_next_post() )  { ?>	
					<!-- Begin Navigation -->
					<div class="before-nav"></div>
					<div class="single-post-navigation">
						
						<div class="prev-left" >
							<?php if( get_previous_post() ) : ?>
								<?php previous_post_link('<div class="prev-arrow">%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /prev-left -->
						
						<div class="next-right" >
							<?php if( get_next_post() ) : ?>
								<?php next_post_link('<div class="next-arrow">%link</div>') ?>
							<?php endif; ?>					
						</div> <!-- /next-right -->
						<div class="clear"></div>
					</div> <!-- /single-post-navigation -->

					<div class="after-nav"></div>
				 <?php } ?>	
		</div> <!-- eleven columns -->
		
		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Right' ) get_sidebar();
		 ?>			

		<div class="clear"></div>
	
	</div> <!-- /container -->
	
</div> <!-- content-wrapper -->

<?php get_footer(); ?>