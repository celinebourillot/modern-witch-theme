 @if(have_rows('sections'))
      <div class="modular-content">
        @while (have_rows('sections'))  @php(the_row())
  
          @if (get_row_layout() == 'media_and_text_block')
  
            @include('blog-blocks/content-block')
  
          @elseif (get_row_layout() == 'related_content_block')
  
            @include('page-blocks/related-content-block')
  
          @endif
        @endwhile
      </div>
    @else 
    <div class="text-content medium-padding-tb">
      <?php
        the_content();
      ?>
  
    </div>
@endif
@php(comments_template())

  