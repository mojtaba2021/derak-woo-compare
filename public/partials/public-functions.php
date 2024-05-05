<?php
// init public styles and scripts

function dwpc_public_styles_scripts()
{
    wp_enqueue_style('dwpc-font-awesome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_style('dwpc-public-style', DWPC_URL . 'public/css/public.css', 'dwpc-font-awesome-style', rand());
    wp_register_script('dwpc-public-script', DWPC_URL . 'public/js/public.js', array('jquery'), rand(), true);
    wp_enqueue_script('dwpc-public-script');
}

add_action('wp_enqueue_scripts', 'dwpc_public_styles_scripts');
