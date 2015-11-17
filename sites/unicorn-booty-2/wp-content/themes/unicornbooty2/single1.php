<?php get_header();
the_post(); ?>



<div id="content" class="clearfix">
	<?php if (get_option('ubooty_integration_single_top') <> '' && get_option('ubooty_integrate_singletop_enable') == 'on') echo(get_option('ubooty_integration_single_top')); ?>
	<div id="left-area">
		<div id="post" class="post">
			<div class="post-content clearfix">
				<div class="info-panel">
					<?php include(TEMPLATEPATH . '/includes/infopanel.php'); ?>
				</div> <!-- end .info-panel -->
				
				<div class="post-text">
					<h1 class="title"><?php the_title(); ?></h1>
					
					<?php if (get_option('ubooty_postinfo2') <> '') { ?>
						<p class="post-meta">
							<?php _e('Posted','ubooty'); ?> <?php if (in_array('author', get_option('ubooty_postinfo2'))) { ?> <?php _e('by','ubooty'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('ubooty_postinfo2'))) { ?> <?php _e('on','ubooty'); ?> <?php the_time(get_option('ubooty_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('ubooty_postinfo2'))) { ?> <?php _e('in','ubooty'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('ubooty_postinfo2'))) { ?> | <?php comments_popup_link(__('0 comments','ubooty'), __('1 comment','ubooty'), '% '.__('comments','ubooty')); ?><?php }; ?>
						</p>
					<?php }; ?>
					
					<div class="hr"></div>
					
					<?php the_content(); ?>
					
					<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','ubooty').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					<?php edit_post_link(__('Edit this page','ubooty')); ?>
					
					<?php if (get_option('ubooty_integration_single_bottom') <> '' && get_option('ubooty_integrate_singlebottom_enable') == 'on') echo(get_option('ubooty_integration_single_bottom')); ?>
					
					<a href="/ask-the-bottom-whisperer"><img src="<?php bloginfo('template_directory'); ?>/images/bw_tip.png" alt="ask the bottom whisperer" class="foursixeight" /></a>
				</div> <!-- .post-text -->
			</div> <!-- .post-content -->			
		</div> <!-- #post -->
		
		<?php if (get_option('ubooty_show_postcomments') == 'on') comments_template('', true); ?>
	</div> <!-- #left-area -->
	<?php get_sidebar(); ?>
</div> <!-- #content -->
			
<div id="content-bottom-bg"></div>
			
<?php get_footer(); ?>			