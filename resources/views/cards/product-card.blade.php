<?php
$parfum = get_field('parfum', $post->ID);
?>

<div class="card card--product">
    <div class="image-shape">
        <div class="card-square">
             @if( has_term( 'produits-personnalises', 'product_cat', $post->ID ))
                <div class="label label--corner">
                    Personnalise-moi !
                </div>
             @endif
            <a href="{{ $permalink }}">
                <img class="img-resp" src="<?php echo $image[0]; ?>" data-id="<?php echo $post->ID; ?>">
            </a>
        </div>
    </div>
    <div class="card__container">
    
            <a href="{{ $permalink }}"><h3>{{ $title }}</h3></a>

            @if($parfum)
                <p class="card--product__excerpt">{{ $parfum }}</p>
            @endif

            @if( has_term( 'produits-personnalises', 'product_cat', $post->ID ))

                <a href="{{ $permalink }}" class="btn btn--primary normal-margin-top">
                    Choisir le parfum
                </a>

            @elseif($collection === 'yes')
                <a href="{{ $permalink }}" class="link normal-margin-top">
                    @include('svg.etoile-orange') <span>Voir le produit</span> @include('svg.etoile-orange')
                </a>
            @else

                <a href="/shop/?add-to-cart=<?php echo $post->ID ?>" data-quantity="1" class="btn btn--primary button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $post->ID ?>" data-product_sku="" aria-label="Ajouter “Bougie naturelle parfumée Air” à votre panier" rel="nofollow">Acheter • {{ $price }}€</a>

                <a href="{{ $permalink }}" class="link normal-margin-top">
                    @include('svg.etoile-orange') <span>Voir le produit</span> @include('svg.etoile-orange')
                </a>
            @endif
            
            <!--<?php if (empty($sold)) : echo do_shortcode('[yith_wcwl_add_to_wishlist]'); endif; ?>-->
    </div>
</div>