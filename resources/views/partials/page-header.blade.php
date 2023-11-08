<!-- hero banner block -->
<?php
$buttons = get_field('Buttons');
$testimonialpicture = get_field('testimonial_picture');
$bg_colour = get_field('background-colour');
$video_id = get_field('video_id');
$tag_id = get_field('newsletter_tag_id');

if(is_home()):
  $title = get_field('blog_page_title','option');
  $intro = get_field('blog_page_intro','option');
  $newsletter = get_field('show_newsletter_subscription_form','option');
  $bg_image = get_field('blog_page_header_image','option');
  $content_image = get_field('blog_page_content_image','option');
else :
  $title = get_field('header_title');
  $intro = get_field('header_intro');
  $newsletter = get_field('show_newsletter_subscription_form');
  $bg_image = get_field('background_image');
  $content_image = get_field('content_image');
endif;


?>
<section class="hero hero--banner-block {{ $bg_colour }}" style="background-image:url({{$bg_image['url']}}); background-repeat: no-repeat; background-size:cover">
  <div class="container">
    <div class="columns">
      <div class="column is-6">
        <div class="hero__body">
            <div class="hero__text">
              <div class="hero__heading">

                @if( $title )
                  <h1>{!! $title !!}</h1>
                @endif

              </div>
              @if( $intro )
                <div class="hero__body__intro">
                  {!! $intro !!}
                </div>
              @endif

              @if( get_field('testimonial') )
                <div class="hero__body__testimonial">
                  <img src="{{ $testimonialpicture['sizes']['square'] }}" />
                  <div>
                    <p>{!! get_field('testimonial') !!}</p>
                    <strong>{{ get_field('testimonial_name') }}</strong>
                  </div>
                </div>
              @endif

              @if ($newsletter === true)
                @include('partials.newsletter-form')
              @endif

              @if ($buttons)
                @include('partials.buttons')
              @endif
            </div>
          </div>
        </div>
        <div class="column is-6">
        @if($content_image)
          <img class="hero__image" src="{{ $content_image['url'] }}" alt="{{ $title }}"/>
        @endif
        @if($video_id)
          <div class="vimeo-wrapper is-hidden-touch">
            <iframe src="https://player.vimeo.com/video/{{ $video_id }}?title=0&byline=0&portrait=0&background=1&autoplay=1&loop=1&controls=0" width="640" height="311" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

  <!-- hero banner block -->




@if ( !is_front_page() )
<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
@endif