<?php
$title = get_sub_field('title');
$texte = get_sub_field('text');
$button = get_sub_field('Button');
$bg_colour = get_sub_field('background-colour');
?>

<section class="section content-block {{$bg_colour}}">

    <div class="text-content">

        @if($title)
          <h2>{!! $title !!}</h2>               
        @endif

        {!! $texte !!}

        @if ($button["label"])

        @include('partials.single-button')

        @endif

          
  </div>
</section>
