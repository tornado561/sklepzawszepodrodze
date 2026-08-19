<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'hero-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$background_type = get_field('csi_background_type');
		$color_scheme = get_field('csi_background_color');
		$background_image = get_field('csi_background_image');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
		$buttons = get_field('buttons_buttons');
		$slides = get_field('slides');
	} else {
		$id = 'hero-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$background_type = $args['csi_background_type'];
		$color_scheme = $args['csi_background_color'];
		$background_image = $args['csi_background_image'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$text = $args['text'];
		$buttons = $args['buttons_buttons'];
		$slides = $args['slides'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="hero hero--<?= ($background_type) ? 'img' : $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">

			<?php if (!empty($background_image) && $background_type) : ?>
				<img src="<?= $background_image['url'] ?>"
					 alt="<?= $background_image['alt'] ?>"
					 aria-hidden="true"
					 class="hero__backgroundImage">
			<?php endif ?>

			<div class="hero__wrapper container">
				<div class="hero__helper">
					<div class="hero__content">
						<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
							<div class="hero__heading">
								<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'hero__headingItem') ?>
							</div>
						<?php endif ?>
						<?php if (!empty($text)) : ?>
							<div class="hero__text">
								<?= $text ?>
							</div>
						<?php endif ?>
						<?php if (!empty($buttons)) : ?>
							<div class="hero__actions">
								<?php foreach ($buttons as $button) : ?>
									<?php (new CodeUnion)->getLink($button['link'], 'button button--' . $button['color_scheme']) ?>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
                    <div class="hero__slider keen-slider" id="<?= $id; ?>-slider" data-keen-slider>
                        <?php if (!empty($slides)) : ?>
                            <?php foreach ($slides as $index => $slide) : ?>
                                <div class="keen-slider__slide hero__slide">
                                    <?php if (!empty($slide['image'])) : ?>
                                        <img src="<?= $slide['image']['url'] ?>" alt="<?= $slide['image']['alt'] ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($slide['title'])) : ?>
                                        <h3 class="hero__slideTitle"><?= $slide['title'] ?></h3>
                                    <?php endif; ?>
                                    <?php if (!empty($slide['text'])) : ?>
                                        <p class="hero__slideText"><?= $slide['text'] ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="hero__sliderNav">
                        <button class="hero__prev" aria-label="Previous slide">
                            <svg width="39" height="29" viewBox="0 0 39 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.5 27L2 14.5L14.5 2" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 14L37 14" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="hero__dots"></div>
                        <button class="hero__next" aria-label="Next slide">
                            <svg width="39" height="29" viewBox="0 0 39 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24.5 2L37 14.5L24.5 27" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M37 15L2 15" stroke="#204B42" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
				</div>
			</div>
		</section>
	<?php endif;
endif;