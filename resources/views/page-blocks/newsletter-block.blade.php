@php 
    $newsletterTitle = get_sub_field('title') ? get_sub_field('title') : get_field('default_newsletter_title','option');
    $newsletterIntro = get_sub_field('intro') ? get_sub_field('intro') : get_field('default_newsletter_intro','option');
    $image = get_sub_field('resource_image');
    $bg_colour = get_sub_field('background-colour');
@endphp

<div class="newsletter-block section {{$bg_colour}}">
    <div class="text-content">
        <h2>{{$newsletterTitle}}</h2>
        <p>{!! $newsletterIntro !!}</p>

       @if($image)
        <img class="img-resp" src="{{ $image['sizes']['large'] }}" alt="{{ $newsletterTitle }}"/>
       @endif

       @include('partials.newsletter-form')

    </div>
</div>