<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'testimonials-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$color_scheme = get_field('cs_background_color');
		$items_per_row = get_field('items_per_row');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
	} else {
		$id = 'testimonials-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$color_scheme = $args['cs_background_color'];
		$items_per_row = $args['items_per_row'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$testimonials = get_field('s_testimonials', 'option');

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active && !empty($testimonials)) : ?>
		<section class="testimonials testimonials--<?= $color_scheme ?> <?= $spacing_classes ?>"
				 data-testimonials-section
				 id="<?= $id; ?>">
			<div class="testimonials__wrapper container">
				<div class="testimonials__helper">
					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="testimonials__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'testimonials__headingItem') ?>
						</div>
					<?php endif ?>
					<?php if (!empty($text)) : ?>
						<div class="testimonials__text">
							<?= $text ?>
						</div>
					<?php endif ?>


					<div class="testimonials__sliderHelper">

						<div class="testimonials__sliderBox">
							<div class="testimonials__slider testimonials__slider--<?= $items_per_row ?> keen-slider"
								 data-slider
								 data-items="<?= $items_per_row ?>"
								 data-active="false">
								<?php $sliderCounter = 1; ?>
								<?php foreach ($testimonials as $item) : ?>
									<div class="testimonials__item keen-slider__slide number-slide<?= $sliderCounter ?>">
										<?php if (!empty($item['rating'])) : ?>
										<?php endif ?>
										<div class="testimonials__itemRating">
											<?php for ($i = 1; $i <= $item['rating']; $i++) : ?>
												<img src="<?= get_template_directory_uri() ?>/public/img/icons/star.svg"
													 alt="<?= __('Ikona gwiazdy', 'codeunion') ?>"
													 aria-hidden="true"
													 class="testimonials__itemRatingIcon style-svg">
											<?php endfor ?>
										</div>
										<div class="testimonials__itemAuthor">
											<?= $item['author_name'] ?>
										</div>
										<div class="testimonials__itemText">
											<?= $item['text'] ?>
										</div>
										<div class="testimonials__itemInfo">
											<div class="testimonials__itemDate">
												<?= $item['date'] ?>
											</div>
											<div class="testimonials__itemGoogle">
												<img src="<?= get_template_directory_uri() ?>/public/img/icons/logo-google.png"
													 alt="<?= __('Logo Google', 'codeunion') ?>"
													 aria-hidden="true"
													 class="testimonials__itemGoogleIcon">
											</div>
										</div>
									</div>
									<?php $sliderCounter++; ?>
								<?php endforeach ?>
							</div>
						</div>

					</div>

					<div class="testimonials__nav" data-nav data-active="false">
						<button type="button"
								class="testimonials__navBtn"
								aria-label="<?= __('Previous slide', 'codeunion') ?>"
								data-nav-prev>
							<img src="<?= get_template_directory_uri() ?>/public/img/icons/arrow-left.svg"
								 alt="<?= __('Previous slide', 'codeunion') ?>"
								 class="style-svg"
								 aria-label="<?= __('Previous slide', 'codeunion') ?>">
						</button>
						<button type="button"
								class="testimonials__navBtn"
								aria-label="<?= __('Next slide', 'codeunion') ?>"
								data-nav-next>
							<img src="<?= get_template_directory_uri() ?>/public/img/icons/arrow-right.svg"
								 alt="<?= __('Next slide', 'codeunion') ?>"
								 class="style-svg"
								 aria-label="<?= __('Next slide', 'codeunion') ?>">
						</button>
					</div>


				</div>
			</div>
		</section>
	<?php endif;
endif;