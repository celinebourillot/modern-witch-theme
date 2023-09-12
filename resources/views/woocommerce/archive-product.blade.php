{{--
The Template for displaying product archives, including the main shop page which is a post type archive

This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

HOWEVER, on occasion WooCommerce will need to update template files and you
(the theme developer) will need to copy the new files to your theme to
maintain compatibility. We try to do this as little as possible, but it does
happen. When this occurs the version of the template file will be bumped and
the readme will list any important changes.

@see https://docs.woocommerce.com/document/template-structure/
@package WooCommerce/Templates
@version 3.4.0
--}}

@extends('layouts.app')

@php
$getCategory = get_queried_object();
$categoryId = $getCategory->taxonomy.'_'.$getCategory->term_id;
$seoContent = get_field('seo_content', $categoryId );
@endphp

@section('content')


    <header class="hero hero--post">
        <div class="hero__body">


            <h1 class="align-center">
                @if( is_search() )
                    Tes résultats de recherche
                @else             
                    {!! woocommerce_page_title(false) !!}
                @endif
            </h1>
              <div class="text-content category-desc">
                @php
                    do_action('woocommerce_archive_description');
                @endphp
            </div>
        </div>
    </header>

    <div class="container">     
        <div class="shop-container">

                <?php

                    if( is_search() ) {
                    $per_page = 10000;
                    $country = $_GET['collection'] ? $_GET['collection'] : null;
                    $product_cat = $_GET['product_cat'] ? $_GET['product_cat'] : null;
                    $search = $_GET['s'] ? $_GET['s'] : null;
                    $meta_query  = [];
                    $tax_query   = [];
                    $meta_query = array('relation' => 'AND');

                        if ($country)
                            {
                                $meta_query[] =  array(
                                    "key" => "collection",
                                    "value" => $collection,
                                    "compare" => "="
                                );
                            }


                        if ($product_cat)
                            {
                                $tax_query[] =  array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'slug',
                                    'terms'    =>  array($product_cat),
                                );
                            }


                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => $per_page,
                            'paged' => get_query_var( 'paged' ),
                            's' => $search,
                            'meta_query' => $meta_query,
                            'tax_query' => $tax_query,
                            'date_query' => $date_query,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        );
                            

                            // Set the query
                            $products = wc_get_products($args);

                            $count = $products[0] ->found_posts;
                            $page_number = round($count / $per_page); ?>

                            <?php if($_GET['product_cat']):
                                $string = $_GET['product_cat'];
                                $product_type = str_replace("-", " ", $string);

                                else :

                                $product_type = "any product";

                                endif; 
                                
                                ?>

                            <div class="count-products">Tu recherches des <strong><?php echo $product_type; ?></strong> dans <strong><?php echo $_GET['collection'] ? "la collection ".$_GET['country']."</strong>" : "toutes les collections</strong>"; echo $query ? " contenant le mot-clé <strong>".$query."</strong>" : null;?> .</div>

                            <div class="columns is-multiline">

                            <?php 
                            // Standard loop
                            if($products) :
                                foreach ($products as $product) :
                                    global $post;
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'square' );
                                    $price = $product->get_price();
                                    $title = $product->get_title();
                                    $excerpt= excerpt(30);
                                    $created = $product->get_date_created();
                                    $new = is_new($created);
                                    $permalink = get_permalink($post->ID);
                                    $collection = "no";

                                        // Your new HTML markup goes here
                                        ?>
                                        <div class="product-block column is-3">
                                            @include('cards.product-card')
                                        </div>
                                        <?php
                                    endforeach; ?>

                            </div>

                            <?php
                                   
                                    custom_pagination($page_number);
                                    wp_reset_postdata();
                                endif; ?>

                                

                                <?php
                                }
                                // Only run on shop archive pages, not single products or other pages
                                elseif ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || $template ) {
                                    // Products per page
                                    $per_page = 100;
                                    if ( get_query_var( 'taxonomy' ) ) { // If on a product taxonomy archive (category or tag)
                                        
                                        $args = array(
                                            'post_type' => 'product',
                                            'posts_per_page' => $per_page,
                                            'paged' => get_query_var( 'paged' ),
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => get_query_var( 'taxonomy' ),
                                                    'field'    => 'slug',
                                                    'terms'    => get_query_var( 'term' ),
                                                ),
                                            ),
                                        );
                                    } else {
                                        $args = array(
                                            'post_type' => 'product',
                                            'orderby' => 'date',
                                            'order' => 'DESC',
                                            'posts_per_page' => $per_page,
                                            'paged' => get_query_var( 'paged' ),
        
                                        );
                                    }
                                    // Set the query
                                    $products = new WP_Query( $args );
                                    $count = $products ->found_posts; 
                                    $page_number = round($count / $per_page); 
                                    ?>

                                    <!--<div class="count-products"><?php echo $count; ?> produits.</div>-->
                                    <div class="columns is-multiline">

                                    <?php
                                    // Standard loop
                                    if ( $products->have_posts() ) :
                                        while ( $products->have_posts() ) : $products->the_post();
                                        global $post;
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'square' );
                                        $product = wc_get_product( $post->ID );
                                        $price = $product->get_price();
                                        $title = $product->get_title();
                                        $excerpt = excerpt(30);
                                        $created = $product->get_date_created();
                                        $new = is_new($created);
                                        $permalink = get_permalink($post->ID);
                                        $collection = "no";

                                            // Your new HTML markup goes here
                                            ?>
                                            <div class="column is-3">
                                                @include('cards.product-card')
                                            </div>
                                            <?php
                                        endwhile; ?>

                                    </div>

                                    <?php
                                        custom_pagination($page_number); 
                                        wp_reset_postdata();

                                            endif; ?>
                                        
                                            
                                <?php
                                } else { // If not on archive page (cart, checkout, etc), do normal operations
                                    woocommerce_content();
                                }
                            ?>
            

        </div>
    </div>
</div>
<div class="text-content seo-content-category">
    {!! $seoContent !!}
</div>
    <!--<a id="back2Top" title="Back to top" href="#">Retour en haut</a>-->

@endsection
