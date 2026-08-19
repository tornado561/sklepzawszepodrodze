<?php

use CodeUnion\CodeUnion;

if (isset($block) || isset($args)) :
	if (isset($block)) {
		$id = 'contactForm-' . $block['id'];
		$is_active = get_field('is_active');
		$anchor_name = get_field('anchor_name');
		$padding_top = get_field('padding_top');
		$padding_bottom = get_field('padding_bottom');
		$alignment = get_field('settings_a_alignment');
		$color_scheme = get_field('cs_background_color');
		$heading_text = get_field('heading_text');
		$heading_type = get_field('heading_type');
		$text = get_field('text');
		$show_contact_info = get_field('show_contact_info');
		$map_iframe = get_field('map_iframe');
		$cf7_shortcode = get_field('cf7_shortcode');
	} else {
		$id = 'contactForm-' . uniqid();
		$is_active = $args['is_active'];
		$anchor_name = $args['anchor_name'];
		$padding_top = $args['padding_top'];
		$padding_bottom = $args['padding_bottom'];
		$alignment = $args['settings_a_alignment'];
		$color_scheme = $args['cs_background_color'];
		$heading_text = $args['heading_text'];
		$heading_type = $args['heading_type'];
		$text = $args['text'];
		$show_contact_info = $args['show_contact_info'];
		$map_iframe = $args['map_iframe'];
		$cf7_shortcode = $args['cf7_shortcode'];
	}
	if (!empty($anchor_name)) {
		$id = $anchor_name;
	}

	if ($show_contact_info) {
		$company_info = get_field('s_contact_company_info', 'option');
	}

	$spacing_classes = (new CodeUnion)->getSpacingClasses($padding_top, $padding_bottom);

	if (isset($block['data']['preview_image_help'])) :
		echo '<img src="' . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
	elseif ($is_active) : ?>
		<section
				class="contactForm contactForm--<?= $color_scheme ?> <?= $spacing_classes ?>"
				id="<?= $id; ?>">
			<div class="contactForm__wrapper container">
				<div class="contactForm__helper contactForm__helper--<?= $alignment ?>">
					<div class="contactForm__content">
						<div class="contactForm__contentBox">
							<?php if (!empty($heading_text) && !empty($heading_type)) : ?>
								<div class="contactForm__heading">
									<?php (new CodeUnion)->getHeading($heading_type, $heading_text, 'contactForm__headingItem') ?>
								</div>
							<?php endif ?>
							<?php if (!empty($text)) : ?>
								<div class="contactForm__text">
									<?= $text ?>
								</div>
							<?php endif ?>
							<?php if ($show_contact_info) : ?>
								<?php if (!empty($company_info)) : ?>
									<div class="contactForm__info">
										<?php if (!empty($company_info['company_phone'])) : ?>
											<div class="contactForm__infoItem">
												<div class="contactForm__infoIcon">
													<img src="<?= get_template_directory_uri() ?>/public/img/icons/phone-solid-full.svg"
														 alt="<?= __('Phone icon', 'codeunion') ?>"
														 aria-hidden="true"
														 class="contactForm__infoIconImage style-svg">
												</div>
												<?php (new CodeUnion)->getLink($company_info['company_phone'], 'contactForm__infoLink') ?>
											</div>
										<?php endif ?>
										<?php if (!empty($company_info['company_mail'])) : ?>
											<div class="contactForm__infoItem">
												<div class="contactForm__infoIcon">
													<img src="<?= get_template_directory_uri() ?>/public/img/icons/envelope-solid-full.svg"
														 alt="<?= __('Phone icon', 'codeunion') ?>"
														 aria-hidden="true"
														 class="contactForm__infoIconImage style-svg">
												</div>
												<?php (new CodeUnion)->getLink($company_info['company_mail'], 'contactForm__infoLink') ?>
											</div>
										<?php endif ?>
										<?php if (!empty($company_info['company_address'])) : ?>
											<div class="contactForm__infoItem">
												<div class="contactForm__infoIcon">
													<img src="<?= get_template_directory_uri() ?>/public/img/icons/location-dot-solid-full.svg"
														 alt="<?= __('Phone icon', 'codeunion') ?>"
														 aria-hidden="true"
														 class="contactForm__infoIconImage style-svg">
												</div>
												<div class="contactForm__infoText">
													<?= $company_info['company_address'] ?>
												</div>
											</div>
										<?php endif ?>
									</div>
								<?php endif ?>
							<?php endif ?>
						</div>
						<?php if (!empty($map_iframe)) : ?>
							<div class="contactForm__map">
								<?= $map_iframe ?>
							</div>
						<?php endif ?>
					</div>
					<div class="contactForm__form">
						<?php if (!empty($cf7_shortcode)) : ?>
							<?= do_shortcode($cf7_shortcode) ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif;
endif;