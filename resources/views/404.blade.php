@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="container medium-padding-tb">

  @if (!have_posts())
  <div class="search-results align-center content">
      <div class="alert alert-warning">
        <p>Sorry, this page doesn't exist. Go back to the <a href="{{ home_url('/') }}">homepage</a> or try searching for a keyword :</p>
      </div>
      {!! get_search_form(false) !!}
  </div>
  @endif
  </div>
@endsection
