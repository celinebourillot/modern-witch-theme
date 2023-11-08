<!-- cta block -->
<?php
$title = get_sub_field('title');
$logos = get_sub_field('Logos');
?>

<section class="logo-block section" >
    <div class="container">

        @if($title)
          <h2>{{ $title }}</h2>
        @endif

        <div class="columns">
            @foreach ($logos as $logo)

              @php
                setup_postdata($logo);
                $image = $logo['logo'];
                $lonk = $logo['logo_link'];
              @endphp

              <div class="column normal-padding">
              <a href="{{$link}}" target="_blank">
                <img src="{{ $image['sizes']['medium'] }}" />
              </a>
              </div>

              @php
                wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
              @endphp

            @endforeach
        </div>

    </div>
  </section>
  <!-- hero banner block -->

