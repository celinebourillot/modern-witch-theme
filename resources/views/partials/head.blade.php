<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php wp_head() @endphp
  <?php
  $favicon = get_field('favicon', 'option');
  $code = get_field('analytics_code', 'option');
  ?>
  <link rel="icon" type="image/png" href="{{ $favicon['url'] }}" />

  {!! $code !!}
</head>