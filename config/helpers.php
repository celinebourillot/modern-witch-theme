<?php
//SQUARE SIZE
add_image_size( 'square', 400, 400, true );

//GET TAXONOMY LIST

function generate_select_field($taxonomy)
{
  $options = get_all_terms($taxonomy->name);

  var_dump($options);

  foreach ($options as $option) {
    if($option !== 'Uncategorized'):
    $slug = str_replace(" ", "-", $option);
    $slug2 = str_replace("--", "", $slug);
    echo '<option value="' . strtolower($slug2) . '">' . $option . '</option>';
    endif;
  }
}


function get_all_terms($taxonomy)
{
  $parent_args = [
    'taxonomy'     => $taxonomy,
    'parent'        => 0,
    'hide_empty'    => false
  ];
  $parent_terms = get_terms($parent_args);

  $return = [];

  foreach ($parent_terms as $parent_term) {
    $return[] = $parent_term->name;
    $all_children = get_all_term_children($parent_term->term_id, $taxonomy);
    foreach ($all_children as $child) {
      $return[] = '--' . $child;
    }
  }
  return $return;
}

function get_all_term_children($term_id, $taxonomy)
{
  $namearray = [];
  $children_terms = get_term_children($term_id, $taxonomy);

  foreach ($children_terms as $child) {
    $term = get_term_by('id', $child, $taxonomy);
    $namearray[] = $term->name;
  }
  return $namearray;
}

//AJAX SEARCH
add_action('wp_ajax_loadmorebutton', 'cosmos_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'cosmos_loadmore_ajax_handler');

function cosmos_loadmore_ajax_handler()
{

  // prepare our arguments for the query
  $params = json_decode(stripslashes($_POST['query']), true); // query_posts() takes care of the necessary sanitization 
  $params['paged'] = $_POST['page'] + 1; // we need next page to be loaded
  $params['post_status'] = 'publish';
  $params['orderby'] = 'title';
  $params['order'] = 'ASC';

  // it is always better to use WP_Query but not here
  query_posts($params);

  if (have_posts()) :

    // run the loop
    while (have_posts()) : the_post();

    $postType = get_post_type();

      // look into your theme code how the posts are inserted, but you can use your own HTML of course
      // do you remember? - my example is adapted for Twenty Seventeen theme
      if (is_search() && !is_tax() && !is_archive()) : 
        get_template_part('../resources/views/cards/card-search-ajax');
      else :?>
        <?php get_template_part('../resources/views/cards/card-blog'); ?>
    <?php
    endif;
  endwhile;
endif;
die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_cosmosfilter', 'cosmos_filter_function');
add_action('wp_ajax_nopriv_cosmosfilter', 'cosmos_filter_function');

function get_all_taxonomies()
{
  $remove = array('action-group', 'product_visibility', 'product_type', 'product_tag', 'from', 'product_shipping_class', 'tag');
  $all = get_taxonomies(array('_builtin' => FALSE));
  $taxonomies = array_diff($all, $remove);
  $taxonomies[] = 'category';

  return $taxonomies;
}

function cosmos_filter_function()
{

  // Order elements
  if($_POST['cosmos_order_by']){
    $order = explode('-', $_POST['cosmos_order_by']);
    $orderby = $order[0];
    $orderfinal = $order[1];
  } else {
    $orderby = 'title';
    $orderfinal ='ASC';
  }

  $search = sanitize_text_field($_POST['ajax-keyword-search']);


  if ($_POST['location']) :
    $tax_query[] =  array(
      'taxonomy' => 'location',
      'field'    => 'slug',
      'terms'    => $_POST['location'],
    );
  endif;

  if ($_POST['event_type']) :
    $tax_query[] =  array(
      'taxonomy' => 'event_type',
      'field'    => 'slug',
      'terms'    => $_POST['event_type'],
    );
  endif;

  if ($_POST['category']) :
    $tax_query[] =  array(
      'taxonomy' => 'category',
      'field'    => 'slug',
      'terms'    => $_POST['category'],
    );
  endif;

  if ($_POST['people_type']) :
    $tax_query[] =  array(
      'taxonomy' => 'people_type',
      'field'    => 'slug',
      'terms'    => $_POST['people_type'],
    );
  endif;

  if ($_POST['language']) :
    $tax_query[] =  array(
      'taxonomy' => 'language',
      'field'    => 'slug',
      'terms'    => $_POST['language'],
    );
  endif;

  //if term archive page
  if ($_POST['ajax_taxonomy']) :
    $tax_query[] =  array(
      'taxonomy' => $_POST['ajax_taxonomy'],
      'field'    => 'slug',
      'terms'    => $_POST['ajax_term'],
    );
  endif;

  if ($_POST['product_cat']) :
    $tax_query[] =  array(
      'taxonomy' => 'product_cat',
      'field'    => 'slug',
      'terms'    => $_POST['product_cat'],
    );
  endif;

  $params = array(
    'post_type' => $_POST['ajax_post_type'],
    'posts_per_page' => 24, // when set to -1, it shows all posts
    's' =>  $search,
    'meta_key' => $_POST['meta_key_value'],
    'orderby' => $orderby, // example: date
    'tax_query' => $tax_query,
    'order'  => $orderfinal // example: ASC
  );

  query_posts($params);

  global $wp_query;

  if (have_posts()) :

    ob_start(); // start buffering because we do not need to print the posts now

    while (have_posts()) : the_post();
    $postType = get_post_type();
      
      if($postType === 'products') : ?>
      <div class="column is-4">
      <?php get_template_part('../resources/views/cards/card-products'); ?>
      </div>
      <?php else : ?>
        <?php get_template_part('../resources/views/cards/card-blog'); ?>
  <?php endif;
  endwhile;

  $posts_html = ob_get_contents(); // we pass the posts to variable
  ob_end_clean(); // clear the buffer
else :
  $posts_html = '<p>No results matching your criterias.</p>';
endif;

// no wp_reset_query() required

echo json_encode(array(
  'posts' => json_encode($wp_query->query_vars),
  'max_page' => $wp_query->max_num_pages,
  'found_posts' => $wp_query->found_posts,
  'content' => $posts_html
));

die();
}


