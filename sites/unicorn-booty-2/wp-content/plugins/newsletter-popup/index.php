<?php
require_once dirname(__FILE__) . '/controls.php';
$module = NewsletterPopup::$instance;
$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = $module->options;
} else {

    if ($controls->is_action('save')) {

        if (!is_numeric($controls->data['width']))
            $controls->data['width'] = 600;
        if (!is_numeric($controls->data['height']))
            $controls->data['height'] = 400;
        if (!is_numeric($controls->data['days']))
            $controls->data['days'] = 365;
         if (!is_numeric($controls->data['delay']))
            $controls->data['delay'] = 2;
         if (!is_numeric($controls->data['top']))
            $controls->data['top'] = 50;

        $module->save_options($controls->data);
        $controls->messages = 'Saved.';
    }

    if ($controls->is_action('test')) {
        
    }
}
?>

<div class="wrap">

    <h2>Newsletter Popup Configuration</h2>

    <?php $controls->show(); ?>

    <form action="" method="post">
        <?php $controls->init(); ?>
        <p>
            <?php $controls->button_primary('save', 'Save'); ?>
            <a href="<?php echo get_option('home'); ?>?newsletter_popup=1" target="home" class="button-primary">Open the site with the pop up</a>
        </p>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-main">Configuration</a></li>
                <li><a href="#tabs-theme">Visual options</a></li>
                <li><a href="#tabs-subscription">Subscription</a></li>
                <li><a href="#tabs-thankyou">Thank you</a></li>
            </ul>

            <div id="tabs-main">

                <table class="form-table">
                    <tr>
                        <th>Enabled?</th>
                        <td><?php $controls->yesno('enabled'); ?>
                            <p class="description">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>Show on</th>
                        <td><?php $controls->select('count', array('0' => 'first', '1' => 'second', '2' => 'third', '4' => 'fourth')); ?> page view
                            <p class="description">
                                The number of visits are counted and the pop up opened only on the specified visit number. Usually the best values are 
                                2 or 3.
                            </p>
                        </td>
                    </tr>                    
                    <tr>
                        <th>Delay (seconds)</th>
                        <td><?php $controls->text('delay', 6); ?>
                            <p class="description">
                                Howe many seconds to wait, after the page is full loaded, before show the pop up.
                                Decimal values allowed (for example 0.5 for half a second).
                            </p>
                        </td>
                    </tr>                    
                    <tr>
                        <th>Restart counting after</th>
                        <td><?php $controls->text('days', 5); ?> days
                            <p class="description">
                                The number of days the system should retain memory of shown pop up to a user before
                                restart the process.
                            </p>
                        </td>
                    </tr>                    
                </table>
            </div>


            <div id="tabs-subscription">

                <table class="form-table">
                    <tr>
                        <th>Subscription message</th>
                        <td><?php $controls->wp_editor('subscription_text'); ?>
                            <p class="description">
                                If left empty the stardard text from subscription steps panel is used. Use the tag
                                {subscription_form} where you want the suscription fields.
                            </p>
                        </td>
                    </tr>   
                </table>
            </div>

            <div id="tabs-thankyou">
                
                <table class="form-table">
                    <tr>
                        <th>Thank you message</th>
                        <td><?php $controls->wp_editor('thankyou_text'); ?>
                            <p class="description">
                                If left empty the stardard text is used (either the confirmation or the welcome
                                message depending on the opt-in mode setting).
                            </p>
                        </td>
                    </tr> 
                </table>
            </div>


            <div id="tabs-theme">
                <div style="float: left">
                    <table class="form-table">
                        <tr>
                            <th>Sizes</th>
                            <td><?php $controls->text('width', 5); ?> x <?php $controls->text('height', 5); ?>
                                <p class="description">
                                </p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>Offest from the top</th>
                            <td><?php $controls->text('top', 5); ?> (pixels)
                                <p class="description">Not shown on preview</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th>Outside frame</th>
                            <td><?php $controls->css_border('frame'); ?> 
                                <p class="description">Not shown on preview</p>
                            </td>
                        </tr> 
                        <tr>
                            <th>Pop up theme</th>
                            <td>
                                <?php $controls->themes(); ?> (save after a change to load the new options)
                                <p class="description">
                                </p>
                            </td>
                        </tr>

                    </table>

                    <h3>Selected theme options</h3>
                    <?php $controls->theme_options(); ?>
                </div>
                <div style="float: left; margin: 0 20px">
                    <div style="margin: 0 auto; border: 3px solid #666; width: <?php echo $module->options['width']; ?>px; height:<?php echo $module->options['height']; ?>px;">
                        <iframe style="width: <?php echo $module->options['width']; ?>px; height:<?php echo $module->options['height']; ?>px;" src="<?php echo wp_nonce_url(plugins_url('newsletter-popup') . '/iframe.php', 'preview'); ?>"></iframe>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>

        </div>


        <p>
            <?php $controls->button('save', 'Save'); ?>
        </p>

    </form>

</div>