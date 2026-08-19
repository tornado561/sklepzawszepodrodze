<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'iconGrid-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$color_scheme = get_field('cs_background_color');
		$columns_count = get_field('columns_count');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$items = get_field('items');
	} else {
		$id = 'iconGrid-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$color_scheme = $args['cs_background_color'];
		$columns_count = $args['columns_count'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$items = $args['items'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}
	if (empty($columns_count)) {
		$columns_count = 4;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="iconGrid iconGrid--<?= $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">
			<div class="iconGrid__wrapper container">
				<div class="iconGrid__helper">
					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="iconGrid__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'iconGrid__headingItem') ?>
						</div>
					<?php endif ?>
					<?php if (!empty($items)) : ?>
						<div class="iconGrid__tiles iconGrid__tiles--<?= $columns_count ?>">
							<?php foreach ($items as $item) : ?>
								<div class="iconGrid__tile">
									<div class="iconGrid__tileIcon">
										<img src="<?= $item['icon']['url'] ?>"
											 alt="<?= $item['icon']['alt'] ?>"
											 aria-hidden="true"
											 class="iconGrid__tileIconImage">
									</div>
									<div class="iconGrid__tileContent">
										<div class="iconGrid__tileTitle">
											<?= $item['title'] ?>
										</div>
										<div class="iconGrid__tileText">
											<?= $item['text'] ?>
										</div>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</section>
	<?php endif;
endif;