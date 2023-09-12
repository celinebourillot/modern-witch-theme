<div class="block-buttons">
                    
        @if ($button['link_type'] === 'internal')

        <?php
        $link = $button['page_url'];
        $target='';
        $bookingclass= '';
        ?>
        
        @elseif ($button['link_type'] === 'external')

        <?php
        $link = $button['link_url'];
        $target='target="_blank"';
        $bookingclass= '';
        ?>

        @endif

        <a href="{{$link}}" {{$target}} class="btn btn--primary"><span>{{$button['label']}}</span></a>

  </div>