<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'imageSlider-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$color_scheme = get_field('cs_background_color');
		$images_per_row = get_field('images_per_row');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$items = get_field('items');
	} else {
		$id = 'imageSlider-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$color_scheme = $args['cs_background_color'];
		$images_per_row = $args['images_per_row'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$items = $args['items'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="imageSlider imageSlider--<?= $color_scheme ?> <?= $spacing_classes ?>"
				data-image-slider-section
				id="<?= $id; ?>">
			<div class="imageSlider__wrapper container">
				<div class="imageSlider__helper">
					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="imageSlider__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'imageSlider__headingItem') ?>
						</div>
					<?php endif ?>

					<?php if (!empty($items)) : ?>
						<div class="imageSlider__sliderHelper">

							<div class="imageSlider__sliderBox">
								<div class="imageSlider__slider imageSlider__slider--<?= $images_per_row ?> keen-slider"
									 data-slider
									 data-items="<?= $images_per_row ?>"
									 data-active="false">
									<?php $sliderCounter = 1; ?>
									<?php foreach ($items as $item) : ?>
										<div class="imageSlider__item keen-slider__slide number-slide<?= $sliderCounter ?>">
											<div class="imageSlider__itemHelper">
												<img src="<?= $item['image']['url'] ?>"
													 alt="<?= $item['image']['alt'] ?>"
													 class="imageSlider__itemImage">
											</div>
										</div>
										<?php $sliderCounter++; ?>
									<?php endforeach ?>
								</div>
							</div>

						</div>

						<div class="imageSlider__nav" data-nav data-active="false">
							<button type="button"
									class="imageSlider__navBtn"
									aria-label="<?= __('Previous slide', 'codeunion') ?>"
									data-nav-prev>
								<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-left-solid-full.svg"
									 alt="<?= __('Previous slide', 'codeunion') ?>"
									 class="style-svg"
									 aria-label="<?= __('Previous slide', 'codeunion') ?>">
							</button>
							<button type="button"
									class="imageSlider__navBtn"
									aria-label="<?= __('Next slide', 'codeunion') ?>"
									data-nav-next>
								<img src="<?= get_template_directory_uri() ?>/public/img/icons/chevron-right-solid-full.svg"
									 alt="<?= __('Next slide', 'codeunion') ?>"
									 class="style-svg"
									 aria-label="<?= __('Next slide', 'codeunion') ?>">
							</button>
						</div>
					<?php endif ?>
				</div>
			</div>
		</section>
	<?php endif;
endif;