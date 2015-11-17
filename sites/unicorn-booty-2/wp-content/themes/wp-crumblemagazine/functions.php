<?php
/**
 * Slightly Modified Options Framework
*/
require_once ('admin/index.php');


/*=======================================
    Preparing the Theme For Localization
=======================================*/
add_action('after_setup_theme', 'accord_theme_setup');
function accord_theme_setup(){
	load_theme_textdomain( 'crumble', get_template_directory() . '/languages' );
}


/*=======================================
	Add WP Menu Support
=======================================*/

function register_crumble_menu() { 
  register_nav_menus(
    array(
      'main_menu' => __( 'main navigation' , 'crumble' ),
      'secondary_menu' => __( 'additional navigation' , 'crumble' )
    )
  );
}


add_action( 'init', 'register_crumble_menu' ); 



/*require_once('includes/el-metabox-portfolio.php');*/

/*=======================================
	Register Sidebar
=======================================*/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div><div class="clear"></div>',
        'before_title' => '<div class="widget-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Magazine',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Single Post Widget',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Top Blog',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Bottom Blog',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Reviews',
        'before_widget' => '',
        'after_widget' => '<div class="clear"></div><div class="margin-30b"></div>',
        'before_title' => '<div class="post-title"><h4>',
        'after_title' => '</h4></div>',
    ));


if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: First Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Second Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Third Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Footer: Fourth Column',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
));



/*=======================================
	Content Width and Excerpt Redeclared
=======================================*/
if ( !isset( $content_width ) ) 
    $content_width = 980;

// Remove rel attribute from the category list
function remove_category_list_rel($output)
{
  $output = str_replace(' rel="category"', '', $output);
  return $output;
}

add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

add_theme_support( 'automatic-feed-links' );

function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');


function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



 // Add Theme Thumbnails Support
	 if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   		
	}

 add_image_size('mag-carousel', 420, 300, true); 
 add_image_size('big-post-thumb', 630, 315, true); 
 add_image_size('single-post-thumb', 300, 200, true);
 add_image_size('small-post-thumb', 80, 50, true); 
 add_image_size('related-post-thumb', 137, 85, true); 
 add_image_size('mag-slider', 630, 390, true); 
 add_image_size('fix', 80, 80, true); 


/*=======================================
	Add Admin Bar only for Editors
=======================================*/

if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}



/*=======================================
	Show Featured Images in RSS Feed
 =======================================*/

function featuredtoRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
}
return $content;
}
 
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/*-----------------------------------------------------------------------------------*/
/*  This will add rel=lightbox[postid] to the href of the image link
/*-----------------------------------------------------------------------------------*/
    if ( !function_exists( 'ct_add_prettyphoto_rel' ) ) {
        function ct_add_prettyphoto_rel ($content)
        {   
            global $post;
            $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
            $replacement = '<a$1href=$2$3.$4$5 rel="prettyphoto['.$post->ID.']"$6>$7</a>';
            $content = preg_replace($pattern, $replacement, $content);
            return $content;
        }
        add_filter('the_content', 'ct_add_prettyphoto_rel', 12);
    }


/*=======================================
   prettyPhoto in WordPress Galleries
 =======================================*/
//add_filter( 'wp_get_attachment_link', 'crumble_prettyadd');
 
//function crumble_prettyadd ($content) {
//	$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[slides]\"",$content,1);
//	return $content;
//}



 /*=======================================
	Post Formats
 =======================================*/


add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );


/*=======================================
	Enable Shortcodes In Sidebar Widgets
=======================================*/

add_filter('widget_text', 'do_shortcode');


// Get Tag ID Function
					function get_tag_id_by_name($tag_name) {
						global $wpdb;
						$tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE `name` = '".$tag_name."'");
						return $tag_ID;
					}


// Exclude page from search 
function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type',  array( 'post', 'reviews'));
}
return $query;
}
//add_filter('pre_get_posts','SearchFilter'); 



/*=======================================
	Include jQuery Libraries
=======================================*/
function my_scripts_method() {
	global $data;
	
	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {

		/* Super Fish JS */
		wp_register_script('super-fish',get_template_directory_uri().'/js/superfish.js',false, null , true);
		wp_enqueue_script('super-fish',array('jquery'));	

		/* Jquery-Easing */
		wp_register_script('jquery-easing',get_template_directory_uri().'/js/jquery.easing.1.3.js',false, null , true);
		wp_enqueue_script('jquery-easing',array('jquery'));	

		/* JCarousel */
		$carousel_visible = stripslashes ( $data['crumble_carousel_visible'] ); 
		if ( $carousel_visible == "Enable" ) {
		
			wp_register_script('jquery-carousel',get_template_directory_uri().'/js/jcarousel.min.js',false, null , true);
			wp_enqueue_script('jquery-carousel',array('jquery'));	
		}

		//wp_register_script('jquery-carousel-responsive',get_template_directory_uri().'/js/jcarousel_update.js',false, null , true);
		//wp_enqueue_script('jquery-carousel-responsive',array('jquery','jquery-carousel'));			

		/* Nivo Slider */
		$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 
		

		if( $enable_slider == 'Enable' ) {
		
			wp_register_script('jquery-nivoslider',get_template_directory_uri().'/js/jquery.nivo.slider.js',false, null , true);
			wp_enqueue_script('jquery-nivoslider',array('jquery'));	
		}

		/* Flickr */
		wp_register_script('jquery-flickr',get_template_directory_uri().'/js/jflickrfeed.min.js',false, null , true);
		wp_enqueue_script('jquery-flickr',array('jquery'));	

		/* Collapse */
		wp_register_script('jquery-collapse',get_template_directory_uri().'/js/jquery.collapse.js',false, null , true);
		wp_enqueue_script('jquery-collapse',array('jquery'));	

		/* Tabs */
		wp_register_script('jquery-tabs',get_template_directory_uri().'/js/tabs.js',false, null , true);
		wp_enqueue_script('jquery-tabs',array('jquery'));	

		
	
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));	



		/* Prettyphoto */
		wp_register_script('prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('prettyphoto-js',array('jquery'));

		/* Masonry */
		wp_register_script('masonry-js',get_template_directory_uri().'/js/jquery.masonry.min.js',false, null , true);
		wp_enqueue_script('masonry-js',array('jquery'));

		/* To Top */
		wp_register_script('scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
		wp_enqueue_script('scrolltopcontrol-js',array('jquery'));


		/* Custom JS */
		wp_register_script('custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('custom-js',array('jquery'));

	
	} /* End Include jQuery Libraries */
}
add_action('wp_enqueue_scripts', 'my_scripts_method');


// Related Post
function get_related_posts($post_id, $tags = array()) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	$query = new WP_Query( array('showposts' => 4,'post_type' => $post_types,'post__not_in' => array($post_id),'tag__in' => $tagsA,'ignore_sticky_posts' => 1,
	));
  	return $query;
}


function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = ($wp_rewrite->using_permalinks()) ? user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' ) : @add_query_arg('paged','%#%');
  if( !empty($wp_query->query_vars['s']) ) $a['add_args'] = array( 's' => get_query_var( 's' ) );
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = '3'; 
  $a['end_size'] = '1'; 
  $a['prev_text'] = 'Back'; 
  $a['next_text'] = 'Next'; 
  $a['total'] = $wp_query->max_num_pages;

  if ($max > 1) echo '<div class="pagination">';
  echo  paginate_links($a);
  if ($max > 1) echo '</div>';
}


function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'plain'
	);
	if( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	if( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
}



function upload_scripts_post() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');

	wp_register_script('project-scripts', get_template_directory_uri().'/admin/js/project_scripts.js', false);
	wp_enqueue_script('project-scripts');
		
}


function upload_styles_post() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'upload_scripts_post'); 
add_action('admin_print_styles', 'upload_styles_post'); 




// Add Widgets

include("functions/crumble-widget-twitter.php");
include("functions/crumble-tabs-widget.php");
include("functions/crumble-recent-posts-thumbs-widget.php");
include("functions/crumble-recent-reviews-widget.php");
include("functions/crumble-author-profile-widget.php");
include("functions/crumble-related-posts-widget.php");
include("functions/crumble-fblikebox-widget.php");

include("functions/crumble-fbcomments-widget.php");
include("functions/crumble-fbsubscribe-widget.php");
include("functions/crumble-sharethis-widget.php");
include("functions/crumble-1-column-magazine-widget-reviews.php");
include("functions/crumble-2-columns-magazine-widget-reviews.php");
include("functions/crumble-flickr-widget.php");
include("functions/crumble-recent-comments-widget.php");
include("functions/crumble-popular-post-widget.php");
include("functions/crumble-4ads125x125-widget.php");
include("functions/crumble-ads300x250-widget.php");
include("functions/crumble-ads630x90-widget.php");
include("functions/crumble-1-column-magazine-widget-horizontal.php");
include("functions/crumble-2-columns-magazine-widget-vertical.php");
include("functions/crumble-2-columns-magazine-widget-thumbs.php");
include("functions/crumble-video-widget.php");
include("functions/social-counter/social-counter-widget.php");
include("functions/crumble-recent-posts-widget.php");



function custom_active_item_class($link) {
  return str_replace('current_page_item', 'crumble_current_page_item', $link);
}
 
add_filter('wp_nav_menu', 'custom_active_item_class');
add_filter('wp_list_pages', 'custom_active_item_class');

/**
*	Create Review Post Type 
*/
include("functions/reviews/crumble_create_review.php");

/**
*	Create Post Views in admin panel 
*/
include("includes/post_views.php");


/**
*	Create Social Links for Author
*/
include("includes/author_social.php");


/**
*	Get Shortcodes
*/
include("includes/shortcodes.php");


/**
*	SounCloud Shortcodes
*/
include("includes/soundcloud-shortcode.php");


// Get author for comment
function dp_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = __('Anonymous', 'crumble' );
    else
        $author = $comment->comment_author;
    return $author;
} 


/*-----------------------------------------------------------------------------------*/
/* Displays page links for paginated posts/pages
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_link_pages' ) ) {
    function ct_wp_link_pages( $args = '' ) {
        $defaults = array(
            'before' => '<p class="pagination clearfix"><span>' . __( 'Pages:', 'crumble' ) . '</span>', 
            'after' => '</p>',
            'text_before' => '',
            'text_after' => '',
            'next_or_number' => 'number', 
            'nextpagelink' => __( 'Next page', 'crumble' ),
            'previouspagelink' => __( 'Previous page', 'crumble' ),
            'pagelink' => '%',
            'echo' => 1
        );

        $r = wp_parse_args( $args, $defaults );
        $r = apply_filters( 'wp_link_pages_args', $r );
        extract( $r, EXTR_SKIP );

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ( $multipage ) {
            if ( 'number' == $next_or_number ) {
                $output .= $before;
                for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
                    $j = str_replace( '%', $i, $pagelink );
                    $output .= ' ';
                    if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                        $output .= _wp_link_page( $i );
                    else
                        $output .= '<span class="current">';

                    $output .= $text_before . $j . $text_after;
                    if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
                        $output .= '</a>';
                    else
                        $output .= '</span>';
                }
                $output .= $after;
            } else {
                if ( $more ) {
                    $output .= $before;
                    $i = $page - 1;
                    if ( $i && $more ) {
                        $output .= _wp_link_page( $i );
                        $output .= $text_before . $previouspagelink . $text_after . '</a>';
                    }
                    $i = $page + 1;
                    if ( $i <= $numpages && $more ) {
                        $output .= _wp_link_page( $i );
                        $output .= $text_before . $nextpagelink . $text_after . '</a>';
                    }
                    $output .= $after;
                }
            }
        }

        if ( $echo )
            echo $output;

        return $output;
    }
}


/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_pagination' ) ) {
    function ct_pagination($pages = '', $range = 4)
    {  
        $showitems = ($range * 2)+1;  
 
        global $paged;
        if(empty($paged)) $paged = 1;
 
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }   
 
		if(1 != $pages)
		{
			echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>".__('Page ','crumble').$paged." ".__('of','crumble')." ".$pages."</span>";

			if (is_rtl()) {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>".__('First','crumble')." &laquo;</i></a>";
			} else {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; ".__('First','crumble')."</a>";
			}


			if (is_rtl()) {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>".__('Previous','crumble')." &lsaquo;</a>";
			} else {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; ".__('Previous','crumble')."</a>";
			}
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if (is_rtl()) {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo; ".__('Next','crumble')."</a>";  
			} else {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','crumble')." &rsaquo;</a>";
			}

			if (is_rtl()) {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo; ".__('Last','crumble')."</a>";
			} else {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','crumble')." &raquo;</a>";
			}

			echo "</div>\n";
		}
    }
}


function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="first-comment">
			<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e( 'Your comment is awaiting moderation.' , 'crumble' ); ?></em>
			<?php endif; ?>

	    	<?php 
	    	/*
	    		Gravatar
	    	*/
	    	echo get_avatar($comment,$size='50',$default='' );
	    	?>

			<div class="comment-author-link">
				<?php 
				/*
					Author comment
				*/
				comment_author_link(); 
				?>
			</div> <!-- .comment-author-link -->
			
			<div class="comment-date-link">
				<?php echo get_comment_date('F d, Y g:i:s a'); ?>
			</div>

			<?php comment_text() ?>

			<div class="replay-buttton">	
				<?php comment_reply_link(array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>	
			</div><!-- .replay-buttton -->
			<div class="clear"></div>	
		</div> <!-- end #comment-ID -->
<?php
}
