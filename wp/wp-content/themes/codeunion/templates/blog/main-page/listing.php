<?php

use CodeUnion\CodeUnion;

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page') ?? 12;
$order = 'DESC';
if (isset($_GET['sort']) && $_GET['sort'] === 'asc') {
	$order = 'ASC';
}

if (!empty($args) && !empty($args['latest_post_id'])) {
	$excluded_post_id = $args['latest_post_id'];
	$query = new WP_Query([
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'post__not_in' => [$excluded_post_id],
			'paged' => $paged,
			'order' => $order,
	]);
} else {
	$query = new WP_Query([
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'paged' => $paged,
			'order' => $order,
	]);
}


?>

	<div class="categoryListing">
		<div class="categoryListing__wrapper container">
			<div class="categoryListing__helper">

				<div class="categoryListing__header">
					<div class="categoryListing__actions">
						<?php get_template_part('includes/components/category-picker'); ?>
						<?php if ($query->have_posts()) : ?>
							<?php get_template_part('includes/components/sort-component'); ?>
						<?php endif ?>
					</div>
				</div>

				<?php if ($query->have_posts()) : ?>

					<div class="categoryListing__tiles">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<div class="categoryListing__tile">
								<?php get_template_part("includes/components/post-tile-detailed", null, ['post_id' => get_the_ID()]); ?>
							</div>
						<?php endwhile ?>
					</div>


					<div class="pagination">
						<?php the_posts_pagination(array(
								'prev_text' => '<span aria-label="' . __('Previous page', 'codeunion') . '"><img src="' . get_template_directory_uri() . '/public/img/icons/chevron-left-solid-full.svg" alt="' . __('Previous page', 'codeunion') . '" class="style-svg"></span>',
								'next_text' => '<span aria-label="' . __('Next page', 'codeunion') . '"><img src="' . get_template_directory_uri() . '/public/img/icons/chevron-right-solid-full.svg" alt="' . __('Next page', 'codeunion') . '" class="style-svg"></span>',
						)); ?>
					</div>
				<?php else : ?>
					<div class="categoryListing__empty">
						<?= __('There is no articles here yet!.', 'codeunion') ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>

<?php wp_reset_postdata();