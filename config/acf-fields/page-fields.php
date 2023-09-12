<?php 

    //REUSABLE FIELDS 
    $backgroundColor = new StoutLogic\AcfBuilder\FieldsBuilder('background-colour');
    $backgroundColor
        ->addSelect('background-colour')
            ->addChoice('is-white', 'White')
            ->addChoice('is-primary-gradient', 'Dégradé violet')
            ->addChoice('is-cream', 'Crème')
            ->addChoice('is-tertiary-gradient', 'Dégradé jaune/orange')
            ->setDefaultValue('is-white');

    $button = new StoutLogic\AcfBuilder\FieldsBuilder('button');
    $button
        ->addGroup('Button')
        ->addText('label')
        ->addSelect('link_type')
            ->addChoice('external', 'External')
            ->addChoice('internal', 'Internal')
            ->setDefaultValue('internal')
        ->addUrl('link_url')
            ->conditional('link_type', '==', 'external')
        ->addPageLink('page_url', ['post_type' => 'page', 'post_type' => 'product'])
            ->conditional('link_type', '==', 'internal');

    $header = new StoutLogic\AcfBuilder\FieldsBuilder('1_page_header');
    $header
        ->addFields($backgroundColor)
        ->addText('video_id')
        ->addText('header_title')
        ->addTextarea('header_intro')
        ->addImage('background_image')
        ->addTrueFalse('show_newsletter_subscription_form')
        ->addRepeater('Buttons', [
            'min' => 0,
            'max' => 2,
            'button_label' => 'Add Button',
            'layout' => 'block',
          ])
            ->addFields($button)
            ->setLocation('post_type', '==', 'page');
    
    $affiliate = new StoutLogic\AcfBuilder\FieldsBuilder('2_affiliate_info');
    $affiliate
        ->addImage('custom_logo')
            ->setLocation('page_template', '==', 'views/affiliate-landing.blade.php');

    //LAYOUTS
    $collectionBlock = new StoutLogic\AcfBuilder\FieldsBuilder('collection_block');
    $collectionBlock
        ->addFields($backgroundColor)
        ->addText('collection_slug')
        ->addText('collection_title')
        ->addTextarea('collection_intro')
        ->addImage('background_image')
        ->addRelationship('featured_products', ['post_type' => 'product'])
        ->addFields($button);
    
    $contentBlock = new StoutLogic\AcfBuilder\FieldsBuilder('media_and_text_block');
    $contentBlock
        ->addFields($backgroundColor)
        ->addText('title')
        ->addWysiwyg('text')
        ->addImage('content_image')  
        ->addFields($button);
    
    $bioBlock = new StoutLogic\AcfBuilder\FieldsBuilder('bio_block');
    $bioBlock
        ->addText('bio_title')
        ->addText('bio_name')
        ->addWysiwyg('bio_text') 
        ->addImage('bio_image')   
        ->addFields($button);
    
    $highlightBlock = new StoutLogic\AcfBuilder\FieldsBuilder('highlight_block');
    $highlightBlock
        ->addText('highlight_title')
        ->addWysiwyg('highlight_text') 
        ->addImage('highlight_image')   
        ->addFields($button);
    
    $categoryBlock = new StoutLogic\AcfBuilder\FieldsBuilder('category_block');
    $categoryBlock
        ->addFields($backgroundColor)
        ->addText('title')
        ->addRepeater('categories', [
            'min' => 0,
            'max' => 6,
            'button_label' => 'Add Category',
            'layout' => 'block',
          ])
            ->addImage('image')
            ->addText('category_title')
            ->addTextarea('category_description')
            ->addUrl('category_link');
    
    $uspBlock = new StoutLogic\AcfBuilder\FieldsBuilder('usp_block');
    $uspBlock
        ->addText('title')
        ->addWysiwyg('content')
        ->addRepeater('USPs', [
            'min' => 0,
            'max' => 6,
            'button_label' => 'Add USP',
            'layout' => 'block',
          ])
            ->addImage('icon')
            ->addText('usp_title')
            ->addTextarea('usp_description');

    $logoBlock = new StoutLogic\AcfBuilder\FieldsBuilder('logo_block');
    $logoBlock
        ->addText('title')
        ->addRepeater('Logos', [
            'min' => 0,
            'max' => 4,
            'button_label' => 'Add Logo',
            'layout' => 'block',
          ])
            ->addImage('logo');

    $testimonials = new StoutLogic\AcfBuilder\FieldsBuilder('testimonials_block');
    $testimonials
        ->addFields($backgroundColor)
        ->addText('title')
        ->addWysiwyg('content')
        ->addRelationship('testimonials', ['post_type' => 'testimonial'])
        ->addFields($button);

    $relatedcontent = new StoutLogic\AcfBuilder\FieldsBuilder('related_content_block');
    $relatedcontent
        ->addFields($backgroundColor)
        ->addSelect('boxes_per_line')
            ->addChoice('is-6', '2')
            ->addChoice('is-4', '3')
            ->addChoice('is-3', '4')
            ->setDefaultValue('is-6')
        ->addText('title')
        ->addWysiwyg('content')
        ->addRelationship('related_content')
        ->addFields($button);
    
    $newsletterBlock = new StoutLogic\AcfBuilder\FieldsBuilder('newsletter_block');
    $newsletterBlock
        ->addFields($backgroundColor)
        ->addTrueFalse('use_default_form')
        ->addText('title')
        ->addTextarea('intro')
        ->addImage('resource_image')
        ->addText('group_id')
        ->addText('form_id');
    
    $accordion = new StoutLogic\AcfBuilder\FieldsBuilder('accordion_block');
    $accordion
        ->addFields($backgroundColor)
        ->addText('title')
        ->addWysiwyg('content')
        ->addRelationship('faqs', ['post_type' => 'faq'])
        ->addRepeater('accordion', [
            'button_label' => 'Add Accordion Section',
            'layout' => 'block'])
                ->addText('accordion_title')
                ->addWysiwyg('accordion_content');
    
    $productcat = new StoutLogic\AcfBuilder\FieldsBuilder('product_cat');
    $productcat
        ->addWysiwyg('seo_content')
    ->setLocation('taxonomy', '==', 'product_cat');
    
    //FLEXIBLE CONTENT AFFILIATE PAGE
    $affiliatecontent = new StoutLogic\AcfBuilder\FieldsBuilder('3_page_affiliate');
    $affiliatecontent
        ->addFlexibleContent('sections')
            ->addLayout($collectionBlock)
            ->addLayout($relatedcontent)
            ->addLayout($contentBlock)
            ->addLayout($highlightBlock)
            ->addLayout($testimonials)
        ->setLocation('page_template', '==', 'views/affiliate-landing.blade.php');
    
    //FLEXIBLE CONTENT GROUPS
    $content = new StoutLogic\AcfBuilder\FieldsBuilder('2_page_content');
    $content
        ->addFlexibleContent('sections')
            ->addLayout($collectionBlock)
            ->addLayout($uspBlock)
            ->addLayout($relatedcontent)
            ->addLayout($contentBlock)
            ->addLayout($bioBlock)
            ->addLayout($logoBlock)
            ->addLayout($testimonials)
            ->addLayout($newsletterBlock)
            ->addLayout($accordion)
            ->addLayout($highlightBlock)
            ->addLayout($categoryBlock)
        ->setLocation('post_type', '==', 'page')
            ->and('page_template', '!=', 'views/affiliate-landing.blade.php');

add_action('acf/init', function() use ($header, $content, $affiliate, $affiliatecontent, $productcat) {
    acf_add_local_field_group($header->build());
    acf_add_local_field_group($affiliate->build());
    acf_add_local_field_group($content->build());
    acf_add_local_field_group($affiliatecontent->build());
    acf_add_local_field_group($productcat->build());
});

?>