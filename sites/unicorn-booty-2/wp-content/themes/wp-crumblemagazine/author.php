<?php 
/**
 * The template for displaying Author Archive pages.
 *
 */
 
get_header();

?>


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

			<?php if ( have_posts() ) : ?>

				<?php
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					the_post();
				?>


		
							<div class="pages-titles">
					<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'crumble' ), '<span class="vcard"><a class="url fn n" style="padding: 3px;color: #BFBFBF; font-weight: normal;" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
									<div class="clear"></div>
							</div> <!-- /pages-titles -->
	
				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

		
				<?php
				// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2 style="background-color: #467504; padding: 3px; display: inline-block;"><?php printf( __( 'About %s', 'crumble' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div><!-- #author-description	-->
				</div><!-- #author-info -->
				<?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
	
				
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

	<?php endwhile; ?>		

				<div class="clear"></div>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'crumble' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'crumble' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
			

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