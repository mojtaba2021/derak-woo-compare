<?php
// rewrite endpoint
function wcpc_add_compare_endpoint()
{
    add_rewrite_endpoint('compare', EP_ROOT); // You can change 'comparison' to whatever you want
}
add_action('init', 'wcpc_add_compare_endpoint');

// Add compare button to shop loop items
function wcpc_add_compare_button_to_shop_loop()
{
    global $product;
    $product_id = $product->get_id();
    echo "<div class='dwpc-card-buttons'>";
    echo "<a  href='" . esc_url(home_url('compare')) . "' class='dwpc-btn-compare'  data-product-id='$product_id'></a>";
    echo "</div>";
}
add_action('woocommerce_before_shop_loop_item_title', 'wcpc_add_compare_button_to_shop_loop');

//  Add compare button to single product page
function wcpc_add_compare_button_product_single_page()
{
    global $product;
    $product_id = $product->get_id();
    echo "<span class='dwpc-card-buttons-single-product'>";
    echo "<a  href='" . esc_url(home_url('compare')) . "' class='dwpc-btn-compare'  data-product-id='$product_id'>مقایسه</a>";
    echo "</span>";
}
add_action('woocommerce_single_product_summary', 'wcpc_add_compare_button_product_single_page');
