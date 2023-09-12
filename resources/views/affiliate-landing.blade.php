{{--
  Template Name: Affiliate Page
--}}

@extends('layouts.app')

@section('content')
    @while(have_posts()) @php(the_post())
        @include('partials.page-header')
        @include('partials.content-page-affiliate')
    @endwhile
@endsection