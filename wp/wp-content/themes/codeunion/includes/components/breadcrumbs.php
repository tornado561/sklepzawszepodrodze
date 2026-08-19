<?php if (!empty($args)) : ?>

	<?php
	$breadcrumbs = $args['breadcrumbs'];

	$homeLinkArr = [];
	$homeLinkArr['url'] = get_home_url() . '/';
	$homeLinkArr['title'] = __('Strona Główna', 'codeunion');
	$counter = 1;

	?>

	<?php if (!empty($breadcrumbs)) : ?>
		<ul class="breadcrumbs">
			<li class="breadcrumbs__item">
				<a class="breadcrumbs__link" href="<?= $homeLinkArr['url'] ?>">
					<?= $homeLinkArr['title'] ?>
				</a>
				<img aria-hidden="true"
					 class="breadcrumbs__arrow style-svg"
					 src="<?= get_template_directory_uri() . '/public/img/icons/chevron-right-solid-full.svg' ?>"
					 alt="">
			</li>

			<?php foreach ($breadcrumbs as $item) : ?>
				<li class="breadcrumbs__item">
					<?php if ($counter === count($breadcrumbs)) : ?>
						<span class="breadcrumbs__text">
							<?= $item['link']['title'] ?>
						</span>
					<?php else : ?>
						<a class="breadcrumbs__link" href="<?= $item['link']['url'] ?>">
							<?= $item['link']['title'] ?>
						</a>
						<img aria-hidden="true"
							 class="breadcrumbs__arrow style-svg"
							 src="<?= get_template_directory_uri() . '/public/img/icons/chevron-right-solid-full.svg' ?>"
							 alt="">
					<?php endif ?>
				</li>
				<?php $counter++ ?>
			<?php endforeach ?>

		</ul>

	<?php endif ?>
<?php endif;