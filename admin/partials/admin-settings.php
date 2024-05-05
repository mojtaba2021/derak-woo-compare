<?php
// render settings section and fields
function dwpc_render_settings_page()
{
    echo '<div class="wrap" id="dwpc-general-settings-table"><h1>تنظیمات افزونه مقایسه ووکامرس</h1><form method="post" action="options.php">';
    settings_fields('dwpc_settings_group');
    do_settings_sections('dwpc-settings');
    submit_button('دخیره تنظیمات');
    echo '</form></div>';

}

// add fields to settings page

function dwpc_initialize_settings()
{
    add_settings_section(
        'dwpc_general_settings_section',
        'تنظیمات کلی مقایسه ووکامرس',
        'dwpc_settings_section_callback',
        'dwpc-settings'
    );

    add_settings_field(
        'dwpc_compare_page_title',
        'عنوان صفحه مقایسه',
        'dwpc_compare_page_title_callback',
        'dwpc-settings',
        'dwpc_general_settings_section'
    );
    register_setting('dwpc_settings_group', 'dwpc_compare_page_title');

    // add_settings_field(
    //     'dwpc_compare_page_slug',
    //     'اسلاگ صفحه مقایسه',
    //     'dwpc_compare_page_slug_callback',
    //     'dwpc-settings',
    //     'dwpc_general_settings_section'
    // );
    // register_setting('dwpc_settings_group', 'dwpc_compare_page_slug');

    add_settings_field(
        'dwpc_product_picture_size',
        ' اندازه عکس محصول در صفحه مقایسه',
        'dwpc_product_picture_size_callback',
        'dwpc-settings',
        'dwpc_general_settings_section'
    );

    register_setting('dwpc_settings_group', 'dwpc_product_picture_size');

    add_settings_field(
        'dwpc_enable_add_to_cart',
        ' دکمه افزودن به سبد خرید',
        'dwpc_enable_add_to_cart_callback',
        'dwpc-settings',
        'dwpc_general_settings_section'
    );
    register_setting('dwpc_settings_group', 'dwpc_enable_add_to_cart');

    add_settings_field(
        'dwpc_product_properties',
        'ویژگی‌های محصول در صفحه مقایسه',
        'dwpc_product_properties_callback',
        'dwpc-settings',
        'dwpc_general_settings_section'
    );
    register_setting('dwpc_settings_group', 'dwpc_product_properties');

    add_settings_field(
        'dwpc_comparison_table_theme',
        'تغییر قالب جدول مقایسه',
        'dwpc_comparison_table_theme_callback',
        'dwpc-settings',
        'dwpc_general_settings_section'
    );
    register_setting('dwpc_settings_group', 'dwpc_comparison_table_theme');

}
add_action('admin_init', 'dwpc_initialize_settings');

function dwpc_settings_section_callback()
{
    echo '<p>برای نمایش جدول مقایسه از شورت کد زیر استفاده کنید</p>';
    echo '<div class="notice notice-info dwpc-shortcode"><p>   برای نمایش جدول مقایسه از شورت کد زیر استفاده کنید <strong> [derak-woo-compare] </strong> </p><span class="dashicons dashicons-clipboard">  <span class="tooltiptext" id="myTooltip">کپی</span>
    </span></div>';

}

function dwpc_enable_add_to_cart_callback()
{
    $dwpc_enable_addToCart = get_option('dwpc_enable_add_to_cart') ?? '';
    echo "<input type='checkbox' name='dwpc_enable_add_to_cart' value='1' " . checked($dwpc_enable_addToCart, 1, false) . " >";

}

function dwpc_compare_page_title_callback()
{
    $dwpc_compare_page_title = get_option('dwpc_compare_page_title') ?? '';

    echo "<input type='text' name='dwpc_compare_page_title' value='" . esc_html($dwpc_compare_page_title) . "' >";
}
// function dwpc_compare_page_slug_callback()
// {
//     $dwpc_compare_page_slug = get_option('dwpc_compare_page_slug') ?? 'compare';

//     echo "<input type='text' name='dwpc_compare_page_slug' value='" . esc_html($dwpc_compare_page_slug) . "' placeholder='به صورت پیشفرض compare' >";
// }

function dwpc_product_picture_size_callback()
{
    $dwpc_compare_page_product_size = get_option('dwpc_product_picture_size') ?? '';

    $options = array(
        'thumbnail' => 'کوچک',
        'medium' => 'متوسط',
        'large' => 'بزرگ',
    );

    echo '<select name="dwpc_product_picture_size">';
    foreach ($options as $value => $label) {
        $selected = selected($dwpc_compare_page_product_size, $value, false);
        echo "<option value='$value' $selected>$label</option>";
    }
    echo '</select>';
}

function dwpc_product_properties_callback()
{
    $dwpc_product_properties = get_option('dwpc_product_properties') ?? '';

    $options = [
        'weight' => 'وزن',
        'dimensions' => 'ابعاد',
        'sku' => 'شناسه محصول',
        'stock_status' => 'وضعیت موجودی',
        'price' => 'قیمت',
    ];
    $selected_properties = !empty($dwpc_product_properties) ? (array) $dwpc_product_properties : [];
    foreach ($options as $value => $label) {
        $checked = in_array($value, $selected_properties) ? 'checked' : '';
        echo "<input type='checkbox' name='dwpc_product_properties[]' value='$value' $checked> $label<br> <br>";
    }
}

function dwpc_comparison_table_theme_callback()
{
    $current_theme = get_option('dwpc_comparison_table_theme', 'theme1');

    $themes = [
        'theme1' => 'قالب اول',
        'theme2' => 'قالب دوم',
    ];

    foreach ($themes as $theme_id => $theme_label) {
        echo '<label>';
        echo '<input type="radio" name="dwpc_comparison_table_theme" value="' . esc_attr($theme_id) . '" ' . checked($current_theme, $theme_id, false) . '>';
        echo esc_html($theme_label);
        echo '</label><br><br>';
    }
}
