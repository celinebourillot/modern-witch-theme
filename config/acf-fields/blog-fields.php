<?php 

    //REUSABLE FIELDS 
    $header = new StoutLogic\AcfBuilder\FieldsBuilder('1_blog_header');
    $header
        ->addTextarea('article_excerpt')
        ->addWysiwyg('article_introduction')
        ->addTrueFalse('display_table_of_content')
            ->setLocation('post_type', '==', 'post');

    $footer = new StoutLogic\AcfBuilder\FieldsBuilder('3_blog_footer');
    $footer
        ->addWysiwyg('conclusion')
        ->addRelationship('related_articles')
            ->setLocation('post_type', '==', 'post');

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
        ->addPageLink('page_url', ['post_type' => 'page'])
            ->conditional('link_type', '==', 'internal');


    //LAYOUTS   
    $guideheader = new StoutLogic\AcfBuilder\FieldsBuilder('guideheader');
    $guideheader
        ->addText('small_title')
        ->addText('title')
        ->addWysiwyg('content')
        ->addImage('guide_header_image')
        ->addRepeater('guide_table_of_content', ['min' => 1,
        'max' => 100,
        'button_label' => 'Add Link',
        'layout' => 'block'])
            ->addImage('guide_section_image')
            ->addText('link_label')
            ->addText('link_section_anchor_id');

    $contentBlock = new StoutLogic\AcfBuilder\FieldsBuilder('media_and_text_block');
    $contentBlock

        ->addText('section_title')
        ->addText('section_number')
        ->addRepeater('content', ['min' => 1,
        'max' => 3,
        'button_label' => 'Add Content',
        'layout' => 'block'])
            ->addSelect('content_type')
                ->addChoice('Text')
                ->addChoice('Image')
                ->addChoice('Video')
                ->setDefaultValue('Text')
            ->addWysiwyg('text')
                ->conditional('content_type', '==', 'Text')
            ->addImage('image')
                ->conditional('content_type', '==', 'Image')
            ->addTextarea('video')
                ->conditional('content_type', '==', 'Video')
            ->addTextarea('caption')
                ->conditional('content_type', '!=', 'Text')
            ->addFields($button);
    
    $highlight = new StoutLogic\AcfBuilder\FieldsBuilder('highlight_block');
    $highlight
        ->addText('title')
        ->addText('subtitle')
        ->addWysiwyg('content')
        ->addImage('image')
        ->addFields($button);

    $relatedcontent = new StoutLogic\AcfBuilder\FieldsBuilder('related_content_block');
    $relatedcontent
        ->addText('title')
        ->addWysiwyg('content')
        ->addSelect('boxes_per_line')
            ->addChoice('is-12', '1')
            ->addChoice('is-6', '2')
            ->setDefaultValue('is-12')
        ->addRelationship('related_content');
    
    //FLEXIBLE CONTENT GROUPS
    $content = new StoutLogic\AcfBuilder\FieldsBuilder('2_blog_content');
    $content
        ->addFlexibleContent('sections')
            ->addLayout($guideheader)
            ->addLayout($relatedcontent)
            ->addLayout($contentBlock)
            ->addLayout($highlight)
        ->setLocation('post_type', '==', 'post');

add_action('acf/init', function() use ($header, $content, $footer) {
    acf_add_local_field_group($header->build());
    acf_add_local_field_group($content->build());
    acf_add_local_field_group($footer->build());
});

?>