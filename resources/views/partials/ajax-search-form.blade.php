@php
$remove = array('post_tag','post_format','product_tag', 'product_type', 'product_shipping_class', 'pa_color', 'product_visibility', 'pa_size');
if(is_category()):
array_push($remove, 'category');
endif;
if(is_tax() && !is_post_type_archive()):
array_push($remove, 'people_type');
endif;
$taxonomies= get_object_taxonomies( $postType, 'object' );

global $wp;
$url = home_url( $wp->request )

@endphp
<form id="cosmos_filters" class="ajax-search-form" action="#">
    <div class="columns">
        <div class="column">
            <input type="text" name="ajax-keyword-search" id="ajax-keyword-search" value="" placeholder="Tape un mot-clé...">
        </div>
        @if ($taxonomies)
            @foreach($taxonomies as $taxonomy)
            @if(in_array( $taxonomy->name, $remove ))
            @else
            <div class="column">
                    <div class="custom-select">
                        @if($taxonomy->name !== 'Uncategorized')
                        <select name={{ $taxonomy->name }} id={{ $taxonomy->ID }}>
                            <option value=''>Toutes les Catégories</option>
                            <?php generate_select_field($taxonomy); ?>
                        </select>
                        @endif
                    </div>
                </div>
            @endif
            @endforeach
        @endif

        @if($postType === 'events')

        <div class="column">
            <label for="cosmos_order_by">Order by</label>
            <div class="custom-select">
                <select name="cosmos_order_by" id="cosmos_order_by">
                <option value="meta_value-DESC">Upcoming events first</option><!-- I will explode these values by "-" symbol later -->
                <option value="meta_value-ASC">Past events first</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="meta_key_value" value="event_date" />

        @endif

        <div class="column is-narrow">
            <button class="btn btn--primary">Rechercher</button>
        </div>
       
        <!-- required hidden field for admin-ajax.php -->
        <input type="hidden" name="action" value="cosmosfilter" />
        <input type="hidden" name="ajax_post_type" value={{ $postType }} />
        @if(is_tax() || is_category() && !is_post_type_archive() && !is_home())
        <input type="hidden" name="ajax_term" value={{ $tax->slug }} />
        <input type="hidden" name="ajax_taxonomy" value={{ $tax->taxonomy }} />
        @endif
    </div>
    <a class="link" href={{ $url }}>Effacer la Recherche</a>
</form>