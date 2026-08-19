<?php

use CodeUnion\CodeUnion;

$header_nav = apply_filters('wpa_get_menu', [], 'header_nav');
$s_header_cta_link = get_field('s_header_cta_link', 'option');
$s_header_cta_color = get_field('s_header_cta_color', 'option');

?>


<div class="mobileNav"
	 id="mobile-menu"
	 data-active="false"
	 aria-hidden="true"
	 data-navbar-mob>

	<div class="mobileNav__menu" data-menu-mob>
		<ul class="mobileNav__menuList">
			<?php $counter = 0 ?>
			<?php foreach ($header_nav as $menuItem) : ?>
				<li class="mobileNav__menuListItem" <?= (!empty($menuItem['children'])) ? 'data-nav-elem aria-haspopup="menu" aria-expanded="false" aria-controls="submenu-mob-' . $counter . '"' : '' ?>>
					<?php if (!($menuItem['url'] == '#' && !empty($menuItem['children']))) : ?>
						<a href="<?= $menuItem['url'] ?>" class="mobileNav__menuListLink">
							<?= $menuItem['title'] ?>
						</a>
					<?php endif ?>

					<?php if (!empty($menuItem['children'])) : ?>
						<?php $label = __('Trigger', 'codeunion') . ' ' . $menuItem['title'] . ' ' . __('submenu', 'codeunion') ?>
						<button aria-label="<?= $label ?>"
								role="button"
								data-trigger
								class="mobileNav__menuListLinkBtn<?= ($menuItem['url'] == '#') ? ' mobileNav__menuListLinkBtn--full' : '' ?>">
							<?php if ($menuItem['url'] == '#') : ?>
								<span class="navbar__menuListText">
										<?= $menuItem['title'] ?>
									</span>
							<?php endif ?>
							<span aria-hidden="true" class="mobileNav__menuListLinkIcon">
									<img src="<?= get_template_directory_uri() . '/public/img/icons/chevron-down-solid-full.svg' ?>"
										 alt=""
										 class="style-svg">
								</span>
						</button>
					<?php endif ?>


					<?php if (!empty($menuItem['children'])) : ?>
						<ul class="mobileNav__subMenu"
							aria-hidden="true"
							role="menu"
							id="submenu-mob-<?= $counter ?>"
							data-submenu>
							<?php foreach ($menuItem['children'] as $secondMenuItem) : ?>
								<li class="mobileNav__subMenuItem">
									<a href="<?= $secondMenuItem['url'] ?>" class="mobileNav__subMenuLink">
										<?= $secondMenuItem['title'] ?>
									</a>
								</li>
							<?php endforeach ?>
						</ul>
					<?php endif ?>
				</li>
				<?php $counter++ ?>
			<?php endforeach ?>
		</ul>


	</div>
	<?php if (!empty($s_header_cta_link) && !empty($s_header_cta_color)) : ?>
		<?php (new CodeUnion)->getLink($s_header_cta_link, 'button button--' . $s_header_cta_color) ?>
	<?php endif ?>

</div>
