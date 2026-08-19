<?php

$latest_post_id = get_posts([
		'numberposts' => 1,
		'orderby' => 'date',
		'order' => 'DESC',
		'fields' => 'ids',
])[0];

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

get_header();
?>

	<main class="page">
		<div class="category">
			<div class="category__header">
				<?php get_template_part('templates/blog/main-page/header'); ?>
			</div>
			<div class="category__content">
				<?php if ($paged == 1) : ?>
					<?php get_template_part('templates/blog/main-page/first-post', null, ['latest_post_id' => $latest_post_id]); ?>
				<?php endif ?>
				<?php get_template_part('templates/blog/main-page/listing', null, ['latest_post_id' => $latest_post_id]); ?>
			</div>
	</main>

<?php get_footer();