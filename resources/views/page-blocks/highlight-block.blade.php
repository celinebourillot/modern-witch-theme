<?php
$title = get_sub_field('highlight_title');
$name = get_sub_field('highlight_name');
$content = get_sub_field('highlight_text');
$image = get_sub_field('highlight_image');
$button = get_sub_field('Button');

?>
<!-- Start Front Categories -->
<section class="section highlight-block">
  <div class="container columns">

    @if($image)
        <div class="column is-6">
            <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo get_the_title(); ?>" />
            @if ($button["label"])
                @include('partials.single-button')
            @endif
        </div>
    @endif
    <div class="column">
        <div class="highlight_text">
            @include('svg.lune-etoile')
            @if($title)
                <h2>{{ $title }}</h2>
            @endif

            @if($name)
                <h5>{{ $name}}</h5>
            @endif

            @if($content)
                {!! $content !!}
            @endif
        </div>
    </div>

  </div>
</section>
<!-- End Front Categories -->