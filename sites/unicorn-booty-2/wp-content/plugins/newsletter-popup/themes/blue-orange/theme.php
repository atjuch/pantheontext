<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: #fff;
                margin: 0px 15px;
            }
            body, th, td, input {
                font-family: verdana;
                font-size: 13px;
            }
            h1 {
                background-color: #fff;
                color: #016272;
                font-size: 24px;
                text-transform: uppercase;
                border-bottom: 1px solid #ccc;
                padding: 10px;
                margin: 0 20px 15px 20px;
                text-align: center;
                font-family: arial;
            }
            #message {
                margin: 10px;
            }
            input {
                padding: 5px;
                border-radius: 3px;
                border: 1px solid #ddd;
            }
            .newsletter-subscription {
                margin: 0 auto;
                width: 300px;
            }
            .newsletter-submit-div {
                text-align: center;
            }
            .newsletter-submit {
                color: #fff;
                background-color: #016272;
                xbox-shadow: 0px 1px 2px #999;
                font-size: 1.1em;
                padding: 10px;
            }
            .newsletter-field-div label {
                xwidth: 150px; 
                display: block;
            }
            .newsletter-field-div input[type=text], .newsletter-field-div input[type=email] {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <?php if (!isset($user)) { ?>
        <h1><?php echo $theme_options['theme_title']; ?></h1>
        <table>
            <tr>
                <td style="vertical-align: middle">
                    <img src="<?php echo $theme_url; ?>/images/envelope.png">
                </td>
                <td>
                    <p><?php echo $theme_options['theme_pre']; ?></p>
                </td>
            </tr>
        </table>
        
        <?php echo NewsletterSubscription::instance()->get_subscription_form('popup', plugins_url('newsletter-popup') . '/subscribe.php'); ?>
        
        <p><em><?php echo $theme_options['theme_post']; ?></em></p>
        
        <?php } else { ?> 
            <?php echo $message; ?>
        <?php } ?>
    </body>
</html>