<!-- cta block -->
<?php
$title = get_sub_field('title');
$usps = get_sub_field('USPs');
$content=get_sub_field('content');
?>

<section class="usp-block section" >
    <div class="container">

      <div class="heading align-center">

        @if($title)
          <h2>{{ $title }}</h2>
        @endif

        @if($content)
          <div class="content">
            {!! $content !!}
          </div>

        @endif

      </div>

        <div class="columns">
            @foreach ($usps as $usp)

              @php
                setup_postdata($usp);
                $image = $usp['icon'];
              @endphp

              <div class="column usp normal-padding">
                <div class="circle circle--orange"></div>
                @if($image)
                  <img src="{{ $image['url'] }}" />
                @endif
                <h3>{{ $usp['usp_title'] }}</h3>
                <p>{!! $usp['usp_description'] !!}</p>
              </div>

              @php
                wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
              @endphp

            @endforeach
        </div>

    </div>
  </section>
  <!-- hero banner block -->

