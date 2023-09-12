<?php

$title=get_sub_field('title');
$content=get_sub_field('content');
$faqs=get_sub_field('faqs');
$bg_colour = get_sub_field('background-colour');
?>

<div class="section accordion-block {{$bg_colour}}">

  <div class="text-content">


    <div class="content align-center">

      @if($title)
        <h2>{{ $title }}</h2>
      @endif

      @if($content)
      <div class="normal-padding-tb">
        {!! $content !!}
      </div>

      @endif
    </div>

    <div class="content">

  <!-- .accordion -->
  <div class="accordion"><!-- data-close-other-items determines whether other accordion items will be closed when you click and open one -->
          <?php
          // check if the repeater field has rows of data
          if($faqs): ?>

              @foreach ($faqs as $faq) 

              @php
              setup_postdata($faq);

              // get the sub field values
              $heading = get_field('question', $faq);
              $content = get_field('answer', $faq);

              @endphp

              <!-- __item -->
                <div class="js-accordion">
                <div class="js-accordion__panel">
                  <div class="js-accordion__header">
                      <div class="d-flex align-items">
                          <h4 class="no-padding">{{ $heading }}</h4>
                          <span class="btn--accordion"></span>
                      </div>
                    </div>

                    <div class="js-accordion__content">
                        <p>{!! $content !!}</p>
                    </div>
                </div>
                </div>
                <!-- /__item -->

              @endforeach
      <?php
          endif;
          ?>
          <?php
          // check if the repeater field has rows of data
          if( have_rows('accordion') ):
            // loop through the rows of data
              while ( have_rows('accordion') ) : the_row();

                  // get the sub field values
                  $heading = get_sub_field('accordion_title');
                  $content = get_sub_field('accordion_content');

          ?>
                <!-- __item -->
                <div class="js-accordion">
                <div class="js-accordion__panel">
                  <div class="js-accordion__header">
                      <div class="d-flex align-items">
                          <h4 class="no-padding">{{ $heading }}</h4>
                          <span class="btn--accordion"></span>
                      </div>
                    </div>

                    <div class="js-accordion__content">
                        <p>{!! $content !!}</p>
                    </div>
                </div>
                </div>
                <!-- /__item -->
          <?php
              endwhile;
          endif;
          ?>
      </div>
  </div>
  <!-- /.accordion -->
	</div>
</div>
