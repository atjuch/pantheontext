<?php
	/* 
		Template Name: Fullwidth Page 
	*/
?>

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
		<div class="sixteen columns standard-link">	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div class="post-title"><h1><?php the_title(); ?></h1></div>
					<div class="clear"></div>

						<?php the_content(); ?>

				<?php endwhile; endif; ?>
		 </div>		
	</div>			
	</div>	

			<!-- End Content -->
<?php get_footer(); ?>