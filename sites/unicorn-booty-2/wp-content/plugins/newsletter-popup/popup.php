<?php
/*
  Plugin Name: Newsletter Popup Extension
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter
  Description: Adds a popup subscription system to the Newsletter plugin. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 2.2.0
  Author: Stefano Lissa
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

class NewsletterPopup {

    /**
     * @return NewsletterPopup
     */
    static $instance;
    var $prefix = 'newsletter_popup';
    var $slug = 'newsletter-popup';
    var $plugin = 'newsletter-popup/popup.php';
    var $id = 53;
    var $options;

    function __construct() {
        self::$instance = $this;
        register_activation_hook(__FILE__, array($this, 'hook_activation'));
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix, array());
    }

    function hook_activation() {
        delete_option('newsletter_popup_available_version');
        delete_option('newsletter_popup_version');
        if (empty($this->options))
            $this->options = array();
        if (empty($this->options['theme']))
            $this->options['theme'] = 'default';
        if (empty($this->options['width']))
            $this->options['width'] = '500';
        if (empty($this->options['height']))
            $this->options['height'] = '400';
        if (!isset($this->options['delay']))
            $this->options['delay'] = 2;
        if (!isset($this->options['count']))
            $this->options['count'] = 0;
        if (!isset($this->options['days']))
            $this->options['days'] = 30;
        if (empty($this->options['frame_width']))
            $this->options['frame_width'] = 3;
        if (empty($this->options['frame_type']))
            $this->options['frame_type'] = 'solid';
        if (empty($this->options['frame_color']))
            $this->options['frame_color'] = '#333';
        if (empty($this->options['frame_radius']))
            $this->options['frame_radius'] = 10;

        update_option($this->prefix, $this->options);

        delete_transient($this->prefix . '_plugin');
    }

    function hook_deactivation() {
        delete_transient($this->prefix . '_plugin');
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
        if (!is_admin() && ($this->options['enabled'] == 1 || isset($_GET['newsletter_popup']))) {
            add_action('wp_footer', array($this, 'hook_wp_footer'), 99);
            add_action('wp_head', array($this, 'hook_wp_head'), 1);
            add_action('wp_enqueue_scripts', array($this, 'hook_wp_enqueue_scripts'));
        }

        if (is_admin()) {
            add_action('admin_init', array($this, 'hook_admin_init'));

            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            if (isset($_GET['page']) && strpos($_GET['page'], $this->slug . '/') === 0) {
                wp_enqueue_script('jquery-ui-tabs');
                wp_enqueue_script('wp-color-picker');
                wp_enqueue_style('wp-color-picker');
                wp_enqueue_style($this->prefix . '_css', plugin_dir_url(__FILE__) . '/admin.css');
            }
        }
    }

    function hook_admin_init() {

    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Popup', 'Popup', 'manage_options', $this->slug . '/index.php');
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

    function hook_wp_enqueue_scripts() {
        wp_enqueue_script('jquery');
    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);

        add_option($this->prefix . '_theme_' . $options['theme'], array(), null, 'no');
        $theme_options = array();
        foreach ($options as $key => &$value) {
            if (substr($key, 0, 6) != 'theme_')
                continue;
            $theme_options[$key] = $value;
        }
        update_option($this->prefix . '_theme_' . $options['theme'], $theme_options);
    }

    function get_theme_options($theme) {
        return get_option($this->prefix . '_theme_' . $theme);
    }

    function get_theme_url($theme) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-popup/themes/' . $theme;
        if (is_dir($path)) {
            return WP_CONTENT_URL . '/extensions/newsletter-popup/themes/' . $theme;
        } else {
            return plugins_url($this->slug) . '/themes/' . $theme;
        }
    }

    function get_theme_file($theme, $file) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-popup/themes/' . $theme . '/' . $file;
        if (is_file($path))
            return $path;
        else
            return dirname(__FILE__) . '/themes/' . $theme . '/' . $file;
    }

    function hook_wp_head() {
        ?>
        <style>

            #newsletter-close {
                position: absolute;
                right: -10px;
                top: -10px;
                cursor: pointer;
            }
            #newsletter-popup-overlay {
                display: none;
                background:#000;
                position:fixed;
                top:0;
                bottom: 0;
                right: 0;
                left:0px;
                z-index:10000;
                cursor:pointer;
                opacity: .7;
                filter: alpha(opacity=70);
                -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
            }

            #newsletter-popup-container {
                display: none;
                position:fixed;
                top:0;
                bottom:0;
                right:0;
                left:0;
                z-index:11000;
            }

            #newsletter-popup{
                position: relative;
                margin: <?php echo empty($this->options['top']) ? '50px' : ($this->options['top'] . 'px'); ?> auto;
                background-color:#fff;
                width: <?php echo $this->options['width'] + 10; ?>px;
                height: <?php echo $this->options['height'] + 10; ?>px;
                border: <?php echo $this->options['frame_width']; ?>px <?php echo $this->options['frame_type']; ?> <?php echo $this->options['frame_color']; ?>;
                border-radius: <?php echo $this->options['frame_radius']; ?>px;
                box-sizing: content-box;
            }

            @media (max-width: 768px) {
                #newsletter-popup{
                    width: 90%;
                    margin: 30px auto;
                }
            }
            #newsletter-iframe {
                margin: 5px;
                width: <?php echo $this->options['width']; ?>px;
                height: <?php echo $this->options['height']; ?>px;
                border: 0;
                xmargin: 0;
            }
        </style>
        <?php
    }

    function hook_wp_footer() {
        if (is_user_logged_in() && !isset($_GET['newsletter_popup']))
            return;
        ?>
        <div id="newsletter-popup-overlay"></div>
        <div id="newsletter-popup-container">
            <div id="newsletter-popup"><img id="newsletter-close" src="<?= plugins_url('newsletter-popup') ?>/images/close.png">
                <iframe id="newsletter-iframe" data-src="<?php echo plugins_url('newsletter-popup') . '/iframe.php'; ?>"></iframe></div>
        </div>
        <script>
            function newsletter_set_cookie(name, value, time) {
                var e = new Date();
                e.setTime(e.getTime() + time * 24 * 60 * 60 * 1000);
                document.cookie = name + "=" + value + "; expires=" + e.toGMTString() + "; path=/";
            }
            function newsletter_get_cookie(name, def) {
                var cs = document.cookie.toString().split('; ');
                var c, n, v;
                for (var i = 0; i < cs.length; i++) {
                    c = cs[i].split("=");
                    n = c[0];
                    v = c[1];
                    if (n == name)
                        return v;
                }
                return def;
            }
            jQuery(document).ready(function () {

                jQuery("#newsletter-close").click(
                        function () {
                            jQuery('#newsletter-popup-overlay').fadeOut('fast');
                            jQuery('#newsletter-popup-container').hide();
                        });

                jQuery("#newsletter-popup-overlay").click(
                        function () {
                            jQuery(this).fadeOut('fast');
                            jQuery('#newsletter-popup-container').hide();
                        });

        <?php if (isset($_GET['newsletter_popup'])) { ?>
                    newsletter_popup_open();
        <?php } else { ?>
                    if (newsletter_get_cookie("newsletter", null) == null) {
                        var newsletter_popup = parseInt(newsletter_get_cookie("newsletter_popup", 0));
                        newsletter_set_cookie("newsletter_popup", newsletter_popup + 1, <?php echo (int) $this->options['days']; ?>);
                        if (newsletter_popup == <?php echo (int) $this->options['count']; ?>) {
                            jQuery('#newsletter-iframe').attr("src", jQuery('#newsletter-iframe').attr("data-src"));
                            setTimeout(newsletter_popup_open,
            <?php echo $this->options['delay'] * 1000; ?>);
                        }
                    }
        <?php } ?>
            });

            function newsletter_popup_open() {
                jQuery('#newsletter-iframe').attr("src", jQuery('#newsletter-iframe').attr("data-src"));
                //jQuery('#overlay').css('height', $(document).height());
                jQuery('#newsletter-popup-overlay').fadeIn('fast');
                var windowW = jQuery(window).width();
                var windowH = jQuery(window).height();
                //var modalW = jQuery('#box').width();
                //var modalH = jQuery('#box').height();
                /*
                 jQuery('#box').css({
                 "top": ((windowH - modalH) / 2 + $(document).scrollTop()) + "px",
                 "left": ((windowW - modalW) / 2) + "px"
                 });
                 */
                jQuery('#newsletter-popup-container').fadeIn('slow');
                return false;
            }
        </script>
        <?php
    }

}

new NewsletterPopup();

