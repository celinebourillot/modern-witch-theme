<?php 
  $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
  $categories = get_the_category();
  $showtable = get_field('display_table_of_content');
  $intro = get_field('article_introduction');
?>
<section class="hero hero--post">
    <div class="hero__body">
        @if($categories)
          @foreach ($categories as $category)
              @if($category->name !== 'Uncategorized')
                <span class="label">
                  {{ $category->name }} 
                </span>  
              @endif      
          @endforeach
        @endif
        <div class="hero__heading">
            <h1>{!! App::title() !!}</h1>
            <br/>
        </div>
        <div class="hero__body__intro">

          @if(  get_post_type() === 'post')

              <div class="card--meta">
                <div class="date">Publié le  <time class="updated" datetime="{!! get_post_time('c', true) !!}"> {!! get_the_date() !!}</time> par {!! get_the_author() !!}</div>
              </div>
          @endif
        </div>
    </div>
</section>
<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
<div class="text-content">
@if($intro)
  <div class="article__intro">
    {!! $intro !!}
  </div>
@endif
@if($showtable)
  <div class="article__table-of-content">
    @if(have_rows('sections'))
      <ul>
        @while (have_rows('sections'))  @php(the_row())
        <?php
          $title = get_sub_field('section_title');
          $title_number = get_sub_field('section_number');
          $title_clean_1 = str_replace(' ', '-', $title);
          $title_clean = strtolower($title_clean_1);
        ?>
        <li>
          <a href="#{{ $title_clean }}">
            @if($title && $title_number)
              {{ $title_number }}. {{ $title }}
            @elseif($title)
              {{ $title }}
            @endif
          </a>
        </li>
        @endwhile
      </ul>
    @endif
  </div>
@endif
</div>
