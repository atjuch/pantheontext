<?php global $data, $id; ?>
	<div class="pat-block"></div>
	<div class="inner-pat">
	
		<div class="container">
			<div class="sixteen columns">
				<?php 
					$carousel_title = stripslashes( $data['crumble_carousel_title'] ); 
					if ( $carousel_title != '' ) {
				?>
				<h2 class="featured-carousel-title"><?php echo $carousel_title; ?></h2>
				<?php } ?>

				<div class="clear"></div>
			</div> <!-- /sixteen columns -->
		</div> <!-- /container -->		
	</div> <!-- /inner-pat -->

	<div class="pat-block-after"></div>


	<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			var $zcarousel = $('#crumble_carousel');

		    if( $zcarousel.length ) {

		        var scrollCount;
		        var itemWidth;

		        if( $(window).width() < 479 ) {
           			scrollCount = 1;
            		itemWidth = 300;
        		} else if( $(window).width() < 768 ) {
	            	scrollCount = 2;
            		itemWidth = 200;
        		} else if( $(window).width() < 960 ) {
	            	scrollCount = 3;
            		itemWidth = 172;
        		} else {
	            	scrollCount = 4;
            		itemWidth = 230;
        	}

        	$zcarousel.jcarousel({
               	scroll    : scrollCount,
               	setupCallback: function(carousel) {
               	carousel.reload();
	                },
                	reloadCallback: function(carousel) {
	                    var num = Math.floor(carousel.clipping() / itemWidth);
                    	carousel.options.scroll = num;
                    	carousel.options.visible = num;
                	}
            	});
        	}
		});
		/* ]]> */
	</script>

	<div id="carousel-wrap">
		<div class="container">
				
				<ul id="crumble_carousel" class="jcarousel-skin-tango">
			<?php
					$carousel_post_count = stripslashes( $data['crumble_carousel_items'] );
					
					if ($carousel_post_count == '') { $carousel_post_count = -1; }
					
					$args = array( 'numberposts' => $carousel_post_count, 'category' => $id );
					$myposts = get_posts( $args );
					
				// The Loop
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				
				<?php if(  has_post_thumbnail() ) { ?>
				<li><div class="carousel-thumb four columns">
				
					<?php if ( has_post_format('audio') ) { ?>
						<a href="<?php the_permalink(); ?>"><div class="mask audio"></div></a>
					<?php } ?>
					
					<?php if ( has_post_format('video') ) { ?>
						<a href="<?php the_permalink(); ?>"><div class="mask video"></div></a>
					<?php } ?>

					<?php if ( has_post_format('gallery') ) { ?>
						<a href="<?php the_permalink(); ?>"><div class="mask gallery"></div></a>
					<?php } ?>
					
					<?php if ( has_post_format('image') ) { ?>
						<a href="<?php the_permalink(); ?>"><div class="mask image"></div></a>
					<?php } ?>


					<?php if ( !has_post_format('audio') && !has_post_format('video') && !has_post_format('gallery') && !has_post_format('image') ) { ?>
						<a href="<?php the_permalink(); ?>"><div class="mask standard"></div></a>
					<?php } ?>				
				
				
					<div class="post-comments">
						<?php 
							comments_number('0','1','%');
						?>
					</div> <!-- /post-comments -->

					<?php
						$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mag-carousel'); 
				?>
					<img src="<?php echo $image_url[0]; ?>" alt="" />
					<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
	<?php			
			echo "</div></li>";
			}
			endforeach;
	
	
			wp_reset_query();					
	?>

			</ul>
		</div>
		<div class="pat-block"></div>

	</div> 
