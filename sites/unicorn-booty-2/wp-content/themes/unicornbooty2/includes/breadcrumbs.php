<div id="breadcrumbs" style="font-size:20px;padding:0px 72px;">
		
<?php
	$parents = get_category_parents($cat);
	//error_log(get_category_parents($cat, TRUE, ' &raquo; '));
?>		
		
	<?php if(function_exists('bcn_display')) { bcn_display(); } 
		  else { ?>
				<a href="<?php bloginfo('url'); ?>"><?php _e('Home','ubooty') ?></a> <span >&gt;</span>
				
				<?php if( is_tag() ) { ?>
					<?php _e('Posts Tagged ','ubooty') ?><span >&quot;</span><?php single_tag_title(); echo('&quot;'); ?>
				<?php } elseif (is_day()) { ?>
					<?php _e('Posts made in','ubooty') ?> <?php the_time('F jS, Y'); ?>
				<?php } elseif (is_month()) { ?>
					<?php _e('Posts made in','ubooty') ?> <?php the_time('F, Y'); ?>
				<?php } elseif (is_year()) { ?>
					<?php _e('Posts made in','ubooty') ?> <?php the_time('Y'); ?>
				<?php } elseif (is_search()) { ?>
					<?php _e('Search results for','ubooty') ?> <?php the_search_query() ?>
				<?php } elseif (is_single()) { ?>
					<?php $category = get_the_category();
						  $catlink = get_category_link( $category[0]->cat_ID );
						  $crumbs = get_category_parents($category[0]->cat_ID, TRUE, ' &gt; ');
						  echo (substr($crumbs,0,strlen($crumbs)-5));//('<a href="'.$catlink.'">'.$category[0]->cat_name.'</a> '.'<span >&gt;</span> ');
						  //echo (get_the_title()); 
						
						  ?>
				<?php } elseif (is_category()) { ?>
					<?php 
					//single_cat_title();
					$crumbs = get_category_parents($cat, TRUE, ' &gt; ');
					$crumbs = substr($crumbs,0,strlen($crumbs)-5);
					
					$parents = get_category_parents($cat);
					$pararr = explode('/',$parents);
				
					if(sizeof($pararr)>2){
						$crumbs = substr($crumbs,0,strpos($crumbs,'&gt;')+4);
					}else{
						$crumbs='';
					}
					echo ($crumbs.'&nbsp;'.get_cat_name($cat)); 
					?>
				<?php } elseif (is_author()) { ?>
					<?php global $wp_query; $curauth = $wp_query->get_queried_object(); _e('Posts by ','ubooty'); echo ' ',$curauth->nickname; ?>
				<?php } elseif (is_page()) { ?>
					<?php wp_title(''); ?>
				<?php }; ?>
	<?php }; ?>

</div> <!-- end #breadcrumbs -->