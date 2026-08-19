<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'headingTextImage-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$alignment = get_field('settings_a_alignment');
		$color_scheme = get_field('cs_background_color');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
		$buttons = get_field('buttons_buttons');
		$image_size = get_field('image_size');
		$image = get_field('image');
	} else {
		$id = 'headingTextImage-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$alignment = $args['settings_a_alignment'];
		$color_scheme = $args['cs_background_color'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$text = $args['text'];
		$buttons = $args['buttons_buttons'];
		$image_size = $args['image_size'];
		$image = $args['image'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);


	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="headingTextImage headingTextImage--<?= $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">
			<div class="headingTextImage__wrapper container">
				<div class="headingTextImage__helper headingTextImage__helper--<?= $alignment ?>">
					<div class="headingTextImage__content headingTextImage__content--<?= $image_size ?>">
						<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
							<div class="headingTextImage__heading">
								<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'headingTextImage__headingItem') ?>
							</div>
						<?php endif ?>
						<?php if (!empty($text)) : ?>
							<div class="headingTextImage__text">
								<?= $text ?>
							</div>
						<?php endif ?>
						<?php if (!empty($buttons)) : ?>
							<div class="headingTextImage__actions">
								<?php foreach ($buttons as $button) : ?>
									<?php (new CodeUnion)->getLink($button['link'], 'button button--' . $button['color_scheme']) ?>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
					<div class="headingTextImage__image headingTextImage__image--<?= $image_size ?>">
						<?php if (!empty($image)) : ?>
							<img src="<?= $image['url'] ?>"
								 alt="<?= $image['alt'] ?>"
								 class="headingTextImage__imageItem">
						<?php endif ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif;
endif;