<?php
require_once dirname(__FILE__) . '/controls.php';
$module = NewsletterMandrill::$instance;
$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = $module->options;
} else {

    if ($controls->is_action('save')) {
        $module->save_options($controls->data);
        $controls->messages = 'Saved.';
    }

    if ($controls->is_action('trigger')) {
        $res = $module->bounce();
        if (!empty($module->mandrill_result)) {
            $controls->errors = $module->mandrill_result;
        } else {
        $controls->messages = $module->bounce_result;
        }
    }

    if ($controls->is_action('reset')) {
        $module->save_last_run(0);
        $controls->messages = 'Done.';
    }

    if ($controls->is_action('smtp_test')) {
            $message['html'] = "<!DOCTYPE html>\n";
            $message['html'] .= "This is the rich text (HTML) version of a test message sent via Mandrill.</p>\n";
            $message['html'] .= "This is a <strong>bold text</strong></p>\n";
            $message['html'] .= "This is a <a href='http://www.thenewsletterplugin.com'>link to www.thenewsletterplugin.com</a></p>\n";
            
            $message['text'] = 'This is the TEXT version of a test message sent via Mandrill. You should see this message only if you email client does not support the rich text (HTML) version.';
            
        if ($controls->data['api'] == 1) {

            $subject = '[' . get_option('blogname') . '] API test message from the Newsletter Mandrill Extension';
            
            $headers = array('X-Newsletter-Email-Id'=>'0');

            $result = $module->mail($controls->data['smtp_test_email'], $subject, $message, $headers);
            if ($result) {
                $controls->messages = 'Success.<br>' . htmlspecialchars(print_r($module->mandrill_result, true));
            } else {
                $controls->errors = htmlspecialchars(print_r($module->mandrill_result, true));
            }
        } else {

            $subject = '[' . get_option('blogname') . '] API test messager from the Newsletter Mandrill Extension';
            require_once ABSPATH . WPINC . '/class-phpmailer.php';
            require_once ABSPATH . WPINC . '/class-smtp.php';
            $mail = new PHPMailer();

            $mail->IsSMTP();
            $mail->SMTPDebug = true;
            $mail->CharSet = 'UTF-8';
            $mail->IsHTML(true);
            $mail->Body = $message['html'];
            $mail->AltBody = $message['text'];
            $mail->From = $newsletter->options['sender_email'];
            $mail->FromName = $newsletter->options['sender_name'];

            $mail->Subject = $subject;

            $mail->Host = $controls->data['smtp_host'];
            if (!empty($controls->data['smtp_port']))
                $mail->Port = (int) $controls->data['smtp_port'];

            $mail->SMTPSecure = $controls->data['smtp_secure'];

            $mail->SMTPAuth = true;
            $mail->Username = $controls->data['smtp_user'];
            $mail->Password = $controls->data['smtp_password'];

            $mail->SMTPKeepAlive = true;
            $mail->ClearAddresses();
            $mail->AddAddress($controls->data['smtp_test_email']);
            ob_start();
            $mail->Send();
            $mail->SmtpClose();
            $debug = htmlspecialchars(ob_get_clean());

            if ($mail->IsError())
                $controls->errors = $mail->ErrorInfo;
            else
                $controls->messages = 'Success.';

            $controls->messages .= '<textarea style="width:100%;height:250px;font-size:10px">';
            $controls->messages .= $debug;
            $controls->messages .= '</textarea>';
        }
    }
}
?>

<div class="wrap">

    <h2>Newsletter Mandrill Extension</h2>

    <?php $controls->show(); ?>

    <p>
        This module forces Newsletter to use MandrillApp as mail server and daily checks if Mandrill has collected bounces
        setting the releative email addresses as bounced.
    </p>

    <form action="" method="post">
        <?php $controls->init(); ?>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-general">General</a></li>
                <li><a href="#tabs-smtp">SMTP/API</a></li>
                <li><a href="#tabs-bounces">Bounces</a></li>
            </ul>

            <div id="tabs-general">

                <table class="form-table">
                    <tr valign="top">
                        <th>Enabled?</th>
                        <td>
                            <?php $controls->yesno('enabled'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>License key</th>
                        <td>
                            <?php 
                            if (empty(Newsletter::instance()->options['contract_key'])) { 
                            echo 'Not set';
                            } else {
                                echo Newsletter::instance()->options['contract_key'];
                            } ?>
                            <p class="description">
                                The license key can be set on main Newsletter configuration and will be used for the one clic
                                update feature.
                            </p>
                        </td>
                    </tr>
                </table>
            </div>


            <div id="tabs-smtp">

                <p>
                    This configuration overrides realtime the standard SMTP configuration of Newsletter plugin.
                </p>

                <table class="form-table">
                    <tr valign="top">
                        <th>A valid MandrillApp API Key</th>
                        <td>
                            <?php $controls->text('smtp_password', 50); ?>
                            <p class="description">You can generate an API key from their console.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>API or SMTP?</th>
                        <td>
                            <?php $controls->select('api', array('0' => 'SMTP', '1' => 'API')); ?>
                            <p class="description">Using of the API method is now reocmmended, Using the API you don't need to set the
                                fields below.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>MandrillApp username</th>
                        <td>
                            <?php $controls->text('smtp_user', 50); ?>
                            <p class="description">Your MandrillaApp login email address.</p>
                        </td>
                    </tr>
                    <tr>
                        <th>SMTP host/port</th>
                        <td>
                            host: <?php $controls->text('smtp_host', 30); ?>
                            port: <?php $controls->text('smtp_port', 6); ?>
                            <?php $controls->select('smtp_secure', array('' => 'No secure protocol', 'tls' => 'TLS protocol', 'ssl' => 'SSL protocol')); ?>
                            <p class="description">
                                Typically use host smtp.mandrillapp.com, port 465, protocol SSL.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <th>To test this configuration</th>
                        <td>
                            <?php $controls->text('smtp_test_email', 30); ?>
                            <?php $controls->button('smtp_test', 'Send a message to this email'); ?>
                        </td>
                    </tr>
                </table>
            </div>


            <div id="tabs-bounces">
                <p>
                    Daily this extension retrives bounced addresses from Mandrill and eventually set those address as bounced if
                    present on subscriber list.
                </p>
                <table class="form-table">
                    <tr valign="top">
                        <th>Process soft bounces</th>
                        <td>
                            <?php echo $controls->yesno('bounce_soft'); ?>
                            <p class="description">If enabled even addresses valid but with temporary errors
                                (like mailbox full) will be treated as invalid addresses.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Delete bounces on Mandrill</th>
                        <td>
                            <?php echo $controls->yesno('bounce_delete'); ?>
                            <p class="description">Not recommended if you want to keep Mandrill check emails
                                potentially sent to bounced addresses may be by other service you connected to Mandrill.</p>
                        </td>
                    </tr>                    
                    <tr valign="top">
                        <th>Bounce checking last run</th>
                        <td>
                            <?php echo $controls->print_date($module->get_last_run()); ?>
                            <?php $controls->button('trigger', 'Check now'); ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th>Bounce checking next run</th>
                        <td>
                            <?php echo $controls->print_date(wp_next_scheduled($module->prefix . '_bounce')); ?>
                        </td>
                    </tr>
                </table>

            </div>

        </div>

        <p>
            <?php $controls->button('save', 'Save'); ?>
        </p>
    </form>

</div>