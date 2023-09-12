@php
  $newsletterTitle = get_field('default_newsletter_title','option');
  $newsletterIntro = get_field('default_newsletter_intro','option');
@endphp

<div class="modal modal--newsletter">
    <div class="modal__container">
            <div class="modal__border large-padding">
                <div class="btn--close">X</div>
                <h2>{{$newsletterTitle}}</h2>
                <p>{{$newsletterIntro}}</p>
                @include('partials.newsletter-form')
            </div>
        </div>
</div>