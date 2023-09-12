@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())

  <?php $header = get_field('hide_default_page_header'); ?>
  @if(!is_front_page())
    @include('partials.page-header-post')
  @endif
    @include('partials.content-page')
  @endwhile
  
@endsection



