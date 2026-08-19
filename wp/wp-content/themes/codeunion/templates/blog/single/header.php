<?php

global $post;

$s_post_image = get_field('s_post_image', $post->ID);
$s_post_author = get_field('s_post_author', $post->ID);

if (!empty($s_post_image)) {
	$post_image_url = $s_post_image['url'];
} else {
	$post_image_url = get_template_directory_uri() . '/public/img/placeholder.png';
}

$post_category = get_the_category($post->ID);

if (!empty($post_category) && !is_wp_error($post_category)) {
	$category = $post_category[0];
	$category_name = $category->name;
	$category_link = get_category_link($category->term_id);
}

?>

<div class="singleHeader">
	<div class="singleHeader__image">
		<img src="<?= $post_image_url ?>"
			 alt="<?= get_the_title() ?>"
			 class="singleHeader__imageItem">
	</div>
	<div class="singleHeader__content">
		<div class="singleHeader__info">
			<div class="singleHeader__date">
				<img src="<?= get_template_directory_uri() ?>/public/img/icons/calendar-solid-full.svg"
					 alt="<?= __('Calendar icon', 'codeunion') ?>"
					 aria-hidden="true"
					 class="singleHeader__dateIcon">
				<span>
					<?= get_the_date('d.m.Y'); ?>
				</span>
			</div>
			<div class="singleHeader__author">
				<?= (!empty($s_post_author)) ? $s_post_author : __('Admin', 'codeunion') ?>
			</div>
		</div>
		<?php if (!empty($category_name) && !empty($category_link)) : ?>
			<div class="singleHeader__category">
				<a href="<?= esc_url($category_link) ?>" class="button button--primary singleHeader__categoryBtn">
					<?= esc_html($category_name) ?>
				</a>
			</div>
		<?php endif ?>
	</div>
</div>