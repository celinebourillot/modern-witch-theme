@php
$logo = get_field('logo_header','option');
$name = get_field('company_name','option');
$button = get_field('Header CTA','option');
$instagram = get_field('instagram','option');
$facebook = get_field('facebook','option');
$pinterest = get_field('pinterest','option');
$linkedin = get_field('linkedin','option');
$youtube = get_field('youtube','option');
$cartTotal = WC()->cart->get_cart_contents_count();
@endphp
<header class="header">
  <!--<div class="newsletter-heart is-hidden-touch">
    @include('svg.coeur')
  </div>-->
  <nav class="navbar">
    <div class="container">
      <div class="columns is-gapless is-mobile">
        <div class="column is-hidden-touch">

          <div class="navbar__container">

            <ul class="navbar__menu">
              @if (has_nav_menu('primary_navigation'))
              {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
              @endif
            </ul>
          </div>

        </div>
        <div class="navbar__logo">
          <a class="brand" href="{{ home_url('/') }}">
            @if($logo && $logo['url'])
            <img src={{$logo['url']}} alt="{{ $name }} logo" />
            @endif
          </a>
        </div>


        @if ($button['label'])
        <div class="column is-narrow is-hidden-touch">
          <div class="block-buttons">
                    
              @if ($button['link_type'] === 'internal')
      
              <?php
              $link = $button['page_url'];
              $target='';
              ?>
              
              @elseif ($button['link_type'] === 'external')
      
              <?php
              $link = $button['link_url'];
              $target='target="_blank"';
              ?>
      
              @endif
      
              <a href="{{$link}}" {{$target}} class="btn btn--primary">@include('svg.envelop')<span>{{$button['label']}}</span></a>
          </div>
        </div>

        @endif

        <div class="column is-narrow"> 
              
                <ul class="icon-nav"> 
                    <!--<li class="icon-button">
                        <div class="btn btn--primary btn--search"><span class="icon-search-solid"></span>Product search</div>
                    </li>-->
                    <li class="icon-button">
                        <a href="<?php echo get_site_url(); ?>/panier">
                          <span class="icon-shopping-basket"></span>
                          <span class="btn-label"> Panier </span>
                          <!-- <div class="cart-total">{{ $cartTotal }} </div> -->
                        </a>

                        <ul class="submenu submenu--cart">
                            <div class="arrow-up"></div>
                            <li>
                                @if($cartTotal === 0)
                                    <p>Ton panier est vide !</p>
                                @elseif ($cartTotal === 0)
                                    <p>Tu as un produit dans ton panier, d'une valeur de <?php echo WC()->cart->get_cart_total(); ?>.</p>
                                    <a href="{!! wc_get_cart_url() !!}" class="btn btn--primary">Go to basket</a>
                                @else
                                    <p>Tu as {{ $cartTotal }} produits dans ton panier, d'une valeur totale de <?php echo WC()->cart->get_cart_total(); ?>.</p>
                                    <a href="{!! wc_get_cart_url() !!}" class="btn btn--primary">Voir le panier</a>
                                @endif
                                
                            </li>
                        </ul>
                    </li>

                   <!-- @if ( is_user_logged_in() ) 
                        <li class="icon-button is-hidden-touch">
                            <span class="icon-user-circle"></span>
                            <span class="btn-label"> Mon Compte </span>
                             <ul class="submenu submenu--account">
                                    <div class="arrow-up"></div>
                                     <li><a href="<?php echo get_site_url(); ?>/my-account">Dashboard</a></li>
                                     <li><a href="<?php echo get_site_url(); ?>/my-account/orders">Mes commandes</a></li>
                                     <li><a href="<?php echo get_site_url(); ?>/wp-login.php?action=logout">Me Déconnecter</a></li>
                             </ul>
                         </li>
                    @else
                        <li class="icon-button is-hidden-touch">
                            <a href="/my-account" class="link"><span class="icon-user-circle"></span>
                            <span class="btn-label"> Se Connecter </span></a>
                        </li>
                    @endif-->
                </ul>
               
            </div>
            <div class="mobile-nav column is-narrow is-hidden-desktop">

              <a role="button" class="navbar-burger burger" aria-label="menu" data-target="mobile-menu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
              </a>

            </div>
            <div class="column is-narrow is-hidden-touch">
              <div class="header__social">
                        @if ($instagram)
                        <a href={{ $instagram }} target ="_blank">
                          <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                        </a>
                      @endif
        
                      @if ($facebook)
                        <a href={{ $facebook }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                          </a>
                      @endif
        
                      @if ($pinterest)
                        <a href={{ $pinterest }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest" class="svg-inline--fa fa-pinterest fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"></path></svg>
                        </a>
                      @endif
        
                      @if ($linkedin)
                        <a href={{ $linkedin }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" class="svg-inline--fa fa-linkedin-in fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>
                        </a>
                      @endif
        
                      @if ($youtube)
                        <a href={{ $youtube }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
                        </a>
                      @endif
                </div>
              </div>
      </div>
    </div>
  </nav>

  <nav class="nav-mobile nav-mobile--is-hidden">

    <button class="btn--close">X</button>

    <div class="container">


      @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}

      @endif
      @if ( is_user_logged_in() ) 
        <a href="<?php echo get_site_url(); ?>/my-account">Mon Compte</a>
        <a href="<?php echo get_site_url(); ?>/my-account/orders">Mes commandes</a>
        <a href="<?php echo get_site_url(); ?>/wp-login.php?action=logout">Me Déconnecter</a>
      @else
        <a href="/my-account">Se Connecter</a>
      @endif

      <div class="footer__social">
          <h4>Rejoins la communauté</h4>
                      @if ($instagram)
                        <a href={{ $instagram }} target ="_blank">
                          <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" class="svg-inline--fa fa-instagram fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                          Instagram
                        </a>
                      @endif

                      @if ($pinterest)
                        <a href={{ $pinterest }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="pinterest" class="svg-inline--fa fa-pinterest fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"></path></svg>
                        </a>
                      @endif
        
                      @if ($facebook)
                        <a href={{ $facebook }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg>
                            Facebook
                          </a>
                      @endif
        
                      @if ($linkedin)
                        <a href={{ $linkedin }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" class="svg-inline--fa fa-linkedin-in fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg>
                            Linkedin
                        </a>
                      @endif
        
                      @if ($youtube)
                        <a href={{ $youtube }} target ="_blank">
                            <svg aria-hidden="true" focusable="false" data-prefix="fab" data-icon="youtube" class="svg-inline--fa fa-youtube fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path></svg>
                            Youtube
                        </a>
                      @endif
                        
                    </div>

    </div>
  </nav>
</header>
@include('partials.newsletter-modal')