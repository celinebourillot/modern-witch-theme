<div class="columns">

        <?php $i = 0; ?>

          @while (have_rows('Buttons'))@php(the_row())
        
            <?php $button = get_sub_field('Button'); ?>
            
            @if ($button['link_type'] === 'internal')

            <?php
            $link = $button['page_url'];
            $classbooking = '';
            ?>
            
            @elseif ($button['link_type'] === 'external')

            <?php
            $link = $button['link_url'];
            $classbooking = '';
            ?>

            @elseif ($button['link_type'] === 'booking')

            <?php
            $link = '#';
            $classbooking = 'btn--booking';
            ?>

            @include('partials.booking-modal')

            @endif

            @if ($i === 0 )
            <?php
            $class = 'btn--primary';
            ?>
            @else
            <?php
            $class = 'btn--secondary';
            ?>
            @endif

            <div class="column is-narrow">

              <a href="{{$link}}" class="btn {{$class}} {{ $classbooking }}">

                  <span>{{$button['label']}}</span>
              </a>

            </div>

            <?php $i ++; ?>

          @endwhile
</div>