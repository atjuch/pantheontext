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
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="post-title"><h2><?php the_title(); ?></h2></div>
					
						<div class="clear"></div>

						<?php the_content(); ?>
						<?php ct_wp_link_pages(); ?>

				<?php endwhile; endif; ?>
				
		 </div> <!-- /eleven columns -->		
		<?php 
			$sidebar = stripslashes( $data['crumble_sidebar_position'] );

			if ( $sidebar == 'Right' ) get_sidebar();	 
		?>	
		
		</div> <!-- /container -->			
		
	</div> <!-- /content-bg-wrapper -->	
	<!-- End Content -->
	
<?php get_footer(); ?>