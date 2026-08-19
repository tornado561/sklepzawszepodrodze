<?php
$header_nav = apply_filters('wpa_get_menu', [], 'header_nav');
?>


<nav class="navbar" data-navbar aria-label="<?= __('Main navigation menu', 'codeunion') ?>" id="primary-menu">
	<div class="navbar__wrapper">
		<?php if (!empty($header_nav)) : ?>
			<div class="navbar__menu" data-menu>
				<ul class="navbar__menuList">
					<?php $counter = 0 ?>
					<?php foreach ($header_nav as $menuItem) : ?>
						<li class="navbar__menuListItem" <?= (!empty($menuItem['children'])) ? 'data-nav-elem' : '' ?>>

							<?php if (!($menuItem['url'] == '#' && !empty($menuItem['children']))) : ?>
								<a href="<?= $menuItem['url'] ?>" class="navbar__menuListLink">
									<?= $menuItem['title'] ?>
								</a>
							<?php endif ?>

							<?php if (!empty($menuItem['children'])) : ?>
								<?php $label = __('Trigger', 'codeunion') . ' ' . $menuItem['title'] . ' ' . __('submenu', 'codeunion') ?>
								<button aria-label="<?= $label ?>"
										role="button"
										aria-haspopup="menu"
										aria-expanded="false"
										aria-controls="submenu-<?= $counter ?>"
										data-trigger
										class="navbar__menuListLinkBtn">
									<?php if ($menuItem['url'] == '#') : ?>
										<span class="navbar__menuListText">
										<?= $menuItem['title'] ?>
									</span>
									<?php endif ?>
									<span aria-hidden="true" class="navbar__menuListLinkIcon">
										<img src="<?= get_template_directory_uri() . '/public/img/icons/chevron-down-solid-full.svg' ?>"
											 alt=""
											 class="style-svg">
									</span>
								</button>
							<?php endif ?>

							<?php if (!empty($menuItem['children'])) : ?>
								<ul class="navbar__subMenu"
									aria-hidden="true"
									role="menu"
									id="submenu-<?= $counter ?>"
									data-submenu>
									<?php foreach ($menuItem['children'] as $secondMenuItem) : ?>
										<li class="navbar__subMenuItem" role="menuitem">
											<a href="<?= $secondMenuItem['url'] ?>" class="navbar__subMenuLink">
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
		<?php endif ?>
	</div>
</nav>
