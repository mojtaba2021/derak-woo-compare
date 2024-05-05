<?php
/*
 * Plugin Name:       Derak Woo Compare Products
 * Plugin URI:        https://mojtabamohmmadi.ir/
 * Description:       Derak Products Compare for WooCommerce
 * Version:           1.0.0
 * Author:            Mojtaba Mohammadi
 * Author URI:        https://mojtabamohamadi.ir/
 * License:           GPL v2 or later
 * Text Domain:       derak-woo-compare
 * Domain Path:       /languages
 * Requires Plugins: woocommerce
 */

if (!defined('ABSPATH')) {
    die;
}
if (!function_exists('is_woocommerce_activated')) {
    function is_woocommerce_activated()
    {
        if (class_exists('woocommerce')) {return true;} else {return die;}
    }
}



class DerakWooCompare
{

    public function __construct()
    {
        define('DWPC_TEXTDOMAIN', 'derak-woo-compare');
        define('DWPC_ROOT', plugin_basename(__FILE__));
        define('DWPC_DIR', plugin_dir_path(__FILE__));
        define('DWPC_URL', plugin_dir_url(__FILE__));
        define('DWPC_INC', DWPC_DIR . 'inc/');
        define('DWPC_ADMIN', DWPC_DIR . 'admin/');
        define('DWPC_PUBLIC', DWPC_DIR . 'public/');
    }

    public function register()
    {
        if (is_admin()) {
            require_once DWPC_ADMIN . '/admin.php';
        }

        require_once DWPC_PUBLIC . 'public.php';

    }

    public function activate()
    {

        flush_rewrite_rules();

    }

    public function deactivate()
    {
        flush_rewrite_rules();

    }

    public function uninstall()
    {

    }
}

$derakWooCompare = new DerakWooCompare();

$derakWooCompare->register();

//Register the activation hook.
register_activation_hook(__FILE__, array($derakWooCompare, 'activate'));
//Register the deactivation hook.
register_deactivation_hook(__FILE__, array($derakWooCompare, 'deactivate'));
//Register the uninstall hook.
register_uninstall_hook(__FILE__, array($derakWooCompare, 'uninstall'));
