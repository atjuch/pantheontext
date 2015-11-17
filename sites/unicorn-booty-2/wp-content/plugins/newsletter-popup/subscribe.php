<?php

header('Content-Type: text/html;charset=UTF-8');

include '../../../wp-load.php';

$module = NewsletterPopup::$instance;

$theme_options = $module->get_theme_options($module->options['theme']);
$theme_url = $module->get_theme_url($module->options['theme']);

$user = NewsletterSubscription::instance()->subscribe();

if ($user->status == 'E')
    $message = NewsletterSubscription::instance()->options['error_text'];

if ($user->status == 'A')
    $message = NewsletterSubscription::instance()->options['already_confirmed_text'];

if ($user->status == 'S') {
    $message = $module->options['thankyou_text'];
    if (empty($message)) {
        $message = NewsletterSubscription::instance()->options['confirmation_text'];
    }
}
if ($user->status == 'C') {
    $message = $module->options['thankyou_text'];
    if (empty($message)) {
        $message = NewsletterSubscription::instance()->options['confirmed_text'];
    }
    $message .= NewsletterSubscription::instance()->options['confirmed_tracking'];
}

$message = Newsletter::instance()->replace($message, $user);

require $module->get_theme_file($module->options['theme'], 'theme.php');
