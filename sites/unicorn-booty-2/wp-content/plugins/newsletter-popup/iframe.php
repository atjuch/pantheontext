<?php
include '../../../wp-load.php';

header('Content-Type: text/html;charset=UTF-8');

$module = NewsletterPopup::$instance;

$theme_options = $module->get_theme_options($module->options['theme']);
$theme_url = $module->get_theme_url($module->options['theme']);

$form = NewsletterSubscription::instance()->get_subscription_form('popup', plugins_url('newsletter-popup') . '/subscribe.php');
$message = $module->options['subscription_text'];

if (empty($message))
    $message = NewsletterSubscription::instance()->options['subscription_text'];

if (strpos($message, '{subscription_form}') !== false)
    $message = str_replace('{subscription_form}', $form, $message);
else {
    if (strpos($message, '{subscription_form_') === false) {
        $message .= $form;
    }
}

$message = Newsletter::instance()->replace($message, $user);

require $module->get_theme_file($module->options['theme'], 'theme.php');
