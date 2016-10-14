<?php

/**
 * Plugin Name: Custom logo on product image
 * Version: 1.0
 * Plugin URI: http://krzysztofkwiatkowski.pl
 * Description: By this plugin you can add custom logo/image at product image
 * Author: Krzysztof Kwiatkowski
 * Author URI: http://krzysztofkwiatkowski.pl
 * License: GPL v3
 */

add_action('woocommerce_before_shop_loop_item', 'add_logo_category_view');
add_action('woocommerce_product_options_general_product_data', 'woo_add_custom_logo');
add_action('woocommerce_process_product_meta', 'woo_add_custom_logo_save');
add_filter('woocommerce_single_product_image_html', 'add_logo_single_view', 10, 2);

// Add logo in category view

function add_logo_category_view(){

    $logo_temp = get_post_meta( get_the_ID(), 'product_logo', true );
    $logo_temp2 = get_post_meta( get_the_ID(), 'product_logo2', true );

    if ($logo_temp)
        echo "<a href='http://legum.pl'><img style='position: absolute; width: 20%; z-index: 999; right: 0;' src='http://www.legum.pl/wp-content/uploads/2016/09/wdk.png'></a>";
    elseif ($logo_temp2)
        echo "<a href='http://legum.pl'><img style='position: absolute; width: 20%; z-index: 999; right: 0;' src='http://www.legum.pl/wp-content/uploads/2016/10/Nowy_znak_Z-kopia.png'></a>";

}

//Add logo in single product view

function add_logo_single_view( $html, $post_id ) {

    $logo_temp = get_post_meta( get_the_ID(), 'product_logo', true );
    $logo_temp2 = get_post_meta( get_the_ID(), 'product_logo2', true );
    if ($logo_temp)
        $html = $html."<a href='http://legum.pl'><img style='position: absolute; width: 20%; z-index: 999; right: 0%; top: 0%;' src='http://www.legum.pl/wp-content/uploads/2016/09/wdk.png'></a>";
    elseif ($logo_temp2)
        $html = $html."<a href='http://legum.pl'><img style='position: absolute; width: 20%; z-index: 999; right: 0%; top: 0%;' src='http://www.legum.pl/wp-content/uploads/2016/10/Nowy_znak_Z-kopia.png'></a>";

    return $html;
}


//Add setting field in each product

function woo_add_custom_logo(){
    global $post, $woocommerce;

    echo '<div class="options_group">';

    woocommerce_wp_checkbox(
        array(
            'id'            =>  'product_logo',
            'label'         =>  __('WDK', 'woocommerce'),
            'description'   =>  __('Certyfikat WDK', 'woocommerce')
        )
    );
    woocommerce_wp_checkbox(
        array(
            'id'            =>  'product_logo2',
            'label'         =>  __('ITS', 'woocommerce'),
            'description'   =>  __('Certyfikat ITS', 'woocommerce')
        )
    );

    woocommerce_wp_checkbox(
        array(
            'id'            =>  'new',
            'label'         =>  __('ITS', 'woocommerce'),
            'description'   =>  __('Certyfikat ITS', 'woocommerce')
        )
    );

    echo '</div>';
}

//saving logo settings

function woo_add_custom_logo_save($post_id){
    $woocommerce_text_field = $_POST['product_logo'];
    $woocommerce_text_field2 = $_POST['product_logo2'];
    //if(!empty($woocommerce_text_field))
    update_post_meta($post_id, 'product_logo', esc_attr ($woocommerce_text_field));
    update_post_meta($post_id, 'product_logo2', esc_attr ($woocommerce_text_field2));

}
