<?php

function dwpc_register_settings_page()
{
    add_menu_page(
        'Woo Compare Settings',
        'Woo Compare',
        'manage_options',
        'dwpc-settings',
        'dwpc_render_settings_page',
        'dashicons-randomize',
        100
    );
}
add_action('admin_menu', 'dwpc_register_settings_page');
