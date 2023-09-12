<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
$accordions = get_field('accordion');
$faqs=get_field('faqs');
$composition = get_field('composition');
$testimonials = get_field('testimonials');

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?> text-content" <?php wc_product_class( '', $product ); ?> >
	<section class="product-header container">
		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		?>
		<div class="summary entry-summary">
			<div class="summary__content">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				woocommerce_template_single_excerpt - 8
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
				do_action( 'woocommerce_single_product_summary' );

				
				?>
			<?php 
				if($accordions): ?>

					<!-- .accordion -->
					<div class="accordion"><!-- data-close-other-items determines whether other accordion items will be closed when you click and open one -->
						<?php
						// check if the repeater field has rows of data
						if($faqs): ?>

							@foreach ($faqs as $faq) 

							@php
							setup_postdata($faq);

							// get the sub field values
							$heading = get_field('question', $faq);
							$content = get_field('answer', $faq);

							@endphp

							<!-- __item -->
								<div class="js-accordion">
									<div class="js-accordion__panel">
										<div class="js-accordion__header">
											<div class="d-flex align-items">
												<h4 class="no-padding">{{ $heading }}</h4>
												<span class="btn--accordion"></span>
											</div>
										</div>

										<div class="js-accordion__content">
											<p>{!! $content !!}</p>
										</div>
									</div>
								</div>
								<!-- /__item -->

							@endforeach
								<?php
								endif;
								?>
							<?php
							// check if the repeater field has rows of data
							if( $accordions ):
								// loop through the rows of data
								while ( have_rows('accordion') ) : the_row();

									// get the sub field values
									$heading = get_sub_field('accordion_title');
									$content = get_sub_field('accordion_content');

							?>
									<!-- __item -->
									<div class="js-accordion">
										<div class="js-accordion__panel">
											<div class="js-accordion__header">
												<div class="d-flex align-items">
													<h4 class="no-padding">{{ $heading }}</h4>
													<span class="btn--accordion"></span>
												</div>
											</div>

											<div class="js-accordion__content">
												<p>{!! $content !!}</p>
											</div>
										</div>
									</div>
									<!-- /__item -->
							<?php
								endwhile;
							endif;
							?>

					</div>
					<!-- /.accordion -->

				<?php endif; ?>
			</div>
		</div>
	</section>
</div>

<!-- testimonials -->
@if($testimonials)

    <section class="testimonials container section">

		<div class="columns">

			@foreach ($testimonials as $testimonial)

			@php
			setup_postdata($testimonial);
			$image = get_the_post_thumbnail_url($testimonial->ID,'thumbnail');
			$icon = get_field('client_icon', $testimonial);
			@endphp

			<div class="column">

				<div class="card card--testimonial">

					@if($image)
					<img class="img-mini" src="{{ $image }}" alt="{!! get_the_title($column->ID) !!}"/>
					@endif

					<div class="card__container">

						@php
							the_field('testimonial', $testimonial);
						@endphp

						<div class="card__name">

							@php
							the_field('name', $testimonial);
							@endphp

						</div>
					</div>

				</div>
			</div>

			@endforeach
		</div>
    </section>

  @endif

@if($composition)
	<section class="section">
		<div class="composition-produit text-content">
			{!! $composition !!}
		</div>
	</section>
@endif

<?php do_action( 'woocommerce_after_single_product' ); ?>
