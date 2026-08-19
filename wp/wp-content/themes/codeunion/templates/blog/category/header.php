<?php

use CodeUnion\CodeUnion;

$category = get_queried_object();
$category_name = $category->name;
$category_description = $category->description;
$category_id = $category->term_id;
$category_link = get_category_link($category_id);

$s_breadcrumbs_blog_page = get_field('s_breadcrumbs_blog_page', 'option');

$breadcrumbs = [];
if ($s_breadcrumbs_blog_page) {
	$breadcrumbs[] = ['link' => ['url' => $s_breadcrumbs_blog_page['url'], 'title' => $s_breadcrumbs_blog_page['title']]];
}
if ($category_name && $category_link) {
	$breadcrumbs[] = ['link' => ['url' => $category_link, 'title' => $category_name]];
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
				<?php if (!empty($category_name)) : ?>
					<div class="categoryHeader__heading">
						<?php (new CodeUnion)->getHeading('h1', $category_name, 'categoryHeader__headingItem') ?>
					</div>
				<?php endif ?>
				<?php if (!empty($category_description)) : ?>
					<div class="categoryHeader__text">
						<?= $category_description ?>
					</div>
				<?php endif ?>
			</div>

		</div>
	</div>
</section>