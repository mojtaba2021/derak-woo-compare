<?php

// init admin styles and scripts

function dwpc_admin_styles_scripts()
{
    wp_enqueue_style('dwpc-admin-style', DWPC_URL . '/admin/css/admin.css', '', rand());
    wp_enqueue_script('dwpc-admin-script', DWPC_URL . '/admin/js/admin.js', ['wp-data'], false, true);
}

add_action('admin_enqueue_scripts', 'dwpc_admin_styles_scripts');

// add action links to plugin
function dwpc_plugin_action_links($links)
{
    $settings_link = '<a href="' . admin_url('admin.php?page=dwpc-settings') . '">' . 'تنظیمات' . '</a>';
    $documentation_link = '<a href="https://github.com/mojtaba2021">' . 'مستندات' . '</a>';
    array_unshift($links, $settings_link, $documentation_link);
    return $links;
}
add_filter('plugin_action_links_' . DWPC_ROOT, 'dwpc_plugin_action_links');
