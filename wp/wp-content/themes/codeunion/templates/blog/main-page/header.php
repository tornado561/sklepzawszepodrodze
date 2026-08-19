<?php

use CodeUnion\CodeUnion;

$s_blog_main_page_heading = get_field('s_blog_main_page_heading', 'option');
$s_blog_main_page_hero_text = get_field('s_blog_main_page_hero_text', 'option');

$s_breadcrumbs_blog_page = get_field('s_breadcrumbs_blog_page', 'option');

$breadcrumbs = [];
if ($s_breadcrumbs_blog_page) {
	$breadcrumbs[] = ['link' => ['url' => $s_breadcrumbs_blog_page['url'], 'title' => $s_breadcrumbs_blog_page['title']]];
}

?>

<section class="categoryHeader">
	<div class="categoryHeader__wrapper container">
		<div class="categoryHeader__helper">

			<div class="categoryHeader__breadcrumbs">
				<?php if (!empty($breadcrumbs)) : ?>
					<?php (new CodeUnion)->getBreadcrumbs($breadcrumbs) ?>
				<?php endif ?>
			</div>

			<div class="categoryHeader__content">
				<?php if (!empty($s_blog_main_page_heading)) : ?>
					<div class="categoryHeader__heading">
						<?php (new CodeUnion)->getHeading('h1', $s_blog_main_page_heading, 'categoryHeader__headingItem') ?>
					</div>
				<?php endif ?>
				<?php if (!empty($s_blog_main_page_hero_text)) : ?>
					<div class="categoryHeader__text">
						<?= $s_blog_main_page_hero_text ?>
					</div>
				<?php endif ?>
			</div>

		</div>
	</div>
</section>