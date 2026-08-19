<?php

use CodeUnion\CodeUnion;

$category = get_queried_object();
$category_name = $category->name;
$category_id = $category->term_id;


?>

<div class="categoryListing">
	<div class="categoryListing__wrapper container">
		<div class="categoryListing__helper">

			<div class="categoryListing__header">
				<div class="categoryListing__actions">
					<?php get_template_part('includes/components/category-picker'); ?>
					<?php if (have_posts()) : ?>
						<?php get_template_part('includes/components/sort-component'); ?>
					<?php endif ?>
				</div>
			</div>

			<?php if (have_posts()) : ?>

				<div class="categoryListing__tiles">
					<?php while (have_posts()) : the_post(); ?>
						<div class="categoryListing__tile">
							<?php get_template_part("includes/components/post-tile", null, ['post_id' => get_the_ID()]); ?>
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