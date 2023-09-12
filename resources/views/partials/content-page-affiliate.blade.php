<div class="modular-content">
  <!-- flexible content -->
  @if(have_rows('sections'))
    <div class="modular-content">
      @while (have_rows('sections'))  @php(the_row())

        @if (get_row_layout() == 'media_and_text_block')

          @include('page-blocks/content-block')
        
        @elseif (get_row_layout() == 'collection_block')

          @include('page-blocks/collection-block')
        
        @elseif (get_row_layout() == 'highlight_block')

          @include('page-blocks/highlight-block')

        @elseif (get_row_layout() == 'related_content_block')

          @include('page-blocks/logo-block')

        @elseif (get_row_layout() == 'related_content_block')

          @include('page-blocks/related-content-block')

        @elseif (get_row_layout() == 'testimonials_block')

          @include('page-blocks/testimonials-block')

        @endif
      @endwhile
    </div>
  @else 
  <div class="container">
    <?php
      the_content();
    ?>

  </div>
  @endif

<!-- end flexible content -->

</div>
