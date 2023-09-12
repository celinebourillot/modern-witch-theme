<?php
$title = get_sub_field('bio_title');
$name = get_sub_field('bio_name');
$content = get_sub_field('bio_text');
$image = get_sub_field('bio_image');

?>
<!-- Start Front Categories -->
<section class="section bio-block">
  <div class="text-content align-center">
    @if($title)
      <h3>{{ $title }}</h3>
    @endif

    @if($name)
      <h5>{{ $name}}</h5>
    @endif

    @if($content)
      {!! $content !!}
    @endif

  </div>
</section>
<!-- End Front Categories -->
