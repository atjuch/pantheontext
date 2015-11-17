<?php
$theme_defaults = array(
    'theme_intro' => '<p>Dear {name}, here the latest news from ' . get_option('blogname') . '.</p>',
    'theme_end' => '<p>Have a nice reading, ' . get_option('blogname') . '.</p>',
    'theme_unsubscription' => '<p><small>To unsubscribe this newsletter, <a href="{profile_url}">click here</a>.</small></p>',
    'theme_old_posts' => 'Old posts you may have missed',
    'theme_tags' => 'Tags'
);

// Mandatory!
$controls->merge_defaults($theme_defaults);
?>
<table class="form-table">
    <tr valign="top">
        <th>Introduction text</th>
        <td>
            <?php $controls->textarea('theme_intro', 70); ?>
        </td>
    </tr>
    <tr valign="top">
        <th>Closing text</th>
        <td>
            <?php $controls->textarea('theme_end'); ?>
        </td>
    </tr>
    <tr valign="top">
        <th>Unsubscription line</th>
        <td>
            <?php $controls->textarea('theme_unsubscription'); ?>
        </td>
    </tr>
    <tr valign="top">
        <th>Old posts title</th>
        <td>
            <?php $controls->text('theme_old_posts'); ?>
        </td>
    </tr>
    <tr valign="top">
        <th>Tags label</th>
        <td>
            <?php $controls->text('theme_tags'); ?>
        </td>
    </tr>
</table>
