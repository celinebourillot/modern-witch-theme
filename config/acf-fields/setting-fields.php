<?php 

$links = new StoutLogic\AcfBuilder\FieldsBuilder('links');
    $links
        ->addText('label')  
        ->addPageLink('page_url', ['post_type' => 'page']);

$column = new StoutLogic\AcfBuilder\FieldsBuilder('column');
    $column
    ->addText('title')
    ->addWysiwyg('content')
    ->addRepeater('Links', [
        'min' => 0,
        'max' => 10,
        'button_label' => 'Add Link',
        'layout' => 'block',
    ])
    ->addFields($links);    

    
$general = new StoutLogic\AcfBuilder\FieldsBuilder('general_settings');
$general
        
    ->addTab('General')
        ->addImage('default_header_image')
        ->addImage('favicon',[
        'label' => 'Website Favicon',
        'instructions' => 'Please upload a square image in png format.',
    ])
        ->addText('company_name')
        ->addTextarea('analytics_code', [
            'label' => 'Header Scripts',
            'instructions' => 'This field can be used to add tracking scripts like Google Analytics. The code will be placed before the </head> tag.',
        ])

    ->addTab('Newsletter')
        ->addText('default_newsletter_title')
        ->addText('default_newsletter_intro')
        ->addText('default_form_id')

    ->addTab('Social')
        ->addUrl('pinterest')
        ->addUrl('instagram')
        ->addUrl('linkedin')
        ->addUrl('facebook')
        ->addUrl('youtube')
    
    ->addTab('Header')
        ->addImage('logo_header')
        ->addGroup('Header CTA')
            ->addText('label')
            ->addSelect('link_type')
                ->addChoice('external', 'External')
                ->addChoice('internal', 'Internal')
                ->setDefaultValue('internal')
            ->addUrl('link_url')
                ->conditional('link_type', '==', 'external')
            ->addPageLink('page_url', ['post_type' => 'page'])
                ->conditional('link_type', '==', 'internal')
        ->endGroup()

    ->addTab('Footer')
        ->addImage('logo_footer')
        ->addTrueFalse('show_social_media_icons')
        ->addTextarea('footer_tagline')
        ->addRepeater('Footer Columns', [
            'min' => 0,
            'max' => 4,
            'button_label' => 'Add Column',
            'layout' => 'block',
        ])
            ->addFields($column)

        ->endRepeater()

    ->addTab('Blog Archive Page')
        ->addText('blog_page_title')
        ->addTextarea('blog_page_intro')
        ->addImage('blog_page_header_image')
        ->addTrueFalse('show_newsletter_subscription_form')
        ->addWysiwyg('waiting_page_content')
        ->addTextarea('blog_bio_texte')
        ->addImage('blog_bio_image')

    ->setLocation('options_page', '==', 'theme-options');

    

add_action('acf/init', function() use ($general) {
   acf_add_local_field_group($general->build());
});

?>