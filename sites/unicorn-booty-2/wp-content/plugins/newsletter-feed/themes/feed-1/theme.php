<?php

global $newsletter, $post; 
if ($last_run < 0) {
    list($new_posts, $old_posts) = array_chunk($posts, ceil(count($posts)/2));
} else {
    list($new_posts, $old_posts) = NewsletterModule::split_posts($posts, $last_run);
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><title></title></head>
<body style="font-family: 'Trebuchet MS'; font-size: 14px;">

<?php echo $theme_options['theme_intro']; ?>

<table width="550">
<?php foreach($new_posts as $post) { setup_postdata($post); 
    $image = NewsletterModule::get_post_image($post->ID, 'thumbnail'); 
?>
<tr>
    <td>
        <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if ($image != null) { ?>
            <img src="<?php echo $image; ?>" alt="nice photo" align="left" width="100" height="100" hspace="10"/>
        <?php } ?>
        <?php the_excerpt(); ?>
    </td>
</tr>
<?php
}
?>
</table>

<?php if (!empty($old_posts)) { ?>

<h3><?php echo $theme_options['theme_old_posts']; ?></h3>
<table width="550">
    <tr>
        <td>
            <?php foreach($old_posts as $post) { setup_postdata($post); ?>
                <p><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
            <?php } ?>
        </td>
    </tr>
</table>

<?php } ?>

<?php
// This is optional too: we add some more things from our blog, in this example a
// tag cloud.
?>
<h3><?php echo $theme_options['theme_tags']; ?></h3>
<table width="550">
    <tr>
        <td>
            <?php wp_tag_cloud(array('title_li'=>'', 'smallest'=>9, 'largest'=>14, 'unit'=>'px')); ?>
        </td>
    </tr>
</table>

<?php echo $theme_options['theme_end']; ?>

<?php
// Never forget to give the user a way to unsubscribe the feed by mail service. There are some other
// links you may want to add, for example the {profile_url} link to let the subscriber to edit his
// data.
?>
<?php echo $theme_options['theme_unsubscription']; ?>

</body>
</html>
