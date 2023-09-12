@extends('layouts.app')

@section('content')
  @include('partials.page-header-search')

  <div class="container medium-padding-tb">

  @if (!have_posts())
  <div class="search-results align-center content">
    <div class="alert alert-warning">
      <p>{{ __('Sorry, no results were found. Please try another keyword.', 'sage') }}</p>
    </div>
    {!! get_search_form(false) !!}
  </div>
  @endif
    <div id="posts_wrap" class="is-search-results content">
      @while(have_posts()) @php the_post() @endphp
        @php 
          $postType = get_post_type();
          $image = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
          $column = new \stdClass();
          $column->ID = '';
        @endphp
          @include('cards.card-search')
      @endwhile
    </div>
    @php
      global $wp_query;
    @endphp
    @if (  $wp_query->max_num_pages > 1 )
	    <div id="loadmore" class="btn btn--primary">More posts</div>
    @endif

  <!--{!! get_the_posts_navigation() !!}-->
  </div>
@endsection
