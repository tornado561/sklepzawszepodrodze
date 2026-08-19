<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'cta-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$background_type = get_field('csi_background_type');
		$color_scheme = get_field('csi_background_color');
		$background_image = get_field('csi_background_image');
		$type = get_field('type');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
		$buttons = get_field('buttons_buttons');
	} else {
		$id = 'cta-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$background_type = $args['csi_background_type'];
		$color_scheme = $args['csi_background_color'];
		$background_image = $args['csi_background_image'];
		$type = $args['type'];
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
		<?php if ($type == 'box') : ?>
			<section
					class="cta cta--boxed <?= $spacing_classes ?>"
					id="<?= $id; ?>">
				<div class="cta__wrapper container">
					<div class="cta__boxedHelper cta__boxedHelper--<?= ($background_type) ? 'img' : $color_scheme ?>">
						<?php if (!empty($background_image) && $background_type) : ?>
							<img src="<?= $background_image['url'] ?>"
								 alt="<?= $background_image['alt'] ?>"
								 aria-hidden="true"
								 class="cta__backgroundImage">
						<?php endif ?>
						<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
							<div class="cta__heading">
								<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'cta__headingItem') ?>
							</div>
						<?php endif ?>
						<?php if (!empty($text)) : ?>
							<div class="cta__text">
								<?= $text ?>
							</div>
						<?php endif ?>
						<?php if (!empty($buttons)) : ?>
							<div class="cta__actions">
								<?php foreach ($buttons as $button) : ?>
									<?php (new CodeUnion)->getLink($button['link'], 'button button--' . $button['color_scheme']) ?>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</section>
		<?php else : ?>
			<section
					class="cta cta--<?= ($background_type) ? 'img' : $color_scheme ?> <?= $spacing_classes ?>"
					id="<?= $id; ?>">
				<?php if (!empty($background_image) && $background_type) : ?>
					<img src="<?= $background_image['url'] ?>"
						 alt="<?= $background_image['alt'] ?>"
						 aria-hidden="true"
						 class="cta__backgroundImage">
				<?php endif ?>
				<div class="cta__wrapper container">
					<div class="cta__helper">
						<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
							<div class="cta__heading">
								<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'cta__headingItem') ?>
							</div>
						<?php endif ?>
						<?php if (!empty($text)) : ?>
							<div class="cta__text">
								<?= $text ?>
							</div>
						<?php endif ?>
						<?php if (!empty($buttons)) : ?>
							<div class="cta__actions">
								<?php foreach ($buttons as $button) : ?>
									<?php (new CodeUnion)->getLink($button['link'], 'button button--' . $button['color_scheme']) ?>
								<?php endforeach ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</section>
		<?php endif ?>

	<?php endif;
endif;