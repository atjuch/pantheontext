<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p><?php _e( "This post is password protected. Enter the password to view comments." , "crumble" ); ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>


<?php comments_number('','<div class="post-title"><h4>' . __('1 Comment','crumble') . '</h4></div>','<div class="post-title"><h4>' . __('% Comments','crumble') . '</h4></div>')?>



	<div class="clear"></div>

    <ul class="margin-comments">
      	<?php wp_list_comments('max_depth=3&callback=mytheme_comment'); ?>     
    </ul>

		
 <?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p><?php _e( "Comments are closed." , "crumble" ); ?></p>
	
	<?php endif; ?>
<?php endif; ?>


<div class="clear"></div>

<div id="respond">
	<?php if ( comments_open() ) : ?>

		<?php comment_form_title( '<div class="post-title"><h2>' . __('Leave a Reply','crumble') . '</h2></div>', '<div class="post-title"><h2>' . __('Leave a Reply to %s','crumble') . '</h2></div>' ); ?>
		
				<!--- replace comment_form();  -->
				<?php paginate_comments_links('prev_text=back&next_text=forward'); ?>
					<small><?php cancel_comment_reply_link(); ?></small>


<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p><?php _e( 'You must be' , 'crumble' ); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e( 'logged in' , 'crumble' ); ?></a> <?php _e('to post a comment.' , 'crumble' ); ?></p>
<?php else : ?>


<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="contact-form">
<?php if ( is_user_logged_in() ) : ?>
<p><?php _e( 'Logged in as' , 'crumble' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
<?php else : ?>

					<div style="float: left; display: block; margin-right: 20px;">
		                <fieldset>
                            <label><?php _e( 'Name' , 'crumble'); ?> <span class="required">:</span></label>
     
							<div class="clear"></div>

                            <input type="text" name="author" id="Myname" value="<?php echo esc_attr($comment_author); ?>" class="text" placeholder="<?php _e('Your name','crumble'); ?>"/>

                        </fieldset>


						<div class="clear"></div>
                        <div class="margin-10b"></div> 
                        
                        <fieldset>

                          <label><?php _e( 'Email' , 'crumble'); ?> <span class="required">:</span></label>
                                                             
						  <div class="clear"></div>
                          
                          <input type="text" name="email" id="myemail" value="<?php echo esc_attr($comment_author_email); ?>" class="text" placeholder="<?php _e('Your email','crumble'); ?>"/>

                        </fieldset>
                        
                        <fieldset>

                          <label><?php _e( 'Website' , 'crumble'); ?> <span class="required">:</span></label>
                                                             
						  <div class="clear"></div>
                          
                          <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" class="text" placeholder="<?php _e('Your website','crumble'); ?>"/>

                        </fieldset>                        
                        
                        <span style="font-size: 11px; font-style: italic; color: #999"><?php _e( 'Note: All fields are required to fill in!' , 'crumble' ); ?></span>
				</div>
<?php endif; ?>
				
					<div style="float: left">
                        <fieldset>

	                        <label><?php _e( 'Your Comment' , 'crumble' ); ?> <span class="required">:</span></label>

							<div class="clear"></div>
						
                    
							    <textarea name="comment" id="comment" rows="10" cols="10" class="text responsive-textarea" placeholder="<?php _e('Type your comment here...','crumble'); ?>"></textarea>

		                        <fieldset>
		                            <input name="submit" id="submit_form" value="<?php _e('Post Comment','crumble'); ?>" class="submit" type="submit" style="float:left; margin-bottom: 0 !important" />
		                        </fieldset>

                        </fieldset>
					</div>						
					<div class="clear"></div>

	
<p><?php comment_id_fields(); ?></p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>

</div>
