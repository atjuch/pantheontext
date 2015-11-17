<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CrumbleMagazine ADS 630x90 Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that show ADS in Magazine content ( img width: 630px; img height: 90px ).
 	Version: 1.0
 	Author: Zerge
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CrumbleMagazine_ads630x90_load_widgets');


function CrumbleMagazine_ads630x90_load_widgets(){
		register_widget("CrumbleMagazine_Ads630x90_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrumbleMagazine_Ads630x90_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */
	function CrumbleMagazine_Ads630x90_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'crumble_ads630x90_widget', 'description' => __( 'Ads for Magazine Widget' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_ads630x90_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumble_ads630x90_widget' , __( 'CrumbleMagazine: Ads 630x90' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$link = $instance['link'];
		$image = $instance['image'];
		
		?>
		<?php
			if($image) {	
			?>				
			<div class="ads630x90">
				<a href="<?php echo $link; ?>">
					<img src="<?php echo $image; ?>" alt="" />
				</a>
			</div> <!-- /ads630x90 -->
		<?php
		}
		
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
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