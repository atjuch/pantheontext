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
    'theme_pre' => 'Subscribe to our newsletter',
    'theme_pre' => '<table><tr><td><img src="' . plugins_url('newsletter-popup') . '/themes/blue-orange/images/envelope.png"></td><td><p>Subscribe to our mailing list to have free updates every week.</p></td></tr></table>',
    'theme_post' => '<p><em>We care about your privacy. The email address will strickly used for our newsletter.</em></p>'
);

// Mandatory!
$controls->merge_defaults($theme_defaults);
?>
<p>This theme creates its own custom subscription form which collects only the email address and the name.</p>
<table class="form-table">
    <tr>
        <th>Title</th>
        <td><?php $controls->text('theme_title', 70); ?></td>
    </tr>
    <tr>
        <th>Pre form text</th>
        <td><?php $controls->textarea('theme_pre'); ?></td>
    </tr>
    <tr>
        <th>Post form text</th>
        <td><?php $controls->textarea('theme_post'); ?></td>
    </tr>
</table>


