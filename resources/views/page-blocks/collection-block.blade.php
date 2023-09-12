<?php
$products = get_sub_field('featured_products');
$title=get_sub_field('collection_title');
$content=get_sub_field('collection_intro');
$slug = get_sub_field('collection_slug');
$button=get_sub_field('Button');
$bg_image = get_sub_field('background_image');
?>
<!-- Start Front Categories -->

<section class="section collection-block" style="background-image:url({{$bg_image['url']}}); background-repeat: no-repeat;">
  <div class="columns collection-container">

    <div class="column is-4">
      <div class="heading">
        <div class="collection-heading-border">

          @if($title)
            <h2>{!! $title !!}</h2>
          @endif

          @if($content)
            <div class="normal-padding-tb">
              <p>{!! $content !!}</p>
            </div>
          @endif
          @if ($button["label"])

            @include('partials.single-button')

          @endif
        </div>
      </div>
    </div>

    @if($products)

    <div class="collection-products column is-8">

      <div class="columns is-multiline is-mobile">

        @php
          $i = 1;
        @endphp

        @foreach( $products as $product )

          @php setup_postdata($product);
          $product = wc_get_product( $product->ID );
          $id = $product->get_id();
          $image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'square' );
          $price = $product->get_price();
          $title = $product->get_title();
          $excerpt = get_the_excerpt($id);
          $permalink = get_permalink($id);
          $created = $product->get_date_created();
          $new = is_new($created);
          $collection ="yes";
          @endphp

          <!-- Start Blog Item Col -->
          <div class="column product {{ $per_row }} product-{{ $i }}">
            @include('cards.collection-card')
          </div>

          <!-- End Blog Item Col -->

          @php
          wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
          $i++;
          @endphp

        @endforeach



      </div>

    </div>

    @endif
  </div>
</section>
<!-- End Front Categories -->
