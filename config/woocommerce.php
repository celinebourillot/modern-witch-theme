<?php
//ADD MORE FIELDS TO REGISTER FORM
add_filter( 'show_password_fields', '__return_false' );


function product_terms($id, $taxonomy)
{



    $terms = get_the_terms($id, $taxonomy);

    if ($terms && !is_wp_error($terms)) :

        $countries = array();

        foreach ($terms as $term) {
            $countries[] = $term->name;
        }

        $country = join(", ", $countries);

        return $country;
    endif;
}

add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

    ?>
    <a class="cart-customlocation btn btn--primary" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><span class="icon-shopping-basket"></span> <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

function is_new($created)
{
    $newness_days = 28;
    $created = strtotime($created);
    if ((time() - (60 * 60 * 24 * $newness_days)) < $created) {
        return true;
    }
}

function iconic_register_redirect($redirect)
{
    return wc_get_page_permalink('account-created');
}

add_filter('woocommerce_registration_redirect', 'iconic_register_redirect');

function custom_pagination($page_number)
{
    
    $big = 999999999;
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?page=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $page_number,
        'prev_next' => false,
        'type' => 'array',
        'prev_next' => TRUE,
        'prev_text' => '&larr; Previous',
        'next_text' => 'Next &rarr;',
    ));
    if (is_array($pages)) {
        $current_page = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<ul class="woocommerce-pagination">';
        foreach ($pages as $i => $page) {
            if ($current_page == 1 && $i == 0) {
                echo "<li class='active'>$page</li>";
            } else {
                if ($current_page != 1 && $current_page == $i) {
                    echo "<li class='active'>$page</li>";
                } else {
                    echo "<li>$page</li>";
                }
            }
        }
        echo '</ul>';
    }
}

//LIST ALL COUNTRIES

function list_countries()
{
    global $wpdb;
    $result = $wpdb->get_results(
        "
			SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			WHERE pm.meta_key = 'country' 
			ORDER BY pm.meta_value"
    );

    return $result;
}

add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Adds product images to WooCommerce order emails
 */

function lm_modify_wc_order_emails( $args ) {
    
    // bail if this is sent to the admin
    if ( $args['sent_to_admin'] ) {
        return $args; 
    }
  
    $args['show_sku'] = true;
    $args['show_image'] = true;
    $args['image_size'] = array( 100, 100 );
 
    return $args;
}
add_filter( 'woocommerce_email_order_items_args', 'lm_modify_wc_order_emails' );

/* REMOVE USELESS CHECKOUT FIELDS */
add_filter( 'woocommerce_checkout_fields' , 'remove_checkout_fields' ); 
function remove_checkout_fields( $fields ) { 
    unset($fields['billing']['billing_company']); 
    unset($fields['billing']['billing_address_2']);
    return $fields; 
}

?>