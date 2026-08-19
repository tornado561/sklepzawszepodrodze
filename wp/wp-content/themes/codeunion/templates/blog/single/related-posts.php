<?php

use CodeUnion\CodeUnion;

$current_post_id = get_the_ID();
$categories = get_the_category($current_post_id);
$category_ids = [];

if ($categories) {
	foreach ($categories as $cat) {
		$category_ids[] = $cat->term_id;
	}
}

$args = [
		'post_type' => 'post',
		'posts_per_page' => 3,
		'post__not_in' => [$current_post_id],
		'category__in' => $category_ids,
		'orderby' => 'date',
		'order' => 'DESC',
];

$related_posts = new WP_Query($args);

?>

<?php if ($related_posts->have_posts()): ?>
	<section class="relatedPosts">
		<div class="relatedPosts__wrapper">
			<div class="relatedPosts__helper">
				<div class="relatedPosts__heading">
					<?php (new CodeUnion)->getHeading('h2', __('More articles', 'codeunion'), 'relatedPosts__headingItem') ?>
				</div>
				<div class="relatedPosts__tiles">
					<?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
						<div class="relatedPosts__tile">
							<?php get_template_part("includes/components/post-tile", null, ['post_id' => get_the_ID()]); ?>
						</div>
					<?php endwhile ?>
				</div>
			</div>
		</div>
	</section>
	<?php wp_reset_postdata() ?>
<?php endif;
