<?php $excerpt = get_the_excerpt($column->ID); ?>
<div class="card card--default">
    <div class="card__container">

      <div class="card__container__img-container">
        @if($image)
          <a href="{{ get_permalink($column->ID) }}">
            <img class="img-resp normal-margin-bottom" src="{{ $image }}" alt="{!! get_the_title($column->ID) !!}"/>
          </a>
        @endif

        @if( has_category( 'downloads', $column->ID ) )
          <div class="card__icon-circle">
            @include('svg.download')
          </div>
        @elseif($postType === 'online_courses')
        <div class="card__icon-circle">
            @include('svg.book')
          </div>
        @endif
      </div>
      <h3><a href="{{ get_permalink($column->ID) }}">{!! get_the_title($column->ID) !!}</a></h3>
      
      @if($postType === 'post' && $excerpt)
        <div class="entry-summary">
          <p><?php echo get_the_excerpt($column->ID); ?></p>
        </div>
      @elseif($postType === 'online_courses' && $excerpt)
        <div class="entry-summary">
          <p><?php the_field('course_short_description', $column->ID); ?></p>
        </div>
      @elseif ($excerpt && $postType != 'product')
        <div class="entry-summary">
          <p><?php the_field('page_excerpt', $column->ID); ?></p>
        </div>
      @endif

      @if($postType === 'product')
        <a href="<?php the_permalink($column->ID); ?>" class="link">
           @include('svg.etoile-orange') <span>voir le produit</span> @include('svg.etoile-orange')
        </a>
      @else
        <a href="<?php the_permalink($column->ID); ?>" class="link">
           @include('svg.etoile-orange') <span>lire la suite</span> @include('svg.etoile-orange')
        </a>
      @endif
    </div>
</div>