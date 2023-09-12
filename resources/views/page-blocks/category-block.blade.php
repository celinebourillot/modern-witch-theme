<!-- cta block -->
<?php
$title = get_sub_field('title');
$categories = get_sub_field('categories');
$bg_colour = get_sub_field('background-colour');
?>

<section class="category-block section {{$bg_colour}}">
    <div class="container">

        @if($title)
          <h2>{{ $title }}</h2>
        @endif

        <div class="columns">
            @foreach ($categories as $category)

              @php
                setup_postdata($category);
                $image = $category['image'];
                $title = $category['category_title'];
                $desc = $category['category_description'];
                $link = $category['category_link'];
              @endphp

              <div class="column is-4 category normal-padding">
                <div class="card card--category">
                  @if($image)
                    <div class="image-rounded-top">
                      <img class="img-resp" src="{{ $image['url'] }}" />
                    </div>
                  @endif
                  @if($title)
                    <h3>{{ $title }}</h3>
                  @endif
                  @if($desc)
                    <p>{{ $desc }}</p>
                  @endif
                  @if($link)
                    <a href="{{$link}}" class="link">@include('svg.etoile-orange') <span>Voir les produits</span></a>
                  @endif
                </div>
              </div>

              @php
                wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
              @endphp

            @endforeach
        </div>

    </div>
  </section>
  <!-- hero banner block -->

