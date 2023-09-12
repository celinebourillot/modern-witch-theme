<?php

$title=get_sub_field('title');
$button=get_sub_field('Button');
$content=get_sub_field('content');
$testimonials = get_sub_field('testimonials');
$bg_colour = get_sub_field('background-colour');

?>


<section class="testimonials section {{$bg_colour}}">

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


  @if($testimonials)

    <div class="testimonial-slider container">

      <div class="columns">

      @foreach ($testimonials as $testimonial)

        @php
          setup_postdata($testimonial);
          $image = get_the_post_thumbnail_url($testimonial->ID,'thumbnail');
          $icon = get_field('client_icon', $testimonial);
        @endphp

        <div class="column">

          <div class="card card--testimonial">

            @if($image)
              <img class="img-mini" src="{{ $image }}" alt="{!! get_the_title($column->ID) !!}"/>
            @endif

            <div class="card__container">

              @php
                the_field('testimonial', $testimonial);
              @endphp

              <div class="card__name">

                @php
                  the_field('name', $testimonial);
                @endphp

              </div>
            </div>

          </div>
        </div>

      @endforeach
    </div>

    </div>

  @endif



  @if ($button['label'])

  <div class="block-buttons text-content">
        
        @if ($button['link_type'] === 'internal')

        <?php
        $link = $button['page_url'];
        $target='';
        ?>
        
        @else

        <?php
        $link = $button['link_url'];
        $target='target="_blank"';
        ?>

        @endif

        <a href="{{$link}}" {{$target}} class="button">{{$button['label']}}</a>

  </div>

  @endif

</section>
