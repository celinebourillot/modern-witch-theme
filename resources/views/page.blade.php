@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())

  <?php $header = get_field('hide_default_page_header'); ?>
  @if(!$header)
    @include('partials.page-header')
  @endif
    @include('partials.content-page')
  @endwhile
  
@endsection



