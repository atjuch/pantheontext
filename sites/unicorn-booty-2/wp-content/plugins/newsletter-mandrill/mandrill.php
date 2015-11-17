<?php

/*
  Plugin Name: Newsletter Mandrill Extension
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter/mandrill-module
  Description: Integrates Newsletter with Mandrill (Mailchimp) SMTP/API service. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 2.2.0
  Author: Stefano Lissa
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.

 */

class NewsletterMandrill {

    /**
     * @var NewsletterMandrill
     */
    static $instance;
    var $prefix = 'newsletter_mandrill';
    var $slug = 'newsletter-mandrill';
    var $plugin = 'newsletter-mandrill/mandrill.php';
    var $id = 49;
    var $options;

    function __construct() {

        self::$instance = $this;

        register_activation_hook(__FILE__, array($this, 'hook_activation'));
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix, array());
    }

    function hook_activation() {
        delete_option('newsletter_mandrill_available_version');
        delete_option('newsletter_mandrill_version');
        delete_transient($this->prefix . '_plugin');
    }

    function hook_deactivation() {
        delete_transient($this->prefix . '_plugin');
        wp_clear_scheduled_hook('newsletter_mandrill_bounce');
    }

    function hook_init() {
        if (!class_exists('Newsletter')) {
            return;
        }
        if (!defined('NEWSLETTER_EXTENSION_UPDATE') || NEWSLETTER_EXTENSION_UPDATE) {
            add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));
            add_filter('pre_set_site_transient_update_plugins', array($this, 'hook_pre_set_site_transient_update_plugins'));
        } else {
            add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins_disable'));
        }
        if ($this->options['enabled'] == 1) {
            add_action('newsletter_mandrill_bounce', array($this, 'bounce'));
            if ($this->options['api'] == 1) {
                if (method_exists('Newsletter', 'register_mail_method')) {
                    Newsletter::instance()->register_mail_method(array($this, 'mail'));
                }
            } else {
                add_filter('newsletter_smtp', array($this, 'hook_newsletter_smtp'));
            }
        }
        if (is_admin()) {
            add_action('admin_init', array($this, 'hook_admin_init'));

            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            if (isset($_GET['page']) && strpos($_GET['page'], $this->slug . '/') === 0) {
                wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_style($this->prefix . '_css', plugin_dir_url(__FILE__) . '/admin.css');
            }

            if (!defined('DOING_CRON') || !DOING_CRON) {
                if (wp_get_schedule('newsletter_mandrill_bounce') === false) {
                    wp_schedule_event(time() + 60, 'daily', 'newsletter_mandrill_bounce');
                }
            }

//            add_filter('plugin_install_action_links', array($this, 'hook_plugin_install_action_links'), 100, 2);
        }
    }

    function hook_admin_init() {

    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);
    }

    function hook_newsletter_smtp($smtp_options) {
        $smtp_options['enabled'] = 1;
        $smtp_options['host'] = $this->options['smtp_host'];
        $smtp_options['port'] = $this->options['smtp_port'];
        $smtp_options['secure'] = $this->options['smtp_secure'];
        $smtp_options['user'] = $this->options['smtp_user'];
        $smtp_options['pass'] = $this->options['smtp_password'];

        return $smtp_options;
    }

    function hook_pre_set_site_transient_update_plugins($value) {
        // Anyway remove data from WordPress.org
        unset($value->response[$this->plugin]);

        if (!function_exists('get_plugin_data')) {
            return $value;
        }

        $response = wp_remote_get('http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/version.php?f=' . $this->id);
        if (is_wp_error($response))
            return $value;

        $new_version = wp_remote_retrieve_body($response);

        if (empty($new_version))
            return $value;

        $plugin_data = get_plugin_data(__FILE__, false, false);
        if (version_compare($new_version, $plugin_data['Version']) <= 0)
            return $value;

        $plugin = new stdClass();
        $plugin->id = $this->id;
        $plugin->slug = $this->slug;
        $plugin->plugin = $this->plugin;
        $plugin->new_version = $new_version;
        $plugin->url = '';
        set_transient($this->prefix . '_plugin', $plugin, 7 * 86400);
        $value->response[$this->plugin] = $plugin;
        return $value;
    }

    function hook_site_transient_update_plugins($value) {
        if (!class_exists('Newsletter'))
            return $value;

        // See the wp_update_plugins function
        if (!is_object($value))
            return $value;

        if (!isset($value->response[$this->plugin]))
            return $value;

        if (defined('NEWSLETTER_LICENSE_KEY')) {
            $value->response[$this->plugin]->package = 'http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/get.php?f=' . $this->id .
                    '&k=' . NEWSLETTER_LICENSE_KEY;
        } else {
            $value->response[$this->plugin]->package = 'http://www.thenewsletterplugin.com/wp-content/plugins/file-commerce-pro/get.php?f=' . $this->id .
                    '&k=' . Newsletter::instance()->options['contract_key'];
        }

        return $value;
    }

    function hook_site_transient_update_plugins_disable($value) {
        if (!is_object($value))
            return $value;

        if (!isset($value->response[$this->plugin]))
            return $value;

        unset($value->response[$this->plugin]);
        return $value;
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Mandrill', 'Mandrill', 'manage_options', 'newsletter-mandrill/index.php');
    }

    var $mandrill = null;
    var $mandrill_result;

    function mail($to, $subject, $message, $headers = null) {
        $newsletter = Newsletter::instance();

        if ($this->mandrill == null) {
            require_once dirname(__FILE__) . '/api/Mandrill.php';
            $mandrill = new Mandrill($this->options['smtp_password']);
        }
        $data = array();

        if (!is_array($message)) {
            $data['html'] = $message;
        } else {
            if (!empty($message['html'])) {
                $data['html'] = $message['html'];
            }

            if (!empty($message['text'])) {
                $data['text'] = $message['text'];
            }
        }
        $data['subject'] = $subject;

        $data['to'] = array(
            array(
                'email' => $to,
                //'name' => 'Recipient Name',
                'type' => 'to'
            )
        );

        if (isset($headers['X-Newsletter-Email-Id'])) {
            $data['tags'] = array('Newsletter ' . $headers['X-Newsletter-Email-Id']);
        }

        if (!empty($headers)) {
            $data['headers'] = $headers;
        } else {
            $data['headers'] = array();
        }

        $data['from_email'] = $newsletter->options['sender_email'];
        $data['from_name'] = $newsletter->options['sender_name'];

        if (!empty($newsletter->options['reply_to'])) {
            $data['headers']['Reply-To'] = $newsletter->options['reply_to'];
        }

        try {
//    $async = false;
//    $ip_pool = 'Main Pool';
//    $send_at = 'example send_at';
//    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
            $this->mandrill_result = $mandrill->messages->send($data);
            //print_r($result);
            return true;
        } catch (Mandrill_Error $e) {
            $this->mandrill_result = $e->getMessage();
            // Mandrill errors are thrown as exceptions
            //echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            //throw $e;
            return false;
        }
    }

    /**
     * string(223) "[{"reason":"soft-bounce","detail":null,"last_event_at":"2013-06-11 12:26:16.25149","email":"satollo@gcaadddail.com",
     * "created_at":"2013-06-11 12:26:16.25156","expires_at":"2013-06-12 12:26:16","expired":false,"sender":null}]"
     * @global wpdb $wpdb
     */
    var $bounce_result;

    function bounce() {
        global $wpdb, $newsletter;

        require_once dirname(__FILE__) . '/api/Mandrill.php';

        $bounce_delete = false;
        if (isset($this->options['bounce_delete']) && $this->options['bounce_delete'] == 1)
            $bounce_delete = true;

        $bounce_soft = false;
        if (isset($this->options['bounce_soft']) && $this->options['bounce_soft'] == 1)
            $bounce_soft = true;

        try {
            $mandrill = new Mandrill($this->options['smtp_password']);
            $list = $mandrill->rejects->getList(null, true);
            $this->bounce_result .= count($list) . ' rejects found.';
            $this->save_last_run(time());
            $spam = 0;
            $hard = 0;
            $soft = 0;
            $other = 0;
            foreach ($list as &$item) {
                if ($item['reason'] == 'soft-bounce')
                    $soft++;
                else if ($item['reason'] == 'hard-bounce')
                    $hard++;
                else if ($item['reason'] == 'spam')
                    $spam++;
                else
                    $other++;

                if (!$bounce_soft && $item['reason'] == 'soft-bounce')
                    continue;

                $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set status='B' where email=%s limit 1", strtolower($item['email'])));
                if ($bounce_delete)
                    $mandrill->rejects->delete($item['email']);
            }

            $this->bounce_result .= ' ' . $soft . ' soft bounces. ' . $hard . ' hard bounces. ' . $spam . ' spam notifications. ' .
                    $other . ' other kinds of rejects.';

            $this->save_last_run(time());
        } catch (Mandrill_Error $e) {
            $this->mandrill_result = $e->getMessage();
        }
    }

    function save_last_run($time) {
        update_option($this->prefix . '_last_run', $time);
    }

    function get_last_run() {
        return get_option($this->prefix . '_last_run', 0);
    }

}

new NewsletterMandrill();
