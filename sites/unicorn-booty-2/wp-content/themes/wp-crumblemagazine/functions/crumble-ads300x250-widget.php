<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrumbleMagazine ADS 300x250 Sidebar Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show ADS in Sidebar ( img width: 300px; img height: 250px ).
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrumbleMagazine_ads300x250_load_widgets');


function CrumbleMagazine_ads300x250_load_widgets(){
		register_widget("CrumbleMagazine_Ads300x250_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrumbleMagazine_Ads300x250_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CrumbleMagazine_Ads300x250_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'crumble_ads300x250_widget', 'description' => __( 'CrumbleMagazine: Ads 300x250 for sidebar widget' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_ads300x250_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumble_ads300x250_widget', __( 'CrumbleMagazine: Ads 300x250' , 'crumble' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$link = $instance['link'];
		$image = $instance['image'];
		?>

		<div class="widget">
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		
		<?php
			if($image) {	
			?>				
			<div class="ads300-thumb">
				<a href="<?php echo $link; ?>">
					<img src="<?php echo $image; ?>" alt="" />
				</a>
			</div> <!-- /ads300-thumb -->
			<?php } ?>	
		</div> <!-- /widget ads300 -->
		<?php
		

	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS300', 'crumble' ), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Image Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" />
		</p>
		<?php

	}
}
?>