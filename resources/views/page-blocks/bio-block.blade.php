<?php
$title = get_sub_field('bio_title');
$name = get_sub_field('bio_name');
$content = get_sub_field('bio_text');
$image = get_sub_field('bio_image');
$button = get_sub_field('Button');

?>
<!-- Start Front Categories -->
<section class="section bio-block">
  <div class="text-content">

    @if($image)
      <img src="<?php echo $image['sizes']['square']; ?>" alt="<?php echo get_the_title(); ?>" />
    @endif

    <div class="bio_text">
      @if($title)
        <h2>{{ $title }}</h2>
      @endif

      @if($name)
        <h5>{{ $name}}</h5>
      @endif

      @if($content)
        {!! $content !!}
      @endif

      @if ($button["label"])
        @include('partials.single-button')
      @endif
    </div>

  </div>
</section>
<!-- End Front Categories -->