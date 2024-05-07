<?php

function get_compare_products_from_cookie()
{
    if (isset($_COOKIE['dwpc_comparison_products'])) {
        return json_decode(stripslashes($_COOKIE['dwpc_comparison_products']), true);
    } else {
        return array();
    }
}

function dwpc_compare_table_shortcode()
{
    $product_ids = get_compare_products_from_cookie();
    $product_properties = get_option('dwpc_product_properties') ?? [];
    $product_data = [];
    $options = [
        'weight' => 'وزن',
        'dimensions' => 'ابعاد',
        'sku' => 'شناسه محصول',
        'stock_status' => 'وضعیت موجودی',
        'price' => 'قیمت',
    ];
    foreach ($product_ids as $product_id) {
        $product_data[] = wc_get_product($product_id);
    }
    ob_start();

    ?>
    <section class="dwpc-container" dir="ltr">
        <h1 class="page-title" dir="auto"><?=esc_html(get_option('dwpc_compare_page_title')) ?? ''?><h1>
        <div class="dwpc-wraper">
            <div class="dwpc-main-detail">
                <div class="dwpc-table-header">
                    <?php foreach ($options as $value => $label): ?>
                        <?php if (in_array($value, $product_properties)): ?>
                            <p class="dwpc-row <?php echo esc_attr(get_option('dwpc_comparison_table_theme')) == 'theme1' ? '' : 'dwpc-row-light' ?>"><?php echo esc_html($label); ?></p>
                        <?php endif;?>
                    <?php endforeach;?>
                </div>
                </div>
            <div class="dwpc-table-body">
                <?php foreach ($product_data as $product): ?>
                    <div class="dwpc-product-card">
                        <div class="dwpc-product-card-detail">
                            <a class="dwpc-btn-remove-compare" data-product-id="<?php echo esc_html($product->get_id()) ?>"></a>
                            <div class="py-5">
                                <?php echo $product->get_image(get_option('dwpc_product_picture_size')); ?>
                            </div>
                            <a class="dwpc-product-card-detail-title" href="<?php echo get_permalink($product->get_id()) . '">' . $product->get_title() ?></a>
                        </div>
                        <?php foreach ($product_properties as $property): ?>
                            <p class="dwpc-row <?php echo esc_attr(get_option('dwpc_comparison_table_theme')) == 'theme1' ? '' : 'dwpc-row-light' ?>">
                            <?php if (method_exists($product, 'get_' . $property) && $product->{'get_' . $property}() != "N/A"): ?>
                                    <?php echo esc_html(call_user_func(array($product, 'get_' . $property))); ?>

                                    </p>
                            <?php endif;?>

                        <?php endforeach;?>
                        <div class="dwpc-add-to-cart">
                            <?php if (esc_html(get_option('dwpc_enable_add_to_cart'))): ?>
                                <a class="" name="add-to-cart" href="<?php echo ($product->add_to_cart_url()) ?>">افزودن به سبد خرید</a>
                                <?php else: ?>
                                    <div></div>
                                    <?php endif;?>
                                </div>
                    </div>
                <?php endforeach;?>
            </div>
            </div>
        </div>
    </section>

    <?php
return ob_get_clean();
}
add_shortcode('derak-woo-compare', 'dwpc_compare_table_shortcode');