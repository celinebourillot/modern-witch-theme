@extends('layouts.app')

@section('content')

@include('partials.page-header')

@php
  $tax = get_queried_object();
  $featureditems ='';
  $postType = get_post_type();
    if($tax->slug):
    $tax_query = array(
      array(
        'taxonomy' => $tax->taxonomy,
        'terms' => $tax->slug,
        'field' => 'slug',
        'include_children' => true,
        'operator' => 'IN'
      )
    );
    else:
    $tax_query = '';
    endif;
    $meta_query = '';
    $args = array(
        'post_type' => $postType,
        'paged' => get_query_var( 'paged' ),
        'meta_query' => $meta_query,
        'tax_query' => $tax_query,
        );
    $posts = new WP_Query( $args );
    $count = $posts ->found_posts;
    //$page_number = round($count / $per_page);
@endphp

@if (!$posts->have_posts() && !is_tax())
    <div class="container medium-padding no-padding-top">
      <div class="search-results align-center content">
        <div class="alert alert-warning">
          <p>{{ __('Désolée, nous n\'avons pas trouvé de résultat pour ce mot-clé.', 'sage') }}</p>
        </div>
        <!--{!! get_search_form(false) !!}-->
      </div>
    </div>
  @elseif($posts->have_posts())
    <div class="blog-content text-content medium-padding-tb">

      <div id="posts_wrap">
        @while ( $posts->have_posts() ) @php $posts->the_post() @endphp

            @if(!has_category( 'Downloads'))

              @php 
                $postType = get_post_type();
                $image = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
                $column = new \stdClass();
                $column->ID = '';
              @endphp

              @include('cards.card-blog')
            @endif
            
        @endwhile
      </div>
      @php
        global $wp_query;
      @endphp
      @if (  $wp_query->max_num_pages > 1 )
	      <div id="loadmore" class="btn btn--primary"> Charger + d'articles</div>
      @endif
    </div>
    @else
      <p>Coming soon.</p>
    @endif
@endsection
