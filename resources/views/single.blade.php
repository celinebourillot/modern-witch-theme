@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header-'.get_post_type())
    <div class="article_content">
      @include('partials.content-single-'.get_post_type())
      @include('partials.comments')
    </div>
  @endwhile
@endsection
