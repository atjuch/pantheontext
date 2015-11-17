<?php
/*
 * This is a pre packaged theme options page. Every option name
 * must start with "theme_" so Newsletter can distinguish them from other
 * options that are specific to the object using the theme.
 *
 * An array of theme default options should always be present and that default options
 * should be merged with the current complete set of options as shown below.
 *
 * Every theme can define its own set of options, the will be used in the theme.php
 * file while composing the email body. Newsletter knows nothing about theme options
 * (other than saving them) and does not use or relies on any of them.
 *
 * For multilanguage purpose you can actually check the constants "WP_LANG", until
 * a decent system will be implemented.
 */
$theme_defaults = array(
    'theme_background' => '#f4f4f4',
    'theme_title_background'=>'#0088cc',
    'theme_title_color'=>'#fff',
    'theme_font_size'=>'16'
);

// Mandatory!
$controls->merge_defaults($theme_defaults);
?>
<table class="form-table">
        <tr>
        <th>Text font size</th>
        <td><?php $controls->css_font_size('theme_font_size'); ?></td>
    </tr>
    <tr>
        <th>Background color</th>
        <td><?php $controls->color('theme_background'); ?></td>
    </tr>
        <tr>
        <th>Title</th>
        <td><?php $controls->text('theme_title', 70); ?></td>
    </tr>
     <tr>
        <th>Title colors</th>
        <td>
            color: <?php $controls->color('theme_title_color'); ?>
            &nbsp;&nbsp;&nbsp;
            background: <?php $controls->color('theme_title_background'); ?>
        </td>
    </tr>
    
</table>

