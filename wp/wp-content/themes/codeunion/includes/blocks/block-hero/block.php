<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'hero-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
	} else {
		$id = 'hero-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$text = $args['text'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);
	$theme_uri = get_template_directory_uri();

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="hero <?= $spacing_classes ?>"
				id="<?= $id; ?>">

			<video class="hero__video"
				   muted
				   loop
				   playsinline
				   preload="metadata"
				   poster="<?= $theme_uri ?>/public/video/hero-poster.jpg"
				   aria-hidden="true"
				   data-hero-video
				   data-poster-portrait="<?= $theme_uri ?>/public/video/hero-poster-portrait.jpg">
				<source src="<?= $theme_uri ?>/public/video/hero-bg.webm"
						type="video/webm"
						data-src-portrait="<?= $theme_uri ?>/public/video/hero-bg-portrait.webm">
				<source src="<?= $theme_uri ?>/public/video/hero-bg.mp4"
						type="video/mp4"
						data-src-portrait="<?= $theme_uri ?>/public/video/hero-bg-portrait.mp4">
			</video>

			<div class="hero__wrapper container">
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
					<button type="button" class="hero__scroll" data-hero-scroll>
						<span class="hero__scrollLabel">Przewiń w dół</span>
						<span class="hero__scrollIcon">
							<svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
								<path d="M1 1L8 8L15 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</span>
					</button>
				</div>
			</div>
		</section>
	<?php endif;
endif;
