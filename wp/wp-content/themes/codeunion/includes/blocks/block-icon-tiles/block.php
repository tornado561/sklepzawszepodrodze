<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'iconTiles-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$color_scheme = get_field('cs_background_color');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$items = get_field('items');
	} else {
		$id = 'iconTiles-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$color_scheme = $args['cs_background_color'];
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
				class="iconTiles iconTiles--<?= $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">
			<div class="iconTiles__wrapper container">
				<div class="iconTiles__helper">

					<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
						<div class="iconTiles__heading">
							<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'iconTiles__headingItem') ?>
						</div>
					<?php endif ?>

					<?php if (!empty($items)) : ?>
						<div class="iconTiles__tiles">
							<?php foreach ($items as $item) : ?>
								<div class="iconTiles__tile">
									<div class="iconTiles__tileIcon">
										<img src="<?= $item['icon']['url'] ?>"
											 alt="<?= $item['icon']['alt'] ?>"
											 aria-hidden="true"
											 class="iconTiles__tileIconImage">
									</div>
									<div class="iconTiles__tileContent">
										<div class="iconTiles__tileTitle">
											<?= $item['title'] ?>
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