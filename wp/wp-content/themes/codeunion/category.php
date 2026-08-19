<?php

get_header();

$category = get_queried_object();
$category_id = $category->term_id;

?>

	<main class="page">
		<div class="category">
			<div class="category__header">
				<?php get_template_part('templates/blog/category/header'); ?>
			</div>
			<div class="category__content">
				<?php get_template_part('templates/blog/category/listing'); ?>
			</div>
		</div>
	</main>
<?php wp_reset_postdata(); ?>
<?php get_footer();

