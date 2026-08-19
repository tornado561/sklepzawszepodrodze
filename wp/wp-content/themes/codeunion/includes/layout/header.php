<?php

use CodeUnion\CodeUnion;

$s_header_logo = get_field('s_header_logo', 'option');
$s_header_cta_link = get_field('s_header_cta_link', 'option');
$s_header_cta_color = get_field('s_header_cta_color', 'option');
?>

<header class="header" data-header>
	<div class="header__wrapper container">
		<div class="header__helper">
			<?php if (!empty($s_header_logo)) : ?>
				<a href="<?= get_home_url() ?>/" class="header__logo">
					<img src="<?= $s_header_logo['url'] ?>"
						 alt="<?= $s_header_logo['alt'] ?>"
						 class="header__logoItem">
				</a>
			<?php endif ?>
			<div class="header__content">
				<?php get_template_part('includes/layout/navbar'); ?>
			</div>
			<div class="header__side">
				<div class="header__cta">
					<?php if (!empty($s_header_cta_link) && !empty($s_header_cta_color)) : ?>
						<?php (new CodeUnion)->getLink($s_header_cta_link, 'button button--' . $s_header_cta_color) ?>
					<?php endif ?>
				</div>

				<div class="header__mobileActions">
					<button role="button"
							class="header__triggerBtn"
							data-active="false"
							aria-haspopup="menu"
							aria-controls="mobile-menu"
							aria-expanded="false"
							aria-label="<?= __('Menu trigger', 'codeunion') ?>"
							data-mobile-nav-trigger>
					<span aria-hidden="true" class="header__triggerBtnOpen">
						<img src="<?= get_template_directory_uri() ?>/public/img/icons/bars-solid-full.svg"
							 alt=""
							 class="style-svg">
					</span>
						<span aria-hidden="true" class="header__triggerBtnClose">
						<img src="<?= get_template_directory_uri() ?>/public/img/icons/xmark-solid-full.svg"
							 alt=""
							 class="style-svg">
					</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part('includes/layout/mobile-navbar'); ?>
</header>

<div class="headerSeparate"></div>