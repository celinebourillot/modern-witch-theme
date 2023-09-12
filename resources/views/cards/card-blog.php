<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
$id = get_the_ID();
$excerpt = get_field('article_excerpt', $id);
?>

<div class="card card--post">
  <div class="card__container">
  <?php
    $categories = get_the_category($id);
    if($categories):
        foreach ($categories as $category):
            if($category->name !== 'Uncategorized'): ?>
            <span class="label">
                <?php echo $category->name; ?>  
        </span>  
         <?php endif;      
        endforeach;
    endif; ?>

    <h3 class="normal-margin-bottom"><a href="<?php echo get_permalink($id) ?>"><?php the_title() ?></a></h3>

    <?php if ($image) : ?>
    <a href="<?php echo get_permalink($id) ?>">
      <img class="img-resp" src="<?php echo $image; ?>" alt="<?php echo get_the_title(); ?>" />
    </a>
    <?php endif; ?>

    <?php 
    if($excerpt):
      echo '<p>'.$excerpt.'</p>';
    else:
      the_excerpt($id); 
    endif;?>

    <a href="<?php the_permalink($id); ?>" class="btn btn--primary normal-margin-top">
    Lire la suite
  </a>

  </div>
</div>