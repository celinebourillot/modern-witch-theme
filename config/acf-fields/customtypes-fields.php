<?php 

$testimonial = new StoutLogic\AcfBuilder\FieldsBuilder('testimonial');
$testimonial
    ->addText('name')
    ->addTextarea('testimonial')
    ->setLocation('post_type', '==', 'testimonial');

$product = new StoutLogic\AcfBuilder\FieldsBuilder('product');
$product

    ->addTab('Main Content')
        ->addText('parfum')
        ->addWysiwyg('composition')
        ->addImage('content_image')

    ->addTab('Accordion')
        ->addRelationship('faqs', ['post_type' => 'faq'])
        ->addRepeater('accordion', [
            'button_label' => 'Add Accordion Section',
            'layout' => 'block'])
                ->addText('accordion_title')
                ->addWysiwyg('accordion_content')
        ->endRepeater()

    ->addTab('Testimonials')
        ->addRelationship('testimonials', ['post_type' => 'testimonial'])
    ->setLocation('post_type', '==', 'product');

$faq = new StoutLogic\AcfBuilder\FieldsBuilder('faq');
$faq
    ->addText('question')
    ->addWysiwyg('answer')
    ->setLocation('post_type', '==', 'faq');

add_action('acf/init', function() use ($testimonial, $product, $faq) {
   acf_add_local_field_group($testimonial->build());
   acf_add_local_field_group($product->build());
   acf_add_local_field_group($faq->build());
});

?>