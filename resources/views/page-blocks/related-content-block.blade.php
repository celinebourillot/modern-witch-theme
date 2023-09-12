<?php
$columns = get_sub_field('related_content');
$title=get_sub_field('title');
$content=get_sub_field('content');
$button=get_sub_field('Button');
$bg_colour = get_sub_field('background-colour');
$per_row = get_sub_field('boxes_per_line');
?>
<!-- Start Front Categories -->
<section class="section related-content {{$bg_colour}}">

  <div class="container">

    <div class="heading align-center">

      @if($title)
        <h2>{{ $title }}</h2>
      @endif

      @if($content)
        <div class="text-content normal-padding-tb">{!! $content !!}</div>
      @endif

    </div>

    @if($columns)

    <div class="card-line">

      <div class="columns is-multiline">

        @foreach( $columns as $column )

          @php setup_postdata($column);

          $image = get_the_post_thumbnail_url($column->ID,'large');
          $postType = get_post_type($column->ID);

          @endphp

          <!-- Start Blog Item Col -->
          <div class="column {{ $per_row }}">
            @include('cards.card')
          </div>

          <!-- End Blog Item Col -->

          @php
          wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
          @endphp

        @endforeach
      </div>

    </div>

    @endif

      @if ($button["label"])

        @include('partials.single-button')

      @endif
  </div>
</section>
<!-- End Front Categories -->
