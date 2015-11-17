<?php if (get_option('ubooty_blog_style') == 'false') { ?>

	<?php $biglayout = ( (bool) get_post_meta($post->ID,'et_bigpost',true) ) ? true : false;

		$thumb = '';
		$width = $biglayout ? 466 : 222;
		$height = 180;
		$classtext = '';
		$titletext = get_the_title();
		
		$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
		$thumb = $thumbnail["thumb"]; ?>
		
	<div class="entry <?php if ($biglayout) echo('big'); else echo('small');?>">
		<div class="thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
				<span class="overlay"></span>
			</a>
			<div class="category community"><?php the_category(); ?></div>
			<span class="month"><?php the_time('M'); ?><span class="date"><?php the_time('d'); ?></span></span>
		</div> <!-- end .thumbnail -->	
		<h2 class="title"><a href="<?php the_permalink(); ?>"><?php if ($biglayout) truncate_title(40); else truncate_title(20); ?></a></h2>
		<p class="postinfo"><?php _e('posted by','ubooty'); ?> <?php the_author_posts_link(); ?></p>
		<div class="entry-content">
			<div class="bottom-bg">
				<div class="excerpt">
					<p><?php if ($biglayout) truncate_post(650); else truncate_post(295); ?> </p>
					<div class="textright">
						<a href="<?php the_permalink(); ?>" class="readmore"><span>&raquo;</span>&raquo;</a>
					</div>
				</div><!-- end .excerpt -->
			</div><!-- end .bottom-bg -->
		</div><!-- end .entry-content -->
	</div><!-- end .entry -->
	
<?php } else { ?>

	<div class="post">
		<div class="post-content clearfix">			
			<div class="post-text">
				<h2 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				
				<?php if (get_option('ubooty_postinfo1') <> '') { ?>
					<p class="post-meta">
						<?php _e('Posted','ubooty'); ?> <?php if (in_array('author', get_option('ubooty_postinfo1'))) { ?> <?php _e('by','ubooty'); ?> <?php the_author_posts_link(); ?><?php }; ?><?php if (in_array('date', get_option('ubooty_postinfo1'))) { ?> <?php _e('on','ubooty'); ?> <?php the_time(get_option('ubooty_date_format')) ?><?php }; ?><?php if (in_array('categories', get_option('ubooty_postinfo1'))) { ?> <?php _e('in','ubooty'); ?> <?php the_category(', ') ?><?php }; ?><?php if (in_array('comments', get_option('ubooty_postinfo1'))) { ?> | <?php comments_popup_link(__('0 comments','ubooty'), __('1 comment','ubooty'), '% '.__('comments','ubooty')); ?><?php }; ?>
					</p>
				<?php }; ?>
				
				<div class="hr"></div>
				
				<?php the_content(); ?>
				
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages','ubooty').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php edit_post_link(__('Edit this page','ubooty')); ?>
			</div> <!-- .post-text -->
			
			<div class="info-panel">
				<?php include(TEMPLATEPATH . '/includes/infopanel.php'); ?>
			</div> <!-- end .info-panel -->
		</div> <!-- .post-content -->
	</div><!-- end .post -->
	
<?php } ?>