<?php get_header(); ?>

<?php  
/*
Check for enable/disable carousel
*/
$carousel_visible = stripslashes ( $data['crumble_carousel_visible'] ); 

if ( $carousel_visible == "Enable" ) {

	global $query_string, $post;	
	$carousel_category = stripslashes( $data['crumble_carousel_category'] );
	$idObj = get_category_by_slug( $carousel_category ); 
					
	if( $idObj != '' ) {
		$id = $idObj->term_id;
	}	
	get_template_part( 'includes/carousel' );
} else echo '<div class="pat-block"></div>';
?>
	

<?php
/*
------------------------------------------
	Start Content
------------------------------------------
*/
?>
<div id="content-bg-wrapper">
	<div class="container">
		<div class="eleven columns">
			<?php 
			/*
				Get Slider If Enable In Back-End Admin Panel
			*/
			$enable_slider = stripslashes( $data['crumble_slider_visible'] ); 

			if( $enable_slider == 'Enable' ) {
				get_template_part( 'includes/slider' );
	 		} 
		 	?>

			<?php 
			/*
				Get Magazine Widget for All Content
			*/

			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Magazine") ) : endif; ?>
			
		</div> <!-- /eleven columns -->

		<div class="five columns">
			<?php 
			/*
					Get Sidebar
			*/

			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : endif; ?> 
		</div> <!-- /five columns -->

		<div class="clear"></div>
	</div> <!-- /container -->
</div><!-- /content-bg-wrapper -->

<?php get_footer(); ?>