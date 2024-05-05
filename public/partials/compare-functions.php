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
add_action('woocommerce_after_shop_loop_item', 'wcpc_add_compare_button_to_shop_loop');