<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'heroSmall-' . $block['id'];
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
		$breadcrumbs = get_field('breadcrumbs');
	} else {
		$id = 'heroSmall-' . uniqid();
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
		$breadcrumbs = $args['breadcrumbs'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$breadcrumbs_arr = [];
	if (!empty($breadcrumbs)) {
		foreach ($breadcrumbs as $item) {
			$breadcrumbs_arr[] = ['link' => ['url' => $item['link']['url'], 'title' => $item['link']['title']]];
		}
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section class="heroSmall heroSmall--<?= ($background_type) ? 'img' : $color_scheme ?> <?= $spacing_classes ?>"
				 id="<?= $id; ?>">
			<?php if (!empty($background_image) && $background_type) : ?>
				<img src="<?= $background_image['url'] ?>"
					 alt="<?= $background_image['alt'] ?>"
					 aria-hidden="true"
					 class="heroSmall__backgroundImage">
			<?php endif ?>
			<div class="heroSmall__wrapper container">
				<div class="heroSmall__helper">
					<?php if (!empty($breadcrumbs_arr)) : ?>
						<div class="heroSmall__breadcrumbs">
							<?php (new CodeUnion)->getBreadcrumbs($breadcrumbs_arr) ?>
						</div>
					<?php endif ?>
					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="heroSmall__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'heroSmall__headingItem') ?>
						</div>
					<?php endif ?>
					<?php if (!empty($text)) : ?>
						<div class="heroSmall__text">
							<?= $text ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</section>
	<?php endif;
endif;