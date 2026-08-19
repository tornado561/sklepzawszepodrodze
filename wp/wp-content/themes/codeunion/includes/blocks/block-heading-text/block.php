<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'headingText-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$color_scheme = get_field('cs_background_color');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
		$buttons = get_field('buttons_buttons');
	} else {
		$id = 'headingText-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$color_scheme = $args['cs_background_color'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$text = $args['text'];
		$buttons = $args['buttons_buttons'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="headingText headingText--<?= $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">
			<div class="headingText__wrapper container">
				<div class="headingText__helper">
					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="headingText__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'headingText__headingItem') ?>
						</div>
					<?php endif ?>
					<?php if (!empty($text)) : ?>
						<div class="headingText__text">
							<?= $text ?>
						</div>
					<?php endif ?>
					<?php if (!empty($buttons)) : ?>
						<div class="headingText__actions">
							<?php foreach ($buttons as $button) : ?>
								<?php (new CodeUnion)->getLink($button['link'], 'button button--' . $button['color_scheme']) ?>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</section>
	<?php endif;
endif;