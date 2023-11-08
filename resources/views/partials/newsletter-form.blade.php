<?php 
$form_id = get_field('default_form_id','option');
?>
<div class="form_newsletter">
    <!--<?php echo do_shortcode('[forminator_form id='.$form_id.']'); ?>-->
    <!-- Begin Mailchimp Signup Form -->
    <div id="mc_embed_signup">
        <form action="https://themodernwitch.us7.list-manage.com/subscribe/post?u=13e94f64118650e7b537b7fa8&amp;id=e5500861e1" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <div class="mc-field-group">
                    <input type="text" placeholder="Prénom" value="" name="FNAME" class="" id="mce-FNAME">
                </div>
                <div class="mc-field-group">
                    <input type="email" placeholder="Email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
                </div>
                @if($tag_id)
                    <div hidden=""><input type="hidden" name="tags" value="{{$tag_id}}"></div>
                @endif
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_13e94f64118650e7b537b7fa8_e5500861e1" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Je m'inscris !" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
    </div>

    <!--End mc_embed_signup-->
</div>
<em>On respecte ta vie privée en gardant ton email rien que pour nous.</em>
