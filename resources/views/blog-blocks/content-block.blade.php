<?php
$content=get_sub_field('content');
$title = get_sub_field('section_title');
$section_number = get_sub_field('section_number');
$title_clean_1 = str_replace(' ', '-', $title);
$title_clean = strtolower($title_clean_1);
?>

<section class="content-block" id="{{ $title_clean }}">

      @if($content)

        @if($title)

                    <h2 class="normal-margin-bottom">
                      @if($section_number)
                        <span>{{ $section_number }}</span>
                      @endif
                      {!! $title !!}
                    </h2>
                
        @endif

          @while (have_rows('content'))@php(the_row())

            @if ( get_sub_field('content_type') == 'Text')

              <?php 
              $button = get_sub_field('Button');
              ?>

                <div class="blog-section">

                  {!! get_sub_field('text') !!}

                  @if ($button["label"])

                    <div class="block-buttons normal-margin-top">
                          
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

                          @if($bg_colour === 'is-secondary')

                            <a href="{{$link}}" {{$target}} class="btn btn--secondary--dark">> {{$button['label']}}</a>

                          @else 

                            <a href="{{$link}}" {{$target}} class="btn btn--primary">> {{$button['label']}}</a>

                          @endif

                    </div>

                    @endif
              </div>

            @endif

            @if ( get_sub_field('content_type') === 'Image')

              <?php
                  $image = get_sub_field('image');
              ?>

                <div class="blog-section">

                  <div class="img-container">

                    <img src="{{$image['sizes']['full']}}"/>

                    <div class="caption">
                      <em>{{ the_sub_field('caption') }}</em>
                    </div>

                  </div>

              </div>

            @endif

            @if ( get_sub_field('content_type') === 'Video')

                  <div class="blog-section">
                
                    <div class="videoWrapper">
                      {{ the_sub_field('video') }}
                    </div>

                    <div class="caption">
                      <em>{{ the_sub_field('caption') }}</em>
                    </div>

                  </div>

            @endif

          @endwhile

      @endif
</section>
